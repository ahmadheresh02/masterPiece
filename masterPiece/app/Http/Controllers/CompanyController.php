<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of companies.
     */
    public function index(Request $request)
    {
        $query = Company::query()->withCount('listings');

        // Search by keyword (company name, description, or industry)
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('industry', 'like', "%{$keyword}%");
            });
        }

        // Filter by industry
        if ($request->filled('industry')) {
            $industry = $request->input('industry');
            $query->where('industry', 'like', "%{$industry}%");
        }

        // Pass search params back to view
        $searchParams = $request->only(['keyword', 'industry']);

        $companies = $query->latest()->paginate(12);

        // Append query parameters to pagination links
        $companies->appends($searchParams);

        return view('CompaniesPage', compact('companies', 'searchParams'));
    }

    /**
     * Display the specified company.
     */
    public function show(Company $company)
    {
        $company->load('listings');

        return view('companies.show', compact('company'));
    }
}
