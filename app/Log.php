<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    protected $table = 'logs';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
