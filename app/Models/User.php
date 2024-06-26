<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Morilog\Jalali\Jalalian;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'username',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ["date","persianRole"];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function message()
    {
        return $this->belongsTo(MessageModel::class,"message_id");
    }
    public function reactions()
    {
        return $this->hasMany(MessageReactionModel::class,"message_id");
    }
    public function getPersianRoleAttribute()
    {
        if($this->role == 2020){
            return "کاربر عادی";
        } elseif($this->role == 2025) {
            return "مدیر سیستم";
        }
    }
    public function getDateAttribute()
    {
        return Jalalian::forge($this->created_at)->format("%d - %m - %Y H:i");
    }
}
