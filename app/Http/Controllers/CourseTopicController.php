<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course_topics;
use App\Course;

class CourseTopicController extends Controller
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
        return view('admin.course_topic.index',compact('courses'));
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
        // dd(Course_topics::insertGetId());
        // Course_topics::where('course_id' , '=' , '5')->count();
        $total_topic = Course_topics::where('course_id' , '=' , $request->course)->count();
        $count = Course_topics::select('id')->orderby('id' , 'desc')->limit(1)->get();
        if(!is_null($request->voice)){
            if(filesize($request->voice)<1048576){
                $data = array(
                    'id' => $count[0]['id']+1,
                    'course_id' => $request->course,
                    'number' => $total_topic+1,
                    'eng_topic' => $request->eng,
                    'chi_topic' => $request->chi
                );
                Course_topics::insertGetId($data);
                $voice = $request->voice;
                $file_extension = $voice->getClientOriginalExtension();
                //定隨機名稱
                $file_name = ($total_topic+1) . '.' . $file_extension;
                $file_relative_path = public_path()."/data/FOLDER".($request->course-1)."/LS/PAUL/";
                //存放至public相對路徑
                // $file_path = public_path($file_relative_path);
                // //裁切圖片
                // $image = Image::make($photo)->save($file_path);
                // $main_photo_path = $file_relative_path;
                $voice->move($file_relative_path,$file_name);
                toastr()->success('課程新增成功');
                return back();
            }else{
                toastr()->warning('請勿上傳超過1MB的音檔');
                return back();
            }
        }
        $data = array(
            'id' => $count[0]['id']+1,
            'course_id' => $request->course,
            'number' => $total_topic+1,
            'eng_topic' => $request->eng,
            'chi_topic' => $request->chi
        );
        Course_topics::insertGetId($data);
        toastr()->info('課程新增成功，尚未上傳音檔');
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
    public function edit(Request $request,$id)
    {
        //
        // $post = $this->postRepo->find($id);
        $cid = $request->cid;
        $query = Course_topics::where('course_id','=',$cid)->where('number','=',$id)->get();
        
        if (count($query) == 0) {
            return redirect()->route('coursetopic.index');
        }
    
        return view('admin.course_topic.edit',compact('query','cid'));
        // if (!$post) {
        //     return redirect()->route('post.index');
        // }

        // return view('post.edit', ['post' => $post])
        // return view("admin.course.edit");
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
        $cid = $request->cid;
        if(!is_null($request->voice)){
            if(filesize($request->voice)<1048576){
                $voice = $request->voice;
                $file_extension = $voice->getClientOriginalExtension();
                //定隨機名稱
                $file_name = $id . '.' . $file_extension;
                $file_relative_path = public_path()."/data/FOLDER".($cid-1)."/LS/PAUL/";
                //存放至public相對路徑
                // $file_path = public_path($file_relative_path);
                // //裁切圖片
                // $image = Image::make($photo)->save($file_path);
                // $main_photo_path = $file_relative_path;
                $voice->move($file_relative_path,$file_name);
            }
        }
        $data =array(
            'eng_topic' => $request->eng_topic,
            'chi_topic' => $request->chi_topic
        );
        $query = Course_topics::where('course_id','=',$cid)->where('number','=',$id)->update($data);
        
        // if (count($query) == 0) {
        //     return redirect()->route('course.index');
        // }
        toastr()->success('課程修改成功');
        return redirect()->route('coursetopic.index');
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
    }

    public function getcourse(Request $request)
    {
        //
        // $course = Course_topics::where('course_id',$request->id)->get();
        $course = Course::join('course_topics', 'courses.id', '=', 'course_topics.course_id')->where('course_id',$request->id)->get();

        return $course;
    }
}
