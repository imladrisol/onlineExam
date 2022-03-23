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
        Route::get('results', ['as'=>'subjects.results','uses'=>'SubjectController@getAllSubjectsResults']);
        Route::get('subject', ['as'=>'subject.index', 'uses'=>'SubjectController@getIndex']);
        Route::get('subject/new', ['as'=>'subject.new', 'uses'=>'SubjectController@getNew']);
        Route::get('subject/{id}', ['as'=>'subject.question', 'uses'=>'SubjectController@getQuestions']);
        Route::post('subject/{id}/edit', ['as'=>'subject.question.post.edit', 'uses'=>'SubjectController@postEditQuestion']);
        Route::post('subject/new', ['as'=>'subject.new', 'uses'=>'SubjectController@postNewSubject']);
        Route::post('subject/{id}', 'SubjectController@postNewQuestion');
        Route::get('subject/{id}/edit', ['as'=>'subject.question.edit', 'uses'=>'SubjectController@getEdit']);
        Route::get('subject/{id}/delete', ['as'=>'subject.question.delete', 'uses'=>'SubjectController@getDelete']);
        Route::get('subject/{id}/delete', ['as'=>'subject.question.delete', 'uses'=>'SubjectController@getDeleteQuestion']);
        Route::patch('subject/{id}/edit', ['as'=>'subject.question.patch.edit', 'uses'=>'SubjectController@patchEdit']);
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



