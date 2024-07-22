<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arquivo extends Model
{
    protected $table = 'arquivos';

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
