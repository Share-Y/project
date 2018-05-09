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

Route::get('/','IndexController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('question')->group(function(){
  Route::any('/index','QuestionController@index')->name('index');

  Route::get('/editor','QuestionController@editor')->name('editor');

  Route::post('/publish','QuestionController@publish')->name('publish');

  Route::get('/index/show','AnswerController@show')->name('show');
});

Route::prefix('answer')->group(function(){
  Route::post('/store','AnswerController@store')->name('store');
});

Route::prefix('question/index')->group(function(){
    Route::get('type/{type?}', function ($num){
        return 'type '.$num;
    });
});


Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){

  Route::any('/roles/index','RolesController@index');
  Route::any('/roles/store','RolesController@store');
  Route::any('/roles/update/{id}','RolesController@update');
  Route::any('/roles/destroy/{id}','RolesController@destroy');

  Route::any('/permissions/store','PermissionsController@store');
  Route::any('/permissions/index','PermissionsController@index');
  Route::any('/permissions/destroy/{id}','PermissionsController@destroy');
  Route::any('/permissions/update/{id}','PermissionsController@update');

  Route::any('/users/index','UsersController@index');
  Route::any('/users/update/{id}','UsersController@update');
  Route::any('/users/destroy/{id}','UsersController@destroy');
});
