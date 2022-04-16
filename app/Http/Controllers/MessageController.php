<?php

namespace App\Http\Controllers;

use App\Facades\MilitaryServiceFacade;
use App\Http\Requests\MessageStoreRequest;
use App\Http\Requests\MessageUpdateRequest;
use App\Http\Resources\HumanitarianAidHistoryCollection;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Models\HumanitarianAidHistory;
use App\Models\Message;
use App\Models\User;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\MessageCollection
     */
    public function index(Request $request)
    {
        $messages = Message::all();

        return new MessageCollection($messages);
    }

    /**
     * @param \App\Http\Requests\MessageStoreRequest $request
     * @return \App\Http\Resources\MessageResource
     */
    public function store(MessageStoreRequest $request)
    {
        $message = Message::create($request->validated());

        return new MessageResource($message);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Message $message
     * @return \App\Http\Resources\MessageResource
     */
    public function show(Request $request, Message $message)
    {
        return new MessageResource($message);
    }

    /**
     * @param \App\Http\Requests\MessageUpdateRequest $request
     * @param \App\Models\Message $message
     * @return \App\Http\Resources\MessageResource
     */
    public function update(MessageUpdateRequest $request, Message $message)
    {
        $message->update($request->validated());

        return new MessageResource($message);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Message $message)
    {
        $message->delete();

        return response()->noContent();
    }

    public function sendMessage(Request $request, Recaptcha $recaptcha)
    {
        $request->validate([
            "fname" => "required",
            "sname" => "required",
            "tname" => "required",
            "sms" => "required",
            'recaptcha' => ['required', $recaptcha],
        ]);

        $identify = $request->identify ?? "";
        $fname = $request->fname ?? "";
        $sname = $request->sname ?? "";
        $tname = $request->tname ?? "";
        $sms = $request->sms ?? "";
        $person_id = $request->person_id ?? null;
        //$user_id = $request->user_id ?? null;


        Message::create([
            "full_name" => "$tname $fname $sname",
            "identify" => $identify,
            "sms" => $sms,
            "h_user_id" => $person_id
        ]);


        MilitaryServiceFacade::bot()->sendMessage(env("PEOPLE_LOGGER_CHANNEL"),
            "#письмо_на_фронт_народная_дружина\n" .
            "Сообщение для пользователя:\n" .
            "Кому: $tname $fname $sname ($identify)\n" .
            "Сообщение: $sms");

        /*  if (!is_null($user_id)) {
              $user = User::query()->where("telegram_chat_id",$user_id)->first();

              if (is_null($user))
                  return response()->noContent();

              $name = $user->full_name ?? $user->name ?? "-";

              MilitaryServiceFacade::bot()->sendMessage($user_id,
                  "Ваше письмо успешно добавлено в список на отправку\n" .
                  "#письмо_на_фронт\n" .
                  "От: $name ($user->telegram_chat_id)\n".
                  "Кому: $tname $fname $sname ($identify)\n" .
                  "Сообщение: $sms");
          }*/


        return response()->noContent();
    }

    public function sendMessageLocaly(Request $request)
    {
        $request->validate([
            "receiver_f_name" => "required",
            "receiver_t_name" => "required",
            "sender_f_name" => "required",
            "sender_t_name" => "required",
            "message" => "required",
        ]);

        $receiver_f_name = $request->receiver_f_name ?? null;
        $receiver_s_name = $request->receiver_s_name ?? null;
        $receiver_t_name = $request->receiver_t_name ?? null;

        $sender_f_name = $request->sender_f_name ?? null;
        $sender_s_name = $request->sender_s_name ?? null;
        $sender_t_name = $request->sender_t_name ?? null;
        $receiver_info = $request->receiver_info ?? null;

        $sender_info = $request->sender_info ?? null;
        $message = $request->message ?? null;

        Message::create([
            "full_name" => "$receiver_t_name $receiver_f_name $receiver_s_name",
            "sender_full_name" => "$sender_t_name $sender_f_name $sender_s_name",
            "identify" => $receiver_info,
            "sms" => $message,
            'sender_info' => $sender_info
        ]);


        return response()->noContent();
    }

    public function sendAnnounce(Request $request)
    {

    }

    public function search(Request $request)
    {
        $request->validate([
            "search" => "required",
            //'recaptcha' => ['required', $recaptcha],
        ]);

        $search = $request->search ?? null;

        $messages = Message::query()
            ->where("full_name", "like", "%$search%")
            ->orWhere("identify", "like", "%$search%")
            ->orWhere("sender_full_name", "like", "%$search%")
            ->orWhere("sender_info", "like", "%$search%")
            ->orderBy("created_at", "desc")
            ->take(20)
            ->get();

        return response()->json(new MessageCollection($messages));
    }

}
