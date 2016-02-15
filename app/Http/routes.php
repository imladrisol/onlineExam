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

        //Route::get('/','SubjectController@getIndex');
        Route::get('results', ['as'=>'subjects.results','uses'=>'SubjectController@getAllSubjectsResults']);
        Route::get('subject/new', ['as'=>'subject.new', 'uses'=>'SubjectsController@getNew']);
        Route::resource('subject', 'SubjectController', ['except' => ['result', 'save-question', 'before-exam', 'start-exam']]);
        Route::controller('user', 'UserController');
    });

    Route::group(['prefix'=>'user',  'middleware' => 'user'], function(){
        Route::get('/', function(){return view('user.index');});
        Route::get('result/{id}',['as'=>'result','uses'=>'SubjectController@getShowResultOfSubjectForGuest']);
        Route::post('subject/save-question-result/{id}', ['as'=>'save-question','uses'=>'SubjectController@postSaveQuestionResult']);
        Route::get('subject/{id}/start', ['as'=>'before-exam','uses'=>'SubjectController@getBeforeStartTest']);
        Route::get('subject/{id}/start-test', ['as'=>'start-exam','uses'=>'SubjectController@getStartTest']);

    });
});



