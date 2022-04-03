<?php

use App\Exports\ShelterExport;
use App\Facades\MilitaryServiceFacade;
use App\Models\AidCenter;
use App\Models\HumanitarianAidHistory;
use App\Models\Shelter;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

function sortNearestQuestPointsArray($array, $lat, $lon)
{
    for ($j = 0; $j < count($array) - 1; $j++) {
        for ($i = 0; $i < count($array) - $j - 1; $i++) {
            if (round(Shelter::dist($array[$i]["lat"], $array[$i]["lon"], $lat, $lon)) >
                round(Shelter::dist($array[$i + 1]["lat"], $array[$i + 1]["lon"], $lat, $lon))
            ) {
                $tmp_var = $array[$i + 1];
                $array[$i + 1] = $array[$i];
                $array[$i] = $tmp_var;
            }
        }
    }

    return $array;
}

function getInfoByCoords($coords, $page = 0)
{

    $lat = $coords->lat;
    $lon = $coords->lon;

    $user = MilitaryServiceFacade::bot()->currentUser();

    $radius = 0.5;

    if (!is_null($user))
        $radius = $user->radius ?? 0.5;

    //MilitaryServiceFacade::bot()->reply(print_r(Shelter::getNearestQuestPoints($lat, $lon, $user->radius)->toArray(), true));
    $findLocation = false;

    $array = Shelter::getNearestQuestPoints($lat, $lon, $radius)->toArray();
    $array = collect(sortNearestQuestPointsArray($array, $lat, $lon))->skip($page * 5)->take(5);

    foreach ($array as $pos) {

        $pos = (object)$pos;

        $tmp_text = "<b>Ближайшие точки (в настройках ~$radius км):</b>\n";
        $tmp_text .= "\xF0\x9F\x94\xB6 " . $pos->address . "\n" . round(Shelter::dist($pos->lat, $pos->lon, $lat, $lon)) . " метров от вас \n";
        $tmp_text .= "Город: <b>" . $pos->city . "</b>\n";
        $tmp_text .= "На балане: <b>" . $pos->balance_holder . "</b>\n";
        $tmp_text .= "Отвественный: <b>" . $pos->responsible_person . "</b>\n";
        $tmp_text .= "Описание: <b>" . $pos->description . "</b>\n";

        MilitaryServiceFacade::bot()->replyLocation($pos->lat, $pos->lon);
        MilitaryServiceFacade::bot()->reply($tmp_text);

        $findLocation = true;
        /*  if ($pos->inRange($lat, $lng)) {
              $tmp_text .= "	\xF0\x9F\x94\xB7Точка " . $pos->city . " находится в 0.1км от вас!\n";
          }*/
    }

    if ($findLocation) {

        $tmp = base64_encode("$lat $lon");

        MilitaryServiceFacade::bot()->inlineKeyboard("В вашем радиусе (~$radius км) есть еще точки!", [
            [
                ["text" => "Показать еще!", "callback_data" => "/more_shelters $tmp " . ($page + 1)],
            ]
        ]);
    }

    if (!$findLocation) {
        MilitaryServiceFacade::bot()->inlineKeyboard("Не найдено (в радиусе ~$radius км) ни одной ближайшей к вам точки:(", [
            [
                ["text" => "Сменить настройки дальности", "callback_data" => "/settings"],
            ]
        ]);
    }
}

