<?php

namespace App\Http\Controllers;

use App\Models\MessageModel;
use App\Models\OldMessageModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use SplPriorityQueue;
class OldMessageController extends Controller
{
    /*public function index()
    {
        $filePath = storage_path("app/data/data.json");
        $jsonString = File::get($filePath);
        $data = json_decode($jsonString, true); // Set `true` for associative array

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Error parsing JSON file: ' . json_last_error_msg());
        }
        $messageData = [];
        foreach ($data as $key => $message) {
            $messageData[] = $message;
            if (isset($message["text"]) && is_array($message["text"])) {
                $messageData[] = $message["text"];
            }
        }
        $msgData = [];
        foreach ($messageData[3] as $key => $msg) {
            if(isset($msg["type"]) && $msg["type"] == "message"){
                $msgData[$key]["date"] = Carbon::parse($msg['date']);
                $msgData[$key]["sender"] = $msg['from'];
                $msgData[$key]["sender_id"] = $msg['from_id'];
                if(is_array($msg['text'])){
                    $msgData[$key]['text'] = "";
                    foreach ($msg["text"] as $item) {
                        if(is_string($item)){
                            $msgData[$key]['text'].= $item;
                        }
                    }
                } else {
                    $msgData[$key]['text'] = $msg['text'];
                }
                if(isset($msg["reply_to_message_id"])){
                    $msgData[$key]["reply_to_message_id"] = $msg["reply_to_message_id"];
                }
            }
        }
        collect($msgData)->chunk(100)->each(function ($chunk) {

            try {
                foreach ($chunk as $item) {
                    OldMessageModel::create($item);
                }
            } catch (\Exception $e) {
                Log::error('Error inserting chunk: ' . $e->getMessage());
            }
        });

    }*/
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $messages = OldMessageModel::when($request->has("column"),function ($q) use($request){
            return $q->orderBy($request->column,$request->orderBy);
        })->when($request->has("search"),function ($q) use ($request){
            $search = trim($request->search);
            return $q->where("text","like","%{$search}%")->orWhere("sender","like","%{$search}%");
        })->latest()->paginate($perPage)->withQueryString();

        if($request->has("column") || $request->has("search") || $request->has("page")){
            return $messages;
        }
        return Inertia::render('OldMessage/List', compact("messages"));
    }


    public function frequentWord()
    {
        $topWords = OldMessageModel::select(DB::raw('SUBSTRING_INDEX(SUBSTRING_INDEX(text, " ", numbers.n), " ", -1) AS word'), DB::raw('COUNT(*) AS count'))
            ->join(DB::raw('(SELECT (a.n + b.n * 10 + 1) AS n
            FROM
                (SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL
                 SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                CROSS JOIN
                (SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL
                 SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
        ) AS numbers'), function ($join) {
                $join->on(DB::raw('CHAR_LENGTH(text) - CHAR_LENGTH(REPLACE(text, " ", ""))'), '>=', DB::raw('numbers.n - 1'));
            })
            ->groupBy('word')
            ->orderByDesc('count')
            ->limit(1000)
            ->get();
        $wordsAndCounts = $topWords->pluck('word', 'count')->toArray();
        dd($wordsAndCounts);
    }
}
