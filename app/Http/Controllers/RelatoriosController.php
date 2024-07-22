<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Faturamento;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Polo;
use Illuminate\Http\Request;

class RelatoriosController extends Controller
{
    public function RelatorioBusca(Request $request)
    {

        $buscaFaturamento = Faturamento::select('faturamentos.*')
                        ->join('convenios', 'convenios.id', '=', 'faturamentos.convenio_id')
                        ->join('empresas', 'empresas.id', '=', 'convenios.empresa_id')
                        ->join('enderecos', 'enderecos.id', '=', 'empresas.endereco_id')
                        ->where('convenios.deleted_at', null);


        if($request->codigoEmpresa){
            $buscaFaturamento->where('convenios.empresa_id', $request->codigoEmpresa);
        }

        if($request->polo){
            $buscaFaturamento->where('convenios.polo_id', $request->polo);
        }

        if($request->cidade_endereco){
            $buscaFaturamento->where('enderecos.cidade_id', $request->cidade_endereco);
        }

        if($request->data_inicial && $request->data_final){
            $buscaFaturamento->whereBetween('faturamentos.data', [$request->data_inicial, $request->data_final]);
        }

        if($request->cnpj){
            $buscaFaturamento->where('empresas.cnpj', Helper::limpa_campo($request->cnpj));
        }

        if($request->nome_fantasia){
            $buscaFaturamento->where('empresas.nome_fantasia', 'like', '%' . $request->nome_fantasia . '%');
        }

        $faturamentos = $buscaFaturamento->orderBy('faturamentos.data', 'desc')->paginate(20);

        $polos = Polo::all();
        $estados = Estado::all();

        return view('sistema.relatorios.index', compact('faturamentos', 'polos', 'estados', 'request'));
    }
}
