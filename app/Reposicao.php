<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reposicao extends Model
{
    protected $table = 'reposicao';

    public function gravarReposicao($contrato, $aluno_id){

        $TemReposicao = Reposicao::where('contrato_id', $contrato->id)->orderBy('id', 'DESC')->first();

        if(isset($TemReposicao)){

            $TemReposicao->aluno_id = $aluno_id;
            $TemReposicao->contrato_id = $contrato->id;
            $TemReposicao->save();

        }else{
            $TemReposicao = new Reposicao();
            $TemReposicao->aluno_id = $aluno_id;
            $TemReposicao->contrato_id = $contrato->id;
            $TemReposicao->save();
        }
        
        return $TemReposicao;
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
