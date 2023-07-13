<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Backend\ApartmentSaleController;
use App\Http\Controllers\Backend\RequestTableController;
use App\Http\Controllers\Backend\ParserController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ActionLogsController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ParsingController;
use App\Http\Controllers\Backend\ObjectTableController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\StreetController;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
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

Auth::routes([
//    'register'=>false
]);
Route::redirect('/real-estate', '/ru/real-estate');
Route::group(['prefix'=>'{language}', 'middleware' => ['setlanguage']], function() {
    Route::get('crawler', [FrontendController::class, 'crawler'])->name('crawler');
    Route::get('after-prse', [FrontendController::class, 'prse'])->name('prse');
    Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha'])->name('reload-captcha');
    //=========================backend=================================================
    Route::group(['prefix'=>'real-estate', 'middleware' => ['auth', 'realestate']], function () {
        Route::get('parsing-url', [ParserController::class, 'parsingUrl'])->name('parsingUrl');
        Route::post('parsing-filter', [ParserController::class, 'parsingFilter'])->name('parsing_filter');
        Route::get('count-flats', [ParserController::class, 'countFlats'])->name('countFlats');
        Route::get('reload-page', [ParserController::class, 'reloadPage'])->name('reloadPage');
        Route::get('to-apartment/{id}', [ParserController::class, 'toApartment'])->name('to_apartment');
        Route::get('parsing', [ParserController::class, 'parsing'])->name('parsing');
        Route::get('olx-flat-delete', [ParserController::class, 'olxFlatDelete'])->name('olxFlatDelete');
        // Tast parsing olx
        Route::get('test', [FrontendController::class, 'json_file_binding']);
        Route::get('test/parsing/number', [ParsingController::class, 'index']);

        Route::get('parsing-obmen', [FrontendController::class, 'parsingObmen'])->name('parsingObmen');
        Route::get('/', [BackendController::class, 'index'])->name('backend.index');
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
//        Route::get('/create',[UserController::class, 'create'])->middleware('can:isAdmin,can:isManager')->name('user.create');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
            Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->middleware('can:isAdmin')->name('user.destroy');
        });
        Route::group(['prefix' => 'action-logs'], function () {
            Route::get('/', [ActionLogsController::class, 'index'])->name('action-logs.index');
            //        Route::get('/create',[LoggingController::class, 'create'])->name('action-logs.create');
            //        Route::post('/store',[LoggingController::class, 'store'])->name('action-logs.store');
            //        Route::get('/edit/{id}',[LoggingController::class, 'edit'])->name('action-logs.edit');
            //        Route::put('/update/{id}',[LoggingController::class, 'update'])->name('action-logs.update');
            Route::get('/show/{id}', [ActionLogsController::class, 'show'])->name('action-logs.show');
            Route::delete('/destroy/{id}', [ActionLogsController::class, 'destroy'])->middleware('can:isAdmin')->name('action-logs.destroy');
            Route::delete('/destroy-multiple/', [ActionLogsController::class, 'destroyMultiple'])->name('action-logs.destroyMultiple');
            Route::delete('/destroy-all', [ActionLogsController::class, 'destroyAll'])->name('action-logs.destroyAll');

        });

        Route::group(['prefix' => 'apartment-sale'], function () {
            Route::get('/', [ApartmentSaleController::class, 'index'])->name('apartment-sale.index');
            Route::post('/parsing/number', [ApartmentSaleController::class, 'parsingNumber'])->name('apartment-sale.parsing_numbere');
            Route::get('/create', [ApartmentSaleController::class, 'create'])->name('apartment-sale.create');
            // Route::post('/', [ApartmentSaleController::class, 'store'])->name('apartment-sale.store');
            Route::get('/edit/{id}', [ApartmentSaleController::class, 'edit'])->name('apartment-sale.edit');
            Route::put('/update/{id}', [ApartmentSaleController::class, 'update'])->name('apartment-sale.update');
            Route::get('/show/{id}', [ApartmentSaleController::class, 'show'])->name('apartment-sale.show');
            Route::delete('/destroy/{id}', [ApartmentSaleController::class, 'destroy'])->name('apartment-sale.destroy');
            Route::delete('/alldestroy', [ApartmentSaleController::class, 'alldestroy'])->name('apartment-sale.alldestroy');
            //        Route::delete('/destroy-multiple/',[ApartmentSaleController::class, 'destroyMultiple'])->name('apartment-sale.destroyMultiple');
            Route::delete('/destroy-img-item/{id}', [ApartmentSaleController::class, 'destroy_img_item'])->name('apartment-sale.destroy_img_item');
            Route::delete('/destroy-img-cron/{id}', [ApartmentSaleController::class, 'destroy_img_cron'])->name('apartment-sale.destroy_img_cron');
            Route::post('/file-upload', [ApartmentSaleController::class, 'fileUpload'])->name('real-estate.apartment-sale.file-upload');
            Route::post('/file-sort', [ApartmentSaleController::class, 'fileSort'])->name('real-estate.apartment-sale.file-sort');
            Route::post('/file-delete/{key}', [ApartmentSaleController::class, 'fileDelete'])->name('real-estate.apartment-sale.file-delete');
            Route::delete('/file-delete-all', [ApartmentSaleController::class, 'fileDeleteAll'])->name('real-estate.apartment-sale.file-delete-all');
        });

        Route::group(['prefix' => 'request'], function () {
            Route::get('/', [RequestTableController::class, 'index'])->name('request.index');
            Route::get('/create', [RequestTableController::class, 'create'])->name('request.create');
            Route::post('/store', [RequestTableController::class, 'store'])->name('request.store');
            Route::get('/edit/{id}', [RequestTableController::class, 'edit'])->name('request.edit');
            Route::put('/update/{id}', [RequestTableController::class, 'update'])->name('request.update');
            Route::get('/show/{id}', [RequestTableController::class, 'show'])->name('request.show');
            Route::delete('/destroy/{id}', [RequestTableController::class, 'destroy'])->name('request.destroy');
            Route::delete('/alldestroy', [RequestTableController::class, 'alldestroy'])->name('request.alldestroy');
            Route::delete('/destroy-img-item/{id}', [RequestTableController::class, 'destroy_img_item'])->name('request.destroy_img_item');
            Route::delete('/destroy-img-cron/{id}', [RequestTableController::class, 'destroy_img_cron'])->name('request.destroy_img_cron');
            Route::post('/file-upload', [RequestTableController::class, 'fileUpload'])->name('real-estate.request.file-upload');
            Route::post('/file-sort', [RequestTableController::class, 'fileSort'])->name('real-estate.request.file-sort');
            Route::post('/file-delete/{key}', [RequestTableController::class, 'fileDelete'])->name('real-estate.request.file-delete');
            Route::delete('/file-delete-all', [RequestTableController::class, 'fileDeleteAll'])->name('real-estate.request.file-delete-all');
        });

        Route::group(['prefix' => 'parser'], function () {
            Route::get('/', [ParserController::class, 'index'])->name('parser.index');
            Route::get('/create', [ParserController::class, 'create'])->name('parser.create');
            Route::post('/store', [ParserController::class, 'store'])->name('parser.store');
            Route::get('/edit/{id}', [ParserController::class, 'edit'])->name('parser.edit');
            Route::put('/update/{id}', [ParserController::class, 'update'])->name('parser.update');
            Route::get('/show/{id}', [ParserController::class, 'show'])->name('parser.show');
            Route::delete('/destroy/{id}', [ParserController::class, 'destroy'])->name('parser.destroy');
            Route::delete('/alldestroy', [ParserController::class, 'alldestroy'])->name('parser.alldestroy');
            //        Route::delete('/destroy-multiple/',[ApartmentSaleController::class, 'destroyMultiple'])->name('apartment-sale.destroyMultiple');
            Route::delete('/destroy-img-item/{id}', [ParserController::class, 'destroy_img_item'])->name('parser.destroy_img_item');
            Route::delete('/destroy-img-cron/{id}', [ParserController::class, 'destroy_img_cron'])->name('parser.destroy_img_cron');
            Route::post('/file-upload', [ParserController::class, 'fileUpload'])->name('real-estate.parser.file-upload');
            Route::post('/file-sort', [ParserController::class, 'fileSort'])->name('real-estate.parser.file-sort');
            Route::post('/file-delete/{key}', [ParserController::class, 'fileDelete'])->name('real-estate.parser.file-delete');
            Route::delete('/file-delete-all', [ParserController::class, 'fileDeleteAll'])->name('real-estate.parser.file-delete-all');
        });

        Route::group(['prefix' => 'object'], function () {
            Route::get('/', [ObjectTableController::class, 'index'])->name('object.index');
            Route::get('/create', [ObjectTableController::class, 'create'])->name('object.create');
            Route::get('/find-town/{id}', [ObjectTableController::class, 'findTown'])->name('object.find-town');
            Route::get('/find-area/{id}', [ObjectTableController::class, 'findArea'])->name('object.find-area');
            Route::post('/store', [ObjectTableController::class, 'store'])->name('object.store');
            Route::get('/edit/{id}', [ObjectTableController::class, 'edit'])->name('object.edit');
            Route::put('/update/{id}', [ObjectTableController::class, 'update'])->name('object.update');
            Route::get('/show/{id}', [ObjectTableController::class, 'show'])->name('object.show');
            Route::delete('/destroy/{id}', [ObjectTableController::class, 'destroy'])->name('object.destroy');
            Route::delete('/destroy-img-item/{id}', [ObjectTableController::class, 'destroy_img_item'])->name('object.destroy_img_item');
            Route::delete('/destroy-file-item/{id}', [ObjectTableController::class, 'destroy_file_item'])->name('object.destroy_file_item');
            Route::post('/file-upload', [ObjectTableController::class, 'fileUpload'])->name('real-estate.object.file-upload');
            Route::post('/image-upload', [ObjectTableController::class, 'imageUpload'])->name('real-estate.object.image-upload');
            Route::post('/file-delete/{key}', [ObjectTableController::class, 'fileDelete'])->name('real-estate.object.file-delete');
            Route::post('/image-delete/{key}', [ObjectTableController::class, 'imageDelete'])->name('real-estate.object.image-delete');
        });

    });


});
Route::redirect('/', '/forthebuilder');


