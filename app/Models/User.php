<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'name',
        'email',
        'about',
        'image_url',
        'phone'
    ];
}
