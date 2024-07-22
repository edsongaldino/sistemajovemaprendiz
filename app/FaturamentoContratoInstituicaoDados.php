<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class FaturamentoContratoInstituicaoDados extends Model
{
    protected $table = 'faturamento_contrato_instituicao_dados';

    public function FaturamentoContrato()
    {
        return $this->belongsTo(FaturamentoContrato::class, 'faturamento_contrato_id');
    }
}
