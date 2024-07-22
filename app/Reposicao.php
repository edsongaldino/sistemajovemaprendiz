<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reposicao extends Model
{
    protected $table = 'reposicao';

    public function gravarReposicao($contrato, $aluno_id){

        $TemReposicao = Reposicao::where('contrato_id', $contrato->id)->get();

        if($TemReposicao->count() > 0){

            $TemReposicao->aluno_id = $aluno_id;
            $TemReposicao->contrato_id = $contrato->id;
            $TemReposicao->save();

        }else{
            $reposicao = new Reposicao();
            $reposicao->aluno_id = $aluno_id;
            $reposicao->contrato_id = $contrato->id;
            $reposicao->save();
        }
        
        return $reposicao;
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id', 'id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id', 'id');
    }
}
