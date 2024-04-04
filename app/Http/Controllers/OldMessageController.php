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
        foreach ($data as $message) {
            var_dump($message);

            // استخراج داده های مورد نیاز از آرایه بر اساس ساختار JSON شما
            switch ($message['type']) {
                case 'service':
                    $messageData['action'] = $message['action'];
                    $messageData['actor'] = $message['actor_id'];
                    $messageData['date'] = Carbon::parse($message['date']);
                    break;
                case 'message':
                    $messageData['sender'] = $message['from_id'];
                    $messageData['text'] = $message['text'];
                    $messageData['date'] = Carbon::parse($message['date']);
                    // استخراج سایر فیلدهای مورد نیاز از پیام
                    break;
            }
        }
        dd($messageData);
    }
}
