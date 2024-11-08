<?php

namespace App\Http\Controllers;

use App\ContaBancaria;
use App\Estado;
use App\Faturamento;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Polo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatoriosController extends Controller
{
    public function RelatorioBusca(Request $request)
    {
        $faturamentos = $this->GetFaturamentos($request);

        $polos = Polo::all();
        $estados = Estado::all();
        $contas = ContaBancaria::all();

        return view('sistema.relatorios.index', compact('faturamentos', 'polos', 'estados', 'contas', 'request'));
    }

    public function ImprimirRelatorio(Request $request){
        $faturamentos = $this->GetFaturamentos($request);
        $data_atual = Carbon::now()->format('d/m/Y H:i');

        switch($request->tipo_relatorio){
            case "1":
                $view = 'sistema.relatorios.imprimir';
            break;
                case "2":
                    $view = 'sistema.relatorios.recebidos';
                break;
                    case "3":
                        $view = 'sistema.relatorios.imprimir';
                    break;
                        case "4":
                            $view = 'sistema.relatorios.imprimir';
                        break;
        }

        return view($view, compact('faturamentos', 'data_atual', 'request'));
    }

    public function GetFaturamentos(Request $request){

        $buscaFaturamento = Faturamento::select('faturamentos.*')->where('faturamentos.deleted_at', null)
                        ->join('convenios', 'convenios.id', '=', 'faturamentos.convenio_id')
                        ->join('empresas', 'empresas.id', '=', 'convenios.empresa_id')
                        ->join('enderecos', 'enderecos.id', '=', 'empresas.endereco_id')
                        ->leftjoin('faturamento_boletos', 'faturamentos.id', '=', 'faturamento_boletos.faturamento_id')
                        ->leftjoin('informe_pagamento', 'faturamentos.id', '=', 'informe_pagamento.faturamento_id');

        if($request->polo){
            $buscaFaturamento->where('convenios.polo_id', $request->polo);
        }

        if($request->cidade_endereco){
            $buscaFaturamento->where('enderecos.cidade_id', $request->cidade_endereco);
        }

        if($request->nome_fantasia){
            $buscaFaturamento->where('empresas.nome_fantasia', 'like', '%' . $request->nome_fantasia . '%');
        }

        if($request->banco){
            $buscaFaturamento->where('informe_pagamento.conta_id', $request->banco);
        }

        if($request->tipo_relatorio){
            switch($request->tipo_relatorio){
                case "1":
                    $buscaFaturamento->join('faturamento_nf', 'faturamentos.id', '=', 'faturamento_nf.faturamento_id');
                    if($request->data_inicial && $request->data_final){
                        $buscaFaturamento->whereBetween('faturamento_nf.created_at', [$request->data_inicial, $request->data_final]);
                    }
                    $buscaFaturamento->where('faturamentos.situacao_pagamento','!=', 'Liquidado');
                break;
                    case "2":
                        $buscaFaturamento->join('faturamento_nf', 'faturamentos.id', '=', 'faturamento_nf.faturamento_id');
                        $buscaFaturamento->where('faturamentos.situacao_pagamento', 'Liquidado')->whereBetween('faturamentos.data_pagamento',[$request->data_inicial, $request->data_final]);
                    break;
                        case "3":
                            $buscaFaturamento->join('faturamento_nf', 'faturamentos.id', '=', 'faturamento_nf.faturamento_id');
                            $buscaFaturamento
                            ->where('faturamentos.situacao_pagamento','!=', 'Liquidado')
                            ->whereBetween('faturamentos.data_vencimento',[$request->data_inicial, $request->data_final]);
                        break;
                            case "4":
                                $buscaFaturamento->join('faturamento_nf', 'faturamentos.id', '=', 'faturamento_nf.faturamento_id');
                                $dataInicial = $request->data_inicial;
                                $dataFinal = $request->data_final;
                                $buscaFaturamento
                                ->where('faturamentos.situacao_pagamento','Liquidado')
                                ->whereBetween('faturamentos.data_vencimento',[$request->data_inicial, $request->data_final])
                                ->where('faturamentos.data_pagamento','>', $request->data_final)
                                ->orWhere(
                                    function($query) use ($dataInicial, $dataFinal) {
                                      return $query
                                      ->where('faturamentos.situacao_pagamento','!=', 'Liquidado')
                                      ->whereBetween('faturamentos.data_vencimento',[$dataInicial, $dataFinal]);
                                     })
                                ->get();                                            
                            break;   
                                case "5":
                                    $buscaFaturamento->join('faturamento_nf', 'faturamentos.id', '=', 'faturamento_nf.faturamento_id');
                                    $buscaFaturamento
                                    ->whereBetween('faturamento_nf.created_at',[$request->data_inicial, $request->data_final]);
                                break;
                                
                                    case "6":
                                        $buscaFaturamento->leftjoin('faturamento_nf', 'faturamentos.id', '=', 'faturamento_nf.faturamento_id');
                                        $buscaFaturamento
                                        ->whereBetween('faturamentos.data',[$request->data_inicial, $request->data_final])
                                        ->where('faturamento_nf.id', null);
                                    break; 

            }
        }
        
        $faturamentos = $buscaFaturamento->groupBy('faturamentos.id')->orderBy('convenios.polo_id', 'desc')->orderBy('faturamentos.data', 'desc')->get();

        return $faturamentos;
    }
}
