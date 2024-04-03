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
        $i = 0;
        while (!feof($fileHandle)) {
            $i++;
            if($i<=1000){
                $line = fgets($fileHandle);
                $message = json_decode($line, true);
                $words = explode(' ', $message);
                $wordsCollection = $wordsCollection->merge($words);
            } else {
                break;
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
