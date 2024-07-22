<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    protected $table = 'sessoes';

    public function permissoes()
    {
        return $this->belongsTo(Permissao::class, 'sessao_id', 'id');
    }
}
