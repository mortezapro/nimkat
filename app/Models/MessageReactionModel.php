<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageReactionModel extends Model
{
    use HasFactory;
    protected $table = "message_reactions";
    protected $primaryKey = ["id"];
    protected $fillable = [
        "user_id","message_id","reaction"
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    public function message()
    {
        return $this->belongsTo(MessageModel::class,"message_id");
    }
}
