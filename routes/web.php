<?php

use App\Exports\ShelterExport;
use App\Facades\MilitaryServiceFacade;
use App\Imports\PeopleAndAidImport;
use App\Models\HumanitarianAidHistory;
use App\Models\People;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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


Route::get("/test-test", function () {

    /* ini_set('memory_limit','2560M');
     ini_set('max_execution_time', 1200);
     $peoples = People::query()
         ->whereNotNull("user_id")
         //->whereBetween("created_at", ["2022-03-30 12:00:00", "2022-03-30 20:00:00"])
         ->get();

     foreach ($peoples as $people) {

         $haid = HumanitarianAidHistory::query()->where("full_name", "like", "%$people->tname%$people->fname%")
             ->get();

         if (count($haid)){
             echo $people->tname . " " . $people->fname . " " . $people->sname . " ".print_r($people->phones,true)
                 ." ".print_r($people->toArray(),true)
                 ."<br>"
                 ."<br>"
                 ."<br>";
         }
     }*/

    //  if (count($haid) > 0)
    /*  \App\Facades\MilitaryServiceFacade::bot()
          ->sendMessage($people->user_id, "Хорошие новости!\n"
              . $people->tname . " " . $people->fname . " " . $people->sname . " По нашим сведеньям данный человек получал недавно гуманитарную помощь!"
          );*/

    /*
                echo $people->tname . " " . $people->fname . " " . $people->sname . " ".print_r($people->phones,true)
                    ." ".print_r($people->toArray(),true)
                    ."<br>"
                    ."<br>"
                    ."<br>";*/
    //  }

    /*ini_set('memory_limit', '2560M');
    ini_set('max_execution_time', 226200);
    $tmp = json_decode(Storage::get("Base12022-4-2-19-4-886-b9097ac3-9362-43fe-87bf-a88daed7584f.json"));
    foreach ($tmp as $item) {
        $item = (object)$item;

        $fname = $item->fname ?? "";
        $sname = $item->sname ?? "";
        $tname = $item->tname ?? "";
        $passport = $item->passport ?? "";

        $checked = People::query()
            ->where("fname", $fname)
            ->where("sname", $sname)
            ->where("tname", $tname)
            ->where("passport", $passport)
            ->first();

        if (!is_null($checked))
            continue;

        $haid = new HumanitarianAidHistory();
        $haid->full_name = ($item->tname ?? "") . " " . ($item->fname ?? "") . " " . ($item->sname ?? "");
        $haid->passport = $item->passport;
        $haid->description = "-";
        $haid->issue_at = $item->issue_at;
        $haid->save();

        $people = new People();
        $people->uuid = Str::uuid();
        $people->fname = $item->fname ?? "";
        $people->sname = $item->sname ?? "";
        $people->tname = $item->tname ?? "";
        $people->type = 1;
        $people->passport = $item->passport;
        $people->save();*/

        /* $people = People::query()->where("fname", $item->sname)
             ->where("sname", $item->sname)
             ->where("tname", $item->tname)
             ->first();*/

        /*
                $haid = HumanitarianAidHistory::query()
                    ->where("full_name","$item->tname $item->sname $item->sname")
                    ->where("passport",$item->passport)
                    ->first();

                if (!is_null($haid))
                {
                    $haid->full_name = "$item->tname $item->sname $item->fname";
                    $haid->save();
                }*/


        /*   if (!is_null($people)) {
               $people->fname = $item->sname??'';
               $people->sname = $item->fname??'';
               $people->tname = $item->tname??'';
               $people->save();

               Log::info("$item->tname $item->sname $item->fname => $people->tname $people->fname $people->sname");
           }*/


   // }


    /*
     *
        $haid = new HumanitarianAidHistory();
        $haid->full_name = $item->tname." ".$item->sname." ".$item->fname;
        $haid->passport = $item->passport;
        $haid->description = "-";
        $haid->issue_at = $item->issue_at;
        $haid->save();

        $people = new People();
        $people->uuid = Str::uuid();
        $people->fname = $item->fname;
        $people->sname = $item->sname;
        $people->tname = $item->tname;
        $people->type = 1;
        $people->passport = $item->passport;
        $people->save();
     */

/*      ini_set('memory_limit','2560M');
      ini_set('max_execution_time', 16200);


      $users = \App\Models\User::query()->get();

      foreach ($users as $user){
          \App\Facades\MilitaryServiceFacade::bot()
              ->sendMessage($user->telegram_chat_id,
              "❔Что происходит в Мариуполе на сегодняшний день
  ❔Как живут люди, пострадавшие в ходе украинской агрессии❔С какими испытаниями столкнулись местные жители и как они находят пути решения проблем
  ❔Какую посильную помощь оказывает гуманитарный центр
  ❔И что за волонтёры в городе❔

  ☝🏻На эти и многие другие вопросы вы найдёте ответ подписавшись на Telegram-канал — @center_er

   https://t.me/lifemariupol #МыЖивыМариуполь. Поиск Мариуполь.
  "
              );
      }*/

});




