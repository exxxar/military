<?php

namespace App\Exports;

use App\Models\HumanitarianAidHistory;
use App\Models\People;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class HAidHistoryExport implements FromView
{


    public function view(): View
    {
        return view('exports.h-aid', [
            'aids' => HumanitarianAidHistory::query()->select(
                    "id",
                    'index',
                    'full_name',
                    'passport',
                    'description',
                    'issue_at',
                    'created_At',

                )->get() ?? []
        ]);

    }
}
