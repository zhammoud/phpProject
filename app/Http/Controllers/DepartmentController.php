<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('department.index',['departments' => Department::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('department.create',
            ['branches' => Branch::all()]
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
            'number_of_employees' => ['required', 'integer', 'gt:0'],
            'branch' => ['required', 'digits_between:1,10', 'gt:0', 'exists:branches,id'],
            'is_visible' => ['sometimes', 'boolean'],
        ])->validate();
        /**
         * @var Department $department
         */
        $department = Department::create([
            'name' => $request->input('name'),
            'number_of_employees' => $request->input('number_of_employees'),
            'branch_id' => $request->input('branch'),
            'is_visible' => $request->input('is_visible', false)
        ]);
        if (!$department) {
            return redirect()->route('department.index')->with('error', 'Couldn\'t be Created.');
        }
        return redirect()->route('department.index')->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return Application|Factory|View
     */
    public function show(Department $department)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return Application|Factory|View
     */
    public function edit(Department $department)
    {
        return view('department.edit',
            ['department' => $department],
            ['branches' => Branch::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Department $department
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Department $department): RedirectResponse
    {
        Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'number_of_employees' => ['required', 'integer', 'gt:0'],
            'branch' => ['required', 'digits_between:1,10', 'gt:0', 'exists:branches,id'],
            'is_visible' => ['sometimes', 'boolean'],
        ])->validate();

        $department ->update([
            'name' => $request->input('name'),
            'number_of_employees' => $request->input('number_of_employees'),
            'branch_id' => $request->input('branch'),
            'is_visible' => $request->input('is_visible', false)
        ]);
        if (!$department) {
            return redirect()->route('department.index')->with('error', 'Couldn\'t be Updated.');
        }
        return redirect()->route('department.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
