<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Userdata;
use App\User;
use App\Ctr;
use App\Course;
use App\Exports\UserdataExport;
use App\Exports\UseractivityExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
        $date = date("Y-m-d");
        $today_user = User::where('updated_at' , 'like' , "%$date%")->count();
        $today_data = Userdata::where('inserted_at' , 'like' , "%$date%")->count();
        $activite = User::orderby('updated_at' ,'desc')->take(5)->get();
        return view('admin.index' , compact('today_user' , 'today_data' ,'activite'));
    }

    public function show(Request $request)
    {
        $user = User::join('userdatas', 'users.id', '=', 'userdatas.user_id')->orderBy('inserted_at', 'desc')->get();

        return view('admin.show',['user'=>$user]);
    }

    public function setting_index(Request $request)
    {
        return view('admin.setting',['profiles'=>User::all()]);
    }

    public function click_rate_show(Request $request)
    {
        // $get_id = Ctr::select('user_id')->distinct()->get();
        $get_id2name = Ctr::join('users','users.id','=','ctrs.user_id')->select('users.id','users.name')->distinct()->get();
        $get_scenes = Course::select('name')->distinct()->get();
        $array1=[];
        $array2=[];
        foreach($get_id2name as $key=>$value){
            // echo $value->name."<br>";
            array_push($array1,$value->name);
            foreach($get_scenes as $scenes){
                $query = Ctr::where('user_id',$value->id)->where('scenes',$scenes->name)->count();
                // echo ($query);
                array_push($array1,$query);

            }
            array_push($array2,$array1);
            $array1=[];
            // echo "<br>";
        }

        // echo $get_scenes;
        return view('admin.click_through_rate',['result'=>$array2 , 'courses'=>$get_scenes]);
    }

    public function activity(Request $request)
    {
        $user = User::where('role','1')->get();
        return view('admin.user_activity',['result'=>$user]);
    }

    public function Userdata_Export(Request $request)
    {
        return Excel::download(new UserdataExport, 'userdata.xlsx');
    }

    public function UserActivity_Export(Request $request)
    {
        return Excel::download(new UserActivityExport, 'activity.xlsx');
    }
}
