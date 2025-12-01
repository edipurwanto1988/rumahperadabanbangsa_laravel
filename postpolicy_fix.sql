-- =====================================================
-- PostPolicy Fix for VPS Deployment
-- =====================================================

-- This SQL contains the updated PostPolicy.php content
-- Replace the content of app/Policies/PostPolicy.php on VPS with:

<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('Super Admin') || $user->hasRole('admin')) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('posts.view');
    }

    /**
     * Determine whether user can view model.
     */
    public function view(User $user, Post $post): bool
    {
        return $user->can('posts.view') || $user->id === $post->user_id;
    }

    /**
     * Determine whether user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('posts.create');
    }

    /**
     * Determine whether user can update model.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->can('posts.edit') && $user->id === $post->user_id;
    }

    /**
     * Determine whether user can delete model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->can('posts.delete') && $user->id === $post->user_id;
    }

    /**
     * Determine whether user can restore model.
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->can('posts.edit') && $user->id === $post->user_id;
    }

    /**
     * Determine whether user can permanently delete model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->can('posts.delete') && $user->id === $post->user_id;
    }
}

-- =====================================================
-- INSTRUCTIONS FOR VPS DEPLOYMENT:
-- 1. Replace the content of app/Policies/PostPolicy.php with the PHP code above
-- 2. Run: php artisan cache:clear
-- 3. Run: php artisan config:clear
-- 4. Run: php artisan route:clear
-- 5. Run: php artisan view:clear
-- =====================================================

-- After applying this fix:
-- Admin users can edit ANY post (regardless of ownership)
-- Regular users can only edit their OWN posts
-- This resolves the 403/404 authorization issues on VPS