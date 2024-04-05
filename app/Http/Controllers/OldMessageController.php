<?php

namespace App\Http\Controllers;

use App\Models\OldMessageModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use SplPriorityQueue;
class OldMessageController extends Controller
{
    public function index()
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
                    $msg[$key]['text'] = "";
                    foreach ($msg["text"] as $item) {
                        if(is_string($item)){
                            $msg[$key]['text'].= $item;
                        }
                    }
                }
                if(isset($msg["reply_to_message_id"])){
                    $msgData[$key]["reply_to_message_id"] = $msg["reply_to_message_id"];
                }
            }
        }
        collect($msgData)->chunk(1000)->each(function ($chunk) {
            dd($chunk->toArray());
            OldMessageModel::insert($chunk->toArray());
        });

    }
    public function flattenArray($array):array {
        $flattened = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $flattened = array_merge($flattened, $this->flattenArray($item));
            } else {
                $flattened[] = $item;
            }
        }
        return $flattened;
    }
}
