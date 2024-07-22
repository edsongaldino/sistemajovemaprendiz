<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atualizacoes extends Model
{
    protected $table = 'atualizacoes';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
