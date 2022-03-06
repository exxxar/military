<?php

namespace App\Http\Controllers;

use App\Facades\MilitaryServiceFacade;
use App\Models\AidCenter;
use App\Models\Shelter;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Telegram\Bot\FileUpload\InputFile;

class FormHandlerController extends Controller
{
    public array $priority = [];

    public function __construct()
    {
        $this->priority = [
            "Отсутствует приоритет",
            "Низкая важность. Не критично.",
            "Низкая важность. Можно потерпеть.",
            "Средняя важность.",
            "Высокая важность.",
            "Очень важность. Критчино."
        ];

    }

    private function sendInvoice($message, $userId, $publicChatId){
        try {
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML(
                view("pdf.document",
                    ["message"=>$message]
                )
            );

            $data = $mpdf->Output("invoice.pdf", "S");

            \App\Facades\MilitaryServiceFacade::bot()
                ->sendDocument($publicChatId,
                    "Файл заявки",
                    InputFile::createFromContents($data, "invoice.pdf"));

            $user = User::query()->where("telegram_chat_id",$userId)->first();

            if (!is_null($user)){

                \App\Facades\MilitaryServiceFacade::bot()
                    ->sendDocument($userId,
                        "Ваша заявка",
                        InputFile::createFromContents($data, "invoice.pdf"));
            }
        }catch (\Exception $ex){

        }
    }

    protected function getPriority($rating)
    {
        return $rating > count($this->priority) || $rating < 0 ? "Отствует приоритет!" : $this->priority[$rating];
    }

    private function storeJson(string $prefix, array $array)
    {
        $date = Carbon::now();
        $title = $prefix
            . $date->year . "-"
            . $date->month . "-"
            . $date->day . "-"
            . $date->hour . "-"
            . $date->second . "-"
            . $date->millisecond . "-"
            . Str::uuid();

        Storage::put($title . ".json",
            json_encode($array)
        );

        return $title;
    }

