<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable = [
        'polo_id',
        'nome',
        'numero',
        'funcao',
        'cbo',
        'ch_total',
        'ch_pratica',
        'ch_teorica',
        'ch_semanal',
        'ch_diaria'
    ];

    public function polo()
    {
        return $this->belongsTo(Polo::class, 'polo_id');
    }
}