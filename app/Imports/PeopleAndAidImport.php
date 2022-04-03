<?php

namespace App\Imports;

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
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Row;
use PhpOffice\PhpSpreadsheet\Exception;

class PeopleAndAidImport implements OnEachRow, WithEvents
{

    private $title;

    private $tmp = [];


    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        if ($rowIndex < 4)
            return null;

        if ($row[0] == '')
            return;



        try {

            if (gettype($row[8])=="integer")
            $issue_at = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8]))->toDateString();
            else {
                $issue_at = Carbon::now()->toDateString();
            }
        } catch (Exception $e) {

        }


        $tname = $row[1] ?? "";
        $fname = $row[2] ?? "";
        $sname = $row[3] ?? "";
        $passport = $row[5] ?? "-";

        $obj = [
            "tname" => trim($tname),
            "sname" => trim($sname),
            "fname" => trim($fname),
            "passport" => $passport,
            "issue_at" => $issue_at,
        ];


        array_push($this->tmp, $obj);


    }

    public function registerEvents(): array
    {
        return [
            // Handle by a closure.

            BeforeImport::class => function (BeforeImport $event) {
                $date = Carbon::now();
                $this->title = "Base1"
                    . $date->year . "-"
                    . $date->month . "-"
                    . $date->day . "-"
                    . $date->hour . "-"
                    . $date->second . "-"
                    . $date->millisecond . "-"
                    . Str::uuid();

            },
            AfterImport::class => function (AfterImport $event) {
                Storage::put($this->title . ".json",
                    json_encode($this->tmp)
                );
            },


        ];

    }
}
