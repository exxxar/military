<?php

namespace App\Http\Controllers;

use App\Classes\TelegramBotHandler;
use App\Facades\MilitaryServiceFacade;
use App\Models\Message;
use App\Models\User;
use Azate\LaravelTelegramLoginAuth\Contracts\Telegram\NotAllRequiredAttributesException;
use Azate\LaravelTelegramLoginAuth\Contracts\Validation\Rules\ResponseOutdatedException;
use Azate\LaravelTelegramLoginAuth\Contracts\Validation\Rules\SignatureException;
use Azate\LaravelTelegramLoginAuth\TelegramLoginAuth;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $tmp_user = $telegramLoginAuth->validateWithError($request);

            if (empty($tmp_user))
                return redirect()->back();

            $user = User::query()->where("telegram_chat_id", $tmp_user->getId())->first();

            if (is_null($user)) {
                $user = User::create([
                    'name' =>$tmp_user->getUsername() ?? $tmp_user->getId(),
                    'email' => $tmp_user->getId()."@donbassit.ru",
                    'telegram_chat_id' => $tmp_user->getId(),
                    'password' => bcrypt($tmp_user->getId()),
                    'full_name' =>  $tmp_user->getLastName() ." ".$tmp_user->getFirstName(),
                    'radius' => 0.5
                ]);
            }

            $credentials = [
                "email"=>$user->email,
                "password"=>$user->telegram_chat_id
            ];

            $msg = $user->is_admin?"Администратор":"Пользователь";

            MilitaryServiceFacade::bot()->sendMessage($user->telegram_chat_id,"Уважаемый $msg! Вы успешно авторизовались на сайте!");

            if (Auth::attempt($credentials)) {
                return redirect()->route("mobile.index");
            }

        } catch(NotAllRequiredAttributesException $e) {
            Log::info($e->getMessage());
        } catch(SignatureException $e) {
            Log::info($e->getMessage());
        } catch(ResponseOutdatedException $e) {
            Log::info($e->getMessage());
        } catch(Exception $e) {
            Log::info($e->getMessage());
        }

    }
}
