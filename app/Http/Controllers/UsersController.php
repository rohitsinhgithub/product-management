<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Validator;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Create a new user
    public function create()
    {
        $roles = Role::all(); // Fetch all roles
        return view('admin.users.create', compact('roles'));
    }

    // Store a new user
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole($request->role);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully.',
            'redirect' => route('users.index')
        ]);
    }

    // Edit an existing user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.create', compact('user', 'roles'));
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // 'password' => 'nullable|confirmed',  
            'role' => 'required|exists:roles,name',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        if(isset($user->getRoleNames()[1])) {
            foreach($user->getRoleNames() as $one) {
                $user->removeRole($one);
            }
        } else {
            $user->removeRole($user->getRoleNames());
        }

        $user->assignRole($request->role);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully.',
            'redirect' => route('users.index')
        ]);
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.',
            'redirect' => route('users.index')
        ]);
    }
}
