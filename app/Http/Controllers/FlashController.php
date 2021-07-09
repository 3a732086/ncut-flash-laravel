<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use App\Userdata;
use App\User;
use App\Course;
use App\Course_topics;
use App\Ctr;
use GuzzleHttp\Client;

class FlashController extends Controller
{
    //
    public function index(Request $request)
    {
        $courses = Course::orderby('id' , 'asc')->get();
        $file_sentence=[];//宣告一個陣列存放所有folder內的句子

        $folderPath="data/";
        $countFile=0;
        $totalFiles=glob($folderPath."*");
        if($totalFiles){
            $countFile=count($totalFiles);
        }
        for($i=0;$i<$countFile;$i++)
        {

            $folder1 = file_get_contents($totalFiles[$i]."/LS/ListenSpeak.json");
            $folder1_json = json_decode($folder1, true);
            array_push($file_sentence,$folder1_json);

        }
        // $total_course=[];
        // $get_scenes = Course::select('id','name')->orderBy('id', 'asc')->get();

        // foreach($get_scenes as $scenes){
        //     $course_topic = Course::select('name' , 'course_id' , 'number' , 'eng_topic' , 'chi_topic')->join('course_topics', 'courses.id', '=', 'course_topics.course_id')->where('course_topics.course_id',$scenes->id)->orderBy('course_topics.number', 'asc')->get();

        //     array_push($total_course,json_encode($course_topic));

        // }
        return view('lobby',compact('courses'));
        
    }
    public function get_allqa()
    {
        $file_sentence=[];//宣告一個陣列存放所有folder內的句子

        // $folderPath="data/";
        // $countFile=0;
        // $totalFiles=glob($folderPath."*");
        // if($totalFiles){
        //     $countFile=count($totalFiles);
        // }
        // for($i=0;$i<$countFile;$i++)
        // {

        //     $folder1 = file_get_contents($totalFiles[$i]."/LS/ListenSpeak.json");
        //     $folder1_json = json_decode($folder1, true);
        //     array_push($file_sentence,$folder1_json);

        // }
        // return $file_sentence;
        $total_course=[];
        $get_scenes = Course::select('id','name')->orderBy('id', 'asc')->get();

        foreach($get_scenes as $scenes){
            $course_topic = Course::select('name' , 'course_id' , 'number' , 'eng_topic' , 'chi_topic')->join('course_topics', 'courses.id', '=', 'course_topics.course_id')->where('course_topics.course_id',$scenes->id)->orderBy('course_topics.number', 'asc')->get();

            array_push($total_course,($course_topic));

        }
        
        // $total_course=[];
        // $get_scenes = Course::orderBy('id', 'asc')->get();
        // foreach($get_scenes as $scenes){
        //     $course_topic = Course::join('course_topics', 'courses.id', '=', 'course_topics.course_id')->where('course_topics.course_id',$scenes->id)->orderBy('courses.id', 'asc')->orderBy('course_topics.number', 'asc')->get();

        //     array_push($total_course,$course_topic);

        // }
            // dd($total_course);
        return $total_course;
    }
    public function insert(Request $request){
        if($request->scenes != null && $request->topic != null && $request->text != null){
            $result=Userdata::insert(['user_id' => Auth::id() ,'scenes' => $request->scenes ,'topic' => $request->topic , 'inputdata' => $request->text ]);
            if($result){
                return ['status'=>true,'code'=>'新增成功'];
            }else{
                return ['status'=>false,'code'=>'新增失敗'];
            }
        }else{
            return ['status'=>false,'code'=>'請輸入答案後再送出'];
        }
    }
    public function show_detail(){
        return view('show',['user'=>User::find(Auth::id())]);
    }

    // public function speech_recognition(){
    //     $client = new \GuzzleHttp\Client();
    //     $res = $client->get("127.0.0.1:5000/");
    //     $response = json_decode($res->getBody()->__toString(), true);
    //     return $res->getBody()->__toString();
    // }

    public function CTR(Request $request){
        //Click Through Rate
        if($request->scenes != null && $request->user_id != null){
            $result=Ctr::insert(['user_id' => Auth::id() ,'scenes' => $request->scenes ]);
            // if($result){
            //     return ['status'=>true,'code'=>'新增成功'];
            // }else{
            //     return ['status'=>false,'code'=>'新增失敗'];
            // }
        }
        // else{
        //     return ['status'=>false,'code'=>'請輸入答案後再送出'];
        // }
    }
}
