<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'alunos';
    use SoftDeletes;

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    public function curriculo()
    {
        return $this->hasOne(CurriculoAluno::class, 'aluno_id', 'id');
    }

    public function polo()
    {
        return $this->hasOne(Polo::class, 'id', 'polo_id');
    }

    public function conjuge()
    {
        return $this->hasOne(Conjuge::class, 'aluno_id', 'id');
    }

    public function responsavel()
    {
        return $this->hasOne(Responsavel::class, 'aluno_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function ProcessoSeletivo($tipo)
   	{
        switch($tipo){
            case 'Geral':
                return $this->hasMany('App\ProcessoSeletivo', 'aluno_id');
                break;
            case 'Ativo':
                return $this->hasMany('App\ProcessoSeletivo', 'aluno_id')->where('processo_seletivo.situacao','=','Em análise' ?? 'Aceito');
                break;
            default:
                return $this->hasMany('App\ProcessoSeletivo', 'aluno_id');
                break;
        }

   		
   	}

    public function verificaDuplicidade($campo, $valor){

        $dup = $this::where($campo, Helper::limpa_campo($valor))->first();

        if(isset($dup)){
            return $dup;
        }else{
            return false;
        }
    }

}
