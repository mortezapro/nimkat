<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    use HasFactory;
    protected $table = "messages";
    protected $primaryKey = ["id"];
    protected $fillable = [
        "chat_id","user_id","text"
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

}