    public function needHelpStore(Request $request)
    {

        $title = $this->storeJson("need-help-", $request->toArray());

        $name = $request->full_name ?? "-";
        $age = $request->age ?? "-";
        $phone = $request->phone ?? "-";
        $description = $request->description ?? "-";
        $user_id = $request->user_id ?? "Не указан ID пользователя";
        $people_count = $request->people_count ?? 1;

        $need_goods = $request->need_goods ?? false;
        $need_psyhologist = $request->need_psyhologist ?? false;
        $need_home = $request->need_home ?? false;
        $need_animal = $request->need_animal ?? false;
        $need_clothes = $request->need_clothes ?? false;
        $need_medical_goods = $request->need_medical_goods ?? false;
        $need_debris_removal = $request->need_debris_removal ?? false;
        $need_arrive = $request->need_arrive ?? false;
        $need_doctor = $request->need_doctor ?? false;
        $need_evacuation = $request->need_evacuation ?? false;
        $need_coal = $request->need_coal ?? false;
        $cannotPay = $request->cannotPay ?? false;
        $need_search_people = $request->need_search_people ?? false;

        $need_technical_water = $request->need_technical_water ?? false;
        $need_drinking_water = $request->need_drinking_water ?? false;
        $drinking_water = $request->drinking_water ?? 1;
        $technical_water = $request->technical_water ?? 1;

        $animals = $request->animals ?? "-";
        $rating = $request->rating ?? 1;
        $coal = $request->coal ?? 1;
        $description_for_doctor = $request->description_for_doctor ?? "-";

        $food_goods = $request->food_and_goods ?? [];
        $medical_goods = $request->medical_goods ?? [];
        $clothes = $request->clothes ?? [];

        $needs = "";

        $marker = "\xF0\x9F\x94\xB8";

        if ($need_goods)
            $needs .= "$marker Нуждается в продуктах\n";
        if ($need_psyhologist)
            $needs .= "$marker Нуждается в психологической помощи\n";
        if ($need_home)
            $needs .= "$marker Нуждается в проживании или временном размещении\n";
        if ($need_animal)
            $needs .= "$marker Нуждается в помощи с животными\n";
        if ($need_clothes)
            $needs .= "$marker Нуждается в вещах\n";
        if ($need_medical_goods)
            $needs .= "$marker Нуждается в медикаментах\n";
        if ($need_debris_removal)
            $needs .= "$marker Нуждается в помощи по разбору завалов\n";
        if ($need_arrive)
            $needs .= "$marker Нуждается в перевозке(доставке)\n";
        if ($need_doctor)
            $needs .= "$marker Нуждается в консультации доктора\n";
        if ($cannotPay)
            $needs .= "$marker Находится в затруднительном материальном положении\n";
        if ($need_search_people)
            $needs .= "$marker Нуждается в поиске родственников\n";
        if ($need_evacuation)
            $needs .= "$marker Нуждается в эвакуации\n";
        if ($need_technical_water)
            $needs .= "$marker Нуждается в запасе технической воды в объеме $technical_water л.\n";
        if ($need_drinking_water)
            $needs .= "$marker Нуждается в запасе питьевой воды воды в объеме $drinking_water л.\n";
        if ($need_coal)
            $needs .= "$marker Нуждается в угле для отопления в объеме $coal тонн\n";

        $priority = $this->getPriority($rating);

        $message =
            "<b>Общая заявка на помощь ($user_id)</b>\n" .
            "<b>№ $title</b>\n" .
            "Имя заявителя: <b>$name</b>\n" .
            "Возраст: <b>$age</b>\n" .
            "Телефон: <b>$phone</b>\n" .
            "Дополнительня информация: <b>$description</b>\n" .
            "Число людей, нуждающихся по заявке: <b>$people_count</b>\n" .
            "Значимость для заявителя: <b>$priority</b>\n" .
            "<b>Потребности заявителя:</b>\n<b>$needs</b>\n";

        if ($need_animal)
            $message .= "Животные заявителя, требующие ухода: <b>$animals</b>\n";
        if ($need_doctor)
            $message .= "Требуется консультация врача по вопросу: <b>$description_for_doctor</b>\n";

        if ($need_goods) {
            $goods = "";

            foreach ($food_goods as $index => $item) {
                $item = (object)$item;

                $goods .= ($index + 1) . ") <b>" . $item->title . "</b> требуется " . $item->value . " " . $item->measure . "\n";
            }

            $message .= "<b>Необходимые продукты:</b>\n$goods\n";
        }

        if ($need_medical_goods) {
            $goods = "";

            foreach ($medical_goods as $index => $item) {
                $item = (object)$item;

                $goods .= ($index + 1) . ") <b>" . $item->title . "</b> требуется " . $item->value . " " . $item->measure . "\n";
            }

            $message .= "<b>Необходимые медикаменты:</b>\n$goods\n";
        }


        if ($need_clothes) {
            $goods = "";

            foreach ($clothes as $index => $item) {
                $goods .= ($index + 1) . ") <b>" . $item . "</b>\n";
            }

            $message .= "<b>Необходимые вещи:</b>\n$goods\n";
        }


        MilitaryServiceFacade::bot()
            ->sendMessage(env("ASK_LOGGER_CHANNEL"),
                $message
            );

        $this->sendInvoice($message, $user_id, env("ASK_LOGGER_CHANNEL"));

        return response()->noContent();
    }