MilitaryServiceFacade::bot()
    ->addRoute("/find_peoples|.*Жди меня - поиск людей|.*Поиск.*|.*Найти человека", function ($message) {

        $url = env("APP_URL");

        $user_id = $this->chatId;

        $message = "Запрос на поиск людей либо добавления данных о себе";

        MilitaryServiceFacade::bot()->inlineKeyboard($message, [
            [
                ["text" => "\xF0\x9F\x8E\xB2Просмотр заявок", "callback_data" => "/start_circular_search"],
            ],
            [
                ["text" => "\xF0\x9F\x94\x8EОставить запрос на поиск", "url" => "$url/forms/need-people-search-request?uid=$user_id&t=0"],
            ],

            [
                ["text" => "\xF0\x9F\x91\xA6Добавить данные о себе", "url" => "$url/forms/need-people-search-request?uid=$user_id&t=1"],
            ],

            [
                ["text" => "\xF0\x9F\x93\x83Поиск человека по базе", "url" => "$url/forms/search-in-base?uid=$user_id"],
            ],

            /*  [
                  ["text" => "\xF0\x9F\x8D\xB4Мне нужен ремонт эл. техники или авто", "url" => "$url/forms/help-delivery?uid=$user_id"],
              ],*/
        ]);


    })
    ->addRoute("/.*Скачать список", function ($message) {

        MilitaryServiceFacade::bot()->reply("Скачать список!");


        Excel::store(new ShelterExport, 'coords.xlsx');


        MilitaryServiceFacade::bot()->replyDocument("Список всех убежищ", \Illuminate\Support\Facades\Storage::get("coords.xlsx"), "coords.xlsx");


        $schelters = \App\Models\Shelter::query()->get();

        if (empty($schelters)) {
            MilitaryServiceFacade::bot()->reply("Список убежищ пуст!");
            return;
        }

    })
    ->addRoute("/can_help|.*Помощь и волонтерство", function ($message) {

        $user_id = $this->chatId;

        $url = env("APP_URL");
        MilitaryServiceFacade::bot()->inlineKeyboard("Направления помощи", [
            [
                ["text" => "\xF0\x9F\x9A\x80Добавить новое убежище", "url" => "$url/forms/new-shelter?uid=$user_id"],
            ],
            [
                ["text" => "\xF0\x9F\x8F\xA0Добавить точку сбор гуманитарки", "url" => "$url/forms/new-aid-center?uid=$user_id"],
            ],
            [
                ["text" => "\xE2\x9C\x8AИмею полезные навыки!", "url" => "$url/forms/can-assistance?uid=$user_id"],
            ],
            [
                ["text" => "\xF0\x9F\x8D\x94Могу кормить людей!", "url" => "$url/forms/help-feeder?uid=$user_id"],
            ],
            /* [
                 ["text" => "\xF0\x9F\x92\xB5Могу помочь деньгами", "url" => "$url/forms/help-with-money"],
             ],*/

            [
                ["text" => "\xF0\x9F\x91\x95Могу помочь с вещами", "url" => "$url/forms/help-clothes?uid=$user_id"],
            ],
            [
                ["text" => "\xF0\x9F\x9A\x97Могу подвести \ доставить", "url" => "$url/forms/can-driver?uid=$user_id"],
            ],

        ]);

    })
    ->addRoute("/need_help|.*Я нуждаюсь", function ($message) {

        $url = env("APP_URL");

        $user_id = $this->chatId;

        $message = "Запрос на помощь...\n" .
            "\xF0\x9F\x8D\xB4Продукты питания\n" .
            "\xF0\x9F\x92\xA7Доставка воды\n" .
            "\xF0\x9F\x8D\x80Психологическя помощь и поддержка!\n" .
            "\xF0\x9F\x8F\xA0Жильё или временное размещение\n" .
            "\xF0\x9F\x9A\x90Помощь с проездом или доставкой\n" .
            "\xF0\x9F\x93\xA6Одежда\n" .
            "\xF0\x9F\x92\x8AМедикаменты\n" .
            "\xF0\x9F\x92\x89Мед. помощь\n" .
            "\xF0\x9F\x93\x88Работа\n" .
            "\xF0\x9F\x94\xA8Разбор завалов\n" .
            "\xF0\x9F\x94\xA8Ремонт эл.техники или авто";

        MilitaryServiceFacade::bot()->inlineKeyboard($message, [
            [
                ["text" => "Нужна помощь", "url" => "$url/forms/need-help?uid=$user_id"],
            ],
            [
                ["text" => "Продукты или медикаменты", "url" => "$url/forms/need-goods-and-food?uid=$user_id"],
            ],
            [
                ["text" => "Нужна вода", "url" => "$url/forms/help-water?uid=$user_id"],
            ],
            [
                ["text" => "Нужна перевозка", "url" => "$url/forms/help-delivery?uid=$user_id"],
            ],
            /*  [
                  ["text" => "\xF0\x9F\x8D\xB4Мне нужен ремонт эл. техники или авто", "url" => "$url/forms/help-delivery?uid=$user_id"],
              ],*/
        ]);


    })
    ->addRoute("/.*Доступные регионы ([()0-9]+)", function ($message, $command, $count) {

        MilitaryServiceFacade::bot()->reply("Доступные регионы!");

        $shelters = Shelter::query()->select("city", "id")->get()->unique('city');

        $keyboard = [];

        $index = 0;

        $tmp = [];

        foreach ($shelters as $key => $shelter) {

            $index++;

            array_push($tmp, ["text" => $shelter->city, "callback_data" => "/region " . $key . " 0"]);

            if ($index % 2 == 0 || $index == count($shelters)) {
                array_push($keyboard, $tmp);
                $tmp = [];
            }

        }

        MilitaryServiceFacade::bot()
            ->inlineKeyboard("Какой регион интересует?", $keyboard)
            ->next("start");

    }, "regions")
    ->addRoute("/.*Центры гуманитарной помощи ([()0-9]+)", function ($message, $command, $count) {

        MilitaryServiceFacade::bot()->reply("Доступные гуманитарные центры!");

        $aid_centers = AidCenter::query()->select("city", "id")->get()->unique('city');

        $keyboard = [];

        $index = 0;

        $tmp = [];

        foreach ($aid_centers as $key => $shelter) {

            $index++;

            array_push($tmp, ["text" => $shelter->city, "callback_data" => "/aid_centers " . $key . " 0"]);

            if ($index % 2 == 0 || $index == count($aid_centers)) {
                array_push($keyboard, $tmp);
                $tmp = [];
            }

        }

        MilitaryServiceFacade::bot()
            ->inlineKeyboard("Из какого региона отобрзить центры сбора гуманитарной помощи?", $keyboard)
            ->next("start");

    })
    ->addRoute("/settings|.*Настройки", function ($message) {

        $radius_table = [
            0.1, 0.2, 0.3, 0.4, 0.5, 1, 2
        ];
        $index = 0;

        $user = MilitaryServiceFacade::bot()->currentUser();

        $radius = 0.5;

        if (!is_null($user))
            $radius = $user->radius ?? 0.5;

        foreach ($radius_table as $key => $value) {
            if ($radius === $value) {
                $index = $key;
                break;
            }
        }

        MilitaryServiceFacade::bot()->inlineKeyboard("<b>Радиус поиска убежищ</b>",
            [
                [
                    ["text" => ($index == 0 ? "\xE2\x9C\x85" : "") . "До 100 метров", "callback_data" => "/change_setting 0"],
                    ["text" => ($index == 1 ? "\xE2\x9C\x85" : "") . "До 200 метров", "callback_data" => "/change_setting 1"],
                    ["text" => ($index == 2 ? "\xE2\x9C\x85" : "") . "До 300 метров", "callback_data" => "/change_setting 2"],
                    ["text" => ($index == 3 ? "\xE2\x9C\x85" : "") . "До 400 метров", "callback_data" => "/change_setting 3"],
                ],
                [

                    ["text" => ($index == 4 ? "\xE2\x9C\x85" : "") . "До 500 метров", "callback_data" => "/change_setting 4"],
                    ["text" => ($index == 5 ? "\xE2\x9C\x85" : "") . "До 1000 метров", "callback_data" => "/change_setting 5"],
                    ["text" => ($index == 6 ? "\xE2\x9C\x85" : "") . "До 2000 метров", "callback_data" => "/change_setting 6"],
                ]
            ]
        );
    }, "settings")
    ->addRoute("/start_circular_search", function ($message){

        $message = "Мы по очереди будем покзывать Вам анкеты пользователей! " .
            "Кто-то из них уже вышел на связь, а о ком-то еще нет никакой информации." .
            "Просматривая анкеты Вы можете найти знакомых Вам людей и сообщить о них информацию " .
            "или связаться с ними по средствам текстового письма.";

        MilitaryServiceFacade::bot()->inlineKeyboard($message, [
            [
                ["text" => "\x31\xE2\x83\xA3Все заявки", "callback_data" => "/circular_search 2"],
            ],

            [
                ["text" => "\x32\xE2\x83\xA3Только найденные", "callback_data" => "/circular_search 1"],
            ],

            [
                ["text" => "\x33\xE2\x83\xA3Только не найденные", "callback_data" => "/circular_search 0"],
            ],

        ]);

    })
    ->addRoute("/circular_search ([0-9]{1})", function ($message, $command, $type) {

        $user = MilitaryServiceFacade::bot()->currentUser();

        if (is_null($user->current_people_index_all)) {
            $user->current_people_index_all = 0;
            $user->current_people_index_type_0 = 0;
            $user->current_people_index_type_1 = 0;
            $user->save();
        }

        $type = intval($type)??2;

        switch ($type) {
            case 0:
                $offset = $user->current_people_index_type_0;
                break;
            case 1:
                $offset = $user->current_people_index_type_1;
                break;
            default:
            case 2:
                $offset = $user->current_people_index_all;
                break;
        }

        $people = \App\Models\People::query();

        if ($type==0||$type==1)
            $people = $people->where("type", $type);

        $people = $people
            ->orderBy("created_at", "ASC")
            ->take(1)
            ->offset($offset)
            ->first();


        if (is_null($people)) {
            MilitaryServiceFacade::bot()->reply("К сожалению что-то пошло не так... мы работаем над этим!");
            return;
        }

        $invoice_type = $people->type == 0 ? "заявка на поиск" : "вышел на связь";
        $full_name = ($people->tname ?? "") . " " . ($people->fname ?? "") . " " . ($people->sname ?? "");

        $user_id = $this->chatId;

        $message = "Статус заявки: <b>$invoice_type</b>\n" .
            "Ф.И.О.: <b>$full_name</b>";

        $url = env("APP_URL");

        $keyboard = [
            [
                ["text" => "\xF0\x9F\x93\xA7Оставить записку", "url" => "$url/forms/send-message/$people->id?by=people"],
                ["text" => "\xE2\x9D\xA4Есть инфо", "url" => "$url/forms/need-people-search-request?uid=$user_id&t=1"],
            ],

            [
                ["text" => "\xF0\x9F\x94\x8EСледующая заявка", "callback_data" => "/circular_search $type"],
            ],
        ];

        $photos = [];
        if (gettype($people->photos) == "array")
            $photos = $people->photos;
        if (gettype($people->photos) == "string")
            $photos = json_decode($people->photos);

        if (count($photos) == 0)
            MilitaryServiceFacade::bot()->inlineKeyboard($message, $keyboard);

        if (count($photos) >= 1) {
            MilitaryServiceFacade::bot()->replyPhoto($message,
                \Telegram\Bot\FileUpload\InputFile::create( "https://shelter-dpr.ru/people-photo/" . trim($photos[0])),
                $keyboard
            );
        }

        switch ($type) {
            case 0:
                $user->current_people_index_type_0++;
                break;
            case 1:
                $user->current_people_index_type_1++;
                break;
            default:
            case 2:
                $user->current_people_index_all++;
                break;
        }
        $user->save();
    })
    ->addRoute("/.*Разработчикам на кофе", function ($message) {
        MilitaryServiceFacade::bot()->inlineKeyboard("А вот тут вы сможете пожертвовать для разработчиков на кофе:)", [
            [
                ["text" => "Пожертвовать 500 руб", "callback_data" => "/invoice", "pay" => true],
            ],

        ]);
    })
    ->addRouteLocation(function ($message, $coords) {
        //MilitaryServiceFacade::bot()->reply("Координаты!" . $coords->lon . " " . $coords->lat);
        getInfoByCoords((object)[
            "lat" => $coords->lat ?? 0,
            "lon" => $coords->lon ?? 0
        ]);
    })
    ->addRouteFallback(function ($message) {
        $need_to_search = false;
        $text = $message->text ?? "";

        $objects = ["ул.", "c.", "пгт.", "город", "г.", "квартал", "улица", "район", "микрорайон", "мк-р"];

        foreach ($objects as $object) {
            if (mb_strpos($text, $object) !== false) {
                $need_to_search = true;
            }

        }

        if ($need_to_search) {

            try {
                $data = YaGeo::setQuery($text)->load();

                if (!is_null($data->getResponse())) {
                    $data = (object)$data->getResponse()->getRawData();

                    $tmp = explode(' ', $data->Point["pos"]);

                    getInfoByCoords((object)[
                        "lat" => $tmp[1] ?? 0,
                        "lon" => $tmp[0] ?? 0
                    ]);
                } else {
                    MilitaryServiceFacade::bot()->reply("На ваш запрос ничего не найдено! Попробуйте ввести данные по примеру <b>город Донецк, ул. Кирова, 22</b>");
                }

            } catch (Exception $e) {
                MilitaryServiceFacade::bot()->reply("На текущий момент поиск ограничен!");
            }


        } else {


            $user = MilitaryServiceFacade::bot()->currentUser();

            $name = $user->full_name ?? $user->name ?? "-";

            if (mb_strlen(trim($text)) > 0)
                MilitaryServiceFacade::bot()->sendMessage(env("PEOPLE_LOGGER_CHANNEL"),
                    "#сообщение_народная_дружина\n" .
                    "Сообщение от пользователя:\n" .
                    "От: $user->telegram_chat_id ($name)\n" .
                    "Сообщение: $text");


            $find = false;
            $hAids = HumanitarianAidHistory::query()->where("full_name", "like", "%$text%")
                ->get();

            if (count($hAids)) {
                $tmp = "";

                $count = $hAids->count();

                $hAids = $hAids->take(30);


                foreach ($hAids as $index => $item) {
                    $bId = $item->id;

                    $tmp .= ($index + 1) . "# " . $item->full_name . " (гум. помощь "
                        . \Carbon\Carbon::parse($item->issue_at)->toDateString() . ")\n<a href='https://shelter-dpr.ru/forms/send-message/$bId'>\xF0\x9F\x93\xA7Оставить записку</a>\n";
                }

                MilitaryServiceFacade::bot()->reply(
                    "В нашей базе есть некоторые совпадения ($count совпадений), возможно это те люди, которых вы ищите:\n$tmp"
                );

                $find = true;

            }

            if (!$find) {
                MilitaryServiceFacade::bot()->reply("По вашему запросу ничего не обнаружено! Обратитесь за помощью в https://vk.com/nddnr");
            }

        }


        //MilitaryServiceFacade::bot()->reply("Методов не обнаружено!");

    });

