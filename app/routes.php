<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

//Auth routes for login view and OAUTH2 login google.
Route::get('/auth/google', array('uses' => 'AuthController@googleLogin', 'as' => 'auth'));

Route::get('/auth/login', array('uses' => 'AuthController@getLogin', 'as' => 'login'));

//Route group, can only access routes inside if you are logged in.
Route::group(array('before' => 'auth'), function() {
    
    //Route for index/home view
    Route::get('/', array('uses' => 'ModuleController@hello', 'as' => 'home'));
    
    //Route for watching chapters
    Route::get('/module/{mid}/chapter/{cid}', array('uses' => 'ModuleController@viewChapter', 'as' => 'viewChapter'));
    
    //Route for logout
    Route::get('/auth/logout', array('uses' => 'AuthController@getLogout', 'as' => 'getLogout'));

    //Route group for form posts, only for admin functions
    Route::group(array('before' => 'csrf'), function(){
        
        Route::post('/module/{mid}/chapter/{cid}/question/{nr}', array('uses' => 'ModuleController@nextQuestion', 'as' => 'nextQuestion'));

    });

});


//Route group for admin views/functions
Route::group(array('before' => 'isAdmin', 'prefix' => 'admin'), function() {

    Route::get('/', array('uses' => 'AdminController@index', 'as' => 'adminIndex'));

    //START -- Chapters functions and views --
    
    Route::get('/module/{id}/chapter', array('uses' => 'AdminController@getChapter', 'as' => 'getChapters'));

    Route::get('/module/{mid}/chapter/{cid}/edit', array('uses' => 'AdminController@editChapter', 'as' => 'editChapter'));

    Route::get('/module/{id}/chapter/add', array('uses' => 'AdminController@addChapter', 'as' => 'addChapter'));
    
    Route::get('/module/{mid}/chapter/{cid}/remove', array('uses' => 'AdminController@postRemoveChapter', 'as' => 'removeChapter'));

    Route::get('/module/{id}/chapter/{cid}/question', array('uses' => 'AdminController@showQA', 'as' => 'question'));

    Route::get('/module/{id}/chapter/{cid}/question/{qid}/addanswer', array('uses' => 'AdminController@getAnswer', 'as' => 'addAnswer'));

    Route::get('/module/{id}/chapter/{cid}/question/{qid}/editquestion', array('uses' => 'AdminController@editQuestion', 'as' => 'editQuestion'));

    Route::get('/module/{id}/chapter/{cid}/question/{qid}/editanswer/{aid}', array('uses' => 'AdminController@editAnswer', 'as' => 'editAnswer'));

    Route::get('/module/{id}/chapter/{cid}/question/{qid}/removequestion', array('uses' => 'AdminController@removeQuestion', 'as' => 'removeQuestion'));

    Route::get('/module/{id}/chapter/{cid}/question/{qid}/removeanswer', array('uses' => 'AdminController@removeAnswer', 'as' => 'removeAnswer'));
    //END -- Chapters functions and views --


    //START -- Modules functions and views --
        Route::get('/module', array('uses' => 'AdminController@showModule', 'as' => 'showModule'));

        Route::get('/module/remove/{id}', array('uses' => 'AdminController@removeModule', 'as' => 'removeModule'));
        
        Route::get('/module/add', array('uses' => 'AdminController@addModule', 'as' => 'addModule'));

        Route::get('/module/{id}/edit', array('uses' => 'AdminController@editModule', 'as' => 'editModule'));
    //END -- Modules functions and views --
    
    //START -- Users functions and views --

        Route::get('/users', array('uses' => 'AdminController@getUsers', 'as' => 'getUsers'));
        Route::get('/users/page/{nr}', array('uses' => 'AdminController@getUsers', 'as' => 'getUsers'));

        Route::get('/users/add', array('uses' => 'AdminController@addUser', 'as' => 'addUser'));

        Route::get('/users/remove', array('uses' => 'AdminController@removeUser', 'as' => 'removeUser'));

        Route::get('/users/{id}/edit', array('uses' => 'AdminController@editUser', 'as' => 'editUser'));

        Route::get('/users/addxml', array('uses' => 'AdminController@addXml', 'as' => 'addXml'));
    
        Route::get('/users/{id}', array('uses' => 'AdminController@postRemoveUser', 'as' => 'removeUser'));


    //Route group for form posts, only for admin functions
    Route::group(array('before' => 'csrf'), function(){
        
        Route::post('/module/{mid}/chapter/{cid}/edit', array('uses' => 'AdminController@postEditChapter', 'as' => 'postEditChapter'));

        Route::post('/module/add', array('uses' => 'AdminController@postModule', 'as' => 'postModule'));

        Route::post('/module/{id}/edit', array('uses' => 'AdminController@postEditModule', 'as' => 'postEditModule'));

        Route::post('/module/{id}/chapter/add', array('uses' => 'AdminController@postAddChapter', 'as' =>'postAddChapter'));

        Route::post('/users/{id}/edit', array('uses' => 'AdminController@postEditUser', 'as' => 'postEditUser'));
        
        Route::post('/users/addxml', array('uses' => 'AdminController@postXml', 'as' => 'postXml'));
        
        Route::post('/users/add', array('uses' => 'AdminController@postUser', 'as' => 'postUser'));
        
        Route::post('/users/search', array('uses' => 'AdminController@postSearch', 'as' => 'postSearch'));

        Route::post('/module/{id}/chapter/{cid}/question', array('uses' => 'AdminController@postAddQuestion', 'as' => 'addQuestion'));

        Route::post('/module/{id}/chapter/{cid}/question/{qid}/addanswer', array('uses' => 'AdminController@postAddAnswer', 'as' => 'postAddAnswer'));

        Route::post('/module/{id}/chapter/{cid}/question/{qid}/editquestion', array('uses' => 'AdminController@postEditQuestion', 'as' => 'postEditQuestion'));    

        Route::post('/module/{id}/chapter/{cid}/question/{qid}/editanswer', array('uses' => 'AdminController@postEditAnswer', 'as' => 'postEditAnswer'));

    });
    
});