    public function newShelterStore(Request $request)
    {
        $title = $this->storeJson("new-shelter-",$request->toArray());

        $city = $request->city ?? "-";
        $region = $request->region ?? "-";
        $address = $request->address ?? "-";
        $balance_holder = $request->balance_holder ?? "-";
        $responsible_person = $request->responsible_person ?? "-";
        $capacity = $request->capacity ?? 10;

        $status = $request->status ?? 0;
        $quality = $request->quality ?? 0;
        $type = $request->type ?? 0;
        $facilities = $request->facility ?? [];
        $rating = $request->rating ?? 1;

        $phone = $request->phone ?? "-";
        $description = $request->description ?? "-";
        $user_id = $request->user_id ?? "Не указан ID пользовтеля";

        $message = "<b>Добавление нового убежища ($user_id)</b>\n" .
            "<b>№ $title</b>\n" .
            "Город расположения: <b>$city</b>\n" .
            "Регион или район: <b>$region</b>\n" .
            "У кого на балансе: <b>$balance_holder</b>\n" .
            "Ответственный: <b>$responsible_person</b>\n" .
            "Вместимость: <b>$capacity</b>\n" .
            "Телефон: <b>$phone</b>\n" .
            "Дополнительня информация: <b>$description</b>\n" .
            "Субъективный рейтинг убежища: <b>$rating</b>\n" .
            "Статус убежища: <b>$status</b>\n" .
            "Качество убежища: <b>$quality</b>\n" .
            "Тип убежища: <b>$type</b>\n";


        if (count($facilities) > 0) {
            $tmp = "";
            $marker = "\xF0\x9F\x94\xB8";
            foreach ($facilities as $index => $item) {
                $item = (object)$item;

                $tmp .= "$marker <b>" . $item . "</b>\n";
            }

            $message .= "<b>Удобства в убежище:</b>\n$tmp\n";
        }

        MilitaryServiceFacade::bot()
            ->sendMessage(env("PROPOSE_LOGGER_CHANNEL"),
                $message
            );


        $shelter = Shelter::query()->create([
            'city' => $city,
            'region' => $region,
            'address' => $address,
            'balance_holder' => $balance_holder,
            'responsible_person' => $responsible_person,
            'capacity' => $capacity,
            'description' => $description . ", " . $phone,
            "status" => $status,
            "quality" => $quality,
            "type" => $type,
            "facility" => json_encode($facilities),
            "is_moderate" => false,
            "rating" => $rating
        ]);

        try {
            $data = YaGeo::setQuery("$city $address")->load();

            if (!is_null($data->getResponse())) {
                $data = (object)$data->getResponse()->getRawData();

                $tmp = explode(' ', $data->Point["pos"]);

                $shelter->lat = $tmp[1] ?? 0;
                $shelter->lon = $tmp[0] ?? 0;
                $shelter->save();

            }
        } catch (\Exception $e) {

        }

        $this->sendInvoice($message, $user_id, env("PROPOSE_LOGGER_CHANNEL"));

        return response()->noContent();
    }

    public function needGoodsAndFoodStore(Request $request)
    {
        $title = $this->storeJson("need-goods-",$request->toArray());

        $name = $request->full_name ?? "-";
        $people_count = $request->people_count ?? 1;
        $phone = $request->phone ?? "-";
        $description = $request->description ?? "-";
        $need_arrive = $request->need_arrive ?? false;
        $need_water = $request->need_water ?? false;
        $cannot_pay = $request->cannot_pay ?? false;
        $rating = $request->rating ?? 1;
        $food_and_goods = $request->food_and_goods ?? [];
        $medical_goods = $request->medical_goods ?? [];

        $user_id = $request->user_id ?? "Не указан ID пользовтеля";

        $priority = $this->getPriority($rating);

        $message = "<b>Заявка на продукты и медикаменты ($user_id)</b>\n" .
            "<b>№ $title</b>\n" .
            "Имя заявителя: <b>$name</b>\n" .
            "Телефон: <b>$phone</b>\n" .
            "Дополнительня информация: <b>$description</b>\n" .
            "Число людей, нуждающихся по заявке: <b>$people_count</b>\n" .
            "Значимость для заявителя: <b>$priority</b>\n";

        if ($cannot_pay)
            $message .= "Заявитель находится в трудном материльном положении\n";

        if (count($food_and_goods)) {
            $goods = "";

            foreach ($food_and_goods as $index => $item) {
                $item = (object)$item;

                $goods .= ($index + 1) . ") <b>" . $item->title . "</b> требуется " . $item->value . " " . $item->measure . "\n";
            }

            $message .= "<b>Необходимые продукты:</b>\n$goods\n";
        }

        if (count($medical_goods)) {
            $goods = "";

            foreach ($medical_goods as $index => $item) {
                $item = (object)$item;

                $goods .= ($index + 1) . ") <b>" . $item->title . "</b> требуется " . $item->value . " " . $item->measure . "\n";
            }

            $message .= "<b>Необходимые медикаменты:</b>\n$goods\n";
        }

        if ($need_arrive)
            $message .= "Нужна доставка продуктов\n";
        if ($need_water)
            $message .= "Нужна питьева вода в объеме " . ($people_count * 5) . " л. \n";


        MilitaryServiceFacade::bot()
            ->sendMessage(env("ASK_LOGGER_CHANNEL"),
                $message
            );

        $this->sendInvoice($message, $user_id, env("ASK_LOGGER_CHANNEL"));

        return response()->noContent();
    }

