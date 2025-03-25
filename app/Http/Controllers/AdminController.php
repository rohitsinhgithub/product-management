<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info; // Assuming you have a model for storing info

class AdminController extends Controller
{
    public function index(){
        $data=[];
        return view('admin.dashboard.index', $data);
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,avi,mov|max:20000', // Adjust validation rules as needed
        ]);

        $path = $request->file('video')->store('videos');

        // Save path to the database or any other necessary action

        return redirect()->route('admin.index')->with('success', 'Video uploaded successfully!');
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

        return redirect()->route('admin.showInfo')->with('success', 'Information saved successfully!');
    }

    public function showInfo()
    {
        $infos = Info::all();
        return view('admin.showInfo', compact('infos'));
    }
}
