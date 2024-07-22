<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaga extends Model
{
    protected $table = 'vagas';
    use SoftDeletes;

    public function polo()
    {
        return $this->belongsTo(Polo::class, 'polo_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

}