    public function newAidCenterStore(Request $request)
    {
        $title = $this->storeJson("aid-center-", $request->toArray());

        $name = $request->full_name ?? "-";
        $city = $request->city ?? "-";
        $address = $request->address ?? "-";
        $phone = $request->phone ?? "-";
        $description = $request->description ?? "-";
        $user_id = $request->user_id ?? "Не указан ID пользовтеля";
        $time_from = $request->time_from ?? "8:00";
        $time_to = $request->time_to ?? "17:00";
        $requires = $request->requires ?? [];

        $message = "<b>Заявк на добавление центра гум.помощи ($user_id)</b>\n" .
            "<b>№ $title</b>\n" .
            "Имя заявителя: <b>$name</b>\n" .
            "Город расположения: <b>$city</b>\n" .
            "Адрес расположения: <b>$address</b>\n" .
            "Телефон: <b>$phone</b>\n" .
            "Дополнительня информация: <b>$description</b>\n" .
            "Время работы: с <b>$time_from</b> до <b>$time_to</b>\n";

        $goods = "";

        foreach ($requires as $index => $item) {
            $goods .= ($index + 1) . ") <b>" . $item . "</b>\n";
        }

        $message .= "<b>Необходимые вещи:</b>\n$goods\n";


        MilitaryServiceFacade::bot()
            ->sendMessage(env("PROPOSE_LOGGER_CHANNEL"),
                $message
            );

        AidCenter::create([
            'city' => $city,
            'region' => "",
            'address' => $address,
            'phone' => $phone,
            'required' => json_encode($requires),
            'description' => $description,
        ]);

        $this->sendInvoice($message, $user_id, env("PROPOSE_LOGGER_CHANNEL"));
        return response()->noContent();
    }

    public function helpFeederStore(Request $request)
    {
        $title = $this->storeJson("help-feeder-", $request->toArray());

        $name = $request->full_name ?? "-";
        $age = $request->age ?? 18;
        $phone = $request->phone ?? "-";
        $description = $request->description ?? "-";
        $user_id = $request->user_id ?? "Не указан ID пользовтеля";

        $locations = $request->locations ?? [];


        $message = "<b>Уведомление про деятельность общественной столовой ($user_id)</b>\n" .
            "<b>№ $title</b>\n" .
            "Имя организатора: <b>$name</b>\n" .
            "Возраст организатора: <b>$age</b>\n" .
            "Телефон: <b>$phone</b>\n" .
            "Дополнительня информация: <b>$description</b>\n";

        $tmp_locations = "";

        foreach ($locations as $index => $item) {
            $item = (object)$item;

            $item_title = $item->title ?? 'Без названия';
            $item_address = ($item->city ?? 'Город не указан') . "," . ($item->address ?? "Адрес не указан");
            $item_from = $item->time_from ?? "-";
            $item_to = $item->time_to ?? "-";
            $item_phone = $item->phone ?? $phone ?? '-';
            $item_description = $item->description ?? '-';

            $tmp_locations .= ($index + 1) . ") <b>$item_title</b> вместимость $item->volume чел.\n"
                . "Адрес: <b>$item_address</b>\n"
                . "Время социальнго обслуживания: с <b>$item_from</b> до <b>$item_to</b>\n"
                . "Номер телефона: $item_phone \n"
                . "Детали:\n$item_description\n\n";
        }

        $message .= "<b>Предоствляется в следующих локациях:</b>\n$tmp_locations\n";

        MilitaryServiceFacade::bot()
            ->sendMessage(env("PROPOSE_LOGGER_CHANNEL"),
                $message
            );

        $this->sendInvoice($message, $user_id, env("PROPOSE_LOGGER_CHANNEL"));

        return response()->noContent();
    }

