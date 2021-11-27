<?php

namespace App\Http\Controllers;

use App\Blue;
use App\Green;
use App\Greenmm;
use Illuminate\Http\Request;
use App\Yellow;
use App\Quiz_score;
use App\User;
use Auth;

class QuizController extends Controller
{
    //
    public function index()
    {
        //
        // $yellow_word = Yellow::where('Count' , '>=' , '2')->inRandomOrder()->limit(5)->get();
        return view('quiz.index');
    }

    public function getyellow()
    {
        $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->inRandomOrder()->limit(5)->get()->toArray();
        $yellow_word[0] = array_filter($yellow_word[0]);
        foreach($yellow_word as $key => $value){
            $yellow_word[$key] = array_values(array_filter($yellow_word[$key]));
        }

        $new_randbox = [];
        $box = ["btn1" , "btn2" , "btn3" , "btn4" , "btn5" , "btn6" , "btn7" , "btn8" , "btn9" , "btn10"];
        while(count($box) >= 2){
            $getrand = rand(0 ,count($box)-1);
            $new_getrand = rand(0 , count($box)-1);
            while( $getrand == $new_getrand){
                $new_getrand = rand(0 , count($box)-1);
            }
            array_push($new_randbox , $box[$getrand]);
            array_push($new_randbox , $box[$new_getrand]);
            unset($box[$getrand]);
            unset($box[$new_getrand]);
            $box = array_values($box);
        }
        $new_word = [];
        foreach($yellow_word as $word){
            switch(count($word)){
                case 2:
                    array_push($new_word , $word[0] , $word[1]);
                    break;
                case 3:
                    $getrand = rand(0 ,2);
                    $new_getrand = rand(0 , 2);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 2);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
                case 4:
                    $getrand = rand(0 ,3);
                    $new_getrand = rand(0 , 3);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 3);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
            }
        }
        return [$new_randbox , $new_word , array(0,0,1,1,2,2,3,3,4,4)];
    }

    public function save(Request $request)
    {
        //
        // $yellow_word = Yellow::where('Count' , '>=' , '2')->inRandomOrder()->limit(5)->get();
        $fail =$request->fail;
        Quiz_score::create([
            'user_id' => $request->user_id,
            'score' => $request->score,
            'use_time' => $request->time,
            'fail' => json_encode($fail)
        ]);
        return view('quiz.index');
    }

    public function yellow_show()
    {
        $yellow_data = Yellow::all();
        return view('admin.quiz.index' , compact('yellow_data'));
    }

    public function yellow_word_insert(Request $request)
    {

        if(is_null($request->verb) && is_null($request->noun) && is_null($request->adjective) && is_null($request->adverb)){
            toastr()->warning('請勿填白輸入');
            return redirect('admin/yellow');
        }
        Yellow::create([
            'Verb' => $request->verb,
            'Noun' => $request->noun,
            'Adjective' => $request->adjective,
            'Adverb' => $request->adverb,
            'Count' => count(array_filter($request->except('_token')))
        ]);
        toastr()->success('新增成功');
        return redirect('admin/yellow');
    }

    public function quiz_show()
    {
        $result = User::select('users.name' , 'quiz_score.*')->join('quiz_score' , 'users.id' , '=' , 'quiz_score.user_id')->where('users.id' , Auth::user()->id)->orderby('quiz_score.created_at' , 'desc')->get();
        return view('quiz_show' , compact('result'));
        // dd($result);
    }

    public function show_data()
    {
        $result = User::select('users.name' , 'quiz_score.*')
                ->join('quiz_score' , 'users.id' , '=' , 'quiz_score.user_id')
                ->orderby('quiz_score.created_at' , 'desc')
                ->get();

        // $result = Quiz_score::all();
        // dd($result);
        return view('admin.quiz.show_data' , compact('result'));

    }

    public function quiz_record(Request $request)
    {
        $result = User::select('users.name' , 'quiz_score.*')
                ->join('quiz_score' , 'users.id' , '=' , 'quiz_score.user_id')
                ->where('quiz_score.id' , $request->id)
                ->pluck('quiz_score.fail')->toArray();
        return view('admin.quiz.quiz_record' , compact('result'));
    }

    public function menu()
    {
        return view('quiz.menu');
    }

    public function practice()
    {
        return view('quiz.practice');
    }

    public function practice_data($id = 1)
    {
        switch($id){
            case 1:
                $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->limit(5)->get()->toArray();
                break;
            case 2:
                $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(5)->limit(5)->get()->toArray();
                break;
            case 3:
                $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(10)->limit(5)->get()->toArray();
                break;
            case 4:
                $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(15)->limit(5)->get()->toArray();
                break;
            case 5:
                $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(20)->limit(5)->get()->toArray();
                break;
            case 6:
                $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(25)->limit(5)->get()->toArray();
                break;
            case 7:
                $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(30)->limit(5)->get()->toArray();
                break;
            case 8:
                $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(35)->limit(5)->get()->toArray();
                break;
            case 9:
                $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(40)->limit(5)->get()->toArray();
                break;
            default:
                $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->limit(5)->get()->toArray();
                break;
        }
        // $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->inRandomOrder()->limit(5)->get()->toArray();
        $yellow_word[0] = array_filter($yellow_word[0]);
        foreach($yellow_word as $key => $value){
            $yellow_word[$key] = array_values(array_filter($yellow_word[$key]));
        }

        $new_randbox = [];
        $box = ["btn1" , "btn2" , "btn3" , "btn4" , "btn5" , "btn6" , "btn7" , "btn8" , "btn9" , "btn10"];
        while(count($box) >= 2){
            $getrand = rand(0 ,count($box)-1);
            $new_getrand = rand(0 , count($box)-1);
            while( $getrand == $new_getrand){
                $new_getrand = rand(0 , count($box)-1);
            }
            array_push($new_randbox , $box[$getrand]);
            array_push($new_randbox , $box[$new_getrand]);
            unset($box[$getrand]);
            unset($box[$new_getrand]);
            $box = array_values($box);
        }
        $new_word = [];
        foreach($yellow_word as $word){
            switch(count($word)){
                case 2:
                    array_push($new_word , $word[0] , $word[1]);
                    break;
                case 3:
                    $getrand = rand(0 ,2);
                    $new_getrand = rand(0 , 2);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 2);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
                case 4:
                    $getrand = rand(0 ,3);
                    $new_getrand = rand(0 , 3);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 3);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
            }
        }
        return [$new_randbox , $new_word , array(0,0,1,1,2,2,3,3,4,4)];
    }

    public function edit(Request $request , $id)
    {
        $data = Yellow::find($id);
        return view('admin.quiz.edit' , compact('data'));
    }

    public function update(Request $request , $id)
    {
        // dd(Yellow::all());
        $data = Yellow::find($id);
        $data->Verb = $request->verb;
        $data->Noun = $request->noun;
        $data->Adjective = $request->adjective;
        $data->Adverb = $request->adverb;
        $data->Count = count(array_filter($request->except(['_token','_method'])));
        $data->save();

        return redirect()->route('yellow_show');
    }



    //green
    //----------------------後台----------------------------
    public function green_show()
    {
        $green_data = Green::all();
        return view('admin.quiz.green.index' , compact('green_data'));
    }

    public function green_word_insert(Request $request)
    {
        if(is_null($request->verb) && is_null($request->noun) && is_null($request->adjective) && is_null($request->adverb)){
            toastr()->warning('請勿填白輸入');
            return redirect('admin/green');
        }
        Green::create([
            'Verb' => $request->verb,
            'Noun' => $request->noun,
            'Adjective' => $request->adjective,
            'Adverb' => $request->adverb,
            'Count' => count(array_filter($request->except('_token')))
        ]);
        toastr()->success('新增成功');
        return redirect('admin/green');
    }

    public function green_edit(Request $request , $id)
    {
        $data = Green::find($id);
        return view('admin.quiz.green.edit' , compact('data'));
    }

    public function green_update(Request $request , $id)
    {
        // dd(Green::all());
        $data = Green::find($id);
        $data->Verb = $request->verb;
        $data->Noun = $request->noun;
        $data->Adjective = $request->adjective;
        $data->Adverb = $request->adverb;
        $data->Count = count(array_filter($request->except(['_token','_method'])));
        $data->save();

        return redirect()->route('green_show');
    }
    //----------------------後台----------------------------


    //----------------------前台----------------------------

    public function index_green()
    {
        //
        // $yellow_word = Yellow::where('Count' , '>=' , '2')->inRandomOrder()->limit(5)->get();
        return view('quiz.green.index');
    }

    public function menu_green()
    {
        return view('quiz.green.menu');
    }

    public function practice_green()
    {
        return view('quiz.green.practice');
    }

    public function getgreen()
    {
        $green_word = Green::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->inRandomOrder()->limit(5)->get()->toArray();
        $green_word[0] = array_filter($green_word[0]);
        foreach($green_word as $key => $value){
            $green_word[$key] = array_values(array_filter($green_word[$key]));
        }

        $new_randbox = [];
        $box = ["btn1" , "btn2" , "btn3" , "btn4" , "btn5" , "btn6" , "btn7" , "btn8" , "btn9" , "btn10"];
        while(count($box) >= 2){
            $getrand = rand(0 ,count($box)-1);
            $new_getrand = rand(0 , count($box)-1);
            while( $getrand == $new_getrand){
                $new_getrand = rand(0 , count($box)-1);
            }
            array_push($new_randbox , $box[$getrand]);
            array_push($new_randbox , $box[$new_getrand]);
            unset($box[$getrand]);
            unset($box[$new_getrand]);
            $box = array_values($box);
        }
        $new_word = [];
        foreach($green_word as $word){
            switch(count($word)){
                case 2:
                    array_push($new_word , $word[0] , $word[1]);
                    break;
                case 3:
                    $getrand = rand(0 ,2);
                    $new_getrand = rand(0 , 2);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 2);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
                case 4:
                    $getrand = rand(0 ,3);
                    $new_getrand = rand(0 , 3);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 3);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
            }
        }
        return [$new_randbox , $new_word , array(0,0,1,1,2,2,3,3,4,4)];
    }


    public function practice_data_green($id = 1)
    {
        switch($id){
            case 1:
                $green_word = Green::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->limit(5)->get()->toArray();
                break;
            case 2:
                $green_word = Green::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(5)->limit(5)->get()->toArray();
                break;
            case 3:
                $green_word = Green::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(10)->limit(5)->get()->toArray();
                break;
            case 4:
                $green_word = Green::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(15)->limit(5)->get()->toArray();
                break;
            case 5:
                $green_word = Green::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(20)->limit(5)->get()->toArray();
                break;
            case 6:
                $green_word = Green::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(25)->limit(5)->get()->toArray();
                break;
            case 7:
                $green_word = Green::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(30)->limit(5)->get()->toArray();
                break;
            case 8:
                $green_word = Green::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(35)->limit(5)->get()->toArray();
                break;
            case 9:
                $green_word = Green::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(40)->limit(5)->get()->toArray();
                break;
            default:
                $green_word = Green::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->limit(5)->get()->toArray();
                break;
        }
        // $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->inRandomOrder()->limit(5)->get()->toArray();
        $green_word[0] = array_filter($green_word[0]);
        foreach($green_word as $key => $value){
            $green_word[$key] = array_values(array_filter($green_word[$key]));
        }

        $new_randbox = [];
        $box = ["btn1" , "btn2" , "btn3" , "btn4" , "btn5" , "btn6" , "btn7" , "btn8" , "btn9" , "btn10"];
        while(count($box) >= 2){
            $getrand = rand(0 ,count($box)-1);
            $new_getrand = rand(0 , count($box)-1);
            while( $getrand == $new_getrand){
                $new_getrand = rand(0 , count($box)-1);
            }
            array_push($new_randbox , $box[$getrand]);
            array_push($new_randbox , $box[$new_getrand]);
            unset($box[$getrand]);
            unset($box[$new_getrand]);
            $box = array_values($box);
        }
        $new_word = [];
        foreach($green_word as $word){
            switch(count($word)){
                case 2:
                    array_push($new_word , $word[0] , $word[1]);
                    break;
                case 3:
                    $getrand = rand(0 ,2);
                    $new_getrand = rand(0 , 2);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 2);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
                case 4:
                    $getrand = rand(0 ,3);
                    $new_getrand = rand(0 , 3);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 3);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
            }
        }
        return [$new_randbox , $new_word , array(0,0,1,1,2,2,3,3,4,4)];
    }
    //----------------------前台----------------------------


    //----------------------後台----------------------------
    //blue
    public function blue_show()
    {
        $blue_data = Blue::all();
        return view('admin.quiz.blue.index' , compact('blue_data'));
    }


    public function blue_word_insert(Request $request)
    {

        if(is_null($request->verb) && is_null($request->noun) && is_null($request->adjective) && is_null($request->adverb)){
            toastr()->warning('請勿填白輸入');
            return redirect('admin/blue');
        }
        Blue::create([
            'Verb' => $request->verb,
            'Noun' => $request->noun,
            'Adjective' => $request->adjective,
            'Adverb' => $request->adverb,
            'Count' => count(array_filter($request->except('_token')))
        ]);
        toastr()->success('新增成功');
        return redirect('admin/blue');
    }


    public function blue_edit(Request $request , $id)
    {
        $data = Blue::find($id);
        return view('admin.quiz.blue.edit' , compact('data'));
    }

    public function blue_update(Request $request , $id)
    {
        // dd(Blue::all());
        $data = Blue::find($id);
        $data->Verb = $request->verb;
        $data->Noun = $request->noun;
        $data->Adjective = $request->adjective;
        $data->Adverb = $request->adverb;
        $data->Count = count(array_filter($request->except(['_token','_method'])));
        $data->save();

        return redirect()->route('blue_show');
    }
    //----------------------後台----------------------------

    //----------------------前台----------------------------
    public function index_blue()
    {
        //
        // $yellow_word = Yellow::where('Count' , '>=' , '2')->inRandomOrder()->limit(5)->get();
        return view('quiz.blue.index');
    }

    public function menu_blue()
    {
        return view('quiz.blue.menu');
    }

    public function practice_blue()
    {
        return view('quiz.blue.practice');
    }

    public function getblue()
    {
        $blue_word = Blue::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->inRandomOrder()->limit(5)->get()->toArray();
        $blue_word[0] = array_filter($blue_word[0]);
        foreach($blue_word as $key => $value){
            $blue_word[$key] = array_values(array_filter($blue_word[$key]));
        }

        $new_randbox = [];
        $box = ["btn1" , "btn2" , "btn3" , "btn4" , "btn5" , "btn6" , "btn7" , "btn8" , "btn9" , "btn10"];
        while(count($box) >= 2){
            $getrand = rand(0 ,count($box)-1);
            $new_getrand = rand(0 , count($box)-1);
            while( $getrand == $new_getrand){
                $new_getrand = rand(0 , count($box)-1);
            }
            array_push($new_randbox , $box[$getrand]);
            array_push($new_randbox , $box[$new_getrand]);
            unset($box[$getrand]);
            unset($box[$new_getrand]);
            $box = array_values($box);
        }
        $new_word = [];
        foreach($blue_word as $word){
            switch(count($word)){
                case 2:
                    array_push($new_word , $word[0] , $word[1]);
                    break;
                case 3:
                    $getrand = rand(0 ,2);
                    $new_getrand = rand(0 , 2);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 2);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
                case 4:
                    $getrand = rand(0 ,3);
                    $new_getrand = rand(0 , 3);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 3);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
            }
        }
        return [$new_randbox , $new_word , array(0,0,1,1,2,2,3,3,4,4)];
    }


    public function practice_data_blue($id = 1)
    {
        switch($id){
            case 1:
                $blue_word = Blue::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->limit(5)->get()->toArray();
                break;
            case 2:
                $blue_word = Blue::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(5)->limit(5)->get()->toArray();
                break;
            case 3:
                $blue_word = Blue::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(10)->limit(5)->get()->toArray();
                break;
            case 4:
                $blue_word = Blue::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(15)->limit(5)->get()->toArray();
                break;
            case 5:
                $blue_word = Blue::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(20)->limit(5)->get()->toArray();
                break;
            case 6:
                $blue_word = Blue::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(25)->limit(5)->get()->toArray();
                break;
            case 7:
                $blue_word = Blue::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(30)->limit(5)->get()->toArray();
                break;
            case 8:
                $blue_word = Blue::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(35)->limit(5)->get()->toArray();
                break;
            case 9:
                $blue_word = Blue::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->offset(40)->limit(5)->get()->toArray();
                break;
            default:
                $blue_word = Blue::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->limit(5)->get()->toArray();
                break;
        }
        // $yellow_word = Yellow::where('Count' , '>=' , '2')->select('Verb' , 'Noun' , 'Adjective' , 'Adverb')->inRandomOrder()->limit(5)->get()->toArray();
        $blue_word[0] = array_filter($blue_word[0]);
        foreach($blue_word as $key => $value){
            $blue_word[$key] = array_values(array_filter($blue_word[$key]));
        }

        $new_randbox = [];
        $box = ["btn1" , "btn2" , "btn3" , "btn4" , "btn5" , "btn6" , "btn7" , "btn8" , "btn9" , "btn10"];
        while(count($box) >= 2){
            $getrand = rand(0 ,count($box)-1);
            $new_getrand = rand(0 , count($box)-1);
            while( $getrand == $new_getrand){
                $new_getrand = rand(0 , count($box)-1);
            }
            array_push($new_randbox , $box[$getrand]);
            array_push($new_randbox , $box[$new_getrand]);
            unset($box[$getrand]);
            unset($box[$new_getrand]);
            $box = array_values($box);
        }
        $new_word = [];
        foreach($blue_word as $word){
            switch(count($word)){
                case 2:
                    array_push($new_word , $word[0] , $word[1]);
                    break;
                case 3:
                    $getrand = rand(0 ,2);
                    $new_getrand = rand(0 , 2);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 2);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
                case 4:
                    $getrand = rand(0 ,3);
                    $new_getrand = rand(0 , 3);
                    while( $getrand == $new_getrand){
                        $new_getrand = rand(0 , 3);
                    }
                    array_push($new_word , $word[$getrand] , $word[$new_getrand]);
                    break;
            }
        }
        return [$new_randbox , $new_word , array(0,0,1,1,2,2,3,3,4,4)];
    }
    //----------------------前台----------------------------
}
