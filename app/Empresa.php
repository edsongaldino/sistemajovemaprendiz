<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    use SoftDeletes;

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    public function inscricoes()
   	{
   		return $this->hasMany('App\IeEmpresa', 'empresa_id');
   	}

    public function convenios()
   	{
   		return $this->hasMany('App\Convenio', 'empresa_id');
   	}

    public function contatos()
   	{
   		return $this->hasMany('App\EmpresaContato', 'empresa_id');
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
