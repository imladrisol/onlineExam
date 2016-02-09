<?php

use Illuminate\Contracts\Auth\Access\Gate;


Route::group(['middleware' => 'web'], function () {

    Route::auth();
    Route::get('/home', function(){
        return redirect('/');
    });
    Route::get('/', 'HomeController@index');
    Route::group(['prefix'=>'admin',  'middleware' => 'admin'], function(){
        Route::get('/', function(){
            return view('admin.index');
        });
        Route::get('/user', function(){
            return view('admin.user');
        });

        Route::controller('category', 'CategoryController');
        //Route::get('subject/{id}/start-test', 'SubjectController@getStartTest');
        Route::get('subject/save-question-result/{id}', 'SubjectController@postSaveQuestionResult');
        Route::get('subject/{id}/start', 'SubjectController@getBeforeStartTest');

        Route::controller('subject', 'SubjectController');
        Route::controller('user', 'UserController');
    });
});



