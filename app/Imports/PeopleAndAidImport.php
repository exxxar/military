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

class PeopleAndAidImport implements OnEachRow
{


    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        if ($rowIndex < 4)
            return null;

        if ($row[0] == '')
            return;


        try {

            if (gettype($row[8]) == "integer")
                $issue_at = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8]))->toDateString();
            else {
                $issue_at = Carbon::now()->toDateString();
            }
        } catch (Exception $e) {

        }

        /*        if (Carbon::parse("2022-04-10 00:00:00")->timestamp
                    >Carbon::parse($issue_at)->timestamp)
                    return;*/

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

        $item = json_decode(json_encode($obj));


        DB::beginTransaction();
        DB::transaction(function () use($item) {
/*

               $checked1 = People::query()
                   ->where("fname", $item->fname)
                   ->where("sname", $item->sname)
                   ->where("tname", $item->tname)
                   ->where("passport", $item->passport)
                   ->first();

               $checked2 = HumanitarianAidHistory::query()
                   ->where("f_name", $item->fname)
                   ->where("s_name", $item->sname)
                   ->where("t_name", $item->tname)
                   ->where("passport", $item->passport)
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

                   return;
               }*/
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
            DB::commit();

        });
    }

}