MilitaryServiceFacade::bot()
    ->addRoute("/region ([0-9a-zA-Z=]+) ([0-9]+)", function ($message, $command, $index, $page) {
        $regions = Shelter::query()->select("city", "id", "lat", "lon")
            ->get()
            ->unique('city')->toArray();

        $shelters = Shelter::query()
            ->where("city", $regions[$index]["city"])
            ->take(20)
            ->skip(0)
            ->get();

        $shelter_in_base = Shelter::query()
            ->where("city", $regions[$index]["city"])->count();


        $tmp = "Вы выбрали город <b>" . $regions[$index]["city"] . "</b>\n";


        foreach ($shelters as $shelter) {

            if ($shelter->lon == 0 || $shelter->lat == 0)
                $link = "https://www.google.com/maps/search/" . $shelter->address . " " . $shelter->city;
            else
                $link = "https://www.google.com/maps/search/" . $shelter->lat . "," . $shelter->lon;

            $tmp .= "\xF0\x9F\x93\x8D " . ($shelter->address ?? "-") . " <a href='" . $link . "'>На карте</a>\n";
        }


        $keyboard = [];

        if ($shelter_in_base > 20) {
            array_push($keyboard, [
                ["text" => "Еще убежища", "callback_data" => "/shelters " . $index . " 1"]
            ]);
        }
        MilitaryServiceFacade::bot()->inlineKeyboard("Локаций в регионе ($shelter_in_base - в нашей базе):\n $tmp", $keyboard);


    })
    ->addRoute("/aid_centers ([0-9a-zA-Z=]+) ([0-9]+)", function ($message, $command, $index, $page) {
        $regions = AidCenter::query()->select("city", "id")
            ->get()
            ->unique('city')->toArray();

        $aid_centers = AidCenter::query()
            ->where("city", $regions[$index]["city"])
            ->take(20)
            ->skip(0)
            ->get();

        $aid_centers_in_base = AidCenter::query()
            ->where("city", $regions[$index]["city"])->count();


        $tmp = "Вы выбрали город <b>" . $regions[$index]["city"] . "</b>\n";


        foreach ($aid_centers as $aid_center) {

            $link = "";
            if (!is_null($aid_center->address))
                $link = "https://www.google.com/maps/search/" . $aid_center->address . " " . $aid_center->city;
            $link = " <a href='" . $link . "'>На карте</a>\n";

            $tmp .= "\xF0\x9F\x93\x8D " . ($aid_center->address ?? "-") . $link
                . "\nЧто требуется: <i>$aid_center->required</i>"

                . "\nОписание: <i>$aid_center->description</i>"

                . "\nНомер телефона: <i>" . ($aid_center->phone ?? "-") . "</i>";
        }


        $keyboard = [];

        if ($aid_centers_in_base > 20) {
            array_push($keyboard, [
                ["text" => "Еще центры", "callback_data" => "/aid_centers " . $index . " 1"]
            ]);
        }
        MilitaryServiceFacade::bot()->inlineKeyboard("Локаций в регионе ($aid_centers_in_base - в нашей базе):\n $tmp", $keyboard);


    })
    ->addRoute("/more_shelters ([0-9a-zA-Z=]+) ([0-9]+)", function ($message, $command, $bCoords, $page) {

        $tmp = base64_decode($bCoords);

        $tmp = explode(" ", $tmp);

        $lat = $tmp[0] ?? 0;
        $lon = $tmp[1] ?? 0;

        getInfoByCoords((object)[
            "lat" => $lat,
            "lon" => $lon
        ], $page);

    })
    ->addRoute("/shelters ([0-9a-zA-Z=]+) ([0-9]+)", function ($message, $command, $index, $page) {

        $regions = Shelter::query()->select("city", "id", "lat", "lon")
            ->get()
            ->unique('city')->toArray();

        $shelters = Shelter::query()
            ->where("city", $regions[$index]["city"])
            ->take(20)
            ->skip($page * 20)
            ->get();

        $shelter_in_base = Shelter::query()
            ->where("city", $regions[$index]["city"])->count();


        $tmp = "Вы выбрали город <b>" . $regions[$index]["city"] . "</b>\n";


        foreach ($shelters as $shelter) {

            if ($shelter->lon == 0 || $shelter->lat == 0)
                $link = "https://www.google.com/maps/search/" . $shelter->address . " " . $shelter->city;
            else
                $link = "https://www.google.com/maps/search/" . $shelter->lat . "," . $shelter->lon;

            $tmp .= "\xF0\x9F\x93\x8D " . ($shelter->address ?? "-") . " <a href='" . $link . "'>На карте</a>\n";
        }


        $keyboard = [];

        if ($shelter_in_base > $page * 20 + $shelters->count()) {
            array_push($keyboard, [
                ["text" => "Еще убежища", "callback_data" => "/shelters " . $index . " " . ($page + 1)]
            ]);
        }
        MilitaryServiceFacade::bot()->inlineKeyboard("Локаций в регионе ($shelter_in_base - в нашей базе):\n $tmp", $keyboard);


    })
    ->addRoute("/change_setting ([0-9]+)", function ($message, $command, $index) {

        $message = (object)$message;

        $radius_table = [
            0.1, 0.2, 0.3, 0.4, 0.5, 1, 2
        ];
        $user = MilitaryServiceFacade::bot()->currentUser();
        $user->radius = $radius_table[$index < count($radius_table) ? $index : 0];
        $user->save();

        MilitaryServiceFacade::bot()->replyEditInlineKeyboard($message->message_id, [
            [
                ["text" => ($index == 0 ? "\xE2\x9C\x85" : "") . "До 100 метров", "callback_data" => "/change_setting 0"],
                ["text" => ($index == 1 ? "\xE2\x9C\x85" : "") . "До 200 метров", "callback_data" => "/change_setting 1"],
                ["text" => ($index == 2 ? "\xE2\x9C\x85" : "") . "До 300 метров", "callback_data" => "/change_setting 2"],
                ["text" => ($index == 3 ? "\xE2\x9C\x85" : "") . "До 400 метров", "callback_data" => "/change_setting 3"],
            ],
            [

                ["text" => ($index == 4 ? "\xE2\x9C\x85" : "") . "До 500 метров", "callback_data" => "/change_setting 4"],
                ["text" => ($index == 5 ? "\xE2\x9C\x85" : "") . "До 1000 метров", "callback_data" => "/change_setting 5"],
                ["text" => ($index == 6 ? "\xE2\x9C\x85" : "") . "До 2000 метров", "callback_data" => "/change_setting 6"],
            ]
        ]);


    })
    ->addRoute("/next ([0-9a-zA-Z=]+) ([0-9a-zA-Z=]+)", function ($message, $command, $region, $page) {
        MilitaryServiceFacade::bot()->reply("Следующий регион! $command $region $page");
    })
    ->addRoute("/start|.*Меню|.*menu", function ($message) {

        $shelters_count = Shelter::query()->select("city", "id")->get()->unique('city')->count();
        $aid_center_count = AidCenter::query()->select("city", "id")->get()->unique('city')->count();

        MilitaryServiceFacade::bot()->replyKeyboard(
            "Главное меню. Тестовая версия. Обновлено <b>03.04.2022 23:30</b>\n
⚡️Друзья, подписывайтесь на Telegram-канал Народной Дружины и будьте вкурсе последних новостей.\n
Подписаться можно здесь👇🏻\n
@nddnr

Обновление:
\xF0\x9F\x93\x8D база найденных людей ~30 000 человек
\xF0\x9F\x93\x8D поиск по фамилии через сообщение боту (напишите, Иванов в чат для примера)
\xF0\x9F\x93\x8D отправка короткого текстового письма человеку
\xF0\x9F\x93\x8D при добавлении заявки на поиск авоматическое оповещение заявителя в случае если человек есть в базе
\xF0\x9F\x93\x8D раздел справочной инфорамцией
\xF0\x9F\x93\x8D раздел контаков с оператором
\xF0\x9F\x93\x8D изменен механизм поиска людей

Мы работаем для вас и ежедневно обновляем базу найденных людей!
",

            [
                [
                    ["text" => "\xF0\x9F\x93\x8DОтправить координаты", "request_location" => true],
                ],
                [
                    ["text" => "\xF0\x9F\x94\x8DЯ нуждаюсь"],
                    ["text" => "\xE2\x9D\xA4Помощь и волонтерство"],
                ],
                [
                    ["text" => "\xF0\x9F\x91\xAAЖди меня - поиск людей"],
                ],
                [
                    ["text" => "\xF0\x9F\x8C\x8DДоступные регионы ($shelters_count)"],
                ],

                [
                    ["text" => "\xF0\x9F\x93\x91Скачать список"],
                    ["text" => "\xF0\x9F\x92\xBBНастройки"],
                ],
                [
                    ["text" => "\xF0\x9F\x9A\xA8Центры гуманитарной помощи ($aid_center_count)"],
                ],
                [
                    ["text" => "\xF0\x9F\x93\x9EКонсультация онлайн"],
                ],
                [
                    ["text" => "\xF0\x9F\x93\x96Справочник"],
                ],
                /*[
                    ["text" => "\xF0\x9F\x92\xB3Разработчикам на кофе"],
                ]*/
            ]);
    }, "start")
    ->addRoute("/help|.*Консультация онлайн", function ($message) {
        MilitaryServiceFacade::bot()->reply("Здравствуйте!\n
Приветствуем Вас в чат-боте <b>НД ДНР</b>, который покажет адреса бомбоубежищ.\n
В скором времени будет запущено приложение, работающее в оффлайн-режиме.\n
Надеемся, оно Вам не пригодится 🙃\n
<b>Дежурная часть МГБ: 071-300-19-81, 062-301-85-38, 062-340-62-99</b>
");
        MilitaryServiceFacade::bot()->inlineKeyboard("https://vk.com/nddnr По вопросам помощи обращаться по ссылке!", [
            [
                ["text" => "\xF0\x9F\x93\x9DГруппа Народной Дружины в ВК", "url" => "https://vk.com/nddnr"]
            ],
            [
                ["text" => "\xF0\x9F\x93\x9EЧат с оператором онлайн", "url" => "https://tawk.to/chat/6244a9950bfe3f4a87708849/1fve3csou"]
            ]
        ]);
    })
    ->addRoute("/help|.*Справочник", function ($message) {
        MilitaryServiceFacade::bot()->reply("Полезная информация:
https://telegra.ph/Kak-vesti-sebya-v-zone-boevyh-dejstvij-04-03
");

    })
    ->addRoute("/invoice", function ($message) {
        MilitaryServiceFacade::bot()->replyInvoice("Временно в разработке", "test", [
            ["label" => "В разработке", "amount" => 10000]
        ], "data");
    });
