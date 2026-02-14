<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::with('owner')->withCount('members')->latest();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('plan')) {
            $query->where('plan', $request->plan);
        }

        $companies = $query->paginate(12)->withQueryString();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        $users = User::where('status', 'active')->get();
        return view('admin.companies.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'owner_id'    => 'required|exists:users,id',
            'plan'        => 'required|in:free,pro,enterprise',
            'max_members' => 'required|integer|min:2',
            'status'      => 'required|in:active,inactive,suspended',
            'logo'        => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(4);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company = Company::create($validated);

        // Auto-add owner as member
        $company->members()->attach($validated['owner_id'], [
            'role'      => 'owner',
            'joined_at' => now(),
        ]);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company created successfully!');
    }

    public function show(Company $company)
    {
        $company->load(['owner', 'members', 'channels']);
        return view('admin.companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        $users = User::where('status', 'active')->get();
        return view('admin.companies.edit', compact('company', 'users'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'owner_id'    => 'required|exists:users,id',
            'plan'        => 'required|in:free,pro,enterprise',
            'max_members' => 'required|integer|min:2',
            'status'      => 'required|in:active,inactive,suspended',
            'logo'        => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($validated);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company updated!');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deleted!');
    }
}
