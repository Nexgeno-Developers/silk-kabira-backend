<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Services\ApiPayloadCache;

class CompanyController extends Controller
{
    protected $moduleName;

    public function __construct()
    {
        //Module Name
        $this->moduleName = 'Company';
        view()->share('moduleName', $this->moduleName);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Start building the query
        $query = Company::with('meta');

        // Filter by company_id if authenticated user has one, otherwise, return all companies
        $companyId = Auth::user()?->company_id;
        if ($companyId) {
            $query->where('id', $companyId);
        }

        // Execute the query and get the results
        $pageData = $query->get();

        return view('backend.companies.index', compact('pageData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        try {
            $company = DB::transaction(function () use ($validated) {
                $company = Company::create($this->companyData($validated));
                $this->syncMetaFields($company, $validated['meta'] ?? []);

                return $company;
            });

            ApiPayloadCache::invalidateCompany((int) $company->id);

            return redirect()->route('companies.edit', $company->id)->with('success', 'Company created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating company', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('companies.create')->with('error', 'There was an error creating the company.');
        }
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
        $query = Company::with('meta');

        $companyId = Auth::user()?->company_id;
        if ($companyId) {
            $query->where('id', $companyId);
        }

        $pageData = $query->findOrFail($id);

        return view('backend.companies.edit', compact('pageData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->rules());

        try {
            $company = Company::findOrFail($id);

            DB::transaction(function () use ($company, $validated) {
                $company->update($this->companyData($validated));
                $this->syncMetaFields($company, $validated['meta'] ?? []);
            });

            ApiPayloadCache::invalidateCompany((int) $company->id);

            return redirect()->route('companies.edit', $company->id)->with('success', 'Company details updated successfully!');

        } catch (\Exception $e) {
            // Log the error message with a detailed stack trace
            Log::error('Error updating company details for company ID ' . $id, [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
    
            // Optionally, return a failure message to the user
            return redirect()->route('companies.edit', $id)->with('error', 'There was an error updating the company details.');
        }
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'logo' => 'required|string',
            'short_description' => 'nullable|string',
            'copyright_text' => 'nullable|string|max:500',
            'catalogue' => 'nullable|string',
            'sample' => 'nullable|string',
            'cta_title' => 'nullable|string|max:255',
            'cta_subtitle' => 'nullable|string|max:1000',
            'email' => 'required|email:rfc|max:50',
            'phone' => 'required|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'address' => 'required|string',
            'website' => 'required|url|max:50',
            'google_map' => 'nullable|url|max:2000',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'meta' => 'nullable|array',
            'meta.instagram_url' => 'nullable|url|max:255',
            'meta.x_url' => 'nullable|url|max:255',
            'meta.facebook_url' => 'nullable|url|max:255',
            'meta.youtube_url' => 'nullable|url|max:255',
            'meta.pinterest_url' => 'nullable|url|max:255',
        ];
    }

    private function companyData(array $validated): array
    {
        return [
            'name' => $validated['name'],
            'logo' => $validated['logo'],
            'short_description' => $validated['short_description'] ?? null,
            'copyright_text' => $validated['copyright_text'] ?? null,
            'catalogue' => $validated['catalogue'] ?? null,
            'sample' => $validated['sample'] ?? null,
            'cta_title' => $validated['cta_title'] ?? null,
            'cta_subtitle' => $validated['cta_subtitle'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'whatsapp' => $validated['whatsapp'] ?? null,
            'address' => $validated['address'],
            'website' => $validated['website'],
            'google_map' => $validated['google_map'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'is_active' => (int) ($validated['is_active'] ?? 1),
        ];
    }

    private function syncMetaFields(Company $company, array $metaFields): void
    {
        foreach ($metaFields as $key => $value) {
            $existingMeta = $company->meta()->where('meta_key', $key)->first();

            if ($existingMeta) {
                $existingMeta->update(['meta_value' => $value]);
                continue;
            }

            if ($value !== null && $value !== '') {
                $company->meta()->create([
                    'meta_key' => $key,
                    'meta_value' => $value,
                ]);
            }
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
