<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CompaniesExport;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $owners = User::where('userType', 'owner')->get();
        $owners = User::get();
        return view('admin.companies.create', compact('owners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:users,id',
            'company_name' => 'required',
            'gstin' => 'nullable|string',
            'phone' => 'required',
            'email' => 'nullable|email',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'status' => 'boolean'
        ]);

        Company::create($validated);

        return response()->json(['message' => 'Company created successfully']);
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
    public function edit(Company $company)
    {
        // $owners = User::where('userType', 'owner')->get();
        $owners = User::get();
        return view('admin.companies.create', compact('company', 'owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:users,id',
            'company_name' => 'required',
            'gstin' => 'nullable|string',
            'phone' => 'required',
            'email' => 'nullable|email',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'status' => 'boolean'
        ]);

        $company->update($validated);

        return response()->json(['message' => 'Company updated successfully']);
    }
    
    public function exportExcel()
    {
        return Excel::download(new CompaniesExport, 'companies.xlsx');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Company::findOrFail($id)->delete();
        return response()->json(['message' => 'Company soft deleted']);
    }
}
