<?php

namespace App\Http\Controllers;

use App\Arquivo;
use App\Faturamento;
use App\FaturamentoNF;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArquivoController extends Controller
{

    public function index(){

        $arquivos = Arquivo::orderBy('created_at', 'desc')->paginate(15);
        return view('sistema.financeiro.relatorio_importacao', compact('arquivos'));

    }

    public function GerarTXTFaturamento(Request $request){


        if($request->tipo == 'FATURAMENTO'){

            $FaturamentoNF = FaturamentoNF::whereBetween('created_at', [$request->data_inicial, $request->data_final])
                                            ->where('status', 'Autorizada')                                
                                            ->groupBy('faturamento_id') 
                                            ->get();

            $nomeArquivo = $request->tipo.Carbon::parse($request->data_inicial)->format('mY');
            $urlArquivo = "/uploads/faturamentos/".$nomeArquivo.".txt";
            $arquivo = fopen(base_path() . "/public/uploads/faturamentos/".$nomeArquivo.".txt","w");

            $string = "";

            foreach($FaturamentoNF as $nf){

                $faturamento = Faturamento::find($nf->faturamento_id);

                if($faturamento->convenio->empresa->tipo_cadastro == 'CNPJ'){
                    $cpfCnpj = $faturamento->convenio->empresa->cnpj;
                    $nome = Helper::removeAcentos($faturamento->convenio->empresa->razao_social);
                }else{
                    $cpfCnpj = $faturamento->convenio->empresa->cpf;
                    $nome = Helper::removeAcentos($faturamento->convenio->empresa->nome_fantasia);
                }

                if(isset($faturamento->notaFiscal->numero_nf)){
                    //Ano
                    $string .= str_pad(Carbon::parse($faturamento->notaFiscal->created_at)->format('Y'), 4);
                    //Data
                    $string .= str_pad(Carbon::parse($faturamento->notaFiscal->created_at)->format('d/m/Y'), 10);
                    //Histórico
                    $string .= str_pad('0179', 3);
                    //Valor
                    $string .= str_pad(Helper::converte_valor_real(Helper::GetValorTotalFaturado($faturamento->id)), 12, " ", STR_PAD_LEFT);
                    //Branco
                    $string .= str_pad('', 1);
                    //Complemento 1 (Ver qual informação vai aqui)
                    $string .= str_pad($faturamento->notaFiscal->numero_nf, 30);
                    //Complemento 2
                    $string .= str_pad('TITULO - ' . $faturamento->id, 30);
                    //Complemento 3
                    $string .= str_pad(substr($nome, 0, 30), 30);
                    //Complemento 4
                    $string .= str_pad($cpfCnpj, 30);
                    //Conta Crédito
                    $string .= str_pad('21100501010001', 14);
                    //Conta Débito
                    $string .= str_pad($faturamento->convenio->empresa->conta_contabil, 14);
                    //CodClienteDebito
                    $string .= str_pad('', 6);
                    //EmpresaClienteDebito
                    $string .= str_pad('', 3);
                    //CodClienteCredito
                    $string .= str_pad('', 6);
                    //EmpresaClienteCredito
                    $string .= str_pad('', 3);
                    //Branco
                    $string .= str_pad('', 1);
                    //Flag Abertura
                    $string .= str_pad('N', 1);
                    //Branco
                    $string .= str_pad('', 3);
                    //Data Inicial
                    $string .= str_pad(Carbon::parse($faturamento->data_inicial)->format('d/m/Y'), 10);
                    //Data Final
                    $string .= str_pad(Carbon::parse($faturamento->data_final)->format('d/m/Y'), 10);
                    //Centro Custo Crédito
                    $string .= str_pad('', 4);
                    //Centro Custo Débito
                    $string .= str_pad('', 4);
                    //Número de Lançamento
                    $string .= str_pad('', 10);
                    //Quebra linha
                    $string .= "\n";
                }
            }
        }else{

            $FaturamentoPeriodo = Faturamento::where('situacao_pagamento', 'Liquidado')
                                                ->whereBetween('data_pagamento', [$request->data_inicial, $request->data_final])
                                                ->groupBy('faturamentos.id')
                                                ->get();
            
            $nomeArquivo = $request->tipo.Carbon::parse($request->data_inicial)->format('mY');
            $urlArquivo = "/uploads/recebimentos/".$nomeArquivo.".txt";
            $arquivo = fopen(base_path() . "/public/uploads/recebimentos/".$nomeArquivo.".txt","w");

            $string = "";

            foreach($FaturamentoPeriodo as $faturamento){

                if($faturamento->convenio->empresa->tipo_cadastro == 'CNPJ'){
                    $cpfCnpj = $faturamento->convenio->empresa->cnpj;
                    $nome = Helper::removeAcentos($faturamento->convenio->empresa->razao_social);
                }else{
                    $cpfCnpj = $faturamento->convenio->empresa->cpf;
                    $nome = Helper::removeAcentos($faturamento->convenio->empresa->nome_fantasia);
                }

                $data_inicial = Carbon::parse($faturamento->data_pagamento)->startOfMonth()->format('d/m/Y');
                $data_final = Carbon::parse($faturamento->data_pagamento)->endOfMonth()->format('d/m/Y');
          
                if($faturamento->forma_pagamento == 'Boleto'){

                    if(isset($faturamento->boleto)){

                        if($faturamento->boleto->status == 'LIQUIDACAO'){

                            if(isset($request->recebimento)){
                                //Ano
                                $string .= str_pad(Carbon::parse($faturamento->boleto->data_pagamento)->format('Y'), 4);
                                //Data
                                $string .= str_pad(Carbon::parse($faturamento->boleto->data_pagamento)->format('d/m/Y'), 10);
                                //Histórico
                                $string .= str_pad('0007', 3);
                                //Valor
                                $string .= str_pad(Helper::converte_valor_real($faturamento->boleto->valor ?? '0'), 12, " ", STR_PAD_LEFT);
                                //Branco
                                $string .= str_pad('', 1);
                                //Complemento 1 (Ver qual informação vai aqui)
                                $string .= str_pad($faturamento->notaFiscal->numero_nf, 30);
                                //Complemento 2
                                $string .= str_pad('TITULO - ' . $faturamento->id, 30);
                                //Complemento 3
                                $string .= str_pad(substr($nome, 0, 30), 30);
                                //Complemento 4
                                $string .= str_pad($cpfCnpj, 30);
                                //Conta Crédito
                                $string .= str_pad($faturamento->convenio->empresa->conta_contabil, 14);
                                //Conta Débito
                                $string .= str_pad('11010201010097', 14);
                                //CodClienteDebito
                                $string .= str_pad('', 6);
                                //EmpresaClienteDebito
                                $string .= str_pad('', 3);
                                //CodClienteCredito
                                $string .= str_pad('', 6);
                                //EmpresaClienteCredito
                                $string .= str_pad('', 3);
                                //Branco
                                $string .= str_pad('', 1);
                                //Flag Abertura
                                $string .= str_pad('N', 1);
                                //Branco
                                $string .= str_pad('', 3);
                                //Data Inicial
                                $string .= str_pad($data_inicial, 10);
                                //Data Final
                                $string .= str_pad($data_final, 10);
                                //Centro Custo Crédito
                                $string .= str_pad('', 4);
                                //Centro Custo Débito
                                $string .= str_pad('', 4);
                                //Número de Lançamento
                                $string .= str_pad('', 10);
                                //Quebra linha
                                $string .= "\n";
                            }

                            if($faturamento->boleto->valor_juros > 0.00){
                                //Monta inha com os juros
                                if(isset($request->juros)){
                                    //Ano
                                    $string .= str_pad(Carbon::parse($faturamento->boleto->data_pagamento)->format('Y'), 4);
                                    //Data
                                    $string .= str_pad(Carbon::parse($faturamento->boleto->data_pagamento)->format('d/m/Y'), 10);
                                    //Histórico
                                    $string .= str_pad('0253', 3);
                                    //Valor
                                    $string .= str_pad(Helper::converte_valor_real($faturamento->boleto->valor_juros), 12, " ", STR_PAD_LEFT);
                                    //Branco
                                    $string .= str_pad('', 1);
                                    //Complemento 1 (Ver qual informação vai aqui)
                                    $string .= str_pad($faturamento->notaFiscal->numero_nf, 30);
                                    //Complemento 2
                                    $string .= str_pad('TITULO - ' . $faturamento->id, 30);
                                    //Complemento 3
                                    $string .= str_pad(substr($nome, 0, 30), 30);
                                    //Complemento 4
                                    $string .= str_pad($cpfCnpj, 30);
                                    //Conta Crédito
                                    $string .= str_pad('32010108010002', 14);
                                    //Conta Débito
                                    $string .= str_pad('11010201010097', 14);
                                    //CodClienteDebito
                                    $string .= str_pad('', 6);
                                    //EmpresaClienteDebito
                                    $string .= str_pad('', 3);
                                    //CodClienteCredito
                                    $string .= str_pad('', 6);
                                    //EmpresaClienteCredito
                                    $string .= str_pad('', 3);
                                    //Branco
                                    $string .= str_pad('', 1);
                                    //Flag Abertura
                                    $string .= str_pad('N', 1);
                                    //Branco
                                    $string .= str_pad('', 3);
                                    //Data Inicial
                                    $string .= str_pad($data_inicial, 10);
                                    //Data Final
                                    $string .= str_pad($data_final, 10);
                                    //Centro Custo Crédito
                                    $string .= str_pad('', 4);
                                    //Centro Custo Débito
                                    $string .= str_pad('', 4);
                                    //Número de Lançamento
                                    $string .= str_pad('', 10);
                                    //Quebra linha
                                    $string .= "\n";
                                }
                            }

                        }
                    }
                }else{
                    if(isset($faturamento->informePagamento)){
                        //Ano
                        $string .= str_pad(Carbon::parse($faturamento->informePagamento->data_pagamento)->format('Y'), 4);
                        //Data
                        $string .= str_pad(Carbon::parse($faturamento->informePagamento->data_pagamento)->format('d/m/Y'), 10);
                        //Histórico
                        $string .= str_pad('0007', 3);
                        //Valor
                        $string .= str_pad(Helper::converte_valor_real($faturamento->informePagamento->valor_pago ?? '0'), 12, " ", STR_PAD_LEFT);
                        //Branco
                        $string .= str_pad('', 1);
                        //Complemento 1 (Ver qual informação vai aqui)
                        $string .= str_pad($faturamento->notaFiscal->numero_nf, 30);
                        //Complemento 2
                        $string .= str_pad('TITULO - ' . $faturamento->id, 30);
                        //Complemento 3
                        $string .= str_pad(substr($nome, 0, 30), 30);
                        //Complemento 4
                        $string .= str_pad($cpfCnpj, 30);
                        //Conta Crédito
                        $string .= str_pad($faturamento->convenio->empresa->conta_contabil, 14);
                        //Conta Débito
                        $string .= str_pad('11010201010097', 14);
                        //CodClienteDebito
                        $string .= str_pad('', 6);
                        //EmpresaClienteDebito
                        $string .= str_pad('', 3);
                        //CodClienteCredito
                        $string .= str_pad('', 6);
                        //EmpresaClienteCredito
                        $string .= str_pad('', 3);
                        //Branco
                        $string .= str_pad('', 1);
                        //Flag Abertura
                        $string .= str_pad('N', 1);
                        //Branco
                        $string .= str_pad('', 3);
                        //Data Inicial
                        $string .= str_pad($data_inicial, 10);
                        //Data Final
                        $string .= str_pad($data_final, 10);
                        //Centro Custo Crédito
                        $string .= str_pad('', 4);
                        //Centro Custo Débito
                        $string .= str_pad('', 4);
                        //Número de Lançamento
                        $string .= str_pad('', 10);
                        //Quebra linha
                        $string .= "\n";
                    }
                }
            }
        }

        fwrite($arquivo, $string);
        fclose($arquivo);

        $arquivo = new Arquivo();
        $arquivo->user_id = Auth::user()->id;
        $arquivo->url_arquivo = $urlArquivo;
        $arquivo->save();

        if($arquivo->save()):
            return redirect('sistema/arquivo/arquivos-importacao')->with('success', 'Arquivo gerado com sucesso!');
        else:
            return redirect('sistema/arquivo/arquivos-importacao')->with('warning', 'Erro ao gerar arquivo!');
        endif;

    }

    public function destroy(Request $request)
    {
        $arquivo = Arquivo::find($request->id);

        if($arquivo->delete()):
            return true;
        else:
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        endif;

    }
}
