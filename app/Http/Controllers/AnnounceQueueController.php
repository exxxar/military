<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnounceQueueStoreRequest;
use App\Http\Requests\AnnounceQueueUpdateRequest;
use App\Http\Resources\AnnounceQueueCollection;
use App\Http\Resources\AnnounceQueueResource;
use App\Models\AnnounceQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnounceQueueController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\AnnounceQueueCollection
     */
    public function index(Request $request)
    {
        $announceQueues = AnnounceQueue::query();

        if (!is_null(Auth::user()))
            $announceQueues = $announceQueues->where("sender_id", Auth::user()->id);

        $announceQueues = $announceQueues->
        orderBy("created_at", "DESC")
            ->take(20)
            ->get();

        return response()->json(new AnnounceQueueCollection($announceQueues));
    }

    /**
     * @param \App\Http\Requests\AnnounceQueueStoreRequest $request
     * @return \App\Http\Resources\AnnounceQueueResource
     */
    public function store(AnnounceQueueStoreRequest $request)
    {
        $announceQueue = AnnounceQueue::create($request->validated());

        return new AnnounceQueueResource($announceQueue);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AnnounceQueue $announceQueue
     * @return \App\Http\Resources\AnnounceQueueResource
     */
    public function show(Request $request, AnnounceQueue $announceQueue)
    {
        return new AnnounceQueueResource($announceQueue);
    }

    /**
     * @param \App\Http\Requests\AnnounceQueueUpdateRequest $request
     * @param \App\Models\AnnounceQueue $announceQueue
     * @return \App\Http\Resources\AnnounceQueueResource
     */
    public function update(AnnounceQueueUpdateRequest $request, AnnounceQueue $announceQueue)
    {
        $announceQueue->update($request->validated());

        return new AnnounceQueueResource($announceQueue);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AnnounceQueue $announceQueue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $announceQueue = AnnounceQueue::query()->find($id);

        if (is_null($announceQueue))
            return response()->noContent(404);

        $announceQueue->delete();

        return response()->noContent();
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            "title" => "required",
            "text" => "required",
        ]);

        $announceQueue = AnnounceQueue::create($request->all());

        if (!is_null(Auth::user())) {
            $announceQueue->sender_id = Auth::user()->id;
            $announceQueue->save();
        }

        return response()->noContent();
    }
}
