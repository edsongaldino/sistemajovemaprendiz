<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilPermissao extends Model
{
    protected $table = 'perfis_permissoes';

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id', 'id');
    }

    public function permissao()
    {
        return $this->belongsTo(Permissao::class, 'permissao_id', 'id');
    }
}
