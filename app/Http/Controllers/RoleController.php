<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\RoleHasPermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('check.permission:manage role');
    // }

    // Display all roles
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    // Create a new role
    public function create()
    {
        return view('admin.roles.create');
    }

    // Store a new role
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Role::create(['name' => $request->name]);

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully.',
            'redirect' => route('roles.index')
        ]); 
    }

    // Edit a role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.create', compact('role')); // Reuse the create view for editing
    }

    // Update a role
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $role->name = $request->name;
        $role->updated_at = now();
        $role->save();  
       
        return response()->json([
            'success' => true,
            'message' => 'Role Updated successfully.',
            'redirect' => route('roles.index')
        ]); 
    }

    // Delete a role
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role Delete successfully.',
            'redirect' => route('roles.index')
        ]);
    }

    public function assignPermissions($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::all();
        
        // Get already assigned permissions for the role
        $assignedPermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.assignpage', compact('role', 'permissions', 'assignedPermissions'));
    }

    public function storeAssignedPermissions(Request $request, $roleId)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'permissions' => 'array|nullable',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Find the role
        $role = Role::findOrFail($roleId);

        // Sync the role's permissions with the submitted ones
        if (isset($validated['permissions'])) {
            // Detach any permissions that are not selected
            $role->permissions()->sync($validated['permissions']);
        } else {
            // If no permissions are selected, we can detach all
            $role->permissions()->sync([]);
        }

        // Redirect back with success message
        return redirect()->route('roles.assignPermissions', $roleId)->with('success', 'Permissions assigned successfully.');
    }   
}