    public function helpDeliveryStore(Request $request)
    {
        $title = $this->storeJson("help-delivery-", $request->toArray());

        $name = $request->full_name ?? "-";
        $people_count = $request->people_count ?? 1;
        $phone = $request->phone ?? "-";
        $description = $request->description ?? "-";
        $user_id = $request->user_id ?? "Не указан ID пользовтеля";

        $need_arrive = $request->need_arrive ?? false;
        $need_delivery = $request->need_delivery ?? false;
        $from_address = $request->from_address ?? "-";
        $to_address = $request->to_address ?? "-";
        $arrive_date = $request->arrive_date ?? "-";
        $cannot_pay = $request->cannotPay ?? true;
        $rating = $request->rating ?? 1;

        $priority = $this->getPriority($rating);

        $message = "<b>Заявка на перевозку \ доставку ($user_id)</b>\n" .
            "<b>№ $title</b>\n" .
            "Имя заявителя: <b>$name</b>\n" .
            "Телефон: <b>$phone</b>\n" .
            "Число людей в поездке: <b>$people_count</b>\n" .
            "Дополнительня информация: <b>$description</b>\n" .
            "Значимость для заявителя: <b>$priority</b>\n";

        if ($need_arrive)
            $message .= "Заявителя интересует личная поездка\n";
        if ($need_delivery)
            $message .= "Заявителя интересует перевозка вещей\n";
        if ($cannot_pay)
            $message .= "Заявителя находится в тяжелом материальном положении\n";

        $message .= "Дата поездки: <b>$arrive_date</b>\n"
            . "Адрес отправления: <b>$from_address</b>\n"
            . "Адрес назначения: <b>$to_address</b>\n";

        MilitaryServiceFacade::bot()
            ->sendMessage(env("ASK_LOGGER_CHANNEL"),
                $message
            );

        $this->sendInvoice($message, $user_id, env("ASK_LOGGER_CHANNEL"));

        return response()->noContent();
    }

    public function canDriverStore(Request $request)
    {
        $title = $this->storeJson("can-drive-",$request->toArray());

        $name = $request->full_name ?? "-";
        $age = $request->age ?? "-";
        $phone = $request->phone ?? "-";
        $city = $request->city ?? "-";
        $region = $request->region ?? "-";
        $description = $request->description ?? "-";
        $user_id = $request->user_id ?? "Не указан ID пользовтеля";

        $have_a_car = $request->have_a_car ?? false;
        $license_categories = $request->license_categories ?? [];


        $message = "<b>Предоставление помощи по перевозке \ доставке ($user_id)</b>\n" .
            "<b>№ $title</b>\n" .
            "Имя: <b>$name</b>\n" .
            "Телефон: <b>$phone</b>\n" .
            "Возраст <b>$age</b>\n" .
            "Город расположения: <b>$city</b>\n" .
            "Район \ регион расположения: <b>$region</b>\n" .
            "Дополнительня информация: <b>$description</b>\n";

        if ($have_a_car)
            $message .= "Есть своя машина\n";


        if (count($license_categories) > 0) {
            $licenses = "";

            foreach ($license_categories as $index => $item) {
                $licenses .= "<b>$item</b>,";
            }

            $message .= "Категории прав в наличии: $licenses\n";
        }

        MilitaryServiceFacade::bot()
            ->sendMessage(env("PROPOSE_LOGGER_CHANNEL"),
                $message
            );

        $this->sendInvoice($message, $user_id, env("PROPOSE_LOGGER_CHANNEL"));

        return response()->noContent();
    }

