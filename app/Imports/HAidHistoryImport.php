<?php

namespace App\Imports;

use App\Enums\ModelType;
use App\Models\Boundary;
use App\Models\HumanitarianAidHistory;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Row;

class HAidHistoryImport implements OnEachRow
{

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        if ($rowIndex == 1)
            return null;

        if ($row[0] == '')
            return;


        try {
            $issue_at = is_null($row[5] ?? null) ? null : Carbon::parse($row[5]);

        } catch (\Exception $e) {
            $issue_at = null;
        }

        $hAid = HumanitarianAidHistory::create([
            'id'=>$row[0] ?? '-',
            'index' => $row[1] ?? '-',
            'full_name' => $row[2] ?? '-',
            'passport' => $row[3] ?? '-',
            'description' => $row[4] ?? '-',
            'issue_at' => $issue_at,
        ]);

    }
}
