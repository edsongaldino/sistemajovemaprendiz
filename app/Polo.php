<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Polo extends Model
{
    protected $table = 'polos';
    use SoftDeletes;
    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }
}
