<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        $this->logActivity('created', $role, "Created role '{$role->name}'");
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        $changes = $role->getChanges();
        // Remove updated_at from changes if it's the only change
        if (count($changes) === 1 && isset($changes['updated_at'])) {
            return;
        }
        
        $this->logActivity('updated', $role, "Updated role '{$role->name}'", [
            'old' => array_intersect_key($role->getOriginal(), $changes),
            'new' => $changes,
        ]);
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        $this->logActivity('deleted', $role, "Deleted role '{$role->name}'", [
            'old' => $role->toArray()
        ]);
    }

    protected function logActivity(string $action, Role $role, string $description, ?array $properties = null): void
    {
        if (!Auth::check()) {
            return;
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'subject_type' => get_class($role),
            'subject_id' => $role->id,
            'description' => $description,
            'properties' => $properties,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
