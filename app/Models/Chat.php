<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_name',
        'user_email',
        'message',
        'is_admin'
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
