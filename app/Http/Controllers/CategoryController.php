<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Exports\CategoriesExport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();
    
        // Apply filters
        if ($request->filled('category_type')) {
            $query->where('category_type', 'like', '%' . $request->category_type . '%');
        }
        if ($request->filled('category_name')) {
            $query->where('category_name', 'like', '%' . $request->category_name . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        // Apply sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $order = $request->get('order', 'desc');
        
        // Validate sort column to prevent SQL injection
        $allowedSortColumns = ['created_at', 'category_type', 'category_name', 'status'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }
        
        $query->orderBy($sortBy, $order);
    
        // Get paginated results with more items per page
        $categories = $query->paginate(15)->withQueryString();
    
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
            'redirect' => route('admin.categories.index')
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
            'redirect' => route('admin.categories.index')
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
            'redirect' => route('admin.categories.index')
        ]);
    }

    /**
     * Export categories based on filters
     */
    public function export(Request $request)
    {
        try {
            $type = $request->get('type', 'excel');
            $extension = $type === 'excel' ? 'xlsx' : 'csv';
            $fileName = 'categories_' . date('Y-m-d_H-i-s') . '.' . $extension;
            
            return Excel::download(new CategoriesExport($request), $fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export categories: ' . $e->getMessage());
        }
    }
}
