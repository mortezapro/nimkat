<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class OldMessageController extends Controller
{
    public function index()
    {
//        $data = Redis::get("data");
//        if(!$data){
//            $data = Storage::disk('local')->get('data/data.json');
//            Redis::set('data', $data);
//        }
//
//        dd($data);
        try {
            $redis = Redis::connection();
            $redis->ping(); // Test connection
            echo "Connected to Redis!";
        } catch (Exception $e) {
            echo "Connection error: " . $e->getMessage();
        }
    }
}
