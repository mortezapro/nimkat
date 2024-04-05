<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
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
            echo $key . "<br/>";
            if(isset($msg["message"])){
                $msgData["text"] = $msg["message"];
            }
//            switch ($msg['type']) {
//                case 'service':
//                    $msgData['action'] = $msg['action'];
//                    $msgData['actor'] = $msg['actor_id'];
//                    $msgData['date'] = Carbon::parse($msg['date']);
//                    break;
//                case 'message':
//                    $msgData['sender'] = $msg['from_id'];
//                    $msgData['text'] = $msg['text'];
//                    $msgData['date'] = Carbon::parse($msg['date']);
//                    break;
//            }
        }
        dd($msgData);
    }
}
