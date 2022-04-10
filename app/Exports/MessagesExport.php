<?php

namespace App\Exports;

use App\Models\Message;
use App\Models\People;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class MessagesExport implements FromView
{


    public function view(): View
    {
        $messages = Message::query()//->whereNull("send_at")
            ->whereBetween("id",[9780, 17715]) //17715
            ->get();

 /*       foreach ($messages as $message){
            $message->send_at = Carbon::now("+3:00");
            $message->save();
        }*/

        return view('exports.message-simple', [
            'messages' => $messages ?? []
        ]);

    }
}
