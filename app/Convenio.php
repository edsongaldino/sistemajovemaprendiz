<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Convenio extends Model
{
    protected $table = 'convenios';
    use SoftDeletes;

    protected $fillable = [
        'user_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function polo()
    {
        return $this->belongsTo(Polo::class, 'polo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tabela()
    {
        return $this->belongsTo(Tabela::class, 'tabela_id');
    }

    public function contratos()
   	{
   		return $this->hasMany('App\Contrato', 'convenio_id');
   	}

    public function faturamentos()
   	{
   		return $this->hasMany('App\Faturamento', 'convenio_id');
   	}

    public function faturamentoContratos()
   	{
   		return $this->hasMany('App\FaturamentoContrato', 'convenio_id');
   	}

}
