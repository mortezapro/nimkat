<?php

namespace App\Http\Controllers;

use App\Models\MessageModel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
class MessageController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $questions = MessageModel::when($request->has("column"),function ($q) use($request){
            return $q->orderBy($request->column,$request->orderBy);
        })->when($request->has("search"),function ($q) use ($request){
            $search = trim($request->search);
            return $q->where("text","like","%{$search}%");
        })->orWhereHas("user",function ($q) use ($request){
            $search = trim($request->search);
            return $q->where("first_name","like","%{$search}%")->orWhere("last_name","like","%{$search}%")->orWhere("username","like","%{$search}%");
        })->latest()->paginate($perPage)->withQueryString();

        if($request->has("column") || $request->has("search") || $request->has("page")){
            return $questions;
        }
        return Inertia::render('Message/List', compact("questions"));
    }
}
