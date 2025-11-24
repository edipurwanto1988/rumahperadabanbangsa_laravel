<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $this->logActivity('created', $post, "Created post '{$post->title}'");
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $changes = $post->getChanges();
        // Remove updated_at from changes if it's the only change
        if (count($changes) === 1 && isset($changes['updated_at'])) {
            return;
        }
        
        $this->logActivity('updated', $post, "Updated post '{$post->title}'", [
            'old' => array_intersect_key($post->getOriginal(), $changes),
            'new' => $changes,
        ]);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->logActivity('deleted', $post, "Deleted post '{$post->title}'", [
            'old' => $post->toArray()
        ]);
    }

    protected function logActivity(string $action, Post $post, string $description, ?array $properties = null): void
    {
        if (!Auth::check()) {
            return;
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'subject_type' => get_class($post),
            'subject_id' => $post->id,
            'description' => $description,
            'properties' => $properties,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
