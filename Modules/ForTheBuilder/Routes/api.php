<?php

use Illuminate\Http\Request;
use Modules\ForTheBuilder\Http\Controllers\Api\LeadsApiController;
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

//Route::middleware('auth:api')->get('/forthebuilder', function (Request $request) {
//    return $request->user();
//});




Route::group(['prefix'=>'forthebuilder'],function(){
    Route::group(['prefix'=>'leads'],function(){
        Route::post('/store',[LeadsApiController::class, 'store'])->name('forthebuilder-api.leads.store');

    });
    Route::get('/test',function (){
        echo 'test';
    });
});
