<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    protected $table = 'contratos';
    use SoftDeletes;

    protected $fillable = [
        'polo_id',
        'empresa_id',
        'user_id',
        'aluno_id',
        'data_inicial',
        'data_final',
        'status'
    ];

    public function polo()
    {
        return $this->belongsTo(Polo::class, 'polo_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function responsavelJovem()
    {
        return $this->belongsTo(EmpresaContato::class, 'empresa_contato_id');
    }

    public function convenio()
    {
        return $this->belongsTo(Convenio::class, 'convenio_id');
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function comercial()
    {
        return $this->belongsTo(AtuacaoComercial::class, 'id', 'contrato_id');
    }

    public function reposicao()
    {
        return $this->belongsTo(Reposicao::class, 'id', 'contrato_id');
    }

    public function faturamento()
   	{
   		return $this->hasMany('App\FaturamentoContrato', 'contrato_id');
   	}

    public function atualizacoes(){
        return $this->hasMany('App\AtualizacoesContrato', 'contrato_id');
    }

    public function verificaDuplicidade($campo, $valor){

        $dup = $this::where($campo, $valor)->where('situacao', 'Ativo')->first();

        if(isset($dup)){
            return $dup;
        }else{
            return false;
        }
    }

}
