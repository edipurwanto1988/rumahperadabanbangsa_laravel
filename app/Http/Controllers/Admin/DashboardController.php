<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'permission:dashboard.view']);
    }

    public function index()
    {
        // Get statistics
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalPermissions = Permission::count();
        
        // Get recent users
        $recentUsers = User::latest()->take(5)->get();
        
        // Get user distribution by role
        $userRoles = Role::withCount('users')->get();
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalRoles',
            'totalPermissions',
            'recentUsers',
            'userRoles'
        ));
    }
}