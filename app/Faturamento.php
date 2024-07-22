<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faturamento extends Model
{
    protected $table = 'faturamentos';

    public function convenio()
    {
        return $this->belongsTo(Convenio::class, 'convenio_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function boleto()
    {
        return $this->hasOne(FaturamentoBoleto::class)->whereNull('deleted_at');
    }

    public function notaFiscal()
    {
        return $this->hasOne(FaturamentoNF::class)->whereNull('deleted_at');
    }

    public function faturamentoContratos()
    {
        return $this->hasMany(FaturamentoContrato::class)->whereNull('deleted_at');
    }


}
