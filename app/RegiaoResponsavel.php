<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegiaoResponsavel extends Model
{
    protected $table = 'regiao_responsavel';

    public function responsavel()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'regiao_id');
    }

}