<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info; // Assuming you have a model for storing info
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $data = [
            'page_title' => 'Dashboard',
            'breadcrumb' => [
                'Dashboard' => '',
            ],
            'total_categories' => Category::count(),
            'total_users' => User::count(),
            'total_enquiries' => 0, // You can replace this with actual enquiry count when you have the model
        ];
        
        return view('admin.dashboard.index', $data);
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,avi,mov|max:20000', // Adjust validation rules as needed
        ]);

        $path = $request->file('video')->store('videos');

        // Save path to the database or any other necessary action

        return redirect()->route('admin.index')->with('success_message', 'Video uploaded successfully!');
    }

    public function storeInfo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Info::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.showInfo')->with('success_message', 'Information saved successfully!');
    }

    public function showInfo()
    {
        $data = [
            'page_title' => 'Information',
            'breadcrumb' => [
                'Dashboard' => route('admin.index'),
                'Information' => '',
            ],
            'infos' => Info::all(),
        ];
        
        return view('admin.showInfo', $data);
    }
    
    public function myProfile()
    {
        $data = [
            'page_title' => 'My Profile',
            'breadcrumb' => [
                'Dashboard' => route('admin.index'),
                'My Profile' => '',
            ],
            'user' => Auth::user(),
        ];
        
        return view('admin.profile.index', $data);
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user information
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now(),
        ];
        
        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path('uploads/profile_pictures/' . $user->image))) {
                unlink(public_path('uploads/profile_pictures/' . $user->image));
            }
            
            $image = $request->file('profile_pic');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_pictures'), $filename);
            $userData['image'] = $filename;
        }
        
        // Handle password change
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            $userData['password'] = Hash::make($request->new_password);
        }
        
        // Update the user using DB facade
        DB::table('users')->where('id', $user->id)->update($userData);

        return redirect()->route('admin.myProfile')->with('success_message', 'Profile updated successfully.');
    }
}
