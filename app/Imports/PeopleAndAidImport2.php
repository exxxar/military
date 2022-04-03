<?php

namespace App\Imports;

use App\Enums\ModelType;
use App\Models\Boundary;
use App\Models\HumanitarianAidHistory;
use App\Models\People;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Row;

class PeopleAndAidImport2 implements OnEachRow
{

    private $title;

    public function __construct()
    {
        $date = Carbon::now();
        $this->title = "Base2-"
            . $date->year . "-"
            . $date->month . "-"
            . $date->day . "-"
            . $date->hour . "-"
            . $date->second . "-"
            . $date->millisecond . "-"
            . Str::uuid();

        Storage::put($this->title . ".json",
            json_encode([])
        );

    }

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        if ($rowIndex < 3)
            return null;

        if ($row[0] == '')
            return;


        $issue_at = "2022-03-27 10:00:00";

        if (Storage::exists($this->title.".json"))
        {
            $tmp = explode(" ",$row[1]);
            $tname =  $tmp[0]??"";
            $fname =  $tmp[1]??"";
            $sname =  $tmp[2]??"";
            $passport = $row[2] ?? "-";

            $tmp = json_decode(Storage::get($this->title.".json"));

            $obj = [
                "tname"=>$tname,
                "sname"=>$sname,
                "fname"=>$fname,
                "passport"=>$passport,
                "issue_at"=>$issue_at,
            ];
            array_push($tmp, $obj);

            Storage::put($this->title . ".json",
                json_encode($tmp)
            );

        }



   /*     $people = new People();
        $people->uuid = Str::uuid();
        $people->fname = $fname;
        $people->sname = $sname;
        $people->tname = $tname;
        $people->type = 1;
        $people->passport = $passport;
        $people->save();


        $haid = new HumanitarianAidHistory();
        $haid->full_name = "$tname $fname $sname";
        $haid->passport =  $passport;
        $haid->description = "-";
        $haid->issue_at = $issue_at;
        $haid->save();

        Log::info(print_r($haid->toArray(), true));*/


    }
}
