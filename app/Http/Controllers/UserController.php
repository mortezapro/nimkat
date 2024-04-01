<?php

namespace App\Http\Controllers;

use App\Models\MessageModel;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $users = User::when($request->has("column"),function ($q) use($request){
            return $q->orderBy($request->column,$request->orderBy);
        })->when($request->has("search"),function ($q) use ($request){
            $search = trim($request->search);
            return $q->where("first_name","like","%{$search}%")->orWhere("last_name","like","%{$search}%")->orWhere("username","like","%{$search}%");
        })->latest()->paginate($perPage)->withQueryString();

        if($request->has("column") || $request->has("search") || $request->has("page")){
            return $users;
        }
        return Inertia::render('User/List', compact("users"));
    }
}
