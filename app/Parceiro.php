<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parceiro extends Model
{
    protected $table = 'parceiros';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
