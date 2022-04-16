<?php

use App\Http\Controllers\AidCenterController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\ShelterController;
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

Route::middleware('auth:sanctum')->prefix('v1')->group(function (){
    Route::get("/test", function (){
       return "test";
    });
});



Route::get('shelters/regions', [ShelterController::class, 'regions']);
Route::get('shelters/search', [ShelterController::class, 'search']);
/*Route::post('shelters/new-shelter', [ShelterController::class, 'newShelter']);
Route::get('shelters/download/excel', [ShelterController::class, 'downloadExcel']);
Route::get('shelters/download/pdf', [ShelterController::class, 'downloadPdf']);*/


/*
 * хочу добавить убежище
 * хочу помочь в обустройстве убежищь
 * я готов помочь как: водитель, повар, врач, психолог, другое
 * хочу помочь материально деньгами
 * хочу помочь физически
 * хочу помочь вещами
 * Я могу кормить людей
 * Я могу предоставить жильё
 * Предложить новость
 * центры гумонитарной помощи
 * подвезти людей
 * продукты для людей, которые не могут себя обеспечить
 * хочу в дружину
 */

Route::apiResource("shelters", ShelterController::class);

/*Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);


Route::apiResource('assistance', AssistanceController::class);

Route::apiResource('aid-center', AidCenterController::class);

Route::apiResource('people', App\Http\Controllers\PeopleController::class);


Route::apiResource('humanitarian-aid-history', App\Http\Controllers\HumanitarianAidHistoryController::class);


Route::apiResource('message', App\Http\Controllers\MessageController::class);*/

/*
Route::apiResource('announce-queue', App\Http\Controllers\AnnounceQueueController::class);*/


