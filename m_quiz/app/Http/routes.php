<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();
Route::get('/home', 'HomeController@index');
Route::group(['domain' => env('DOMAIN'), 'middleware' => ['auth', 'student']], function(){
	Route::get('/', function () {
	    return view('welcome');
	});




    Route::get('/demo', function () {
        return view('quiz.demo');
    });

    Route::group(['prefix' => 'bai-thi'], function () {
        Route::get('/', ['uses' => 'BaiThiController@index', 'as' => 'bai_thi.list']);
        Route::get('/{id}', ['uses' => 'BaiThiController@quiz', 'as' => 'bai_thi.quiz']);
        Route::post('/{id}', ['uses' => 'BaiThiController@finish', 'as' => 'bai_thi.finish']);
    });

    Route::group(['prefix' => 'test'], function () {;
        Route::get('/', ['uses' => 'TestController@index', 'as' => 'test.list']);
        Route::get('/{id}', ['uses' => 'TestController@test', 'as' => 'test.quiz']);
        Route::post('/{id}', ['uses' => 'TestController@finishTest', 'as' => 'test.finish']);
    });

    Route::group(['prefix' => 'past'], function () {;
        Route::get('/', ['uses' => 'PastController@index', 'as' => 'past.list']);
        Route::get('/{id}', ['uses' => 'PastController@detail', 'as' => 'past.detail']);
    });

    Route::get('/thong-ke', ['uses' => 'BaiThiController@statistic', 'as' => 'statistic.details']);

});
