<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'icon',
        'label',
        'value',
        'type',
        'min',
        'max',
        'description',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get all unique groups
     */
    public static function getGroups()
    {
        return self::select('group')
            ->distinct()
            ->where('is_active', true)
            ->orderBy('group')
            ->pluck('group');
    }

    /**
     * Get settings by group
     */
    public static function getByGroup($group)
    {
        return self::where('group', $group)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    /**
     * Get setting value by key
     */
    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set setting value by key
     */
    public static function setValue($key, $value)
    {
        return self::where('key', $key)->update(['value' => $value]);
    }
}
