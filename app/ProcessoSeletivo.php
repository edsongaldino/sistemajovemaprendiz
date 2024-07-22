<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessoSeletivo extends Model
{
    protected $table = 'processo_seletivo';
    use SoftDeletes;


    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function vaga()
    {
        return $this->belongsTo(Vaga::class, 'vaga_id');
    }
    
}
