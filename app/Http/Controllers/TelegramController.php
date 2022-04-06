<?php

namespace App\Http\Controllers;

use App\Classes\TelegramBotHandler;
use App\Facades\MilitaryServiceFacade;
use Azate\LaravelTelegramLoginAuth\Contracts\Telegram\NotAllRequiredAttributesException;
use Azate\LaravelTelegramLoginAuth\Contracts\Validation\Rules\ResponseOutdatedException;
use Azate\LaravelTelegramLoginAuth\Contracts\Validation\Rules\SignatureException;
use Azate\LaravelTelegramLoginAuth\TelegramLoginAuth;
use Exception;
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

            Log::info(print_r($user->toArray(),true));
            Log::info($user->getId());
            Log::info($user->getFirstName());
            Log::info($user->getLastName());
            Log::info($user->getPhotoUrl());
        } catch(NotAllRequiredAttributesException $e) {
            Log::info($e->getMessage());
        } catch(SignatureException $e) {
            Log::info($e->getMessage());
        } catch(ResponseOutdatedException $e) {
            Log::info($e->getMessage());
        } catch(Exception $e) {
            Log::info($e->getMessage());
        }

        Log::info("Test");
        // ...
    }
}
