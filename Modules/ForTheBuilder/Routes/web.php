<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Modules\ForTheBuilder\Http\Controllers\CalendarController;
use Modules\ForTheBuilder\Http\Controllers\BookingController;
use Modules\ForTheBuilder\Http\Controllers\CurrencyController;
use Modules\ForTheBuilder\Http\Controllers\LeadListsController;
use Modules\ForTheBuilder\Http\Controllers\UserController;
use Modules\ForTheBuilder\Http\Controllers\ClientsController;
use Modules\ForTheBuilder\Http\Controllers\ActionLogsController;
use Modules\ForTheBuilder\Http\Controllers\CouponContoller;
use Modules\ForTheBuilder\Http\Controllers\HouseController;
use Modules\ForTheBuilder\Http\Controllers\HouseFlatController;
use Modules\ForTheBuilder\Http\Controllers\DealController;
use Modules\ForTheBuilder\Http\Controllers\ForTheBuilderController;
use Modules\ForTheBuilder\Http\Controllers\LeadCommentController;
use Modules\ForTheBuilder\Http\Controllers\LeadStatusController;
use Modules\ForTheBuilder\Http\Controllers\InstallmentPlanController;
use Modules\ForTheBuilder\Http\Controllers\TaskController;
use Modules\ForTheBuilder\Http\Controllers\StatusColorsController;
use Modules\ForTheBuilder\Http\Controllers\ExportsController;
use Modules\ForTheBuilder\Http\Controllers\LanguageController;


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

//Route::prefix('forthebuilder')->group(function() {
//    Route::get('/', 'ForTheBuilderController@index');
//    Route::get('/test', 'UserRefererController@index');
//});

// app('debugbar')->disable();


// Route::redirect('/', '/ru/forthebuilder');
// Route::group(['prefix'=>'{language}'], function(){

// });






Route::get('/notification', [App\Http\Controllers\Frontend\FrontendController::class, 'notification'])->name('notification');
Route::post('/notificate', [App\Http\Controllers\Frontend\FrontendController::class, 'notificate'])->name('notificate');

