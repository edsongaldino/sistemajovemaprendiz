<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtuacaoComercial extends Model
{
    protected $table = 'atuacao_comercial';

    public function gravarAtuacao($request, $contrato){

        $comercial = new AtuacaoComercial();
        $comercial->user_id = $request->responsavel_captacao;
        $comercial->contrato_id = $contrato->id;
        $comercial->comissao = $request->comissao;
        $comercial->save();

        return $comercial;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id', 'id');
    }
}