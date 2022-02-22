<?php

namespace App\Classes;

class TelegramMessage
{
    private $message;

    public function message(){
        return $this;
    }

    public function set($message){
        $this->message = $message;
    }

    public function get(){
        return $this->message;
    }
}
