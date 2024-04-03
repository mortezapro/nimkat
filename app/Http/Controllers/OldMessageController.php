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
        $fileHandle = fopen($jsonFilePath, 'r');
        while (!feof($fileHandle)) {
            $line = fgets($fileHandle);
            $message = json_decode($line, true);
            echo is_array($message);
            if (isset($message['text'])) {
                $words = explode(' ', $message['text']);
                $wordsCollection = $wordsCollection->merge($words);
            }
        }
        fclose($fileHandle);

        $wordCounts = $wordsCollection->countBy();
        $maxOccurrences = $wordCounts->max();

        $mostUsedWords = $wordCounts->filter(function ($value) use ($maxOccurrences) {
            return $value === $maxOccurrences;
        })->keys();

        echo "بیشترین تکرار: $maxOccurrences\n";
        echo "کلمات: " . $mostUsedWords->implode(', ');
    }
}
