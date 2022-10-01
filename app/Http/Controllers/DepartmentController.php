<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments =  Department::all();
        $sn = 1;
        return view('department.index', compact('departments', 'sn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dept_name = $request->input('department_name');

        if ($dept_name != null) {
            $department = new Department();
            $department->department = $dept_name;
            if ($department->save()) {
                return redirect()->back()->with('success', 'Saved successfully');
            }
            return redirect()->back()->with('failed', 'Could not save');
        }
        return redirect()->back()->with('failed', 'Please fill all necessary fields');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
        return view('department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $dept_name = $request->input('department_name');

        if ($dept_name != null) {
            $department = Department::find($id);
            $department->department = $dept_name;
            if ($department->save()) {
                return redirect()->back()->with('success', 'Updated successfully');
            }
            return redirect()->back()->with('failed', 'Could not Update');
        }
        return redirect()->back()->with('failed', 'Please fill all necessary fields');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
