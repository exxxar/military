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
use App\Http\Resources\MessageCollection;
use App\Http\Resources\PeopleCollection;
use App\Imports\DeviceImport;
use App\Imports\HAidHistoryImport;
use App\Imports\PeopleAndAidImport;
use App\Imports\PeopleAndAidImport2;
use App\Imports\PeopleAndAidImport3;
use App\Models\HumanitarianAidHistory;
use App\Models\Message;
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
    public function destroy(Request $request, $id)
    {
        $humanitarianAidHistory = HumanitarianAidHistory::query()->find($id);

        if (is_null($humanitarianAidHistory))
            return response()->noContent(404);

        $humanitarianAidHistory->delete();

        return response()->noContent();
    }

    public function export(Request $request, $period = "day")
    {
        ini_set('memory_limit', '7560M');
        ini_set('max_execution_time', 1223200);

        return Excel::download(new HAidHistoryExport($period), 'h-aid.xlsx');
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

        $tmp->full_name = ($tmp->t_name ?? "") . " " . ($tmp->f_name ?? "") . " " . ($tmp->s_name ?? "");

        try {
            $tmp->issue_at = !is_null($tmp->issue_at) ?
                Carbon::parse($tmp->issue_at)->toDateTimeString() : null;

        } catch (\Exception  $e) {
            $tmp->issue_at = null;
        }

        if (empty($tmp->issue_date_history)) {
            $tmp->issue_date_history = [];
        }

        $types = $tmp->types;

        foreach ($types as $type)
            $tmp->issue_date_history = [
                (object)[
                    "date" => $tmp->issue_at,
                    "comment" => "",
                    "type" => $type ?? null
                ]
            ];


        if (!is_null($tmp->id)) {
            $hAid = HumanitarianAidHistory::query()->find($tmp->id);

            if (!is_null($hAid)) {
                $hAid->update((array)$tmp);
                return response()->noContent();
            }
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
            ->take(20)
            ->get();

        $messages = Message::query()
            ->where("full_name", "like", "%$search%")
            ->orWhere("identify", "like", "%$search%")
            ->orWhere("sender_full_name", "like", "%$search%")
            ->orWhere("sender_info", "like", "%$search%")
            ->orderBy("created_at", "desc")
            ->take(20)
            ->get();

        return response()->json([
            "history" => new HumanitarianAidHistoryCollection($aid),
            "messages" => new MessageCollection($messages)
        ]);
    }
}
