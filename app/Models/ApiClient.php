<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiClient extends Model
{
    protected $fillable = ['name', 'access_key', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];


}
