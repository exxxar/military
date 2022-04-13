<?php

namespace App\Exports;

use App\Models\HumanitarianAidHistory;
use App\Models\People;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class HAidHistoryExport implements FromView
{

    private $exportType;
    public function __construct($exportType = "day")
    {
        $this->exportType = $exportType;
    }

    public function view(): View
    {

        switch ($this->exportType){
            default:
            case "day": $tmp = [Carbon::now()->startOfDay(),Carbon::now()->endOfDay()]; break;
            case "month": $tmp = [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()]; break;
            case "week": $tmp = [Carbon::now()->startOfDecade(),Carbon::now()->endOfDecade()]; break;
            case "year": $tmp = [Carbon::now()->startOfYear(),Carbon::now()->endOfYear()]; break;
            case "all": $tmp = [Carbon::now()->subYears(10),Carbon::now()->addYears(10)];  break;

        }


        $hAids =  HumanitarianAidHistory::query()
            ->whereBetween("created_at", $tmp)
            ->get();


      /*  if (!empty($hAids)) {
            foreach ($hAids as $item) {
                if (is_null($item->f_name) && is_null($item->t_name)) {
                    $tmp = explode(' ', $item->full_name);
                    $item->t_name = $tmp[0] ?? null;
                    $item->f_name = $tmp[1] ?? null;
                    $item->s_name = $tmp[2] ?? null;
                    $item->save();
                }
            }
        }*/

        return view('exports.h-aid', [
            'aids' =>$hAids?? []
        ]);


    }
}
