<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_type' => 'required',
            'category_name' => 'required',
            'sub_category' => 'required_if:is_main,0',
            'status' => 'nullable',
            'is_main' => 'nullable',
            'image_id' => 'nullable',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Generate a unique 8-digit integer ID using the model method
        $uniqueId = Category::generateUniqueId();

        $category = new Category();
        $category->id = $uniqueId; // Set the generated unique ID
        $category->category_type = $request->category_type;
        $category->category_name = $request->category_name;
        $category->sub_category = $request->sub_category;
        $category->status = $request->status ?? 1;
        $category->is_main = $request->is_main;
        $category->image_id = $request->image_id;
        $category->save();

        // return redirect()->route('categories.index')->with('success', 'Category created successfully.');        
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully.',
            'redirect' => route('categories.index')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.create', compact('category')); // Reuse the create view for editing
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_type' => 'required',
            'category_name' => 'required',
            'sub_category' => 'required_if:is_main,0',
            'status' => 'nullable',
            'is_main' => 'nullable',
            'image_id' => 'nullable',
        ]);

        $category->category_type = $request->category_type;
        $category->category_name = $request->category_name;
        $category->sub_category = $request->sub_category;
        $category->status = $request->status ?? 1;
        $category->is_main = $request->is_main;
        $category->image_id = $request->image_id;
        $category->save();

        // return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
            'redirect' => route('categories.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        // return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        return response()->json([
            'success' => true,
            'message' => 'Category Delete successfully.',
            'redirect' => route('categories.index')
        ]);
    }
}
