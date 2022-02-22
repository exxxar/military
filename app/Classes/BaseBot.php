<?php

namespace App\Classes;

use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;

abstract class BaseBot
{
    protected $bot;

    protected $chatId;

    protected $routes = [];

    public function reply($message)
    {
        $this->sendMessage($this->chatId, $message);
    }

    public function replyLocation($lat, $lon)
    {
        $this->sendLocation($this->chatId, $lat, $lon);
    }

    public function replyInvoice($title,$description, $prices, $data )
    {
        $this->sendInvoice($this->chatId,$title, $description,$prices, $data );
    }

    public function replyKeyboard($message, $keyboard = [])
    {
        $this->sendReplyKeyboard($this->chatId, $message, $keyboard);
    }

    public function replyDocument($caption, $path, $filename = 'locations.pdf')
    {
        $this->sendDocument($this->chatId, $caption, InputFile::create($path, $filename));
    }


    public function inlineKeyboard($message, $keyboard = [])
    {
        $this->sendInlineKeyboard($this->chatId, $message, $keyboard);
    }

    public function sendMessage($chatId, $message)
    {
        try {
            $this->bot->sendMessage([
                "chat_id" => $chatId,
                "text" => $message,
                "parse_mode" => "HTML"
            ]);
        } catch (\Exception $e) {

        }

    }

    public function sendLocation($chatId, $lat, $lon)
    {
        try {
            $this->bot->sendLocation([
                "chat_id" => $chatId,
                "latitude" => $lat,
                "longitude" => $lon,
                "parse_mode" => "HTML"
            ]);
        } catch (\Exception $e) {

        }

    }

    public function sendDocument($chatId, $caption, $path)
    {
        try {
            $this->bot->sendDocument([
                "chat_id" => $chatId,
                "document" => $path,
                "caption" => $caption,
                "parse_mode" => "HTML"
            ]);
        } catch (\Exception $e) {

        }

    }


    public function sendReplyKeyboard($chatId, $message, $keyboard)
    {

        try {
            $this->bot->sendMessage([
                "chat_id" => $chatId,
                "text" => $message,
                "parse_mode" => "HTML",
                'reply_markup' => json_encode([
                    'keyboard' => $keyboard,
                    'resize_keyboard' => true,
                    'input_field_placeholder' => "Выбор действия"
                ])

            ]);

        } catch (\Exception $e) {

        }

    }

    public function sendInvoice($chatId, $title, $description, $prices, $data){
        try {
            $this->bot->sendInvoice([
                "chat_id" => $chatId,
                "title" => $title,
                "description" => $description,
                "payload" => $data,
                "provider_token" => env("PAYMENT_PROVIDER_TOKEN"),
                "currency" => env("PAYMENT_PROVIDER_CURRENCY"),
                "prices" => $prices,
            ]);
        }catch (\Exception $e){

        }

        //[
        //                ["label"=>"Test", "amount"=>10000]
        //            ]
    }

    public function sendInlineKeyboard($chatId, $message, $keyboard)
    {

        try {
            $this->bot->sendMessage([
                "chat_id" => $chatId,
                "text" => $message,
                "parse_mode" => "HTML",
                'reply_markup' => json_encode([
                    'inline_keyboard' => $keyboard,
                ])

            ]);
        } catch (\Exception $e) {

        }
    }

    public function addRoute($path, $function):TelegramBotHandler
    {
        array_push($this->routes, [
            "path" => $path,
            "is_service"=>false,
            "function" => $function
        ]);

        return $this;
    }

    public function addRouteLocation($function):TelegramBotHandler
    {
        array_push($this->routes, [
            "path" => "location",
            "is_service"=>true,
            "function" => $function
        ]);

        return $this;
    }

    public function addRouteFallback($function):TelegramBotHandler
    {
        array_push($this->routes, [
            "path" => "fallback",
            "is_service"=>true,
            "function" => $function
        ]);

        return $this;
    }
}
