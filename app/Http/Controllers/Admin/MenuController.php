<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'permission:menus.view'])->only('index', 'show', 'tree', 'reorder');
        $this->middleware(['auth', 'permission:menus.create'])->only('create', 'store');
        $this->middleware(['auth', 'permission:menus.edit'])->only('edit', 'update');
        $this->middleware(['auth', 'permission:menus.delete'])->only('destroy');
    }

    /**
     * Display a listing of the menus with tree structure.
     */
    public function index()
    {
        $menus = Menu::tree();
        $allMenus = Menu::with('parent')->ordered()->get();
        
        return view('admin.menus.index', compact('menus', 'allMenus'));
    }

    /**
     * Show the form for creating a new menu.
     */
    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')->active()->ordered()->get();
        $allMenus = Menu::active()->ordered()->get();
        $pages = \App\Models\Page::where('status', 'published')->get();
        
        return view('admin.menus.create', compact('parentMenus', 'allMenus', 'pages'));
    }

    /**
     * Store a newly created menu in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:150',
            'url' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'parent_id' => 'nullable|exists:menus,id',
            'page_id' => 'nullable|exists:pages,id',
            'type' => 'required|in:link,label,divider',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $orderNo = $request->parent_id 
                ? Menu::getNextOrder($request->parent_id)
                : Menu::getNextOrder();

            $menu = Menu::create([
                'title' => $request->title,
                'url' => $request->url,
                'icon' => $request->icon,
                'parent_id' => $request->parent_id,
                'page_id' => $request->page_id,
                'order_no' => $orderNo,
                'type' => $request->type,
                'is_active' => $request->is_active ?? true,
            ]);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Menu created successfully.',
                    'menu' => $menu->load('parent')
                ]);
            }

            return redirect()->route('admin.menus.index')
                ->with('success', 'Menu created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create menu: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to create menu: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified menu.
     */
    public function show(Menu $menu)
    {
        $menu->load(['parent', 'children' => function($query) {
            $query->ordered();
        }]);

        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')
                          ->where('id', '!=', $menu->id)
                          ->active()
                          ->ordered()
                          ->get();
        
        $allMenus = Menu::active()
                       ->where('id', '!=', $menu->id)
                       ->ordered()
                       ->get();

        $pages = \App\Models\Page::where('status', 'published')->get();

        return view('admin.menus.edit', compact('menu', 'parentMenus', 'allMenus', 'pages'));
    }

    /**
     * Update the specified menu in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:150',
            'url' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'parent_id' => 'nullable|exists:menus,id|not_in:' . $menu->id,
            'page_id' => 'nullable|exists:pages,id',
            'type' => 'required|in:link,label,divider',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $oldParentId = $menu->parent_id;
            $newParentId = $request->parent_id;

            // Update menu
            $menu->update([
                'title' => $request->title,
                'url' => $request->url,
                'icon' => $request->icon,
                'parent_id' => $newParentId,
                'page_id' => $request->page_id,
                'type' => $request->type,
                'is_active' => $request->is_active ?? true,
            ]);

            // Reorder old siblings if parent changed
            if ($oldParentId !== $newParentId) {
                Menu::reorderSiblings($oldParentId);
                
                // Update order for new position
                $newOrder = $newParentId 
                    ? Menu::getNextOrder($newParentId)
                    : Menu::getNextOrder();
                $menu->update(['order_no' => $newOrder]);
            }

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Menu updated successfully.',
                    'menu' => $menu->load('parent')
                ]);
            }

            return redirect()->route('admin.menus.index')
                ->with('success', 'Menu updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update menu: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to update menu: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified menu from storage.
     */
    public function destroy(Menu $menu)
    {
        DB::beginTransaction();
        try {
            $parentId = $menu->parent_id;
            
            // Move children to parent or make them root
            if ($menu->hasChildren()) {
                $menu->children()->update(['parent_id' => $parentId]);
            }

            $menu->delete();

            // Reorder siblings
            Menu::reorderSiblings($parentId);

            DB::commit();

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Menu deleted successfully.'
                ]);
            }

            return redirect()->route('admin.menus.index')
                ->with('success', 'Menu deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete menu: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.menus.index')
                ->with('error', 'Failed to delete menu: ' . $e->getMessage());
        }
    }

    /**
     * Reorder menus via drag and drop.
     */
    public function reorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menus' => 'required|array',
            'menus.*.id' => 'required|exists:menus,id',
            'menus.*.parent_id' => 'nullable|exists:menus,id',
            'menus.*.order_no' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            foreach ($request->menus as $menuData) {
                $menu = Menu::find($menuData['id']);
                $menu->update([
                    'parent_id' => $menuData['parent_id'],
                    'order_no' => $menuData['order_no'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Menus reordered successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to reorder menus: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get menu tree structure for AJAX requests.
     */
    public function tree()
    {
        $menus = Menu::tree();
        
        return response()->json([
            'success' => true,
            'menus' => $menus
        ]);
    }

    /**
     * Toggle menu active status.
     */
    public function toggle(Menu $menu)
    {
        $menu->update(['is_active' => !$menu->is_active]);

        return response()->json([
            'success' => true,
            'message' => 'Menu status updated successfully.',
            'is_active' => $menu->is_active
        ]);
    }
}