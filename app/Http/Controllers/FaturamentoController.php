<?php
namespace App\Http\Controllers;
include_once(base_path() . '/vendor/enotas/php-client/src/eNotasGW.php');

use App\AtualizacoesContrato;
use App\ContaBancaria;
use App\Contrato;
use App\Convenio;
use App\EmpresaContato;
use App\Estado;
use App\Faturamento;
use App\FaturamentoBoleto;
use App\FaturamentoContrato;
use App\FaturamentoContratoEmpresaDados;
use App\FaturamentoContratoInstituicaoDados;
use App\FaturamentoCredito;
use App\FaturamentoNF;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\InformePagamento;
use App\Mail\EmailFaturamento;
use App\Polo;
use Carbon\Carbon;
use CodePhix\Asaas\Conta;
use eNotasGW;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use OpenBoleto\Banco\Sicredi;
use OpenBoleto\Agente;

use eNotasGW\Api\Exceptions as Exceptions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FaturamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $FaturamentosTotal = Faturamento::orderBy('created_at', 'desc')->get();
        $polos = Polo::all();
        $estados = Estado::all();
        $faturamentos = Faturamento::orderBy('created_at', 'desc')->paginate(10);
        $contas = ContaBancaria::all();
        return view('sistema.financeiro.index', compact('faturamentos', 'polos', 'estados', 'FaturamentosTotal', 'contas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $convenios = Convenio::where('situacao','=', 'Ativo')->paginate(20);
        $data_inicial = Carbon::now()->startOfMonth()->toDateString();
        $data_final = Carbon::now()->endOfMonth()->toDateString();
        return view('sistema.financeiro.faturamento', compact('convenios', 'data_inicial', 'data_final'));
    }

    public function FaturadosBusca(Request $request)
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
            $buscaFaturamento->whereBetween('faturamentos.data_inicial', [$request->data_inicial, $request->data_final])->orWhereBetween('faturamentos.data_final', [$request->data_inicial, $request->data_final]);
        }

        if($request->cnpj){
            $buscaFaturamento->where('empresas.cnpj', Helper::limpa_campo($request->cnpj));
        }

        if($request->cpf){
            $buscaFaturamento->where('empresas.cpf', Helper::limpa_campo($request->cpf));
        }

        if($request->nome_fantasia){
            $buscaFaturamento->where('empresas.nome_fantasia', 'like', '%' . $request->nome_fantasia . '%');
        }

        $faturamentos = $buscaFaturamento->orderBy('faturamentos.data', 'desc')->paginate(20);
        $FaturamentosTotal = $buscaFaturamento->orderBy('faturamentos.data', 'desc')->get();

        $polos = Polo::all();
        $estados = Estado::all();
        $contas = ContaBancaria::all();

        return view('sistema.financeiro.index', compact('faturamentos', 'polos', 'estados', 'request', 'FaturamentosTotal', 'contas'));
    }

    /*
    REMOVIDO POR PROBLEMAS DE CACHE - MOVIDO PARA FATURAMENTOCONTRATOCONTROLLER
    public function FaturamentoBusca(Request $request)
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
    */

    public function FaturamentoConvenioBusca(Request $request)
    {
        $faturamentos = Faturamento::select('faturamentos.*')
                        ->join('convenios', 'convenios.id', '=', 'faturamentos.convenio_id')
                        ->where('convenios.empresa_id', $request->codigoEmpresa)
                        ->where('convenios.deleted_at', null)
                        ->orderBy('faturamentos.data', 'desc')
                        ->paginate(20);

        return view('sistema.financeiro.index', compact('faturamentos', 'request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Faturamento = new Faturamento();
        $Faturamento->user_id = $request->user_id;
        $Faturamento->empresa_id = $request->empresa_id;

        if($Faturamento->save()):
            return Redirect::back()->with('success', 'Contrato faturado com sucesso!');
        else:
            return Redirect::back()->with('warning', 'Erro ao faturar contrato!');
        endif;

    }

    public function VisualizarContratos($id)
    {
        $faturamento = Faturamento::find($id);
        $data_inicial = $faturamento->data_inicial;
        $contratos = Contrato::select('contratos.*')
                                ->join('alunos', 'alunos.id', '=', 'contratos.aluno_id')
                                ->where('contratos.convenio_id','=', $faturamento->convenio_id)
                                ->where(function ($query) use ($data_inicial) {
                                    $query->where('contratos.data_final','>=', $data_inicial);
                                          //->Where('contratos.situacao','=', 'Ativo');
                                })
                                ->orderBy('alunos.nome', 'asc')
                                ->paginate(20);
        $data_inicial = $faturamento->data_inicial;
        $data_final = $faturamento->data_final;

        return view('sistema.financeiro.faturamento_contrato', compact('faturamento', 'contratos', 'data_inicial', 'data_final'));
    }

    public function VisualizarEnvios($id)
    {
        $faturamento = Faturamento::find($id);
        $data_inicial = $faturamento->data_inicial;
        $data_inicial = $faturamento->data_inicial;
        $data_final = $faturamento->data_final;

        return view('sistema.financeiro.relatorio_envio', compact('faturamento', 'data_inicial', 'data_final'));
    }

    public function faturarContrato(Request $request)
    {
        
        if(Auth::check() === false){
            return redirect()->route('login')->with('warning', 'Sua sessão expirou! Efetue login novamente.');
        }

        $faturamento = (New FaturamentoContrato())->FaturarContrato($request->id, $request->faturamento_id, $request->data_inicial, $request->data_final);
        
        if($faturamento){
            return response()->json(array('status'=>'success', 'msg'=>"Contrato Faturado com Sucesso!"), 200);
        }else{
            return response()->json(array('status'=>'error', 'msg'=>"Erro ao faturar contrato!"), 200);
        }

    }

    public function faturarConvenio(Request $request)
    {

        if(Auth::check() === false){
            return redirect()->route('login')->with('warning', 'Sua sessão expirou! Efetue login novamente.');
        }

        $convenio = Convenio::find($request->id);

        $faturamento = (New Faturamento())->FaturarConvenio($convenio, $request->data_inicial, $request->data_final);

        if($faturamento):
            return true;
        else:
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        endif;
    }

    public function faturarConvenioAutomatico($convenio,$data_inicial,$data_final)
    {
        $faturamento = (New Faturamento())->FaturarConvenio($convenio, $data_inicial, $data_final);
        return $faturamento;
    }

    public function GetFaturamentoConvenioByPeriodo($convenio_id,$data_inicial,$data_final)
    {
        $faturamento = Faturamento::where('convenio_id', $convenio_id)->whereBetween('faturamentos.data_inicial', [$data_inicial, $data_final])->whereNull('deleted_at')->get();
        return $faturamento->count();
    }

    public function faturarContratoAutomatico($contrato_id,$faturamento_id,$data_inicial,$data_final)
    {
        $faturamento = (New FaturamentoContrato())->FaturarContrato($contrato_id, $faturamento_id, $data_inicial, $data_final);
        return $faturamento;
    }

    public function InformarNumeroPedido(Request $request)
    {
        $Faturamento = Faturamento::find($request->Modalfaturamento_id);

        $Faturamento->numero_pedido = $request->numero_pedido;
        $Faturamento->dados_bancarios = $request->dados_bancarios;

        if($Faturamento->update()):
            return redirect()->back()->with('success', 'Os dados foram informados!');
        else:
            return redirect()->back()->with('error', 'Erro ao informar dados!');
        endif;
    }

    public function InformarCredito(Request $request)
    {
        if($request->Credito_id <> null){

            $FaturamentoCredito = FaturamentoCredito::find($request->Credito_id);
            $FaturamentoCredito->valor_credito = Helper::converte_reais_to_mysql($request->valor_credito);
            $FaturamentoCredito->descricao_credito = $request->descricao_credito;

            if($FaturamentoCredito->update()):
                return redirect()->back()->with('success', 'O crédito foi atualizado!');
            else:
                return redirect()->back()->with('error', 'Erro ao atualizar crédito!');
            endif;

        }else{

            $FaturamentoCredito = new FaturamentoCredito();
            $FaturamentoCredito->user_id = Auth::user()->id;
            $FaturamentoCredito->faturamento_id = $request->ModalCreditoFaturamento_id;
            $FaturamentoCredito->valor_credito = Helper::converte_reais_to_mysql($request->valor_credito);
            $FaturamentoCredito->descricao_credito = $request->descricao_credito;

            if($FaturamentoCredito->save()):
                return redirect()->back()->with('success', 'O crédito foi informado!');
            else:
                return redirect()->back()->with('error', 'Erro ao informar crédito!');
            endif;
        }

    }

    public function InformarPagamento(Request $request)
    {
        //Informa Pagamento
        $Faturamento = Faturamento::InformarPagamento($request->Modalfaturamento_id_IP,$request->data_pagamento, 'Depósito');

        $InformePagamento = new InformePagamento();
        $InformePagamento->user_id = Auth::user()->id;
        $InformePagamento->faturamento_id = $Faturamento->id;
        $InformePagamento->conta_id = $request->conta_bancaria;
        $InformePagamento->valor_pago = Helper::converte_reais_to_mysql($request->valor_pago);
        $InformePagamento->data_pagamento = $request->data_pagamento;

        if($InformePagamento->save()):
            return redirect()->back()->with('success', 'O pagamento foi informado!');
        else:
            return redirect()->back()->with('error', 'Erro ao informar pagamento!');
        endif;
    }

    public function GetFaturamentoMesAnterior($id, $data){

        $data_inicial = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($data)))->subMonth()->startOfMonth()->toDateString();
        $data_final = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($data)))->subMonth()->endOfMonth()->toDateString();

        $faturamento = FaturamentoContrato::where('contrato_id',$id)->whereBetween('data', [$data_inicial, $data_final])->get();

        if($faturamento->count() > 0){
            return true;
        }else{
            return false;
        }

    }

    public function GetEncerramentoContratoMesAtual($id, $data){

        $data_inicial = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($data)))->startOfMonth()->toDateString();
        $data_final = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($data)))->endOfMonth()->toDateString();

        $faturamento = Contrato::where('id',$id)->whereBetween('data_final', [$data_inicial, $data_final])->get();

        if($faturamento->count() > 0){
            return true;
        }else{
            return false;
        }

    }

    public static function GetDataDesligamentoContrato($id, $data){

        $data_inicial = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($data)))->startOfMonth()->toDateString();
        $data_final = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($data)))->endOfMonth()->toDateString();

        $faturamento = AtualizacoesContrato::where('contrato_id',$id)->where('situacao_contrato','Desligado')->whereBetween('data', [$data_inicial, $data_final])->first();

        if(isset($faturamento->data)){
            return $faturamento->data;
        }else{
            return false;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faturamento  $faturamento
     * @return \Illuminate\Http\Response
     */
    public function show(Faturamento $faturamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faturamento  $faturamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Faturamento $faturamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faturamento  $faturamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faturamento $faturamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faturamento  $faturamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $faturamento = Faturamento::find($request->id);

        FaturamentoNF::where('faturamento_id',$request->id)->forceDelete();
        FaturamentoBoleto::where('faturamento_id',$request->id)->forceDelete();

        if($faturamento->delete()):
            return true;
        else:
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        endif;



    }


    public function getValorAFaturar($data_inicial, $data_final, $id){
        
        $contrato = Contrato::find($id);
        $qtdDias = Helper::getDiasEntreDatas($data_inicial, $data_final);
        $valorTabela = Helper::GetUltimaAtualizacaoValorTabela($contrato->convenio->tabela);

        if($contrato->tipo_faturamento == 'Empresa'){

            $valorTotal = ($valorTabela/30)*$qtdDias;
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Entrega de Uniforme');
            //$valorTotal = $valorTotal - Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Falta Trabalho');
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Exame Admissional');
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Exame Demissional');
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Exame Periodico');

        }else{

            $valorTotal = ($contrato->valor_bolsa/30)*$qtdDias;
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Entrega de Uniforme');
            $valorTotal = $valorTotal - Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Falta Trabalho');
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Exame Admissional');
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Exame Demissional');
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Exame Periodico');
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Benefícios');
        }

        return $valorTotal;

    }

    public function VisualizarRelatorio($id){
        $faturamento = Faturamento::find($id);
        $data_atual = Carbon::now()->format('d/m/Y H:i');
        return view('sistema.financeiro.relatorio_faturamento', compact('faturamento', 'data_atual'));
    }

    public function EnviarEmailFaturamento(Request $request){

        $envio = (New Faturamento())->EnviaEmail($request->id, $request->tipo);
        
        if($envio){
            return response()->json(array('status'=>'success', 'msg'=>"E-mail Enviado com Sucesso!"), 200);
        }else{
            return response()->json(array('status'=>'error', 'msg'=>"E-mail não foi enviado!"), 200);
        }
        
    }

    public function EnviarEmailFaturamentoAutomatico($faturamento_id, $tipo_envio){

        $envio = (New Faturamento())->EnviaEmail($faturamento_id, $tipo_envio); 
        return $envio;
        
    }

    public function validarFaturamento(Request $request){

        $faturamento = Faturamento::find($request->id);
        $data_atual = Carbon::now();

        if(Auth::check() === false){
            return redirect()->route('login')->with('warning', 'Sua sessão expirou! Efetue login novamente.');
        }

        $faturamento->etapa_faturamento = 'Nota Fiscal';
        $faturamento->data_validacao = $data_atual;
        $faturamento->user_validacao = Auth::user()->id;


        if($faturamento->save()){
            return response()->json(array('status'=>'success', 'msg'=>"Faturamento Validado com Sucesso!"), 200);
        }else{
            return response()->json(array('status'=>'error', 'msg'=>"Não foi possível efetuar a validação!"), 200);
        }       

    }

    public function getDataUltimoFaturamento($ContratoID){
        $faturamento = FaturamentoContrato::where('contrato_id',$ContratoID)->orderBy('id', 'DESC')->first();
        if($faturamento->data_final){
            return $faturamento->data_final;
        }else{
            return false;
        }
    }

    public function CalculaISSQN($valor_total, $percentual){
        $indice = 100/(100 - ($percentual ?? 0));
        $valorISSQN = ($valor_total*$indice)-$valor_total;
        return $valorISSQN;
    }

    public function CronAtualizarNF(){

        $notas = FaturamentoNF::where('status', '<>', 'Autorizada')->where('status', '<>', 'Cancelada')->get()->random(1);

        foreach($notas as $notafiscal){
            header('Content-Type: text/html; charset=utf-8');
            $enotas = new eNotasGW;
            $enotas::configure(array(
                'apiKey' => 'ZWJkNzM3YTQtZjhiNC00Zjc5LTkxZDgtMjZhYTIzZWYwODAw'
            ));
            $empresaId = '76D51A32-28E4-4B24-B416-7D1159FA0800';

            try
            {
                $dadosNFe = eNotasGW::$NFeApi->consultar($empresaId, $notafiscal->codigo_nf);
                $dadosNF['status'] = $dadosNFe->status;
                $dadosNF['link_pdf'] = $dadosNFe->linkDownloadPDF ?? '';
                $dadosNF['link_xml'] = $dadosNFe->linkDownloadXML ?? '';
                $dadosNF['numero_rps'] = $dadosNFe->numeroRps ?? '';
                $dadosNF['numero_nf'] = $dadosNFe->numero ?? '';
                $dadosNF['data_emissao'] = $dadosNFe->dataAutorizacao ?? '';
                $AtualizarNF = (new FaturamentoNFController())->update($notafiscal->id, $dadosNF);

                if($AtualizarNF){
                    $response_array['status'] = 'success';
                    dd($dadosNFe);
                }else{
                    $response_array['status'] = 'error';
                    dd($dadosNFe);
                }

            }
            catch(Exceptions\invalidApiKeyException $ex) {
                echo 'Erro de autenticação: </br></br>';
                echo $ex->getMessage();
            }
            catch(Exceptions\unauthorizedException $ex) {
                echo 'Acesso negado: </br></br>';
                echo $ex->getMessage();
            }
            catch(Exceptions\apiException $ex) {
                echo 'Erro de validação: </br></br>';
                echo $ex->getMessage();
            }
            catch(Exceptions\requestException $ex) {
                echo 'Erro na requisição web: </br></br>';

                echo 'Requested url: ' . $ex->requestedUrl;
                echo '</br>';
                echo 'Response Code: ' . $ex->getCode();
                echo '</br>';
                echo 'Message: ' . $ex->getMessage();
                echo '</br>';
                echo 'Response Body: ' . $ex->responseBody;
            }
        }

    }

}
