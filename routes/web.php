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

Route::get('/social/{provider}/authorize', ['as' => 'ms.authorize', 'uses' => 'Auth\MobileSocialController@redirectToProvider']);
Route::get('/social/{provider}/callback', ['as' => 'ms.callback', 'uses' => 'Auth\MobileSocialController@handleProviderCallback']);

Route::get('reset_password/{token}', ['as' => 'password.reset', function($token)
{
     //implement your reset password route here!
}]);

Route::get('/', function () {
    return view('welcome');
});
