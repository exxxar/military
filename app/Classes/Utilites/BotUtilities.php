<?php

namespace App\Classes\Utilites;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Telegram\Bot\FileUpload\InputFile;

trait BotUtilities
{
    protected function sendInvoice($message, $userId, $publicChatId){
        try {
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML(
                view("pdf.document",
                    ["message"=>$message]
                )
            );

            $data = $mpdf->Output("invoice.pdf", "S");

            \App\Facades\MilitaryServiceFacade::bot()
                ->sendDocument($publicChatId,
                    "Файл заявки",
                    InputFile::createFromContents($data, "invoice.pdf"));

            $user = User::query()->where("telegram_chat_id",$userId)->first();

            if (!is_null($user)){

                \App\Facades\MilitaryServiceFacade::bot()
                    ->sendDocument($userId,
                        "Ваша заявка",
                        InputFile::createFromContents($data, "invoice.pdf"));
            }
        }catch (\Exception $ex){

        }
    }

    protected function getPriority($rating)
    {
        $priority = [
            "Отсутствует приоритет",
            "Низкая важность. Не критично.",
            "Низкая важность. Можно потерпеть.",
            "Средняя важность.",
            "Высокая важность.",
            "Очень важность. Критчино."
        ];

        return $rating > count($priority) || $rating < 0 ? "Отствует приоритет!" : $priority[$rating];
    }

    private function storeJson(string $prefix, string $uuid, array $array)
    {
        $date = Carbon::now();
        $title = $prefix
            . $date->year . "-"
            . $date->month . "-"
            . $date->day . "-"
            . $date->hour . "-"
            . $date->second . "-"
            . $date->millisecond . "-"
            . $uuid;

        Storage::put($title . ".json",
            json_encode($array)
        );

        return $title;
    }
}
