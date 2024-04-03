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
        $handle = fopen($filePath, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $data = json_decode($line, true);
                foreach ($data['messages'] as $message) {
                    $text = strtolower($message['text']);
                    $text = preg_replace("/[^a-zA-Z\s]/", "", $text); // Remove punctuation
                    $words = explode(" ", $text);
                    foreach ($words as $word) {
                        if (!empty($word)) {
                            $wordFrequencies[$word] = isset($wordFrequencies[$word]) ? $wordFrequencies[$word] + 1 : 1;
                        }
                    }
                }
            }
            fclose($handle);
            arsort($wordFrequencies);
            $topFifty = array_slice($wordFrequencies, 0, 50);
            foreach ($topFifty as $word => $frequency) {
                echo "$word: $frequency\n";
            }
        } else {
            echo "Error opening the file.";
        }
    }
}