Route::view('/desktop', 'index')->name('desktop.index');

Route::prefix('/forms')->group(function () {


    Route::view("/need-people-search-request", "forms.people-search-online");
    Route::view("/search-in-base", "forms.search-in-base");
    Route::get("/send-message/{id?}", function ($id = null){
        return view("forms.send-message",compact("id"));
    });
    Route::post("/send-message", [\App\Http\Controllers\MessageController::class, "sendMessage"]);
    Route::get("/load-user-by-id", [\App\Http\Controllers\PeopleController::class, "loadUserById"]);
    Route::post("/search-in-base", [\App\Http\Controllers\PeopleController::class, "searchInBase"]);
    Route::post("/need-people-search-online", [\App\Http\Controllers\PeopleController::class, "needPeopleSearchOnline"]);
    Route::post("/upload-photos", [\App\Http\Controllers\PeopleController::class, "uploadPhotos"]);
    Route::get("/pdf/download", [\App\Http\Controllers\PeopleController::class, "pdfDownload"]);
    Route::get("/messages/export", [\App\Http\Controllers\PeopleController::class, "exportExcelMessages"]);

    Route::middleware(["auth","admin"])->group(function () {
        Route::view("/request-people", "forms.request-people");
        Route::view("/need-people-search", "forms.people-search");
        Route::post("/need-people-search", [\App\Http\Controllers\PeopleController::class, "needPeopleSearch"]);
        Route::get("/excel/export-people", [\App\Http\Controllers\PeopleController::class, "exportExcelPeople"]);
        Route::get("/pdf/export-people", [\App\Http\Controllers\PeopleController::class, "exportPdfPeople"]);
        Route::post("/find-people", [\App\Http\Controllers\PeopleController::class, "searchPeople"]);

        Route::post("/h-aid-import", [\App\Http\Controllers\HumanitarianAidHistoryController::class, "import"]);
        Route::get("/h-aid-export", [\App\Http\Controllers\HumanitarianAidHistoryController::class, "export"]);
        Route::post("/h-aid-search", [\App\Http\Controllers\HumanitarianAidHistoryController::class, "search"]);
    });

    Route::view("/h-aid", "forms.h-aid");
    Route::post("/h-aid", [\App\Http\Controllers\HumanitarianAidHistoryController::class, "hAidAdd"]);

    Route::view("/need-help", "forms.help");
    Route::post("/need-help", [\App\Http\Controllers\FormHandlerController::class, "needHelpStore"]);

    Route::view("/new-shelter", "forms.new-shelter");
    Route::post("/new-shelter", [\App\Http\Controllers\FormHandlerController::class, "newShelterStore"]);

    Route::view("/need-goods-and-food", "forms.food-and-goods");
    Route::post("/need-goods-and-food", [\App\Http\Controllers\FormHandlerController::class, "needGoodsAndFoodStore"]);

    Route::view("/new-aid-center", "forms.new-aid-center");
    Route::post("/new-aid-center", [\App\Http\Controllers\FormHandlerController::class, "newAidCenterStore"]);

    Route::view("/help-feeder", "forms.help-feeder");
    Route::post("/help-feeder", [\App\Http\Controllers\FormHandlerController::class, "helpFeederStore"]);

    Route::view("/help-delivery", "forms.can-delivery");
    Route::post("/help-delivery", [\App\Http\Controllers\FormHandlerController::class, "helpDeliveryStore"]);

    Route::view("/can-driver", "forms.can-driver");
    Route::post("/can-driver", [\App\Http\Controllers\FormHandlerController::class, "canDriverStore"]);

    Route::view("/can-assistance", "forms.can-assistance");
    Route::post("/can-assistance", [\App\Http\Controllers\FormHandlerController::class, "canAssistanceStore"]);

    Route::view("/help-water", "forms.help-water");
    Route::post("/help-water", [\App\Http\Controllers\FormHandlerController::class, "helpWithWaterStore"]);

    Route::view("/help-clothes", "forms.help-clothes");
    Route::post("/help-clothes", [\App\Http\Controllers\FormHandlerController::class, "helpWithClothesStore"]);
});

Route::any('/telegram/callback', [\App\Http\Controllers\TelegramController::class, "handleTelegramCallback"] );
Route::any('/telegram/handler', [\App\Http\Controllers\TelegramController::class, "handler"]);

Route::get("/people-photo/{path}", [\App\Http\Controllers\PeopleController::class, "getPhoto"]);

Route::view('/{any?}', 'welcome')->name('mobile.index')->where('any', '.*');

