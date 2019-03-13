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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('/','DashboardController@admin')->name('admin-dashboard');

    Route::group(['prefix'=>'department'],function(){
        Route::get('/','DepartmentController@getDepartment')->name('department-list');
        Route::get('/add','DepartmentController@showDepartmentForm')->name('department-add');
        Route::post('/post','DepartmentController@postDepartment')->name('post-department');
        Route::get('/delete/{id}','DepartmentController@deleteDepartment')->name('department-delete');
        Route::get('/update/{id}','DepartmentController@showDepartmentForm')->name('department-edit');
        Route::post('/update/{id}','DepartmentController@postDepartment')->name('update-department');
    });

    Route::group(['prefix'=>'employee'],function(){
        Route::get('/','EmployeeController@getEmployee')->name('employee-list');
        Route::get('/add','EmployeeController@showEmployeeForm')->name('employee-add');
        Route::post('/post','EmployeeController@postEmployee')->name('post-employee');
        Route::get('/delete/{id}','EmployeeController@deleteEmployee')->name('employee-delete');
        Route::get('/update/{id}','EmployeeController@showEmployeeForm')->name('employee-edit');
        Route::post('/update/{id}','EmployeeController@postEmployee')->name('update-employee');
    });
});