    public function canAssistanceStore(Request $request)
    {
        $title = $this->storeJson("can-assist-",$request->toArray());

        $name = $request->full_name ?? "-";
        $age = $request->age ?? "-";
        $phone = $request->phone ?? "-";
        $description = $request->description ?? "-";
        $user_id = $request->user_id ?? "Не указан ID пользовтеля";

        $need_transfer = $request->need_transfer ?? false;
        $skills = $request->skills ?? [];

        $message = "<b>Заявка на перевозку \ доставку ($user_id)</b>\n" .
            "<b>№ $title</b>\n" .
            "Имя заявителя: <b>$name</b>\n" .
            "Телефон: <b>$phone</b>\n" .
            "Возраст <b>$age</b>\n" .
            "Дополнительня информация: <b>$description</b>\n";

        if ($need_transfer)
            $message .= "Нужна доставка до места выполнения работ\n";

        if (count($skills)) {
            $tmp = "";

            foreach ($skills as $index => $item) {
                $goods .= ($index + 1) . ") <b>" . $item->title . "</b> уровень владения " . $item->rating . " из 5 \n";
            }

            $message .= "<b>Имеющиеся навыки:</b>\n$tmp\n";
        }


        MilitaryServiceFacade::bot()
            ->sendMessage(env("PROPOSE_LOGGER_CHANNEL"),
                $message
            );

        $this->sendInvoice($message, $user_id, env("PROPOSE_LOGGER_CHANNEL"));

        return response()->noContent();
    }

    public function helpWithWaterStore(Request $request)
    {
        $title = $this->storeJson("need-water-",$request->toArray());

        $name = $request->full_name ?? "-";
        $phone = $request->phone ?? "-";
        $description = $request->description ?? "-";
        $user_id = $request->user_id ?? "Не указан ID пользовтеля";
        $people_count = $request->people_count ?? 1;
        $rating = $request->rating ?? 1;
        $need_technical_water = $request->need_technical_water ?? false;
        $need_drinking_water = $request->need_drinking_water ?? false;
        $technical_water = $request->technical_water ?? 1;
        $drinking_water = $request->drinking_water ?? 1;


        $priority = $this->getPriority($rating);

        $message = "<b>Заявка на доставку воды ($user_id)</b>\n" .
            "<b>№ $title</b>\n" .
            "Имя заявителя: <b>$name</b>\n" .
            "Телефон: <b>$phone</b>\n" .
            "Дополнительня информация: <b>$description</b>\n" .
            "Число людей, нуждающихся по заявке: <b>$people_count</b>\n" .
            "Значимость для заявителя: <b>$priority</b>\n";

        if ($need_drinking_water)
            $message = "Требуется питьевая вода в объеме $drinking_water л.\n";

        if ($need_technical_water)
            $message = "Требуется техническая вода в объеме $technical_water л.\n";

        MilitaryServiceFacade::bot()
            ->sendMessage(env("ASK_LOGGER_CHANNEL"),
                $message
            );

        $this->sendInvoice($message, $user_id, env("ASK_LOGGER_CHANNEL"));

        return response()->noContent();
    }

    public function helpWithClothesStore(Request $request)
    {

        $title = $this->storeJson("clothes-",$request->toArray());

        $name = $request->full_name ?? "-";
        $phone = $request->phone ?? "-";
        $description = $request->description ?? "-";
        $user_id = $request->user_id ?? "Не указан ID пользовтеля";

        $need_delivery = $request->need_delivery ?? false;
        $from_address = $request->from_address ?? "-";
        $clothes = $request->clothes ?? [];

        $message = "<b>Предложение вещевой помощи ($user_id)</b>\n" .
            "<b>№ $title</b>\n" .
            "Имя дарителя: <b>$name</b>\n" .
            "Телефон: <b>$phone</b>\n" .
            "Дополнительня информация: <b>$description</b>\n";

        if ($need_delivery) {
            $message .= "Нужна помощь с доставкой: <b>$$from_address</b> - требуется вывезти отсюда\n";
        } else {
            $message .= "Могу доставить вещи самостоятельно, либо - <b>$$from_address</b> - мой адрес для желающих\n";
        }


        $goods = "";

        foreach ($clothes as $index => $item) {
            $goods .= ($index + 1) . ") <b>" . $item . "</b>\n";
        }

        $message .= "<b>Необходимые вещи:</b>\n$goods\n";


        MilitaryServiceFacade::bot()
            ->sendMessage(env("PROPOSE_LOGGER_CHANNEL"),
                $message
            );

        $this->sendInvoice($message, $user_id, env("PROPOSE_LOGGER_CHANNEL"));

        return response()->noContent();
    }


}
