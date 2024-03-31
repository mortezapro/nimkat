<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class MessageModel extends Model
{
    use HasFactory;
    protected $table = "messages";
    protected $primaryKey = "id";
    protected $fillable = [
        "id","chat_id","user_id","text"
    ];
    protected $appends=["fullName","chat","date"];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    public function getFullNameAttribute()
    {
        return $this->user->first_name . "" .$this->user->last_name;
    }
    public function getDateAttribute()
    {
        return Jalalian::forge($this->created_at)->format("%d - %m - %Y H:i");
    }
    public function getChatAttribute()
    {
        if($this->chat_id == "-1002068548070"){
            return "نیمکت";
        }
    }
}
