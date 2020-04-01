<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use Illuminate\Http\Request;

Route::middleware('api')->group(function () {
		Route::post('login', 'UserController@login');

		Route::middleware('auth:api')->group(function () {
			Route::get('user', 'UserController@show');
			Route::post('user/profile/update', 'UserController@updateProfile');
			Route::post('user/password/update', 'UserController@updatePassword');
			Route::apiResources([
				'users' => 'UserController',

			]);
			Route::get('roles', 'UserController@getAllRole');
			Route::get('user/profile', 'UserController@profile');
			Route::get('statistic', 'StatisticController@index');

		});
	});
