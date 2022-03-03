<?php

namespace App\Http\Controllers;

use App\Http\Requests\AidCenterStoreRequest;
use App\Http\Requests\AidCenterUpdateRequest;
use App\Http\Resources\AidCenterCollection;
use App\Http\Resources\AidCenterResource;
use App\Models\AidCenter;
use Illuminate\Http\Request;

class AidCenterController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\AidCenterCollection
     */
    public function index(Request $request)
    {
        $aidCenters = AidCenter::query()->paginate(30);

        return new AidCenterCollection($aidCenters);
    }

    /**
     * @param \App\Http\Requests\AidCenterStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AidCenterStoreRequest $request)
    {
        $aidCenter = AidCenter::create($request->validated());

        return response()->json(new AidCenterResource($aidCenter));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AidCenter $aidCenter
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, AidCenter $aidCenter)
    {
        return response()->json(new AidCenterResource($aidCenter));
    }

    /**
     * @param \App\Http\Requests\AidCenterUpdateRequest $request
     * @param \App\Models\AidCenter $aidCenter
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AidCenterUpdateRequest $request, AidCenter $aidCenter)
    {
        $aidCenter->update($request->validated());

        return response()->json(new AidCenterResource($aidCenter));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AidCenter $aidCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, AidCenter $aidCenter)
    {
        $aidCenter->delete();

        return response()->noContent();
    }
}
