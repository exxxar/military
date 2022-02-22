<?php

use App\Facades\MilitaryServiceFacade;
use App\Models\Shelter;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Methods\Message;

MilitaryServiceFacade::bot()
    ->addRoute("/.*Скачать список", function ($message) {

    MilitaryServiceFacade::bot()->reply("Скачать список!");

    /*   $mpdf = new Mpdf();
       $mpdf->WriteHTML("<p>Test</p>");*/

    // MilitaryServiceFacade::bot()->replyDocument("Список в pdf",,"coords.pdf");


    $schelters = \App\Models\Shelter::query()->get();

    if (empty($schelters)) {
        MilitaryServiceFacade::bot()->reply("Список убежищ пуст!");
        return;
    }

    $tmp = "";
    foreach ($schelters as $schelter)
        $tmp .= "<a href='http://www.example.com/'>inline URL</a>";

    MilitaryServiceFacade::bot()->reply($tmp);
})
    ->addRoute("/.*Доступные регионы", function ($message) {

    MilitaryServiceFacade::bot()->reply("Доступные регионы!");

    $shelters = Shelter::query()->select("city","id")->get()->unique('city');

    $keyboard = [];
    MilitaryServiceFacade::bot()->reply($shelters->count());


    foreach ($shelters as $key=>$shelter){
        array_push($keyboard, [
            ["text" => $shelter->city, "callback_data" => "/region ".$key." 0"],
        ]);

    }

    MilitaryServiceFacade::bot()->inlineKeyboard("Какой регион интересует?", $keyboard);

})
    ->addRoute("/.*Настройки", function ($message) {
        MilitaryServiceFacade::bot()->inlineKeyboard("<b>Радиус поиска убежищ</b>",
            [
                [
                    ["text" => "\xE2\x9C\x85До 100 метров", "callback_data" => "some action"],
                    ["text" => "До 200 метров", "callback_data" => "some action"],
                    ["text" => "До 300 метров", "callback_data" => "some action"],
                ],
                [
                    ["text" => "До 500 метров", "callback_data" => "some action"],
                    ["text" => "До 1000 метров", "callback_data" => "some action"],
                ]
            ]
        );
    })
    ->addRoute("/.*Показать список", function ($message) {

        MilitaryServiceFacade::bot()->reply("Показать список!");

        $schelters = \App\Models\Shelter::query()->get();

        if (empty($schelters)) {
            MilitaryServiceFacade::bot()->reply("Список убежищ пуст!");
            return;
        }

        $tmp = "";
        foreach ($schelters as $schelter)
            $tmp .= "<a href='http://www.example.com/'>inline URL</a>";

        MilitaryServiceFacade::bot()->reply($tmp);
    })
    ->addRoute("/.*Разработчикам на кофе", function ($message) {
        MilitaryServiceFacade::bot()->inlineKeyboard("А вот тут вы сможете пожертвовать для разработчиков на кофе:)",[
            [
                ["text" => "Пожертвовать 500 руб", "callback_data" => "/invoice", "pay"=>true],
            ],

        ]);
    })
    ->addRouteLocation(function ($message, $coords) {
        MilitaryServiceFacade::bot()->reply("Координаты!" . $coords->lon . " " . $coords->lat);

        $lat =  $coords->lat;
        $lon = $coords->lon;

        $tmp_text = "*Ближайшие точки (~0.1км):*\n";
        MilitaryServiceFacade::bot()->reply(print_r(Shelter::getNearestQuestPoints($lat, $lon, 100)->toArray(),true));
        $findLocation = false;


        foreach (Shelter::getNearestQuestPoints($lat, $lon)->toArray() as $pos) {

            $pos = (object)$pos;

            $tmp_text .= "\xF0\x9F\x94\xB6 " . $pos->address . "\n".round(Shelter::dist($pos->lat,$pos->lon,$lat,$lon))." метров от вас" ;

            MilitaryServiceFacade::bot()->replyLocation($pos->lat,$pos->lon);
            $findLocation = true;
          /*  if ($pos->inRange($lat, $lng)) {
                $tmp_text .= "	\xF0\x9F\x94\xB7Точка " . $pos->city . " находится в 0.1км от вас!\n";
            }*/
        }

        if (!$findLocation) {
            $tmp_text .= "Не найдено ни одной ближайшей к вам точки:(";
            MilitaryServiceFacade::bot()->reply($tmp_text);
            return;
        }

        MilitaryServiceFacade::bot()->reply($tmp_text);

        MilitaryServiceFacade::bot()->reply("END");
    })
    ->addRouteFallback(function ($message) {
        MilitaryServiceFacade::bot()->reply("Методов не обнаружено!");


    });

MilitaryServiceFacade::bot()
    ->addRoute("/region ([0-9a-zA-Z=]+) ([0-9]+)", function ($message, $command, $region, $page) {
    MilitaryServiceFacade::bot()->reply("Следующий регион! $command $region $page");

    $shelters = Shelter::query()->select("city","id", "lat","lon")->get()->unique('city')->toArray();

    MilitaryServiceFacade::bot()->reply($shelters[$region]["city"]);
    MilitaryServiceFacade::bot()->replyLocation($shelters[$region]["lat"], $shelters[$region]["lon"]);


})
    ->addRoute("/next ([0-9a-zA-Z=]+) ([0-9a-zA-Z=]+)", function ($message, $command, $region, $page) {
    MilitaryServiceFacade::bot()->reply("Следующий регион! $command $region $page");
})
    ->addRoute("/start", function ($message) {

    Log::info("message=>" . print_r($message, true));

    MilitaryServiceFacade::bot()->replyKeyboard("Главное меню", [
        [
            ["text" => "\xF0\x9F\x93\x8DОтправить координаты", "request_location" => true],
        ],
        [
            ["text" => "\xF0\x9F\x8C\x8DДоступные регионы"],
        ],
        [
            ["text" => "\xF0\x9F\x93\x91Скачать список"],
            ["text" => "\xF0\x9F\x92\xBBНастройки"],
        ],
        [
            ["text" => "\xE2\x98\x95Разработчикам на кофе"],
        ]
    ]);
})
    ->addRoute("/help", function ($message) {
    MilitaryServiceFacade::bot()->reply("Помощь!");
})
    ->addRoute("/invoice", function ($message) {
    MilitaryServiceFacade::bot()->replyInvoice("test","test",[
        ["label"=>"Test", "amount"=>10000]
    ], "data");
});
