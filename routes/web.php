<?php

use App\Exports\ShelterExport;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Mpdf\Mpdf;

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
    Route::view("/need-help","form.help");

    Route::view("/need-goods-and-food","form.goods-and-food");
    Route::view("/need-psychologist","form.psychologist");
    Route::view("/need-housing","form.housing");
    Route::view("/need-transport","form.transport");
    Route::view("/need-clothes","form.clothes");
    Route::view("/need-medicines","form.medicines");
    Route::view("/need-first-aid","form.first-aid");
    Route::view("/need-work","form.work");
    Route::view("/need-debris-removal","form.debris-removal");

    Route::view("/new-shelter","form.new-shelter");
    Route::view("/new-aid-center","form.new-aid-center");
    Route::view("/help-with-shelter","form.help-with-shelter");
    Route::view("/can-help-1","form.can-help-1");
    Route::view("/can-help-2","form.can-help-2");
    Route::view("/help-with-money","form.help-with-money");
    Route::view("/help-with-home","form.help-with-home");
    Route::view("/help-with-car","form.help-with-car");
});

Route::view('/{any?}','welcome')->name('mobile.index')->where('any', '.*');






/*Route::get("/test",function (){

    return Excel::download(new ShelterExport, 'invoices.xlsx');

});*/

Route::any('/telegram/handler', [\App\Http\Controllers\TelegramController::class, "handler"]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
