<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturamentoContratoEmpresaDados extends Model
{
    protected $table = 'faturamento_contrato_empresa_dados';

    public function FaturamentoContrato()
    {
        return $this->belongsTo(FaturamentoContrato::class, 'faturamento_contrato_id');
    }
}
