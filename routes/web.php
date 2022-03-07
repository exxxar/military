<?php

use App\Exports\ShelterExport;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Telegram\Bot\FileUpload\InputFile;


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


Route::view('/desktop','index')->name('desktop.index');

Route::prefix('/forms')->group(function (){
    Route::view("/need-help","forms.help");
    Route::post("/need-help",[\App\Http\Controllers\FormHandlerController::class,"needHelpStore"]);

    Route::view("/new-shelter","forms.new-shelter");
    Route::post("/new-shelter",[\App\Http\Controllers\FormHandlerController::class,"newShelterStore"]);

    Route::view("/need-goods-and-food","forms.food-and-goods");
    Route::post("/need-goods-and-food",[\App\Http\Controllers\FormHandlerController::class,"needGoodsAndFoodStore"]);

    Route::view("/new-aid-center","forms.new-aid-center");
    Route::post("/new-aid-center",[\App\Http\Controllers\FormHandlerController::class,"newAidCenterStore"]);

    Route::view("/help-feeder","forms.help-feeder");
    Route::post("/help-feeder",[\App\Http\Controllers\FormHandlerController::class,"helpFeederStore"]);

    Route::view("/help-delivery","forms.can-delivery");
    Route::post("/help-delivery",[\App\Http\Controllers\FormHandlerController::class,"helpDeliveryStore"]);

    Route::view("/can-driver","forms.can-driver");
    Route::post("/can-driver",[\App\Http\Controllers\FormHandlerController::class,"canDriverStore"]);

    Route::view("/can-assistance","forms.can-assistance");
    Route::post("/can-assistance",[\App\Http\Controllers\FormHandlerController::class,"canAssistanceStore"]);

    Route::view("/help-water","forms.help-water");
    Route::post("/help-water",[\App\Http\Controllers\FormHandlerController::class,"helpWithWaterStore"]);

    Route::view("/help-clothes","forms.help-water");
    Route::post("/help-clothes",[\App\Http\Controllers\FormHandlerController::class,"helpWithClothesStore"]);


});

Route::view('/{any?}','welcome')->name('mobile.index')->where('any', '.*');






/*Route::get("/test",function (){

    return Excel::download(new ShelterExport, 'invoices.xlsx');

});*/

Route::any('/telegram/handler', [\App\Http\Controllers\TelegramController::class, "handler"]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');