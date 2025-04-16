<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::latest()->get();
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name'     => 'required|string|max:255',
            'contact_person'   => 'nullable|string|max:255',
            'phone_number'     => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'state'            => 'required|string|max:100',
            'city'             => 'nullable|string|max:100',
            'address'          => 'nullable|string',
            'gstin'            => 'nullable|string|max:20',
            'pan_card_no'      => 'nullable|string|max:20',
            'aadhar_card_no'   => 'nullable|string|max:20',
            'cin'              => 'nullable|string|max:20',
            'tan'              => 'nullable|string|max:20',
            'tin'              => 'nullable|string|max:20',
        ]);
        $validated['status'] = $request->has('status') ? 1 : 0;
        // dd($validated);
        Vendor::create($validated);
    
        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully');
        // return response()->json(['message' => 'Vendor created successfully.']);
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
    public function edit(Vendor $vendor)
    {
        return view('vendors.create', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $validated = $request->validate([
            'company_name'     => 'required|string|max:255',
            'contact_person'   => 'nullable|string|max:255',
            'phone_number'     => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'state'            => 'required|string|max:100',
            'city'             => 'nullable|string|max:100',
            'address'          => 'nullable|string',
            'gstin'            => 'nullable|string|max:20',
            'pan_card_no'      => 'nullable|string|max:20',
            'aadhar_card_no'   => 'nullable|string|max:20',
            'cin'              => 'nullable|string|max:20',
            'tan'              => 'nullable|string|max:20',
            'tin'              => 'nullable|string|max:20',
        ]);

        $validated['status'] = $request->has('status') ? 1 : 0;

        $vendor->update($validated);
    
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully');
        // return response()->json(['message' => 'Vendor updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully');
        // return response()->json(['message' => 'Vendor deleted successfully.']);
    }
}
