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

use App\Http\Controllers\Backend\{
    UserController
};

Route::namespace('Backend')->group(function () {
    Route::post('login', 'UserController@login');

    Route::middleware('auth:api')->group(function () {
		Route::get('info', 'UserController@info');
		Route::post('logout', 'UserController@logout');
		Route::get('user/profile', 'UserController@profile');
		Route::apiResources([
			'users' => 'UserController',
		]);
	});
});
