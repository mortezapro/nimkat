<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use SplPriorityQueue;
class OldMessageController extends Controller
{
    public function index()
    {

        $filePath = storage_path("app/data/data.json");
        $chunkSize = 10000;
        try {
            $file = fopen($filePath, 'r');
            $wordFrequencyMap = new SplPriorityQueue(); // Use priority queue
            $topWords = [];

            while (($line = fgets($file)) !== false) {
                $data = json_decode($line);
                dd($data);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Invalid JSON data: ' . json_last_error_msg());
                }
                $messageText = $data->message;
                $messageText = strtolower($messageText);
                $messageText = preg_replace('/\W+/', ' ', $messageText);
                $words = explode(' ', $messageText);
                foreach ($words as $word) {
                    if ($wordFrequencyMap->count() < 50) {
                        // Add new word directly (top 50 not yet reached)
                        $wordFrequencyMap->insert($word, 1);
                    } else {
                        // Check if word exists and update count (if top 50 reached)
                        if ($wordFrequencyMap->contains($word)) {
                            $wordFrequencyMap->extract(); // Remove least frequent word
                            $wordFrequencyMap->insert($word, $wordFrequencyMap->offsetGet($word) + 1);
                        }
                    }
                }

                // Process data in chunks (optional, for very large files)
                if ($wordFrequencyMap->count() >= $chunkSize) {
                    // Extract top words from priority queue and merge with existing results
                    $topChunkWords = [];
                    while ($wordFrequencyMap->count() > 0) {
                        $topChunkWords[] = [$wordFrequencyMap->extract(), $wordFrequencyMap->current()];
                    }
                    $topWords = array_merge($topWords, $topChunkWords);
                }
            }

            // After processing entire file, extract final top 50 words
            $topWords = array_slice($topWords, -50); // Get the last 50 elements (top 50)
            $topWords = array_reverse($topWords); // Reverse to get top words in order

            return $topWords; // Array of word-count pairs

        } catch (\Exception $e) {
            return ['error' => $e->getMessage()]; // Handle errors
        }
    }
}
