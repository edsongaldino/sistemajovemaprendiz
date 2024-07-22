<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaturamentoContrato extends Model
{
    protected $table = 'faturamento_contrato';

    public function convenio()
    {
        return $this->belongsTo(Convenio::class, 'convenio_id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function FaturamentoContratoInstituicaoDados()
    {
        return $this->belongsTo(FaturamentoContratoInstituicaoDados::class, 'id', 'faturamento_contrato_id');
    }

    public function FaturamentoContratoEmpresaDados()
    {
        return $this->belongsTo(FaturamentoContratoEmpresaDados::class, 'id', 'faturamento_contrato_id');
    }

}
