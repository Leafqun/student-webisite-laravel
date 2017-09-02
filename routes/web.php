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

Route::get('/', function () {
    return 'hello world';
});
Route::get('/a', function () {
    return view('1');
});
Route::get('/b', function () {
    return view('2');
});
Route::get('/login', [
        'uses' =>  'LoginController@login',//控制器与路由绑定
        'as' => 'login'// 路由命名
    ]
);
Route::get('/notice/getHeadNotice', [
        'uses' =>  'NoticeController@getHeadNotice',//控制器与路由绑定
        'as' => 'getHeadNotice'// 路由命名
    ]
);
Route::get('/notice/getNotice', [
        'uses' =>  'NoticeController@getNotice',//控制器与路由绑定
        'as' => 'getNotice'// 路由命名
    ]
);
Route::get('/notice/getNoticeContent', 'NoticeController@getNoticeContent');
Route::post('/notice/submitNotice', 'NoticeController@submitNotice');
Route::any('/notice/deleteNotice', 'NoticeController@deleteNotice');

Route::get('/message/getMessageList', 'MessageController@getMessageList');
Route::get('/message/getMessage', 'MessageController@getMessage');
Route::post('/message/insertMessage', 'MessageController@insertMessage');
Route::any('/message/deleteMessage', 'MessageController@deleteMessage');

Route::get('/course/getCourseList', 'CourseController@getCourseList');
Route::get('/course/getCourse', 'CourseController@getCourse');
Route::post('/course/submitCourse', 'CourseController@submitCourse');
Route::get('/course/deleteCourse', 'CourseController@deleteCourse');

Route::get('/course/getAllCourseFile', 'CourseController@getAllCourseFile');
Route::get('/course/deleteCourseFile', 'CourseController@deleteCourseFile');
Route::post('/course/insertCourseFile', 'CourseController@insertCourseFile');

Route::get('/tables/getTables', 'TablesController@getTables');
Route::get('/tables/deleteTables', 'TablesController@deleteTables');
Route::post('/tables/insertTables', 'TablesController@insertTables');
