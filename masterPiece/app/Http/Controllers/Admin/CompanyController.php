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

    public function verify(Company $company)
    {
        try {
            $company->update(['is_verified' => true]);

            // You could add notification code here to notify the company

            return redirect()->back()->with('success', 'Company has been verified successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to verify company. ' . $e->getMessage());
        }
    }

    public function unverify(Company $company)
    {
        try {
            $company->update(['is_verified' => false]);
            return redirect()->back()->with('success', 'Company verification has been revoked.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update company status. ' . $e->getMessage());
        }
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
