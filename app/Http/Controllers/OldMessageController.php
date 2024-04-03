<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class OldMessageController extends Controller
{
    public function index()
    {

        $jsonFilePath = storage_path("app/data/data.json");
        $wordsCollection = collect();
        $jsonStream = \json_stream($jsonFilePath);
        $jsonStream->each(function ($message) use (&$wordsCollection) {
            // اگر متن پیام وجود داشته باشد
            if (isset($message['text'])) {
                // کلمات را جدا کرده و به مجموعه اضافه کنید
                $words = explode(' ', $message['text']);
                $wordsCollection = $wordsCollection->merge($words);
            }
        });
        $wordCounts = $wordsCollection->countBy();
        $maxOccurrences = $wordCounts->max();
        $mostUsedWords = $wordCounts->filter(function ($value) use ($maxOccurrences) {
            return $value === $maxOccurrences;
        })->keys();
        echo "بیشترین تکرار: $maxOccurrences\n";
        echo "کلمات: " . $mostUsedWords->implode(', ');
    }
}
