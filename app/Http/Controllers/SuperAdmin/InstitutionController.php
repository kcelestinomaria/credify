<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use App\Models\Institution;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitutionController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super_admin');
    }

    /**
     * Display a listing of institutions.
     */
    public function index(): View
    {
        $institutions = Institution::latest()->paginate(10);
        return view('super-admin.institutions.index', compact('institutions'));
    }

    /**
     * Show the form for creating a new institution.
     */
    public function create(): View
    {
        return view('super-admin.institutions.create');
    }

    /**
     * Store a newly created institution in storage.
     */
    public function store(StoreInstitutionRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        // Handle logo upload if present
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('institution-logos', 'public');
            $validated['logo'] = $path;
        }
        
        Institution::create($validated);
        
        return redirect()->route('institutions.index')
            ->with('success', 'Institution created successfully.');
    }

    /**
     * Display the specified institution.
     */
    public function show(Institution $institution): View
    {
        return view('super-admin.institutions.show', compact('institution'));
    }

    /**
     * Show the form for editing the specified institution.
     */
    public function edit(Institution $institution): View
    {
        return view('super-admin.institutions.edit', compact('institution'));
    }

    /**
     * Update the specified institution in storage.
     */
    public function update(UpdateInstitutionRequest $request, Institution $institution): RedirectResponse
    {
        $validated = $request->validated();
        
        // Handle logo upload if present
        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($institution->logo) {
                Storage::disk('public')->delete($institution->logo);
            }
            
            $path = $request->file('logo')->store('institution-logos', 'public');
            $validated['logo'] = $path;
        }
        
        $institution->update($validated);
        
        return redirect()->route('institutions.index')
            ->with('success', 'Institution updated successfully.');
    }

    /**
     * Remove the specified institution from storage.
     */
    public function destroy(Institution $institution): RedirectResponse
    {
        // Delete logo if it exists
        if ($institution->logo) {
            Storage::disk('public')->delete($institution->logo);
        }
        
        $institution->delete();
        
        return redirect()->route('institutions.index')
            ->with('success', 'Institution deleted successfully.');
    }
}
