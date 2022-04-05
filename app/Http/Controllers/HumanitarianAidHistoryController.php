<?php

namespace App\Http\Controllers;

use App\Classes\Utilites\BotUtilities;
use App\Exports\HAidHistoryExport;
use App\Exports\PeopleExport;
use App\Facades\MilitaryServiceFacade;
use App\Http\Requests\HumanitarianAidHistoryStoreRequest;
use App\Http\Requests\HumanitarianAidHistoryUpdateRequest;
use App\Http\Resources\HumanitarianAidHistoryCollection;
use App\Http\Resources\HumanitarianAidHistoryResource;
use App\Http\Resources\PeopleCollection;
use App\Imports\DeviceImport;
use App\Imports\HAidHistoryImport;
use App\Imports\PeopleAndAidImport;
use App\Imports\PeopleAndAidImport2;
use App\Imports\PeopleAndAidImport3;
use App\Models\HumanitarianAidHistory;
use App\Models\People;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class HumanitarianAidHistoryController extends Controller
{

    use BotUtilities;

    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\HumanitarianAidHistoryCollection
     */
    public function index(Request $request)
    {
        $humanitarianAidHistories = HumanitarianAidHistory::all();

        return new HumanitarianAidHistoryCollection($humanitarianAidHistories);
    }

    /**
     * @param \App\Http\Requests\HumanitarianAidHistoryStoreRequest $request
     * @return \App\Http\Resources\HumanitarianAidHistoryResource
     */
    public function store(HumanitarianAidHistoryStoreRequest $request)
    {
        $humanitarianAidHistory = HumanitarianAidHistory::create($request->validated());

        return new HumanitarianAidHistoryResource($humanitarianAidHistory);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HumanitarianAidHistory $humanitarianAidHistory
     * @return \App\Http\Resources\HumanitarianAidHistoryResource
     */
    public function show(Request $request, HumanitarianAidHistory $humanitarianAidHistory)
    {
        return new HumanitarianAidHistoryResource($humanitarianAidHistory);
    }

    /**
     * @param \App\Http\Requests\HumanitarianAidHistoryUpdateRequest $request
     * @param \App\Models\HumanitarianAidHistory $humanitarianAidHistory
     * @return \App\Http\Resources\HumanitarianAidHistoryResource
     */
    public function update(HumanitarianAidHistoryUpdateRequest $request, HumanitarianAidHistory $humanitarianAidHistory)
    {
        $humanitarianAidHistory->update($request->validated());

        return new HumanitarianAidHistoryResource($humanitarianAidHistory);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HumanitarianAidHistory $humanitarianAidHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, HumanitarianAidHistory $humanitarianAidHistory)
    {
        $humanitarianAidHistory->delete();

        return response()->noContent();
    }

    public function export(Request $request)
    {
        return Excel::download(new HAidHistoryExport(), 'h-aid.xlsx');
    }


    public function import(Request $request)
    {

        $file = $request->file('file');

        if (is_null($file))
            return response()->noContent();

        $destinationPath = storage_path('app/public');
        $file->move($destinationPath, $file->getClientOriginalName());
        ini_set('memory_limit', '7560M');
        ini_set('max_execution_time', 1223200);
        Excel::import(new PeopleAndAidImport(), storage_path('app/public/') . $file->getClientOriginalName());


        return response()->noContent();

    }

    public function hAidAdd(Request $request)
    {

        $uuid = Str::uuid();
        $title = $this->storeJson("h-aid-", $uuid, $request->toArray());

        $tmp = (object)$request->all();

        try {
            $tmp->issue_at = !is_null($tmp->issue_at) ?
                Carbon::parse($tmp->issue_at)->toDateTimeString() : null;

        } catch (\Exception  $e) {
            $tmp->issue_at = null;
        }


        HumanitarianAidHistory::create((array)$tmp);

        return response()->noContent();


    }

    public function search(Request $request)
    {

        $request->validate([
            "search" => "required"
        ]);
        $search = $request->search ?? null;


        $aid = HumanitarianAidHistory::query()
            ->where("full_name", "like", "%$search%")
            ->orWhere("passport", "like", "%$search%")
            ->orderBy("issue_at", "desc")
            ->take(10)
            ->get();


        return response()->json(new HumanitarianAidHistoryCollection($aid));
    }
}
