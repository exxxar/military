<?php

namespace App\Classes;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramBotHandler extends BaseBot
{
    private $user;

    public function __construct()
    {
        $this->bot = new Api(env("TELEGRAM_BOT_TOKEN"));


        //$this->bot->setWebhook(['url' => 'https://api.telegram.org/bot482400672:AAEZu9rGFZfbMOwrqCghI9cR4JhUAf_4xjQ/setWebhook?url=https://9324-109-254-191-71.ngrok.io']);

        $response = $this->bot->getMe();

        $botId = $response->getId();
        $firstName = $response->getFirstName();
        $username = $response->getUsername();


        $this->user = User::query()->where("telegram_chat_id", $botId)->first();

        if (is_null($this->user)) {
            $this->user = User::query()->create([
                'name' => $username ?? $firstName ?? null,
                'email' => "$botId@donbassit.ru",
                'telegram_chat_id' => $botId,
                'password' => bcrypt($botId),
                'full_name' => $firstName ?? null

            ]);
        }
    }

    public function createUser($from)
    {

        $telegram_chat_id = $from->id; //идентификатор чата пользователя из телеграм
        $first_name = $from->first_name ?? null; //имя пользователя из телеграм
        $last_name = $from->last_name ?? null; //фамилия пользователя из телеграм
        $username = $from->username ?? null; //псевдоним пользователя

        //проверяем наличие данного пользователя по его телеграм ID. В системе может быть только 1 такой
        //пользователь. И если он есть, то мы просто возвращаем его данные.
        $this->user = User::where("telegram_chat_id", $telegram_chat_id)->first();

        //А если пользователя нет, то создаем нового пользователя
        if (is_null($this->user)) {
            $this->user = User::create([
                'name' => $username ?? $telegram_chat_id, //берем псевдоним пользователя,
                // а в случае отсуствия - берем в качестве псевдонима идентификатор
                'email' => "$telegram_chat_id@donbassit.ru", //создаем почту н основе идентификатора пользователя
                'telegram_chat_id' => $telegram_chat_id, //задаем телеграм ID (уникальное значение)
                'password' => bcrypt($telegram_chat_id), //генерируем пароль на основе идентификатора
                'full_name' => "$first_name $last_name" ?? null, //заполняем имя пользовтеля
                'radius' => 0.5 //указываем радиус поиска объектов по умолчанию.

            ]);
        }
    }

    public function currentUser(){
        return $this->user;
    }

    public function bot()
    {
        return $this;
    }

    public function handler()
    {

        $update = $this->bot->getWebhookUpdate();

        include_once base_path('routes/bot.php');

        $item = json_decode($update);


        //формируем сообщение из возможных вариантов входных данных
        $message = $item->message ??
            $item->edited_message ??
            $item->callback_query->message ??
            null;

        //если сообщения нет, то завершаем работу
        if (is_null($message))
            return;

        //разделяем логику получения данных об отправителе,
        // так как данные приходят в разных частях JSON-объекта,
        // то создадим условие, по которому будем различать откуда получать эти данные
        if (isset($update["callback_query"]))
            $this->createUser($item->callback_query->from);
        else
            $this->createUser($message->from);


        $query = $item->message->text ?? $item->callback_query->data ?? '';

        $this->chatId = $message->chat->id;

        $find = false;


        if (isset($update["message"]["location"])) {
            foreach ($this->routes as $item) {

                if (is_null($item["path"]))
                    continue;

                if ($item["path"] === "location")
                    try {
                        $item["function"]($message, (object)[
                            "lat" => $update["message"]["location"]["latitude"],
                            "lon" => $update["message"]["location"]["longitude"]
                        ]);
                    } catch (\Exception $e) {
                        Log::error($e->getMessage() . " " . $e->getLine());
                    }
            }


            return;
        }

        $matches = [];
        $arguments = [];

        foreach ($this->routes as $item) {

            if (is_null($item["path"]) || $item["is_service"])
                continue;

            $reg = $item["path"];

            if (preg_match($reg . "$/i", $query, $matches) != false) {
                foreach ($matches as $match)
                    array_push($arguments, $match);

                try {
                    $item["function"]($message, ... $arguments);
                    $find = true;
                } catch (\Exception $e) {
                    Log::error($e->getMessage() . " " . $e->getLine());
                }
                break;
            }

        }

        if (!empty($this->next)){
            foreach ($this->next as $item){
                try {
                    $item["function"]($message);
                    $find = true;
                }catch (\Exception $e){
                    Log::error($e->getMessage() . " " . $e->getLine());
                }
            }
        }

        if (!$find) {
            $isFallbackFind = false;
            foreach ($this->routes as $item) {

                if (is_null($item["path"]))
                    continue;

                if ($item["path"] === "fallback") {
                    try {
                        $item["function"]($message);
                        $isFallbackFind = true;
                    } catch (\Exception $e) {
                        Log::error($e->getMessage() . " " . $e->getLine());
                    }
                }
            }

            if (!$isFallbackFind)
                $this->reply("Ошибка обработки данных!");
        }


    }

}
