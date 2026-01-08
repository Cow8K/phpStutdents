<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');

/**
 * 后台页面
 */
Route::group('admin', function () {
    Route::get('index', 'web.Admin/index');
    Route::get('login', 'web.Admin/login');
    Route::get('adminManage', 'web.Admin/adminManage');

    Route::get('', 'web.StuClazz/clazzManage');
});

Route::group('stuClazz', function () {
    Route::get('clazzManage', 'web.StuClazz/clazzManage');
});

Route::group('student', function () {
    Route::get('studentManage', 'web.Student/studentManage');
});

/**
 * 接口
 */
Route::group('api', function () {
    Route::get('admin/adminList', 'api.ApiAdmin/adminList');
    Route::post('admin/login', 'api.ApiAdmin/login');
    Route::post('admin/addAdmin', 'api.ApiAdmin/addAdmin');
    Route::post('admin/deleteAdmin', 'api.ApiAdmin/deleteAdmin');
    Route::post('admin/updateAdmin', 'api.ApiAdmin/updateAdmin');

    Route::get('clazz/clazzList', 'api.ApiStuClazz/clazzList');
    Route::post('clazz/addClazz', 'api.ApiStuClazz/addClazz');
    Route::post('clazz/deleteClazz', 'api.ApiStuClazz/deleteClazz');
    Route::post('clazz/updateClazz', 'api.ApiStuClazz/updateClazz');

    Route::get('student/studentList', 'api.ApiStudent/studentList');
    Route::post('student/addStudent', 'api.ApiStudent/addStudent');
    Route::post('student/deleteStudent', 'api.ApiStudent/deleteStudent');
    Route::post('student/updateStudent', 'api.ApiStudent/updateStudent');
});
