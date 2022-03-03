<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssistanceStoreRequest;
use App\Http\Requests\AssistanceUpdateRequest;
use App\Http\Resources\AssistanceCollection;
use App\Http\Resources\AssistanceResource;
use App\Models\Assistance;
use Illuminate\Http\Request;

class AssistanceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\AssistanceCollection
     */
    public function index(Request $request)
    {
        $assistances = Assistance::query()->paginate(30);

        return new AssistanceCollection($assistances);
    }

    /**
     * @param \App\Http\Requests\AssistanceStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AssistanceStoreRequest $request)
    {
        $assistance = Assistance::create($request->validated());

        return response()->json(new AssistanceResource($assistance));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assistance $assistance
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Assistance $assistance)
    {
        return response()->json(new AssistanceResource($assistance));
    }

    /**
     * @param \App\Http\Requests\AssistanceUpdateRequest $request
     * @param \App\Models\Assistance $assistance
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AssistanceUpdateRequest $request, Assistance $assistance)
    {
        $assistance->update($request->validated());

        return response()->json(new AssistanceResource($assistance));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Assistance $assistance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Assistance $assistance)
    {
        $assistance->delete();

        return response()->noContent();
    }
}
