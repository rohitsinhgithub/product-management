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
    public function update(Request $request, $id)
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
    
        $item = ItemMaster::findOrFail($id);
        $item->update($request->all());
    
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
