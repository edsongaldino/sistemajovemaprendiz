<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Faturamento;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Polo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RelatoriosController extends Controller
{
    public function RelatorioBusca(Request $request)
    {
        $faturamentos = $this->GetFaturamentos($request);

        $polos = Polo::all();
        $estados = Estado::all();

        return view('sistema.relatorios.index', compact('faturamentos', 'polos', 'estados', 'request'));
    }

    public function ImprimirRelatorio(Request $request){
        $faturamentos = $this->GetFaturamentos($request);
        $data_atual = Carbon::now()->format('d/m/Y H:i');
        return view('sistema.relatorios.imprimir', compact('faturamentos', 'data_atual', 'request'));
    }

    public function GetFaturamentos(Request $request){

        $buscaFaturamento = Faturamento::select('faturamentos.*')
                        ->join('convenios', 'convenios.id', '=', 'faturamentos.convenio_id')
                        ->join('empresas', 'empresas.id', '=', 'convenios.empresa_id')
                        ->join('enderecos', 'enderecos.id', '=', 'empresas.endereco_id')
                        ->leftjoin('faturamento_nf', 'faturamentos.id', '=', 'faturamento_nf.faturamento_id')
                        ->leftjoin('faturamento_boletos', 'faturamentos.id', '=', 'faturamento_boletos.faturamento_id')
                        ->where('faturamentos.deleted_at', null)->where('faturamento_boletos.deleted_at', null);

        if($request->polo){
            $buscaFaturamento->where('convenios.polo_id', $request->polo);
        }

        if($request->cidade_endereco){
            $buscaFaturamento->where('enderecos.cidade_id', $request->cidade_endereco);
        }

        if($request->data_inicial && $request->data_final){
            $buscaFaturamento->whereBetween('faturamentos.data', [$request->data_inicial, $request->data_final]);
        }

        if($request->nome_fantasia){
            $buscaFaturamento->where('empresas.nome_fantasia', 'like', '%' . $request->nome_fantasia . '%');
        }

        if($request->tipo_relatorio){
            switch($request->tipo_relatorio){
                case "1":
                    $buscaFaturamento->where('faturamento_boletos.status', 'Emitido');
                break;
                    case "2":
                        $buscaFaturamento->where('faturamento_boletos.status', 'LIQUIDACAO')->where('faturamento_boletos.data_pagamento','<>', '0000-00-00');
                    break;
                        case "3":
                            $buscaFaturamento->where('faturamento_boletos.status', 'VENCIDO');
                        break;

            }
        }

        $faturamentos = $buscaFaturamento->groupBy('faturamentos.id')->orderBy('faturamentos.data', 'desc')->get();

        return $faturamentos;
    }
}
