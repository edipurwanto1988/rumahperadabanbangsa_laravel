<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PageObserver
{
    /**
     * Handle the Page "created" event.
     */
    public function created(Page $page): void
    {
        $this->logActivity('created', $page, "Created page '{$page->title}'");
    }

    /**
     * Handle the Page "updated" event.
     */
    public function updated(Page $page): void
    {
        $changes = $page->getChanges();
        // Remove updated_at from changes if it's the only change
        if (count($changes) === 1 && isset($changes['updated_at'])) {
            return;
        }
        
        $this->logActivity('updated', $page, "Updated page '{$page->title}'", [
            'old' => array_intersect_key($page->getOriginal(), $changes),
            'new' => $changes,
        ]);
    }

    /**
     * Handle the Page "deleted" event.
     */
    public function deleted(Page $page): void
    {
        $this->logActivity('deleted', $page, "Deleted page '{$page->title}'", [
            'old' => $page->toArray()
        ]);
    }

    protected function logActivity(string $action, Page $page, string $description, ?array $properties = null): void
    {
        if (!Auth::check()) {
            return;
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'subject_type' => get_class($page),
            'subject_id' => $page->id,
            'description' => $description,
            'properties' => $properties,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