Route::group(['prefix' => 'forthebuilder', 'middleware' => ['auth', 'forthebuilder']], function () {
    Route::get('/', [ForTheBuilderController::class, 'index'])->name('forthebuilder.index');
    
    Route::get('/extend/{booking_id}/{notification_id}', [BookingController::class, 'extend'])->name('forthebuilder.extend');
    Route::get('/read/{booking_id}/{notification_id}', [BookingController::class, 'read'])->name('forthebuilder.delete');
    Route::get('/readbefore/{booking_id}/{notification_id}', [BookingController::class, 'readBefore'])->name('forthebuilder.readBefore');
    Route::get('/bookingapi', [BookingController::class, 'bookingApi'])->name('forthebuilder.bookingApi');
    Route::get('/bookingnotification/{id}', [BookingController::class, 'bookingNotification'])->name('forthebuilder.bookingNotification');
    Route::get('/thedaybeforenotification/{id}', [BookingController::class, 'TheDayBeforeNotification'])->name('forthebuilder.TheDayBeforeNotification');
    Route::get('/paystatus-notification/{id}', [InstallmentPlanController::class, 'paystatusNotification'])->name('forthebuilder.paystatusNotification');
    Route::get('/paystatus-api', [InstallmentPlanController::class, 'paystatusApi'])->name('forthebuilder.installment-plan.paystatusApi');
    // filtr-date-dashboard
    Route::get('/filtr/{date}', [ForTheBuilderController::class, 'filtr'])->name('forthebuilder.filtr');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('forthebuilder.user.index');
        Route::get('/settings', [UserController::class, 'settings'])->name('forthebuilder.settings.index');
        Route::get('/create', [UserController::class, 'create'])->name('forthebuilder.user.create');
        //        Route::get('/create',[UserController::class, 'create'])->name('user.create')->middleware('can:isAdmin,can:isManager')->middleware('can:isAdmin');
        Route::post('/store', [UserController::class, 'store'])->name('forthebuilder.user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('forthebuilder.user.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('forthebuilder.user.update');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('forthebuilder.user.show');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('forthebuilder.user.destroy');
        Route::get('/chat', [UserController::class, 'chat'])->name('forthebuilder.user.chat');
        Route::get('/filtr/{arr}', [UserController::class, 'filtr'])->name('forthebuilder.user.filtr');
    });

    Route::group(['prefix' => 'user-chat'], function () {
        Route::get('/', [UserChatController::class, 'index'])->name('forthebuilder.user-chat.index');
    });
    
    

    Route::group(['prefix' => 'action-logs', 'middleware' => ['can:isAdmin']], function () {
        Route::get('/', [ActionLogsController::class, 'index'])->name('forthebuilder.action-logs.index');
        Route::get('/show/{id}', [ActionLogsController::class, 'show'])->name('forthebuilder.action-logs.show');
        Route::delete('/destroy/{id}', [ActionLogsController::class, 'destroy'])->middleware('can:isAdmin')->name('forthebuilder.action-logs.destroy');
        Route::delete('/destroy-multiple/', [ActionLogsController::class, 'destroyMultiple'])->name('forthebuilder.action-logs.destroyMultiple');
        Route::delete('/destroy-all', [ActionLogsController::class, 'destroyAll'])->name('forthebuilder.action-logs.destroyAll');
    });

    Route::group(['prefix' => 'clients'], function () {
        Route::get('/', [ClientsController::class, 'index'])->name('forthebuilder.clients.index');
        Route::get('/all-clients', [ClientsController::class, 'allClients'])->name('forthebuilder.clients.all-clients');
        Route::get('/create/{house_flat_id}', [ClientsController::class, 'create'])->name('forthebuilder.clients.create');
        Route::post('/store', [ClientsController::class, 'store'])->name('forthebuilder.clients.store');
        Route::post('/store-photo', [ClientsController::class, 'storePhoto'])->name('forthebuilder.clients.storePhoto');
        Route::get('/edit/{id}', [ClientsController::class, 'edit'])->name('forthebuilder.clients.edit');
        Route::put('/update/{id}', [ClientsController::class, 'update'])->name('forthebuilder.clients.update');
        Route::get('/show/{id}/{house_flat_id}/{task_id}', [ClientsController::class, 'show'])->name('forthebuilder.clients.show');
        Route::get('/client-house/{client_id}', [ClientsController::class, 'clientHouse'])->name('forthebuilder.client.house');
        Route::get('/client-house-flat/{id}/{client_id}', [ClientsController::class, 'clientHouseFlat'])->name('forthebuilder.client.houseFlat');
        Route::get('/client-show-details/{house_id}/{entrance}/{flat_id}/{client_id}', [ClientsController::class, 'showDetails'])->name('forthebuilder.client.show-details');
        Route::put('/store-budget/{id}', [ClientsController::class, 'storeBudget'])->name('forthebuilder.clients.storeBudget');
        Route::delete('/destroy/{id}', [ClientsController::class, 'destroy'])->name('forthebuilder.clients.destroy');
        Route::get('/calendar', [ClientsController::class, 'calendar'])->name('forthebuilder.clients.calendar');
        Route::get('/index-new-clients', [ClientsController::class, 'indexNewClients'])->name('forthebuilder.clients.indexNewClients');
        // Route::get('export/', [ClientsController::class, 'export'])->name('forthebuilder.clients.export');
        Route::post('import/', [ClientsController::class, 'import'])->name('forthebuilder.clients.import');
        Route::post('/add-task', [ClientsController::class, 'addTask'])->name('forthebuilder.clients.add-task');
    });

    Route::group(['prefix' => 'client-lists'], function () {
        // Route::get('/', [ClientsController::class, 'indexClientList'])->name('forthebuilder.client-lists.indexClientList');
        Route::get('/new', [ClientsController::class, 'indexLeadListNew'])->name('forthebuilder.client-lists.indexLeadListNew');
        Route::get('/getLeadList', [ClientsController::class, 'getLeadList'])->name('forthebuilder.client-lists.getLeadList');;
        // Route::put('/update-type/{id}', [ClientsController::class, 'updateType'])->name('forthebuilder.client-lists.update-type');
    });

    Route::group(['prefix' => 'installment-plan'], function () {
        Route::get('/', [InstallmentPlanController::class, 'index'])->name('forthebuilder.installment-plan.index');
        Route::get('/edit/{id}', [InstallmentPlanController::class, 'edit'])->name('forthebuilder.installment-plan.edit');
        Route::put('/update/{id}', [InstallmentPlanController::class, 'update'])->name('forthebuilder.installment-plan.update');
        Route::get('/show/{id}', [InstallmentPlanController::class, 'show'])->name('forthebuilder.installment-plan.show');
        Route::post('/paySum', [InstallmentPlanController::class, 'paySum'])->name('forthebuilder.installment-plan.paySum');
        Route::post('/reduceSum', [InstallmentPlanController::class, 'reduceSum'])->name('forthebuilder.installment-plan.reduceSum');
        Route::delete('/destroy/{id}', [InstallmentPlanController::class, 'destroy'])->name('forthebuilder.installment-plan.destroy');
        Route::get('/get-status/{id}', [InstallmentPlanController::class, 'getStatus'])->name('forthebuilder.installment-plan.get-status');
        Route::put('/update-status/{id}', [InstallmentPlanController::class, 'updateStatus'])->name('forthebuilder.installment-plan.update-status');
    });

    Route::group(['prefix' => 'task'], function () {
        Route::get('/', [TaskController::class, 'index'])->name('forthebuilder.task.index');
        Route::get('/filter-index', [TaskController::class, 'filterIndex'])->name('forthebuilder.task.filter-index');
        Route::get('/create', [TaskController::class, 'create'])->name('forthebuilder.task.create');
        Route::post('/store', [TaskController::class, 'store'])->name('forthebuilder.task.store');
        Route::post('/calendar-store', [TaskController::class, 'calendar_store'])->name('forthebuilder.task.calendar_store');
        Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('forthebuilder.task.edit');
        Route::put('/update/{id}', [TaskController::class, 'update'])->name('forthebuilder.task.update');
        Route::get('/show/{id}', [TaskController::class, 'show'])->name('forthebuilder.task.show');
        Route::put('/answer', [TaskController::class, 'taskAnswer'])->name('forthebuilder.task.answer');
        Route::get('/read/{notification}', [TaskController::class, 'read'])->name('forthebuilder.task.read');
        Route::delete('/destroy/{id}', [TaskController::class, 'destroy'])->name('forthebuilder.task.destroy');
        // Route::get('/get-status/{id}',[TaskController::class, 'getStatus'])->name('forthebuilder.installment-plan.get-status');
        Route::put('/update-status/{id}', [TaskController::class, 'updateStatus'])->name('forthebuilder.task.update-status');
    });

    Route::group(['prefix' => 'language'], function () {

        Route::get('/', [LanguageController::class, 'index'])->name('forthebuilder.language.index');
        Route::get('/language/show/{id}', [LanguageController::class, 'show'])->name('forthebuilder.language.show');
        Route::post('/translation/save/', [LanguageController::class, 'translation_save'])->name('forthebuilder.translation.save');
        Route::post('/language/change/', [LanguageController::class, 'changeLanguage'])->name('language.change');
        Route::post('/env_key_update', [LanguageController::class, 'env_key_update'])->name('env_key_update.update');
        Route::get('/language/create/', [LanguageController::class, 'create'])->name('languages.create');
        Route::post('/language/added/', [LanguageController::class, 'store'])->name('languages.store');
        Route::get('/language/edit/{id}', [LanguageController::class, 'languageEdit'])->name('forthebuilder.language.edit');
        Route::post('/language/update/', [LanguageController::class, 'update'])->name('languages.update');
        Route::get('/language/delete/{id}', [LanguageController::class, 'languageDestroy'])->name('forthebuilder.language.destroy');
        Route::post('/language/update/value', [LanguageController::class, 'updateValue'])->name('languages.update_value');

        // Route::get('/',[HouseController::class, 'index'])->name('forthebuilder.language.index');

        // Route::get('/new',[ClientsController::class, 'indexLeadListNew'])->name('forthebuilder.client-lists.indexLeadListNew');
        // Route::get('/getLeadList', [ClientsController::class, 'getLeadList'])->name('forthebuilder.client-lists.getLeadList');;
        // Route::put('/update-status/{id}',[ClientsController::class, 'updateStatus'])->name('forthebuilder.leads-lists.update-status');
    });

    Route::group(['prefix' => 'house'], function () {
        Route::get('/', [HouseController::class, 'index'])->name('forthebuilder.house.index');
        Route::get('/create', [HouseController::class, 'create'])->name('forthebuilder.house.create');
        Route::post('/store', [HouseController::class, 'store'])->name('forthebuilder.house.store');
        Route::get('/edit/{id}', [HouseController::class, 'edit'])->name('forthebuilder.house.edit');
        Route::put('/update/{id}', [HouseController::class, 'update'])->name('forthebuilder.house.update');
        Route::get('/show/{id}', [HouseController::class, 'show'])->name('forthebuilder.house.show');
        Route::get('/basket-show/{id}', [HouseController::class, 'basketShow'])->name('forthebuilder.house.basket-show');
        Route::get('/show-more/{id}', [HouseController::class, 'showMore'])->name('forthebuilder.house.show-more');
        Route::get('/show-details/{house_id}/{entrance}/{flat_id}', [HouseController::class, 'showDetails'])->name('forthebuilder.house.show-details');
        Route::get('/show-more-new/{id}', [HouseController::class, 'showMoreNew'])->name('forthebuilder.house.show-more-new'); ///////
        Route::get('/show-more-item-detail/{id}', [HouseController::class, 'showMoreItemDetail'])->name('forthebuilder.house.show-more-item-detail');
        Route::delete('/destroy/{id}', [HouseController::class, 'destroy'])->name('forthebuilder.house.destroy');
        Route::delete('/destroy-file-item/{id}', [HouseController::class, 'destroy_file_item'])->name('forthebuilder.house.destroy_file_item');
        Route::get('/search-by-name/{name}', [HouseController::class, 'searchByName'])->name('forthebuilder.house.search-by-name');
        Route::put('/update-flats-data', [HouseController::class, 'updateFlatsData'])->name('forthebuilder.house.update-flats-data');
        Route::post('/new-basket-house', [HouseController::class, 'newBasketHouse'])->name('forthebuilder.house.new-basket-house');
        Route::post('/basket-to-house', [HouseController::class, 'basketToHouse'])->name('forthebuilder.house.basket-to-house');
        Route::post('/remove-bascket-float', [HouseController::class, 'removeBascketFloat'])->name('forthebuilder.house.remove-bascket-float');
        Route::post('/add-bascket-float', [HouseController::class, 'addBascketFloat'])->name('forthebuilder.house.add-bascket-float');
        Route::post('/marge-flats', [HouseController::class, 'margeFlats'])->name('forthebuilder.house.marge-flats');
        Route::get('/price-formation', [HouseController::class, 'priceFormation'])->name('forthebuilder.house.price-formation');
        Route::get('/prices-house-flats', [HouseController::class, 'pricesHouseFlats'])->name('forthebuilder.house.prices-house-flats');
        Route::post('/save-price-information', [HouseController::class, 'savePriceInformation'])->name('forthebuilder.house.save-price-information');
    });

    Route::group(['prefix' => 'house-flat'], function () {
        Route::get('/', [HouseFlatController::class, 'index'])->name('forthebuilder.house-flat.index');
        Route::get('/create', [HouseFlatController::class, 'create'])->name('forthebuilder.house-flat.create');
        Route::post('/store', [HouseFlatController::class, 'store'])->name('forthebuilder.house-flat.store');
        Route::get('/edit/{id}', [HouseFlatController::class, 'edit'])->name('forthebuilder.house-flat.edit');
        Route::put('/update/{id}', [HouseFlatController::class, 'update'])->name('forthebuilder.house-flat.update');
        Route::put('/update-status/{id}', [HouseFlatController::class, 'updateStatus'])->name('forthebuilder.house-flat.update-status');
        Route::get('/show/{id}', [HouseFlatController::class, 'show'])->name('forthebuilder.house-flat.show');
        Route::get('/search-coupon/{text}', [HouseFlatController::class, 'searchCoupon'])->name('forthebuilder.house-flat.search-coupon');
        //        Route::get('/show-more/{id}',[HouseFlatController::class, 'showMore'])->name('forthebuilder.house-flat.show-more');
        Route::delete('/destroy/{id}', [HouseFlatController::class, 'destroy'])->name('forthebuilder.house-flat.destroy');
        Route::delete('/destroy-file-item/{id}', [HouseFlatController::class, 'destroy_file_item'])->name('forthebuilder.house-flat.destroy_file_item');
        Route::post('/file-upload', [HouseFlatController::class, 'fileUpload'])->name('forthebuilder.house-flat.file-upload');
        Route::post('/file-delete/{key}', [HouseFlatController::class, 'fileDelete'])->name('forthebuilder.house-flat.file-delete');
        Route::post('/printPdf/{key}', [HouseFlatController::class, 'printPdf'])->name('forthebuilder.house-flat.printPdf');
        Route::post('/print/{key}', [HouseFlatController::class, 'print'])->name('forthebuilder.house-flat.print');
    });

    Route::group(['prefix' => 'lead-status'], function () {
        Route::get('/', [LeadStatusController::class, 'index'])->name('forthebuilder.lead-status.index');
        Route::get('/create', [LeadStatusController::class, 'create'])->name('forthebuilder.lead-status.create');
        Route::post('/store', [LeadStatusController::class, 'store'])->name('forthebuilder.lead-status.store');
        Route::get('/edit/{id}', [LeadStatusController::class, 'edit'])->name('forthebuilder.lead-status.edit');
        Route::put('/update/{id}', [LeadStatusController::class, 'update'])->name('forthebuilder.lead-status.update');
        Route::get('/show/{id}', [LeadStatusController::class, 'show'])->name('forthebuilder.lead-status.show');
        Route::delete('destroy/{id}', [LeadStatusController::class, 'destroy'])->name('forthebuilder.lead-status.destroy');
    });


    Route::group(['prefix' => 'deal'], function () {
        Route::get('/', [DealController::class, 'index'])->name('forthebuilder.deal.index');
        Route::put('/update-type/{id}', [DealController::class, 'updateType'])->name('forthebuilder.deal.update-type');
        Route::get('create', [DealController::class, 'create'])->name('forthebuilder.deal.create');


        Route::get('get-flat', [DealController::class, 'getFlat'])->name('forthebuilder.deal.getFlat');
        Route::get('get-flat-price', [DealController::class, 'getFlatPrice'])->name('forthebuilder.deal.getFlatPrice');
        Route::get('get-flat-contract-number', [DealController::class, 'getFlatContractNumber'])->name('forthebuilder.deal.getFlatContractNumber');
        Route::post('store', [DealController::class, 'store'])->name('forthebuilder.deal.store');
        Route::get('edit', [DealController::class, 'edit'])->name('forthebuilder.deal.edit');
        Route::put('update/{id}', [DealController::class, 'update'])->name('forthebuilder.deal.update');
        Route::get('show/{deal}', [DealController::class, 'show'])->name('forthebuilder.deal.show');
        Route::delete('destroy-file-item/{id}', [DealController::class, 'destroy_file_item'])->name('forthebuilder.deal.destroy_file_item');
        Route::post('file-upload', [DealController::class, 'fileUpload'])->name('forthebuilder.deal.file-upload');
        Route::post('file-delete/{key}', [DealController::class, 'fileDelete'])->name('forthebuilder.deal.file-delete');
        Route::post('file-rename-for-sort', [DealController::class, 'fileRenameForSort'])->name('forthebuilder.deal.file-rename-for-sort');
        Route::delete('destroy/{id}', [DealController::class, 'destroy'])->name('forthebuilder.deal.destroy');
        Route::get('createFromBooking/{id}', [DealController::class, 'createFromBooking'])->name('forthebuilder.deal.createFromBooking');
        Route::get('printContract/{id}', [DealController::class, 'printContract'])->name('forthebuilder.deal.printContract');
        // Route::get('generate-contract/{id}',[DealController::class, 'generateContract'])->name('forthebuilder.deal.generateContract');

    });

    Route::group(['prefix' => 'lead-comment'], function () {
        Route::post('/store', [LeadCommentController::class, 'store'])->name('forthebuilder.lead-comment.store');
        Route::delete('/destroy/{id}', [LeadCommentController::class, 'destroy'])->name('forthebuilder.lead-comment.destroy');
        Route::get('/edit/{id}', [LeadCommentController::class, 'edit'])->name('forthebuilder.lead-comment.edit');
        Route::put('/update/{id}', [LeadCommentController::class, 'update'])->name('forthebuilder.lead-comment.update');
    });

    Route::group(['prefix' => 'currency'], function () {
        Route::get('/', [CurrencyController::class, 'index'])->name('forthebuilder.currency.index');
        Route::post('/store', [CurrencyController::class, 'store'])->name('forthebuilder.currency.store');
        Route::delete('/destroy', [CurrencyController::class, 'destroy'])->name('forthebuilder.currency.destroy');
        Route::get('/create', [CurrencyController::class, 'create'])->name('forthebuilder.currency.create');
        Route::put('/update/{id}', [CurrencyController::class, 'update'])->name('forthebuilder.currency.update');
    });

    Route::group(['prefix' => 'booking'], function () {
        Route::get('/', [BookingController::class, 'index'])->name('forthebuilder.booking.index');
        Route::post('/store', [BookingController::class, 'store'])->name('forthebuilder.booking.store');
        Route::post('/booking_period/update', [BookingController::class, 'bookingPeriodUpdate'])->name('forthebuilder.booking.period.update');

        Route::post('/extendBooking', [BookingController::class, 'extendBooking'])->name('forthebuilder.booking.extendBooking');
        Route::post('/finishBooking', [BookingController::class, 'finishBooking'])->name('forthebuilder.booking.finishBooking');
        Route::delete('/destroy/{id}', [BookingController::class, 'destroy'])->name('forthebuilder.booking.destroy');
        Route::post('/clientStatus/update', [BookingController::class, 'statusUpdate'])->name('client.status.update');
        // Route::post('/clientStatus/update', [BookingController::class, 'statusUpdate'])->name('client_status.update');
        Route::get('/edit/{id}', [BookingController::class, 'edit'])->name('forthebuilder.booking.edit');
        Route::get('/show/{id}', [BookingController::class, 'show'])->name('forthebuilder.booking.show');
        Route::put('/update/{id}', [BookingController::class, 'update'])->name('forthebuilder.booking.update');
    });

    // Route::get('/status-colors/', [StatusColorsController::class, 'index']);

    Route::group(['prefix' => 'status-colors'], function () {
        Route::get('/', [StatusColorsController::class, 'index'])->name('forthebuilder.status-colors.index');
        Route::get('/edit/{id}', [StatusColorsController::class, 'edit'])->name('forthebuilder.status-colors.edit');
        Route::put('/update/{id}', [StatusColorsController::class, 'update'])->name('forthebuilder.status-colors.update');
    });

    Route::group(['prefix' => 'exports'], function () {
        Route::get('/rassrochka/{id}', [ExportsController::class, 'rassrochka'])->name('forthebuilder.exports.rassrochka');
        Route::get('/leads', [ExportsController::class, 'leads'])->name('forthebuilder.exports.leads');
        Route::get('generate-contract/{id}', [ExportsController::class, 'generateContract'])->name('forthebuilder.exports.generateContract');
    });

    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', [CouponContoller::class, 'index'])->name('forthebuilder.coupon.index');
        Route::get('create', [CouponContoller::class, 'create'])->name('forthebuilder.coupon.create');
        Route::get('/edit/{id}', [CouponContoller::class, 'edit'])->name('forthebuilder.coupon.edit');
        Route::put('/update/{id}', [CouponContoller::class, 'update'])->name('forthebuilder.coupon.update');
        Route::delete('/destroy/{id}', [CouponContoller::class, 'destroy'])->name('forthebuilder.coupon.destroy');
        Route::post('/store', [CouponContoller::class, 'store'])->name('forthebuilder.coupon.store');
        // Route::get('/', [CouponContoller::class, 'index'])->name('forthebuilder.coupon.create');
    });

    Route::get('send', 'HomeController@sendNotification');
});
