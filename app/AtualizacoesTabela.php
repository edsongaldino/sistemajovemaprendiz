<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtualizacoesTabela extends Model
{
    protected $table = 'atualizacoes_tabela';

    public function tabela()
    {
        return $this->belongsTo(Tabela::class, 'tabela_id', 'id');
    }

    public function atualizacao()
    {
        return $this->belongsTo(Atualizacoes::class, 'atualizacao_id', 'id');
    }
}
