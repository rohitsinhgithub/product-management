<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $branches = Branch::with('company')
            ->when($request->company_id, fn($q) => $q->where('company_id', $request->company_id))
            ->when($request->status != null, fn($q) => $q->where('status', $request->status))
            ->when($request->city, fn($q) => $q->where('city', 'like', "%{$request->city}%"))
            ->when($request->trashed, fn($q) => $q->onlyTrashed())
            ->paginate(10);

        $companies = Company::pluck('company_name', 'id');

        return view('admin.branches.index', compact('branches', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::pluck('company_name', 'id');
        return view('admin.branches.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'branch_name' => 'required|string|max:255',
            'branch_code' => 'nullable|string|unique:branches,branch_code',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);

        $data = $request->only([
            'company_id', 'branch_name', 'branch_code', 'address', 'city', 'state', 'phone', 'email'
        ]);
        $data['status'] = $request->has('status');

        Branch::create($data);

        return response()->json(['message' => 'Branch created successfully']);
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
    public function edit(string $id)
    {
        $branch = Branch::findOrFail($id);
        $companies = Company::pluck('company_name', 'id');
        return view('admin.branches.create', compact('branch', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $branch = Branch::withTrashed()->findOrFail($id);

        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'branch_name' => 'required|string|max:255',
            'branch_code' => 'required|string|max:100|unique:branches,branch_code,' . $branch->id,
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status' => 'required|boolean',
        ]);

        $branch->update($request->all());

        return redirect()->route('admin.branches.index')->with('success', 'Branch updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->back()->with('success', 'Branch deleted successfully.');
    }
    
    public function restore($id)
    {
        $branch = Branch::onlyTrashed()->findOrFail($id);
        $branch->restore();

        return redirect()->back()->with('success', 'Branch restored successfully.');
    }
}
