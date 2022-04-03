<?php

namespace App\Http\Controllers;

use App\Classes\Utilites\BotUtilities;
use App\Exports\PeopleExport;
use App\Exports\ShelterExport;
use App\Facades\MilitaryServiceFacade;
use App\Http\Requests\PeopleStoreRequest;
use App\Http\Requests\PeopleUpdateRequest;
use App\Http\Resources\HumanitarianAidHistoryCollection;
use App\Http\Resources\PeopleCollection;
use App\Http\Resources\PeopleResource;
use App\Imports\HAidHistoryImport;
use App\Models\HumanitarianAidHistory;
use App\Models\People;
use App\Rules\Recaptcha;
use Carbon\Carbon;
use http\Message;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Telegram\Bot\FileUpload\InputFile;

class PeopleController extends Controller
{
    use BotUtilities;

    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\PeopleCollection
     */
    public function index(Request $request)
    {
        $people = People::all();

        return new PeopleCollection($people);
    }

    /**
     * @param \App\Http\Requests\PeopleStoreRequest $request
     * @return \App\Http\Resources\PeopleResource
     */
    public function store(PeopleStoreRequest $request)
    {
        $person = People::create($request->validated());

        return new PeopleResource($person);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\People $person
     * @return \App\Http\Resources\PeopleResource
     */
    public function show(Request $request, People $person)
    {
        return new PeopleResource($person);
    }

    /**
     * @param \App\Http\Requests\PeopleUpdateRequest $request
     * @param \App\Models\People $person
     * @return \App\Http\Resources\PeopleResource
     */
    public function update(PeopleUpdateRequest $request, People $person)
    {
        $person->update($request->validated());

        return new PeopleResource($person);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\People $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, People $person)
    {
        $person->delete();

        return response()->noContent();
    }


    public function exportExcelPeople()
    {
        //Excel::store(new PeopleExport(), 'people.xlsx');

        return Excel::download(new PeopleExport(), 'people.xlsx');
    }

    public function searchInBase(Request $request, Recaptcha $recaptcha)
    {
        $request->validate([
            'recaptcha' => ['required', $recaptcha],
        ]);

        $fname = $request->fname ?? null;
        $sname = $request->sname ?? null;
        $tname = $request->tname ?? null;
        $uuid = $request->uuid ?? null;

        $peoples = People::query();

        if (!is_null($fname))
            $peoples = $peoples->where("fname", $fname);

        if (!is_null($sname))
            $peoples = $peoples->where("sname", $sname);

        if (!is_null($tname))
            $peoples = $peoples->where("tname", $tname);

        if (!is_null($uuid))
            $peoples = $peoples->orWhere("uuid", $uuid);

        $peoples = $peoples
            ->orderBy("created_at", "desc")
            ->take(10)
            ->get();

        $search = $request->search ?? "$tname $fname $sname";


        $aid = HumanitarianAidHistory::query()
            ->where("full_name", "like", "%$search%")
            ->orWhere("passport", "like", "%$search%")
            ->orderBy("issue_at", "desc")
            ->take(10)
            ->get();

        return response()->json([
            "peoples" => new PeopleCollection($peoples),
            "aids" => new HumanitarianAidHistoryCollection($aid)
        ]);
    }


    public function searchPeople(Request $request)
    {

        $fname = $request->fname ?? null;
        $sname = $request->sname ?? null;
        $tname = $request->tname ?? null;
        $uuid = $request->uuid ?? null;

        $peoples = People::query();

        if (!is_null($fname))
            $peoples = $peoples->where("fname", $fname);

        if (!is_null($sname))
            $peoples = $peoples->where("sname", $sname);

        if (!is_null($tname))
            $peoples = $peoples->where("tname", $tname);

        if (!is_null($uuid))
            $peoples = $peoples->orWhere("uuid", $uuid);

        $peoples = $peoples->get();

        return response()->json(new PeopleCollection($peoples));
    }

    public function exportPdfPeople()
    {
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(
            view("pdf.people",
                ["peoples" => People::query()
                    ->take(500)
                    ->skip(0)
                    ->where("type", 0)->get()
                ]
            )
        );

        return $mpdf->Output("peoples.pdf", "D");
    }

    private function searchPeopleHandler($request)
    {
        $uuid = Str::uuid();
        $title = $this->storeJson("search-people-", $uuid, $request->toArray());

        $tmp = (object)$request->all();

        //dd($tmp);
        try {
            $tmp->searched_from = !is_null($tmp->searched_from) ?
                Carbon::parse($tmp->searched_from)->toDateTimeString() : null;

            $tmp->birth = !is_null($tmp->birth) ?
                Carbon::parse($tmp->birth)->toDateTimeString() : null;

        } catch (\Exception  $e) {
            $tmp->searched_from = null;
            $tmp->birth = null;
        }

        $tmp->uuid = $uuid;

        $people = People::create((array)$tmp);


        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(
            view("pdf.person",
                ["people" => $people
                ]
            )
        );

        if ($request->handler_type == 0)
            return $mpdf->Output("person-$uuid.pdf", "I");

        $fname = $request->fname ?? "";
        $sname = $request->sname ?? "";
        $tname = $request->tname ?? "";
        $birth = $request->birth ?? "-";
        $age_from = $request->age_from ?? "-";
        $age_to = $request->age_to ?? "-";
        $sex = $request->sex ? "Мужской" : "Женский";
        $photos = $request->photos ?? [];
        $phones = $request->phones ?? [];
        $city = $request->city ?? "-";
        $region = $request->region ?? "-";
        $address = $request->address ?? "-";
        $story = $request->story ?? "-";
        $description = $request->description ?? "-";
        $searched_from = $request->searched_from ?? "-";
        $phoenix_num = $request->phoenix_num ?? "-";
        $email = $request->email ?? "-";
        $type = $request->type ?? 0;
        $passport = $request->passport ?? "-";
        $user_id = $request->user_id ?? "-";
        $evacuation_place = $request->evacuation_place ?? "-";


        $sub_title = $type == 0 ? "Поиск человека" : "Добавление человека в Базу";

        $message = "<b>$sub_title ($user_id)</b>\n" .
            "<b>№ $title</b>\n" .
            "Ф.И.О.: <b>$tname $fname $sname</b>\n" .
            "Телефон феникс (при наличии): <b>$phoenix_num</b>\n" .
            "Эл. почта (при наличии): <b>$email</b>\n" .
            "Дата рождения: <b>$birth</b>\n" .
            "Выглядит на: <b>$age_from</b> - <b>$age_to</b>\n" .
            "Пол: <b>$sex</b>\n" .
            "Город: <b>$city</b>\n" .
            "Район \ регион: <b>$region</b>\n" .
            "Адрес: <b>$address</b>\n" .
            "Розыскивается с <b>$searched_from</b>\n" .
            "Паспортные данные <b>$passport</b>\n" .
            "Планируемое место эвакуации <b>$evacuation_place</b>\n" .
            "Дополнительня информация: <b>$description</b>\n" .
            "История: <b>$story</b>\n";


        $contacts = "";

        foreach ($phones as $index => $item) {
            $item = (object)$item;
            $contacts .= ($index + 1) . ") <b>" . $item->phone . "</b> (" . $item->description . ")\n";
        }

        $message .= "<b>Контактные номера:</b>\n$contacts\n";


        MilitaryServiceFacade::bot()
            ->sendMessage(env("PEOPLE_LOGGER_CHANNEL"),
                $message
            );

        $hAids = HumanitarianAidHistory::query()
            ->where("full_name", "like", "%$tname%$fname%$sname%")
            ->orWhere("full_name", "like", "%$tname%$fname%")
            ->orWhere("full_name", "like", "%$tname%")
            ->get();

        if (count($hAids)) {
            $tmp = "";

            $count = $hAids->count();

            $hAids = $hAids->take(30);

            foreach ($hAids as $index => $item) {
                $tmp .= ($index + 1) . "# " . $item->full_name . " (гум. помощь "
                    . \Carbon\Carbon::parse($item->issue_at)->toDateString() . ")\n";
            }

            MilitaryServiceFacade::bot()->reply(
                "В нашей базе есть некоторые совпадения ($count совпадений), возможно это те люди, которых вы ищите:\n$tmp"
            );

        }

        $this->sendInvoice($message, $user_id, env("PEOPLE_LOGGER_CHANNEL"));

        return response()->json([
            "upload_to" => base64_encode($people->id)
        ]);

    }

    public function needPeopleSearch(Request $request)
    {
        return $this->searchPeopleHandler($request);
    }

    public function needPeopleSearchOnline(Request $request, Recaptcha $recaptcha)
    {
        $request->validate([
            'recaptcha' => ['required', $recaptcha],
        ]);

        return $this->searchPeopleHandler($request);
    }


    public function pdfDownload(Request $request)
    {
        $request->validate([
            "uuid" => "required"
        ]);

        $person = People::query()->where("uuid", $request->uuid)->first();

        if (is_null($person))
            return "Документ не найден!";

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(
            view("pdf.person",
                ["people" => $person
                ]
            )
        );
        return $mpdf->Output("person.pdf", "D");
    }

    public function uploadPhotos(Request $request)
    {

        $request->validate([
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10485760',
        ]);

        $id = null;

        if (!is_null($request->upload_to ?? null)) {
            $id = base64_decode($request->upload_to);

        }

        $images = [];
        if ($request->images) {

            $media = [];
            foreach ($request->images as $key => $image) {
                $imageName = Str::uuid() . '.' . $image->extension();
                $image->storeAs('images', $imageName);

                //  dd(storage_path('app\images') . "$imageName");

                $uuid = "-";

                if (!is_null($id)) {
                    $tmp = People::find($id);
                    if (!is_null($tmp))
                        $uuid = $tmp->uuid ?? "-";
                }

                MilitaryServiceFacade::bot()
                    ->sendPhoto(env("PEOPLE_LOGGER_CHANNEL"),
                        "Фото к заявке " . ($uuid ?? "не указан"),
                        InputFile::create(storage_path('app/images') . "/" . $imageName)
                    );

                /* array_push($media, [
                     "type" => "photo",
                     "media" =>  "attach://".storage_path('app\images') . "\\" . $imageName,
                     "caption" => "Фото к заявке " . ($uuid ?? "не указан"),
                 ]);*/

                array_push($images, $imageName);

            }

            /* if (count($media) >= 2)
                 MilitaryServiceFacade::bot()
                     ->sendMediaGroup(env("PEOPLE_LOGGER_CHANNEL"),
                         json_encode($media)
                     );
             else {
                 MilitaryServiceFacade::bot()
                     ->sendPhoto(env("PEOPLE_LOGGER_CHANNEL"),
                         $media[0]["caption"],
                         $media[0]["media"],
                     );
             }*/

            // dd($media);
        }

        if (!is_null($id)) {

            $person = People::find($id);

            if (is_null($person))
                return response()->json([
                    "message" => "Ошибка добавления фотографий"
                ], 404);
            $person->photos = json_encode($images);
            $person->save();
        }


        return response()->noContent();

    }


    public function loadUserById(Request $request)
    {
        $request->validate([
            "id" => "required"
        ]);

        $id = base64_decode($request->id);

        $hAid = HumanitarianAidHistory::query()->where("id", $id)->first();

        if (is_null($hAid))
            return response()->json([
                "fname" => "",
                "sname" => "",
                "tname" => "",
            ]);

        $tmp = explode(" ", $hAid->full_name);

        $tname = $tmp[0] ?? "";
        $fname = $tmp[1] ?? "";
        $sname = $tmp[2] ?? "";

        return response()->json([
            "fname" => $fname,
            "sname" => $sname,
            "tname" => $tname,
        ]);
    }

    public function getPhoto(Request $request, $path){


        if (  !Storage::exists("images/$path")) {
            $myFile = public_path("noavatar.png");
            $headers = ['Content-Type: image/png'];

            return response()->file($myFile,  $headers);
        }


        $myFile = storage_path("app\\images\\".$path);
        $headers = ['Content-Type: image/jpeg'];

        return response()->file($myFile,  $headers);


    }
}
