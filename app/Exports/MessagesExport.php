<?php

namespace App\Exports;

use App\Models\Message;
use App\Models\People;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class MessagesExport implements FromView
{


    public function view(): View
    {
        return view('exports.message-simple', [
            'messages' => Message::query()
                   ->get() ?? []
        ]);

    }
}
