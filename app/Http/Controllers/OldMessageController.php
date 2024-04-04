<?php

namespace App\Http\Controllers;

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
        foreach ($data as $message) {
//            $telegramMessageId = $message['message_id'];
//            $senderId = $message['from']['id'];
            $text = $message['text'] ?? null;
            echo $text."<br>";
        }
    }
}
