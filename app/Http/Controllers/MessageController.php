<?php

namespace App\Http\Controllers;

use App\Facades\MilitaryServiceFacade;
use App\Http\Requests\MessageStoreRequest;
use App\Http\Requests\MessageUpdateRequest;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Models\Message;
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

        $identity = $request->identity ?? "";
        $fname = $request->fname ?? "";
        $sname = $request->sname ?? "";
        $tname = $request->tname ?? "";
        $sms = $request->sms ?? "";
        $h_user_id = $request->user_id ?? null;


        Message::create([
            "full_name" => "$tname $fname $sname",
            "identity" => $identity,
            "sms" => $sms,
            "h_user_id"=>$h_user_id
        ]);

        MilitaryServiceFacade::bot()->sendMessage(env("PEOPLE_LOGGER_CHANNEL"),
            "#письмо_на_фронт_народная_дружина\n" .
            "Сообщение для пользователя:\n" .
            "Кому: $tname $fname $sname ($identity)\n" .
            "Сообщение: $sms");

        return response()->noContent();
    }

}
