<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
   
    use SoftDeletes;
    protected $fillable = [
        'cidade_id',
        'cep_endereco',
        'logradouro_endereco',
        'numero_endereco',
        'complemento_endereco',
        'bairro_endereco'
    ];

    public function cidade()
    {
        return $this->hasOne(Cidade::class, 'id', 'cidade_id');
    }
    

}
