<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'icon',
        'parent_id',
        'page_id',
        'order_no',
        'is_active',
        'type'
    ];

    protected $appends = ['resolved_url'];

    protected $casts = [
        'is_active' => 'boolean',
        'order_no' => 'integer',
    ];

    /**
     * Get the resolved URL for the menu.
     */
    public function getResolvedUrlAttribute()
    {
        if ($this->page_id && $this->page) {
            return route('pages.show', $this->page->slug);
        }

        return $this->url;
    }

    /**
     * Get the page linked to the menu.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Get the parent menu.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Get the children menus.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')
                    ->orderBy('order_no', 'asc');
    }

    /**
     * Get all descendants (children, grandchildren, etc.).
     */
    public function descendants(): HasMany
    {
        return $this->children()->with('descendants');
    }

    /**
     * Get all ancestors (parent, grandparent, etc.).
     */
    public function ancestors()
    {
        $ancestors = collect();
        $parent = $this->parent;

        while ($parent) {
            $ancestors->prepend($parent);
            $parent = $parent->parent;
        }

        return $ancestors;
    }

    /**
     * Get root menus (menus without parent).
     */
    public static function roots()
    {
        return self::whereNull('parent_id')
                   ->where('is_active', true)
                   ->orderBy('order_no', 'asc')
                   ->with('children')
                   ->get();
    }

    /**
     * Get menu tree structure.
     */
    public static function tree()
    {
        return self::whereNull('parent_id')
                   ->where('is_active', true)
                   ->with(['children' => function($query) {
                       $query->where('is_active', true)->orderBy('order_no', 'asc');
                   }])
                   ->orderBy('order_no', 'asc')
                   ->get();
    }

    /**
     * Check if menu has children.
     */
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    /**
     * Get the depth level of the menu.
     */
    public function getDepthAttribute()
    {
        return $this->ancestors()->count();
    }

    /**
     * Get the full path with separators.
     */
    public function getFullPathAttribute()
    {
        $path = $this->ancestors()->pluck('title')->push($this->title);
        return $path->implode(' > ');
    }

    /**
     * Scope a query to only include active menus.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include menus of a specific type.
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to order by order_no.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_no', 'asc');
    }

    /**
     * Get the next order number for siblings.
     */
    public static function getNextOrder($parentId = null)
    {
        $maxOrder = self::where('parent_id', $parentId)
                       ->max('order_no');
        
        return $maxOrder ? $maxOrder + 1 : 1;
    }

    /**
     * Reorder siblings after this menu is deleted or moved.
     */
    public static function reorderSiblings($parentId = null, $startOrder = 1)
    {
        $siblings = self::where('parent_id', $parentId)
                       ->orderBy('order_no', 'asc')
                       ->get();

        foreach ($siblings as $index => $sibling) {
            $sibling->update(['order_no' => $startOrder + $index]);
        }
    }
}