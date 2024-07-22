<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaturamentoNF extends Model
{
    protected $table = 'faturamento_nf';
    use SoftDeletes;
}
