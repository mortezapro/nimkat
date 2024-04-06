<?php

namespace App\Http\Controllers;

use App\Models\MessageModel;
use App\Models\OldMessageModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function activeUser()
    {
        $users = OldMessageModel::select('sender', DB::raw('COUNT(*) as message_count'))
            ->groupBy('sender')
            ->orderByDesc('message_count')
            ->limit(50)
            ->get();
        dd($users);
        return view("top-users");
    }
}
