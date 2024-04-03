<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OldMessageController extends Controller
{
    public function index()
    {
        $data = Storage::disk('local')->get('data/data.json');
    }
}
