<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix'=>'auth'], function (){
    Route::post('/register', 'api\PassportAuthController@register')->name('reg');
    Route::post('/login', 'api\PassportAuthController@login');

    Route::group(['middleware'=>'auth:api'], function (){
        Route::get('/logout', 'api\PassportAuthController@logout');
    });
});
Route::middleware('auth:api')->group(function () {
    Route::post('info', 'api\shopController@info');
  //  Route::post('bay', 'api\shopController@bay');
    Route::post('bay/{id_product}', 'api\shopController@bay');
});