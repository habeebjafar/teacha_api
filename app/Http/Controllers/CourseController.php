<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $sn = 1;
        return view('course.index', compact('courses', 'sn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $departments = Department::orderby("department", "asc")
        ->select('id', 'department')
        ->get();
        return view('course.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = $request->input('department');
        $course = $request->input('course');
        $icon = $request->file('icon');
        if($department != null && $course != null && $icon != null ){

            $courseModel = new Course();
            $courseModel->department_id = $department;
            $courseModel->course = $course;

                $ext = $icon->getClientOriginalExtension();
                $fileName = rand(10000, 50000) . '.' . $ext;
                if ($ext == 'jpg' || $ext == 'png') {
                    if ($icon->move(public_path(), $fileName)) {
                        
                        $courseModel->icon = url('/') . '/' . $fileName;
                     
                    }else{
                        return redirect()->back()->with('failed', 'failed to upload, please check your internet');
    
                    }
                    
                }else{
                    return redirect()->back()->with('failed', 'Please upload png or jpg/jpeg');
    
                }

                if ($courseModel->save()) {
                    return redirect()->back()->with('success', 'Course information inserted successfully!');
                }
                return redirect()->back()->with('failed', 'Course information could not be inserted!');
               
        }
        return redirect()->back()->with('failed', 'Please fill all field!');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $departments = Department::all();
        return view('course.edit', compact('course', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department = $request->input('department');
        $course = $request->input('course');
        $icon = $request->file('icon');
        if($department != null && $course != null ){

            $courseModel =  Course::find($id);
            $courseModel->department_id = $department;
            $courseModel->course = $course;

               if($icon != null){

                $ext = $icon->getClientOriginalExtension();
                $fileName = rand(10000, 50000) . '.' . $ext;
                if ($ext == 'jpg' || $ext == 'png') {
                    if ($icon->move(public_path(), $fileName)) {
                        
                        $courseModel->icon = url('/') . '/' . $fileName;
                     
                    }else{
                        return redirect()->back()->with('failed', 'failed to upload, please check your internet');
    
                    }
                    
                }else{
                    return redirect()->back()->with('failed', 'Please upload png or jpg/jpeg');
    
                }

               }else{

                  $courseModel->icon =  $request->input('icon_update');
               }

                if ($courseModel->save()) {
                    return redirect()->back()->with('success', 'Course information updated successfully!');
                }
                return redirect()->back()->with('failed', 'Course information could not be updated!');
               
        }
        return redirect()->back()->with('failed', 'Please fill all field!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
