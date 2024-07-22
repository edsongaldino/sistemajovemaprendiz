<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtualizacoesContrato extends Model
{
    protected $table = 'atualizacoes_contrato';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id', 'id');
    }
}
