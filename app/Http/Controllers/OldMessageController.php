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
        dd("s");
        $data = json_decode(file_get_contents(storage_path('app/data/data.json')));
        $counts = array_count_values(words(implode(' ', $data)));
        arsort($counts);
        $topWords = array_slice($counts, 0, 10);
        foreach ($topWords as $word => $count) {
            echo "$word: $count\n";
        }
    }
}
