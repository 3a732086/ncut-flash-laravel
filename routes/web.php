<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    $users = \App\User::count();
    $courses = \App\Course::count();
    $date = date("Y-m-d");
    $today_data = \App\Userdata::where('inserted_at' , 'like' , "%$date%")->count();
    $today_user = \App\User::where('updated_at' , 'like' , "%$date%")->count();
    return view('index',compact('users' , 'courses' , 'today_data' , 'today_user'));
});

Route::group(['middleware' => 'newauth'],function (){
    Route::get('/lobby','FlashController@index');
    Route::get('/getAllqa','FlashController@get_allqa');
    Route::post('/insert','FlashController@insert');
    Route::post('/ctr','FlashController@CTR');
    Route::get('/detail','FlashController@show_detail')->name('user_show');
    // Route::resource('/account','AccountController');


});
Route::group(['middleware' => 'adminauth'],function (){
    Route::get('/quiz_show','QuizController@quiz_show')->name('quiz_show');

    Route::group(['prefix' => 'quiz'],function (){
        Route::get('/','QuizController@index')->name('test');
        Route::get('/getyellow','QuizController@getyellow');
        Route::post('/save','QuizController@save');

        Route::get('/menu','QuizController@menu')->name('menu');
        Route::get('/practice','QuizController@practice')->name('practice');
        Route::get('/practice_data/{id?}','QuizController@practice_data')->name('practice_data');

        //-------------------------------------------------------------------------------------------
        //green_section
        Route::get('/green','QuizController@index_green')->name('test_green');
        Route::get('/getgreen','QuizController@getgreen');

        Route::get('/menu_green','QuizController@menu_green')->name('menu_green');
        Route::get('/practice_green','QuizController@practice_green')->name('practice_green');
        Route::get('/practice_data_green/{id?}','QuizController@practice_data_green')->name('practice_data_green');

        //-------------------------------------------------------------------------------------------
        //blue_section
        Route::get('/blue','QuizController@index_green')->name('test_blue');
        Route::get('/getblue','QuizController@getblue');

        Route::get('/menu_blue','QuizController@menu_blue')->name('menu_blue');
        Route::get('/practice_blue','QuizController@practice_blue')->name('practice_blue');
        Route::get('/practice_data_blue/{id?}','QuizController@practice_data_blue')->name('practice_data_blue');
    });
});

Route::group(['prefix' => 'admin' , 'middleware' => 'adminauth'],function (){
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/show', 'AdminController@show')->name('admin_show');
    Route::get('/click_rate', 'AdminController@click_rate_show')->name('ctr_show');
    Route::get('/user_activity', 'AdminController@activity')->name('user_activity');
    // Route::get('/setting','AdminController@setting_index');
    Route::resource('/setting','SettingController');
    Route::resource('/course', 'CourseController');
    Route::resource('/coursetopic', 'CourseTopicController');

    Route::post('/coursetopic/getcourse', 'CourseTopicController@getcourse');
    //export data↓↓↓↓↓↓↓

    Route::get('/export_U_data', 'AdminController@Userdata_Export')->name('Userdata2xls');
    Route::get('/export_U_activity', 'AdminController@UserActivity_Export')->name('Useractivity2xls');

    //export data↑↑↑↑↑↑↑
    Route::get('/yellow','QuizController@yellow_show')->name('yellow_show');
    Route::post('/yellow','QuizController@yellow_word_insert')->name('yellow_word_insert');
    Route::get('/yellow/{id?}/edit','QuizController@edit')->name('yellow.edit');
    Route::post('/yellow/update/{id?}','QuizController@update')->name('yellow.update');

    Route::get('/show_data','QuizController@show_data')->name('show_data');
    Route::get('/quiz_record','QuizController@quiz_record')->name('quiz_record');


    //green
    Route::get('/green','QuizController@green_show')->name('green_show');
    Route::post('/green','QuizController@green_word_insert')->name('green_word_insert');
    Route::get('/green/{id?}/edit','QuizController@green_edit')->name('green.edit');
    Route::post('/green/update/{id?}','QuizController@green_update')->name('green.update');


    //blue
    Route::get('/blue','QuizController@blue_show')->name('blue_show');
    Route::post('/blue','QuizController@blue_word_insert')->name('blue_word_insert');
    Route::get('/blue/{id?}/edit','QuizController@blue_edit')->name('blue.edit');
    Route::post('/blue/update/{id?}','QuizController@blue_update')->name('blue.update');

});

// Route::group(['prefix' => 'course' , 'middleware' => 'adminauth'],function (){


    // Route::get('/course','AdminController@setting_index');

    // Route::get('/click_rate', 'AdminController@click_rate_show')->name('ctr_show');
    // Route::get('/user_activity', 'AdminController@activity')->name('user_activity');
    // Route::get('/setting','AdminController@setting_index');

// });

// Route::get('speech_recognition','FlashController@speech_recognition');



