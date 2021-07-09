<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $courses = Course::all();
        $dis_courses = Course::withTrashed()->where('deleted_at' , '!=' , null)->get();
        return view('admin.course.index' , compact('courses' , 'dis_courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id = Course::create([
            'name' => $request->name,
        ])->id;

        $tmp_file_path = public_path()."/data/FOLDER".($id-1)."";//在根目錄下增加tmp目錄的路徑
        if(!is_dir($tmp_file_path)){
            mkdir($tmp_file_path, 0700);//如果不存在tmp目錄，則建立
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        Course::withTrashed()->where('id' , '=' , $id)->update(['deleted_at' => null]);
        toastr()->success('情境開放成功');
        return back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Course::destroy($id);
        toastr()->success('情境刪除成功');
        return back(); 
    }
}
