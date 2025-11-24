# Posts Publish Permission Implementation

Implementasi permission-based publishing untuk modul Post menggunakan Laravel Spatie Permission.

## 🔄 Changes Summary

| Component | Change |
|-----------|--------|
| **Permission** | Added `posts.publish` permission via `PostPermissionSeeder` |
| **Views** | Hidden "Published" status option in create/edit forms for users without permission |
| **Controller** | Added server-side validation to prevent unauthorized publishing |

## 🛠️ Implementation Details

### 1. Permission Setup
The `posts.publish` permission already existed in `PostPermissionSeeder.php` and was seeded to the database.

### 2. View Changes
Updated both `posts/create.blade.php` and `posts/edit.blade.php`:

**Before:**
```blade
<option value="published">Published</option>
```

**After:**
```blade
@can('posts.publish')
<option value="published">Published</option>
@endcan
```

The "Published" option is now only visible to users with the `posts.publish` permission.

### 3. Controller Validation
Added permission checks in `PostController`:

**Store Method:**
```php
if ($request->status === 'published' && !Auth::user()->can('posts.publish')) {
    return back()->withErrors(['status' => 'You do not have permission to publish posts.'])->withInput();
}
```

**Update Method:**
```php
if ($request->status === 'published' && !Auth::user()->can('posts.publish')) {
    return back()->withErrors(['status' => 'You do not have permission to publish posts.'])->withInput();
}
```

This prevents users from bypassing the UI restriction by directly submitting the form.

## 📸 Testing

### Test Case 1: User WITHOUT `posts.publish` permission
1. Login as a user without the permission
2. Visit `/admin/posts/create`
3. **Expected:** "Published" option is hidden in the Status dropdown
4. Only "Draft" and "Archived" options are available

### Test Case 2: User WITH `posts.publish` permission
1. Login as an admin or user with the permission
2. Visit `/admin/posts/create`
3. **Expected:** All status options (Draft, Published, Archived) are visible

### Test Case 3: Direct Form Submission
1. As a user without permission, try to submit status=published via form manipulation
2. **Expected:** Error message "You do not have permission to publish posts."
