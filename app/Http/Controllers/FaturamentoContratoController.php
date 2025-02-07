<?php

namespace App\Http\Controllers;

use App\Convenio;
use App\FaturamentoContrato;
use App\FaturamentoContratoEmpresaDados;
use App\FaturamentoContratoInstituicaoDados;
use App\Helpers\Helper;
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

    public function FaturamentoContratoBusca(Request $request)
    {
        $buscaFaturamento = Convenio::select('convenios.*')
                        ->join('empresas', 'empresas.id', '=', 'convenios.empresa_id')
                        ->join('enderecos', 'enderecos.id', '=', 'empresas.endereco_id')
                        ->where('convenios.deleted_at', null);

        if($request->codigoEmpresa){
            $buscaFaturamento->where('empresa_id', $request->codigoEmpresa);
        }

        if($request->dia_faturamento){
            $buscaFaturamento->where('dia_faturamento', $request->dia_faturamento);
        }

        if($request->cnpj){
            $buscaFaturamento->where('empresas.cnpj', Helper::limpa_campo($request->cnpj));
        }

        if($request->cpf){
            $buscaFaturamento->where('empresas.cpf', Helper::limpa_campo($request->cpf));
        }

        if($request->razao_social){
            $buscaFaturamento->where('empresas.razao_social', 'like', '%' . $request->razao_social . '%');
        }

        if($request->cidade_endereco){
            $buscaFaturamento->where('enderecos.cidade_id', $request->cidade_endereco);
        }

        if($request->polo){
            $buscaFaturamento->where('convenios.polo_id', $request->polo);
        }

        $convenios = $buscaFaturamento->paginate(20);

        return view('sistema.financeiro.faturamento', compact('convenios', 'request'));

    }

}
