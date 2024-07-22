<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaturamentoBoleto extends Model
{
    protected $table = 'faturamento_boletos';
    use SoftDeletes;
    protected $fillable = [
        'faturamento_id',
        'data_vencimento',
        'data_pagamento',
        'codigo_boleto',
        'status'
    ];
    
}
