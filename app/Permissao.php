<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissoes';

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id', 'id');
    }

    public function sessao()
    {
        return $this->belongsTo(Sessao::class, 'sessao_id', 'id');
    }

}
