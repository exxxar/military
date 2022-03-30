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

class PeopleAndAidImport implements OnEachRow
{

    private $title;

    public function __construct()
    {
        $date = Carbon::now();
        $this->title = "Base"
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

        if ($rowIndex < 4)
            return null;

        if ($row[0] == '')
            return;



        try {

            $issue_at = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8]))->toDateTimeString();

        } catch (\Exception $e) {
            $issue_at = null;
        }

        if (Storage::exists($this->title.".json"))
        {
            $tname =  $row[1]??"-";
            $sname =  $row[2]??"-";
            $fname =  $row[2]??"-";
            $passport = $row[5] ?? "-";

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
