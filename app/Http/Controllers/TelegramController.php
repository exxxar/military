<?php

namespace App\Http\Controllers;

use App\Classes\TelegramBotHandler;
use App\Facades\MilitaryServiceFacade;
use Azate\LaravelTelegramLoginAuth\Contracts\Telegram\NotAllRequiredAttributesException;
use Azate\LaravelTelegramLoginAuth\Contracts\Validation\Rules\ResponseOutdatedException;
use Azate\LaravelTelegramLoginAuth\Contracts\Validation\Rules\SignatureException;
use Azate\LaravelTelegramLoginAuth\TelegramLoginAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    public function handler(Request $request)
    {
        MilitaryServiceFacade::bot()->handler();
    }

    public function handleTelegramCallback(TelegramLoginAuth $telegramLoginAuth, Request $request)
    {
        try {
            $user = $telegramLoginAuth->validateWithError($request);

            Log::info(print_r($user,true));
        } catch(NotAllRequiredAttributesException $e) {
            // ...
        } catch(SignatureException $e) {
            // ...
        } catch(ResponseOutdatedException $e) {
            // ...
        } catch(Exception $e) {
            // ...
        }

        Log::info("Test");
        // ...
    }
}
