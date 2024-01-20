<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Role $role)
    {
        $roles = Role::query()
        ->get();

        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->save();

        return redirect()->route('role.index');
    }

    public function delete (Role $role)
    {
        $role->delete();
        return redirect()->route('role.index');
    }

    public function show(Role $role)
    {
        $assignedPermissionsIds = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::whereNotIn('id', $assignedPermissionsIds)->get();
        
        return view('admin.role.show', ['role' => $role, 'permissions' => $permissions]);
    }
    
    public function revokePermission(Role $role, Permission $permission)
    {
        $role->permissions()->detach($permission->id);
        return back();
    }
    
    public function assign(User $user, Request $request)
    {
        $role = Role::findOrFail($request->input('role_id')); 
        $user->roles()->attach($role); 
        return redirect()->route('permissions.create', $user->id)->with('success', 'Мы добавили ему роль');
    }

    public function revoke(User $user, Role $role)
    {
        $user->roles()->detach($role->id);
        return back();
    }
}
