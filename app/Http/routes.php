<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('login');
});

Route::post('login', 'Auth\AuthController@authenticate');
Route::get('logout', 'Controller@getLogout');

Route::get('dashboard','Controller@getDashboard');
	
Route::get('student/homework_details/{id}', 'Controller@getHomework');
Route::post('student/homework_submit', 'Controller@postHomework');

Route::get('teacher/homework_submissions/{id}', 'Controller@getHomeworkSubmissions');
Route::get('teacher/student_submissions/{homeworkid}/{studentid}', 'Controller@getStudentHomeworkHistory');



