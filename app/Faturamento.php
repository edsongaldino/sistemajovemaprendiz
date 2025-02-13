<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Faturamento extends Model
{
    protected $table = 'faturamentos';

    public static function informarPagamento($faturamento_id, $data_pagamento, $forma_pagamento){

        $Faturamento = Faturamento::find($faturamento_id);
        $Faturamento->forma_pagamento = $forma_pagamento;
        $Faturamento->data_pagamento = $data_pagamento;
        $Faturamento->situacao_pagamento = 'Liquidado';
        $Faturamento->update();

        return $Faturamento;
    }

    public function FaturarConvenio($convenio, $data_inicial, $data_final){

        $Faturamento = new Faturamento();
        $Faturamento->user_id = Auth::user()->id;
        $Faturamento->convenio_id = $convenio->id;
        $Faturamento->data = Carbon::now();
        $Faturamento->data_inicial = $data_inicial;
        $Faturamento->data_final = $data_final;
        $Faturamento->forma_pagamento = $convenio->forma_pagamento;
        
        if($Faturamento->save()){
            return $Faturamento;
        }else{
            return false;
        }      

    }

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

    public function informePagamento()
    {
        return $this->hasOne(InformePagamento::class)->orderBy('id', 'DESC');
    }

    public function credito()
    {
        return $this->hasOne(FaturamentoCredito::class)->orderBy('id', 'DESC');
    }

    public function notaFiscal()
    {
        return $this->hasOne(FaturamentoNF::class)->whereNull('deleted_at')->orderBy('id', 'DESC');
    }

    public function faturamentoContratos()
    {
        return $this->hasMany(FaturamentoContrato::class)->whereNull('deleted_at');
    }


}
