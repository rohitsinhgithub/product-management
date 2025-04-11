<?php

namespace App\Http\Controllers;

use App\Models\ItemMaster;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load relationships and get all items
        $items = ItemMaster::with(['category', 'sub_category'])->get(); // Retrieve all items
    
        return view('item_master.index', compact('items'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $maincategories = Category::select('category_name','id')->where('is_main',1)->get();
        $subcategories = Category::select('sub_category','id')->where('is_main',0)->get();
        return view('item_master.create', compact('maincategories','subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'item_type' => 'required',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:categories,id',
            'barcode' => 'required',
            'mrp' => 'nullable|numeric',
            'purchase_price' => 'nullable|numeric',
            'unit_of_measure' => 'required|string',
            'sku' => 'nullable|string',
            'sales_cost' => 'nullable|numeric',
            'cgst' => 'nullable|numeric',
            'sgst' => 'nullable|numeric',
            'igst' => 'nullable|numeric',
        ]);
    
        ItemMaster::create($request->all());
    
        return redirect()->route('items.index')->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemMaster $itemMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [];
        $data['categories'] = Category::all();
        $data['item'] = ItemMaster::find($id);
        $data['maincategories'] = Category::select('category_name','id')->where('is_main',1)->get();
        $data['subcategories'] = Category::select('sub_category','id')->where('is_main',0)->get();

        return view('item_master.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemMaster $item_master)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255', // Name is required, must be a string, and max length is 255
            'item_type' => 'required|string|max:50', // Item type is required, must be a string, and max length is 50
            'category_id' => 'required|exists:categories,id', // Category must exist in the categories table
            'sub_category_id' => 'required|exists:categories,id', // Sub-category must exist in the categories table
            'barcode' => 'required|string|max:100', // Barcode is required, must be a string, and max length is 100
            'mrp' => 'nullable|numeric|min:0', // MRP is optional, must be a numeric value, and cannot be negative
            'purchase_price' => 'nullable|numeric|min:0', // Purchase price is optional, must be a numeric value, and cannot be negative
            'unit_of_measure' => 'required|string|max:20', // Unit of measure is required, must be a string, and max length is 20
            'sku' => 'nullable|string|max:50', // SKU is optional, must be a string, and max length is 50
            'sales_cost' => 'nullable|numeric|min:0', // Sales cost is optional, must be a numeric value, and cannot be negative
            'is_tax_included' => 'nullable|boolean', // Tax included is optional, must be a boolean
            'cgst' => 'nullable|numeric|min:0|max:100', // CGST is optional, must be a numeric value between 0 and 100
            'sgst' => 'nullable|numeric|min:0|max:100', // SGST is optional, must be a numeric value between 0 and 100
            'igst' => 'nullable|numeric|min:0|max:100', // IGST is optional, must be a numeric value between 0 and 100
            'is_available' => 'nullable|boolean', // Availability is optional, must be a boolean
        ]);
    
        // Update the item with the validated data
        $item_master->update($request->only([
            'name',
            'item_type',
            'category_id',
            'sub_category_id',
            'barcode',
            'mrp',
            'purchase_price',
            'unit_of_measure',
            'sku',
            'sales_cost',
            'is_tax_included',
            'cgst',
            'sgst',
            'igst',
            'is_available',
        ]));
    
        // Redirect back to the index with a success message
        return redirect()->route('items.index')->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemMaster $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully');
    }
}
