<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\RoleHasPermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RolesExport;

class RoleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('check.permission:manage role');
    // }

    // Display all roles with filtering and sorting
    public function index(Request $request)
    {
        $query = Role::query();

        // Apply filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('created_from')) {
            $query->whereDate('created_at', '>=', $request->created_from);
        }
        if ($request->filled('created_to')) {
            $query->whereDate('created_at', '<=', $request->created_to);
        }

        // Apply sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $order = $request->get('order', 'desc');

        // Validate sort column to prevent SQL injection
        $allowedSortColumns = ['id', 'name', 'created_at'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }

        $query->orderBy($sortBy, $order);

        // Get paginated results
        $roles = $query->paginate(15)->withQueryString();

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
            'redirect' => route('admin.roles.index')
        ]); 
    }

    // Edit a role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.create', compact('role'));
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

        $role->update(['name' => $request->name]);

        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully.',
            'redirect' => route('admin.roles.index')
        ]); 
    }

    // Delete a role
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully.',
            'redirect' => route('admin.roles.index')
        ]); 
    }

    // Assign permissions to a role
    public function assignPermissions($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::all();
        $assignedPermissions = $role->permissions->pluck('id')->toArray();
        
        return view('admin.roles.assignpage', compact('role', 'permissions', 'assignedPermissions'));
    }

    // Store assigned permissions
    public function storeAssignedPermissions(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permissions ?? []);
        
        return redirect()->route('admin.roles.assignPermissions', $roleId)->with('success', 'Permissions assigned successfully.');
    }

    /**
     * Export roles based on filters
     */
    public function export(Request $request)
    {
        try {
            $type = $request->get('type', 'excel');
            $extension = $type === 'excel' ? 'xlsx' : 'csv';
            $fileName = 'roles_' . date('Y-m-d_H-i-s') . '.' . $extension;
            
            return Excel::download(new RolesExport($request), $fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export roles: ' . $e->getMessage());
        }
    }
}
