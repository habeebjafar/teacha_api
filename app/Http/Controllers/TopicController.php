<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        $sn = 1;
        return view('topic.index', compact('topics', 'sn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments['data'] = Department::orderby("department", "asc")
            ->select('id', 'department')
            ->get();

        return view('topic.create')->with("departments", $departments);
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
        $topic = $request->input('topic');
        $videURL = $request->input('video_url');
        $icon = $request->file('icon');


        if($department != null && $course != null && $videURL != null && $icon != null ){

            $topicModel = new Topic();
            $topicModel->department_id = $department;
            $topicModel->course_id = $course;
            $topicModel->topic = $topic;
            $topicModel->topic_vd_url = $videURL;


                $ext = $icon->getClientOriginalExtension();
                $fileName = rand(10000, 50000) . '.' . $ext;
                if ($ext == 'jpg' || $ext == 'png') {
                    if ($icon->move(public_path(), $fileName)) {
                        
                        $topicModel->icon = url('/') . '/' . $fileName;
                     
                    }else{
                        return redirect()->back()->with('failed', 'failed to upload, please check your internet');
    
                    }
                    
                }else{
                    return redirect()->back()->with('failed', 'Please upload png or jpg/jpeg');
    
                }

                if ($topicModel->save()) {
                    return redirect()->back()->with('success', 'Topic  inserted successfully!');
                }
                return redirect()->back()->with('failed', 'Topic  could not be inserted!');
               
        }
        return redirect()->back()->with('failed', 'Please fill all fields!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::find($id);
        $departments = Department::orderby("department", "asc")
            ->select('id', 'department')
            ->get();
            
        $courses =  Course::orderby("course", "asc")
        ->select('id', 'course')
        ->get();

        return view('topic.edit', compact('topic', 'courses', 'departments'));
    }

    public function getCourseByDepartment($departmentId = 0)
    {
        $coursecData['data'] = Course::orderby("course", "asc")
            ->select('id', 'course')
            ->where('department_id', $departmentId)
            ->get();

        return response()->json($coursecData);
    }

    public function getCourseByDepartmentUpdate($departmentId = 0)
    {
        $coursecData['data'] = Course::orderby("course", "asc")
            ->select('id', 'course')
            ->where('department_id', $departmentId)
            ->get();

        return response()->json($coursecData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department = $request->input('department');
        $course = $request->input('course');
        $topic = $request->input('topic');
        $videURL = $request->input('video_url');
        $icon = $request->file('icon');


        if($department != null && $course != null && $videURL != null){

            $topicModel =  Topic::find($id);
            $topicModel->department_id = $department;
            $topicModel->course_id = $course;
            $topicModel->topic = $topic;
            $topicModel->topic_vd_url = $videURL;


              if($icon != null){
                $ext = $icon->getClientOriginalExtension();
                $fileName = rand(10000, 50000) . '.' . $ext;
                if ($ext == 'jpg' || $ext == 'png') {
                    if ($icon->move(public_path(), $fileName)) {
                        
                        $topicModel->icon = url('/') . '/' . $fileName;
                     
                    }else{
                        return redirect()->back()->with('failed', 'failed to upload, please check your internet');
    
                    }
                    
                }else{
                    return redirect()->back()->with('failed', 'Please upload png or jpg/jpeg');
    
                }
              }else{
                $topicModel->icon =  $request->input('icon_update');
              }

                if ($topicModel->save()) {
                    return redirect()->back()->with('success', 'Topic  updated successfully!');
                }
                return redirect()->back()->with('failed', 'Topic  could not be updated!');
               
        }
        return redirect()->back()->with('failed', 'Please fill all fields!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
