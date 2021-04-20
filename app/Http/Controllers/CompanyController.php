<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {

        return view('company.index', ['companies' => Company::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {

        return view('company.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'profile_picture' => ['required', 'file', 'mimes:jpeg,jpg,png'],
            'business_type' => ['required', 'string', 'in:Grocery,Marketing,Construction'],
            'is_visible' => ['sometimes', 'boolean'],
        ])->validate();
        /**
         * @var Company $company
         */
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $result = $request->file('profile_picture')->store('/public/profile_pictures');
            if (!$result) {
                return redirect()->route('company.create')
                    ->withInput($request->all())
                    ->with('error', 'Company creation failed when saving the uploaded file');
            }
        }
        $company = Company::create([
            'name' => $request->input('name'),
            'profile_picture' => str_replace('public/', '', $result ?? ""),
            'business_type' => $request->input('business_type'),
            'is_visible' => $request->input('is_visible', false)
        ]);
        if (!$company) {
            return redirect()->route('company.index')->with('error', 'Couldn\'t be Created.');
        }
        return redirect()->route('company.index')->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return Application|Factory|View
     */
    public function show(Company $company)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Application|Factory|View
     */
    public function edit(Company $company)
    {
        return view('company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(Request $request, Company $company)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'profile_picture' => ['sometimes', 'file', 'mimes:jpeg,jpg,png'],
            'business_type' => ['required', 'string', 'in:Grocery,Marketing,Construction'],
            'is_visible' => ['sometimes', 'boolean'],
        ])->validate();
        /**
         * @var Company $company
         */
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $result = $request->file('profile_picture')->store('/public/profile_pictures');
            if (!$result) {
                return redirect()->route('company.edit')
                    ->withInput($request->all())
                    ->with('error', 'Company update failed when saving the uploaded file');
            }
        }
        $company->update([
            'name' => $request->input('name'),
            'profile_picture' => str_replace('public/', '', $result ?? $company->profile_picture),
            'business_type' => $request->input('business_type'),
            'is_visible' => $request->input('is_visible', false)
        ]);
        if (!$company) {
            return redirect()->route('company.index')->with('error', 'Couldn\'t be Updated.');
        }
        return redirect()->route('company.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return Response
     */
    public function destroy(Company $company)
    {
        //
    }

    /**
     * @return JsonResponse
     */
    public function getCompanies()
    {
        return response()
            ->json(
                [
                    "companies" => Company::all()
                ]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function company_add(Request $request): JsonResponse
    {
        try {
            Validator::make($request->all(), [
                'name' => ['required', 'max:255'],
                'profile_picture' => ['required', 'file', 'mimes:jpeg,jpg,png'],
                'business_type' => ['required', 'string', 'in:Grocery,Marketing,Construction'],
                'is_visible' => ['sometimes', 'boolean'],
            ])->validate();
        } catch (ValidationException $e) {
            return response()
                ->json($e->getMessage());
        }
        /**
         * @var Company $company
         */
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $result = $request->file('profile_picture')->store('/public/profile_pictures');
            if (!$result) {
                return response()->json(['error' => 'Company creation failed when saving the uploaded file']);
            }
        }
        $company = Company::create([
            'name' => $request->input('name'),
            'profile_picture' => str_replace('public/', '', $result ?? ""),
            'business_type' => $request->input('business_type'),
            'is_visible' => $request->input('is_visible', false)
        ]);
        if (!$company) {
            return response()->json(['error' => 'Couldn\'t be Created.']);
        }
        return response()->json(['success' => 'Created Successfully']);
    }
}
