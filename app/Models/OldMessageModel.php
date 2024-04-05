<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class OldMessageModel extends Model
{
    use HasFactory;
    protected $table = "old_messages";
    protected $primaryKey = "id";
    protected $fillable = [
        "date","sender","sender_id","text","reply_to_message_id"
    ];
    public function getDateAttribute()
    {
        return Jalalian::forge($this->attributes["date"])->format("%d - %m %Y H:i");
    }
}
