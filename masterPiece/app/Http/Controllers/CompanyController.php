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

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('industry', 'like', "%{$search}%");
        }

        $companies = $query->latest()->paginate(12);

        return view('CompaniesPage', compact('companies'));
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
