<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tabela extends Model
{
    protected $table = 'tabelas';
    use SoftDeletes;

    public function atualizacoes()
    {
        return $this->belongsTo(AtualizacoesTabela::class, 'tabela_id', 'id');
    }
}
