<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function show(Request $request, $id) 
    {
        $admin = User::findOrFail($id);
        $permissions = $admin->permissions;

        return view('admin.permissions.show', compact('admin', 'permissions'));
    }


    public function create(Request $request, User $id)
    {
        $admin = User::find($request->user_id);
        $existingPermission = $admin->permissions()->pluck('id');
        $permissions = Permission::query()
        ->whereNotIn('id', $existingPermission)
        ->get();
        $adminPermissions = $admin->permissions;

        $roles = Role::whereDoesntHave('users', function ($query) use ($admin) {
            $query->where('user_id', $admin->id);
        })->get();


        return view('admin.permissions.create', compact('permissions', 'admin', 'adminPermissions', 'roles'));
    }

    public function store(Request $request, Role $role)
    {

        $user = User::findOrFail($request->input('user_id'));
        $permissions = Permission::findOrFail($request->input('permission_id'));
        $user->permissions()->syncWithoutDetaching($permissions);
        $admin = User::find($request->input('user_id'));
        $permissions = $admin->permissions;
    
        return view('admin.permissions.show', compact('admin', 'permissions'));
    }

    public function assignToRole(Request $request, Role $role)
    {
        $permission = Permission::findOrFail($request->input('permission_id'));
        $role->permissions()->syncWithoutDetaching($permission);
        $role->load('permissions');
    
        $assignedPermissionsIds = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::whereNotIn('id', $assignedPermissionsIds)->get();
    
        return view('admin.role.show', compact('role', 'permissions'));
    }
    


    public function index(Permission $permission)
    {
        //
    }

    public function edit(Permission $permission)
    {
        //
    }

    public function update(Request $request, Permission $permission)
    {
        //
    }

    public function delete(Request $request, $userId, $permissionId)
    {
        $user = User::findOrFail($userId);
        $permission = Permission::findOrFail($permissionId);

        $user->permissions()->detach($permission->id);
        return redirect()->route('permissions.show', ['id' => $user->id]);
    }
}
