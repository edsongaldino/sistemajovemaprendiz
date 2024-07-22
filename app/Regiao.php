<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regiao extends Model
{
    protected $table = 'regioes';
    use SoftDeletes;

    public function responsaveis()
    {
        return $this->belongsToMany(User::class,
            'regiao_responsavel',
            'regiao_id',
            'user_id');
    }


}