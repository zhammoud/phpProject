<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BranchController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('branch.index', ['branches' => Branch::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {

        return view('branch.create',
            ['companies' => Company::all()->where('is_visible', '=', 1)]
        );

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
            'establishment_date' => ['required', 'date', 'before:today'],
            'company' => ['required', 'digits_between:1,10', 'gt:0', 'exists:companies,id'],
            'is_visible' => ['sometimes', 'boolean'],
        ])->validate();
        /**
         * @var Branch $branch
         */
        $branch = Branch::create([
            'name' => $request->input('name'),
            'establishment_date' => $request->input('establishment_date'),
            'company_id' => $request->input('company'),
            'is_visible' => $request->input('is_visible', false)
        ]);
        if (!$branch) {
            return redirect()->route('branch.index')->with('error', 'Couldn\'t be Created.');
        }
        return redirect()->route('branch.index')->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Branch $branch
     * @return Application|Factory|View
     */
    public function show(Branch $branch)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Branch $branch
     * @return Application|Factory|View
     */
    public function edit(Branch $branch)
    {
        return view(
            'branch.edit',
            [
                'branch' => $branch,
                'companies' => Company::all()->where('is_visible', '=', 1)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Branch $branch
     * @return RedirectResponse
     */
    public function update(Request $request, Branch $branch): RedirectResponse
    {
        Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'establishment_date' => ['required', 'date', 'before:today'],
            'company' => ['required', 'digits_between:1,10', 'gt:0', 'exists:companies,id'],
            'is_visible' => ['sometimes', 'boolean'],
        ])->validate();

        $branch->update([
            'name' => $request->input('name'),
            'establishment_date' => $request->input('establishment_date'),
            'company_id' => $request->input('company'),
            'is_visible' => $request->input('is_visible', false)
        ]);
        if (!$branch) {
            return redirect()->route('branch.index')->with('error', 'Couldn\'t be Updated.');
        }
        return redirect()->route('branch.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Branch $branch
     * @return Response
     */
    public function destroy(Branch $branch)
    {
        //
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getBranches(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'company' => ['required', 'digits_between:1,10', 'gt:0', 'exists:companies,id'],
            ])->validate();
        } catch (ValidationException $e) {
            return response()
                ->json($e->getMessage());
        }
        return response()
            ->json(
                [
                    "branches" =>
                        DB::table('branches')->leftJoin('departments', 'departments.branch_id', '=', 'branches.id')
                            ->where('branches.company_id', '=', $request->input('company'))
                            ->where('branches.is_visible', '=', 1)
                            ->where('departments.is_visible', '=', 1)
                            ->orWhereNull('departments.is_visible')
                            ->select(
                                'branches.id as branch_id',
                                'branches.name as branch_name',
                                'branches.establishment_date as branch_establishment_date',
                                'branches.company_id as branch_company_id',
                                'departments.id as departments_id',
                                'departments.number_of_employees as departments_number_of_employees',
                            )->get()
                ]);
    }
}
