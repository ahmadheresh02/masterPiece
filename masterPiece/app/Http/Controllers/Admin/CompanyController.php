<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\InternshipListing;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('admin.companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        $listings = InternshipListing::where('company_id', $company->id)
            ->withCount('applications')
            ->latest()
            ->get();

        return view('admin.companies.show', compact('company', 'listings'));
    }

    public function destroy(Company $company)
    {
        try {
            $company->delete();
            return redirect()->route('admin.companies.index')->with('success', 'Company deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete company. ' . $e->getMessage());
        }
    }
}
