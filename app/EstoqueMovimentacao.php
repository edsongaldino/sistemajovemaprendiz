<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstoqueMovimentacao extends Model
{
    protected $table = 'estoque_movimentacoes';
    use SoftDeletes;

    public function produto()
    {
        return $this->hasOne(EstoqueProduto::class, 'id', 'estoque_produto_id');
    }

    public function destino()
    {
        return $this->hasOne(Polo::class, 'id', 'polo_destino');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
