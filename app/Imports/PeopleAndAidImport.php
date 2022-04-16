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
              /*  $date = Carbon::now();
                $this->title = "Base1"
                    . $date->year . "-"
                    . $date->month . "-"
                    . $date->day . "-"
                    . $date->hour . "-"
                    . $date->second . "-"
                    . $date->millisecond . "-"
                    . Str::uuid();*/

            },
            AfterImport::class => function (AfterImport $event) {

                ini_set('memory_limit', '2560M');
                ini_set('max_execution_time', 16200);
                
                $tmp = json_decode(json_encode($this->tmp));
                foreach ($tmp as $item) {
                    $item = (object)$item;

                    $fname = $item->fname ?? "";
                    $sname = $item->sname ?? "";
                    $tname = $item->tname ?? "";
                    $passport = $item->passport ?? "";

                    $checked1 = People::query()
                        ->where("fname", $fname)
                        ->where("sname", $sname)
                        ->where("tname", $tname)
                        ->where("passport", $passport)
                        ->first();

                    $checked2 = HumanitarianAidHistory::query()
                        ->where("f_name", $fname)
                        ->where("s_name", $sname)
                        ->where("t_name", $tname)
                        ->where("passport", $passport)
                        ->first();

                    if (!is_null($checked1) && !is_null($checked2)) {

                        $tmp = $checked2->issue_date_history ?? [];

                        array_push($tmp,

                            (object)[
                                "date" => $item->issue_at,
                                "comment" => "",
                                "type" => "Продуктовый и гигиенический набор"
                            ]);

                        $checked2->issue_date_history = $tmp;
                        $checked2->save();

                        continue;
                    }
                    $haid = new HumanitarianAidHistory();
                    $haid->full_name = ($item->tname ?? "") . " " . ($item->fname ?? "") . " " . ($item->sname ?? "");
                    $haid->t_name = $item->tname ?? null;
                    $haid->f_name = $item->fname ?? null;
                    $haid->s_name = $item->sname ?? null;

                    $haid->has_children = false;
                    $haid->count = 1;
                    $haid->types = json_encode(["Продуктовый набор", "Гигиенический набор"]);
                    $haid->passport = $item->passport ?? null;
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
                    $people->save();

                }
                    /* Storage::put($this->title . ".json",
                         json_encode($this->tmp)
                     );*/
            },


        ];

    }
}
