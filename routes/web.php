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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::pattern('id', '[0-9]+');
Route::pattern('question_id', '^-?[0-9]\d*(\.\d+)?$');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [
        'uses' => 'ProjectController@view',
        'as' => 'projects.view'
    ]);

    Route::get('/projects/list', [
        'uses' => 'ProjectController@getList',
        'as' => 'projects.list'
    ]);

    Route::post('/project/{project_id}/create', [
        'uses' => 'ProjectController@create',
        'as' => 'project.create'
    ]);

    Route::get('/project/{id}/edit', [
        'uses' => 'ProjectController@edit',
        'as' => 'project.edit'
    ]);
    Route::post('/project/delete/{id}', [
        'uses' => 'ProjectController@destroy',
        'as' => 'project.delete'
    ]);
    
    Route::get('/project/{id}', [
        'uses' => 'QuestionController@view',
        'as' => 'questions.view'
        
    ]);

    Route::get('/project/{id}/questions/list', [
        'uses' => 'QuestionController@getList',
        'as' => 'questions.list'
    ]);
    
    Route::get('/project/{id}/question/{question_id}/open-modal',[
        'uses' => 'QuestionController@openModal',
        'as'   => 'question.open.modal'
    ]);
    
    Route::post('/project/{id}/question/{question_id}/create', [
        'uses' => 'QuestionController@create',
        'as' => 'question.create'
    ]);
    
    Route::post('/project/{id}/question/{question_id}/edit', [
        'uses' => 'QuestionController@create',
        'as' => 'question.edit'
    ]);
});


//Route::get('/project',[
//   'uses' => 'ProjectController@viewProjects',
//   'as'   => 'projects.view'
//]);
//
//Route::get('/project/{num}',[
//   'uses' => 'QuestionController@view',
//   'as'   => 'questions.view'
//]);
//
//Route::get('/question/view',[
//   'uses' => 'QuestionController@view',
//   'as'   => 'question.view'
//]);
