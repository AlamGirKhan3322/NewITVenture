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
        
        //Route::get('/','PaymentController@showForm')->name('form-show');
        // Route::post('/post','ProductController@postProductOne')->name('post-productone');
        
    
});
Route::group(['prefix'=>'teamrole'],function(){
        Route::get('/','TeamController@getTeamRole')->name('teamrole-list');
        Route::get('/add','TeamController@showTeamRoleForm')->name('teamrole-add');
        Route::post('/post','TeamController@postTeamRole')->name('post-teamrole');
        Route::post('/edit/{id}','TeamController@postTeamRole')->name('update-teamrole');
        Route::get('/delete/{id}','TeamController@deleteTeamRole')->name('delete-teamrole');
        Route::get('/edit/{id}','TeamController@showTeamRoleForm')->name('edit-teamrole');
    });
Route::group(['prefix'=>'team'],function(){
        Route::get('/','TeamController@getTeam')->name('team-list');
        Route::get('/add','TeamController@showTeamForm')->name('team-add');
        Route::post('/post','TeamController@postTeam')->name('post-team');
        Route::post('/edit/{id}','TeamController@postTeam')->name('update-team');
        Route::get('/delete/{id}','TeamController@deleteTeam')->name('delete-team');
        Route::get('/edit/{id}','TeamController@showTeamForm')->name('edit-team');
    });
    Route::group(['prefix'=>'msg'],function(){
        Route::get('/','MsgController@getMsg')->name('msg-list');
        Route::get('/add','MsgController@showMsgForm')->name('msg-add');
        Route::post('/post','MsgController@postMsg')->name('post-msg');
        Route::post('/edit/{id}','MsgController@postMsg')->name('update-msg');
        Route::get('/delete/{id}','MsgController@deleteMsg')->name('delete-msg');
        Route::get('/edit/{id}','MsgController@showMsgForm')->name('edit-msg');
        Route::get('/role/{id}','TeamController@getMemberByRoleId');
    });