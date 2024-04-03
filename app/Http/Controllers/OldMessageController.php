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
        $data = Cache::get("data");
        if(!$data){
            $data = Storage::disk('local')->get('data/data.json');
            Cache::set('data', $data);
        }

        dd($data);
    }
}
