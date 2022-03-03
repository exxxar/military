<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShelterStoreRequest;
use App\Http\Requests\ShelterUpdateRequest;
use App\Http\Resources\ShelterCollection;
use App\Http\Resources\ShelterRegionCollection;
use App\Http\Resources\ShelterResource;
use App\Models\Shelter;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ShelterCollection
     */
    public function index(Request $request)
    {
        $shelters = Shelter::query()->get();

        return new ShelterCollection($shelters);
    }

    /**
     * @param \App\Http\Requests\ShelterStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ShelterStoreRequest $request)
    {
        $shelter = Shelter::create($request->validated());

        return response()->json(new ShelterResource($shelter));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Shelter $shelter
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Shelter $shelter)
    {
        return response()->json(new ShelterResource($shelter));
    }

    /**
     * @param \App\Http\Requests\ShelterUpdateRequest $request
     * @param \App\Models\Shelter $shelter
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ShelterUpdateRequest $request, Shelter $shelter)
    {
        $shelter->update($request->validated());

        return response()->json(new ShelterResource($shelter));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Shelter $shelter
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Shelter $shelter)
    {
        $tmp = $shelter;
        $shelter->delete();

        return response()->json(new ShelterResource($tmp));
    }

    public function regions(Request $request)
    {
        $shelters = Shelter::query()
            ->select("city", "id")
            ->get()
            ->unique('city');

        $tmp = [];

        foreach ($shelters as $shelter)
            array_push($tmp, (object)[
                "id" => $shelter->id,
                "city" => $shelter->city
            ]);

        return new ShelterRegionCollection($tmp);
    }


}
