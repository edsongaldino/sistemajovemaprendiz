<?php

namespace App\Http\Controllers;

use App\FaturamentoContrato;
use App\FaturamentoContratoEmpresaDados;
use App\FaturamentoContratoInstituicaoDados;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaturamentoContratoController extends Controller
{
    //
    public function destroy(Request $request)
    {
        $faturamento = FaturamentoContrato::find($request->id);

        if($faturamento->FaturamentoContratoInstituicaoDados){
            $faturamento_dados_instituicao = $faturamento->FaturamentoContratoInstituicaoDados->first();
            $faturamento_dados = FaturamentoContratoInstituicaoDados::find($faturamento_dados_instituicao->id);
            $faturamento_dados->delete();
        }elseif($faturamento->FaturamentoContratoEmpresaDados){
            $faturamento_dados_empresa = $faturamento->FaturamentoContratoEmpresaDados->first();
            $faturamento_dados = FaturamentoContratoEmpresaDados::find($faturamento_dados_empresa->id);
            $faturamento_dados->delete();
        }

        if($faturamento->delete()):
            (new AtualizacoesContratoController())->removeIdfaturamentodaAtualizacao($faturamento->id);
            return true;
        else:
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        endif;

    }

}
