<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldMessageModel extends Model
{
    use HasFactory;
    protected $table = "old_messages";
    protected $primaryKey = "id";
    protected $fillable = [
        "date","sender","sender_id","text","reply_to_message_id"
    ];
}
