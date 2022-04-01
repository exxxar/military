<?php

namespace App\Exports;

use App\Models\People;
use App\Models\Shelter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PeopleExport implements FromView
{


    public function view(): View
    {
        return view('exports.people-simple', [
            'peoples' => People::query()
                    ->where("type",0)
                   // ->whereBetween("created_at",["2022-03-30 09:00:00","2022-03-31 23:59:59"])
                    ->where("is_active", true)->select(
                    "id",
                    'uuid',
                    'fname',
                    'sname',
                    'tname',
                    'birth',
                    'age_from',
                    'age_to',
                    'sex',
                    'phones',
                    'city',
                    'region',
                    'address',
                    'story',
                    'description',
                    'status',
                    'for',
                    'searched_from',
                    'is_active',
                    "phoenix_num",
                    "email",
                    "type",
                    "passport",
                    "evacuation_place",

                )->get() ?? []
        ]);

    }
}
