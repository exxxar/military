<?php

namespace App\Classes;

use Telegram\Bot\Api;

class TelegramBotHandler
{

    private $bot;

    public function __construct()
    {
        $this->bot = new Api(env("TELEGRAM_BOT_TOKEN"));

        //$this->bot->setWebhook(['url' => 'https://api.telegram.org/bot482400672:AAEZu9rGFZfbMOwrqCghI9cR4JhUAf_4xjQ/setWebhook?url=https://9324-109-254-191-71.ngrok.io']);

        $response = $this->bot->getMe();

        $botId = $response->getId();
        $firstName = $response->getFirstName();
        $username = $response->getUsername();

        $this->bot->getWebhookUpdate();
    }


}
