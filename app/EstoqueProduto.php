<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstoqueProduto extends Model
{
    protected $table = 'estoque_produtos';
    use SoftDeletes;
}
