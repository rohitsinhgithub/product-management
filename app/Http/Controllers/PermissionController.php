<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\PermissionsExport;
use Maatwebsite\Excel\Facades\Excel;

class PermissionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:super admin'); // Restrict to super admin
    // }

    // Display all permissions
    public function index(Request $request)
    {
        $query = Permission::query();

        // Apply filters
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('created_from')) {
            $query->whereDate('created_at', '>=', $request->created_from);
        }

        if ($request->has('created_to')) {
            $query->whereDate('created_at', '<=', $request->created_to);
        }

        // Apply sorting
        $sortBy = $request->input('sort_by', 'created_at');
        $order = $request->input('order', 'desc');
        
        if (in_array($sortBy, ['id', 'name', 'created_at'])) {
            $query->orderBy($sortBy, $order);
        }

        // Get paginated results
        $permissions = $query->paginate(10)->withQueryString();

        return view('admin.permissions.index', compact('permissions'));
    }

    // Create a new role
    public function create()
    {
        return view('admin.permissions.create');
    }

    // Store a new role
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Permission::create(['name' => $request->name]);

        return response()->json([
            'success' => true,
            'message' => 'Permission created successfully.',
            'redirect' => route('permissions.index')
        ]); 
    }

    // Edit a role
    public function edit($id)
    {
        $permission = permission::findOrFail($id);
        return view('admin.permissions.create', compact('permission')); // Reuse the create view for editing
    }

    // Update a role
    public function update(Request $request, permission $permission)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $permission->name = $request->name;
        $permission->updated_at = now();
        $permission->save();  
       
        return response()->json([
            'success' => true,
            'message' => 'Permission Updated successfully.',
            'redirect' => route('permissions.index')
        ]); 
    }

    // Delete a role
    public function destroy(permission $permission)
    {
        $permission->delete();

        return response()->json([
            'success' => true,
            'message' => 'Permission Delete successfully.',
            'redirect' => route('permissions.index')
        ]);
    }

    /**
     * Export permissions to Excel or CSV
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        $type = $request->input('type', 'excel');
        $fileName = 'permissions_' . date('Y-m-d') . ($type == 'csv' ? '.csv' : '.xlsx');

        return Excel::download(new PermissionsExport, $fileName);
    }
}
