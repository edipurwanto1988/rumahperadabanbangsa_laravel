<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display settings page with tabs
     */
    public function index()
    {
        $groups = Setting::getGroups();
        
        $settings = [];
        foreach ($groups as $group) {
            $settings[$group] = Setting::getByGroup($group);
        }

        return view('admin.settings.index', compact('groups', 'settings'));
    }

    /**
     * Update settings via AJAX
     */
    public function update(Request $request)
    {
        try {
            $group = $request->input('group');
            $settingsData = $request->except(['_token', 'group']);

            foreach ($settingsData as $key => $value) {
                Setting::where('key', $key)->update(['value' => $value]);
            }

            return response()->json([
                'success' => true,
                'message' => ucfirst($group) . ' settings updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating settings: ' . $e->getMessage()
            ], 500);
        }
    }
}
