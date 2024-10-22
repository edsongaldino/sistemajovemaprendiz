<?php
namespace App\Http\Controllers;
include_once(base_path() . '/vendor/enotas/php-client/src/eNotasGW.php');

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

        if($request->nome_fantasia){
            $buscaFaturamento->where('empresas.nome_fantasia', 'like', '%' . $request->nome_fantasia . '%');
        }

        $convenios = $buscaFaturamento->paginate(20);
        return view('sistema.financeiro.faturamento', compact('convenios', 'request'));

    }

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
        $contratos = Contrato::where('convenio_id','=', $faturamento->convenio_id)->where('data_final','>=', $faturamento->data_inicial)->paginate(20);
        $data_inicial = $faturamento->data_inicial;
        $data_final = $faturamento->data_final;

        return view('sistema.financeiro.faturamento_contrato', compact('faturamento', 'contratos', 'data_inicial', 'data_final'));
    }

    public function faturarContrato(Request $request)
    {
        $Faturamento = new FaturamentoContrato();
        $Faturamento->user_id = Auth::user()->id;
        $Faturamento->contrato_id = $request->id;
        $Faturamento->faturamento_id = $request->faturamento_id;
        $Faturamento->data = Carbon::now();

        $contrato = Contrato::find($request->id);

        $faturamentoPadrao = true;

        //Pega a data do último faturamento, se existir ok, senão ele pega a data inicial do contrato
        if($this->GetFaturamentoMesAnterior($request->id, $request->data_inicial)){
            //Quando o período for maior que 30 - pegar somente 30 dias
            $Faturamento->data_inicial = $request->data_inicial;
        }else{
            //Verificar Data do Ultimo Faturamento (Sistema Anterior)
            if($contrato->data_ultimo_faturamento && $contrato->data_ultimo_faturamento <> '0000-00-00'){
                $Faturamento->data_inicial = Carbon::parse($contrato->data_ultimo_faturamento)->addDay(1);
            }else{
                $Faturamento->data_inicial = $contrato->data_inicial;
                $faturamentoPadrao = false;
            }
        }

        //Verifica se o contrato se encerra no mês atual
        if($this->GetEncerramentoContratoMesAtual($request->id, $Faturamento->data)){
            $Faturamento->data_final = $contrato->data_final;
            $faturamentoPadrao = false;
        }else{
            $Faturamento->data_final = $request->data_final;
        }

        //Caso seja um faturamento padrão e quantidade de dias do mês seja maior que 30 parametriza o padrão de 30 dias
        if($faturamentoPadrao){
            $qtdDias = 30;
        }else{
            $qtdDias = Helper::getDiasEntreDatas($Faturamento->data_inicial,$Faturamento->data_final);
        }

        $valorTabela = Helper::GetUltimaAtualizacaoValorTabela($contrato->tabela);

        if($contrato->tipo_faturamento == 'Empresa'){
            $Faturamento->valor = ($valorTabela/30)*$qtdDias;
        }else{
            $Faturamento->valor = ($contrato->valor_bolsa/30)*$qtdDias;
        }

        $txAdm = ($valorTabela/30)*$qtdDias;

        $Faturamento->taxa_administrativa = $txAdm;
        $Faturamento->quantidade_dias = $qtdDias;
        //Inserir ISSQN no faturamento da empresa

        //return response()->json(array('status'=>'error', 'msg'=> $Faturamento->data_inicial), 200);

        if($Faturamento->save()):

            if($Faturamento->contrato->tipo_faturamento == 'Instituição'){
                $dados = new FaturamentoContratoInstituicaoDados();
                $dados->faturamento_contrato_id = $Faturamento->id;
                $dados->valor_salario_liquido = $Faturamento->valor - Helper::calcularPer100DeValor($Faturamento->valor, '7.5');
                $dados->valor_decimo_terceiro = Helper::calculaDecimo($Faturamento);
                $dados->valor_ferias = Helper::calculaFerias($Faturamento);
                $dados->valor_terco_ferias = $dados->valor_ferias/3;
                $dados->valor_inss = Helper::calcularPer100DeValor($Faturamento->valor, '25.5') + Helper::calcularPer100DeValor($Faturamento->valor, '7.5');
                $dados->valor_fgts = Helper::calcularPer100DeValor($Faturamento->valor, '2');
                $dados->valor_pis = Helper::calcularPer100DeValor(($Faturamento->valor+$dados->valor_decimo_terceiro+$dados->valor_ferias+$dados->valor_terco_ferias), '2');
                $dados->valor_inss_provisionamento = Helper::calcularPer100DeValor(($dados->valor_decimo_terceiro+$dados->valor_ferias+$dados->valor_terco_ferias), '25.5');
                $dados->valor_fgts_provisionamento = Helper::calcularPer100DeValor(($dados->valor_decimo_terceiro+$dados->valor_ferias+$dados->valor_terco_ferias), '2');
                $dados->valor_pis_provisionamento = Helper::calcularPer100DeValor(($Faturamento->valor+$dados->valor_decimo_terceiro+$dados->valor_ferias+$dados->valor_terco_ferias), '1');
                $dados->valor_beneficios = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $request->id, 'Benefícios');
                $dados->valor_descontos = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $request->id, 'Falta Trabalho');
                $dados->valor_exames = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $request->id, 'Exame Admissional') + Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $request->id, 'Exame Demissional');
                $dados->valor_uniforme = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $request->id, 'Entrega de Uniforme');

                $dados->valor_total = ($dados->valor_salario_liquido+$txAdm+$dados->valor_decimo_terceiro+
                                        $dados->valor_ferias+$dados->valor_terco_ferias+$dados->valor_inss+
                                        $dados->valor_fgts+$dados->valor_inss_provisionamento+$dados->valor_fgts_provisionamento+$dados->valor_pis_provisionamento+
                                        $dados->valor_beneficios+$dados->valor_exames+$dados->valor_uniforme)-($dados->valor_descontos);
                // Calcular ISSQN
                $dados->valor_issqn = $this->CalculaISSQN($dados->valor_total, $contrato->convenio->percentual_issqn);
                $dados->save();
            }else{
                $dados = new FaturamentoContratoEmpresaDados();
                $dados->faturamento_contrato_id = $Faturamento->id;
                $dados->valor_beneficios = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $request->id, 'Benefícios');
                $dados->valor_descontos = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $request->id, 'Falta Trabalho');
                $dados->valor_exames = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $request->id, 'Exame Admissional') + Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $request->id, 'Exame Demissional');
                $dados->valor_uniforme = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $request->id, 'Entrega de Uniforme');

                $dados->valor_total = ($txAdm+$dados->valor_beneficios+$dados->valor_exames+$dados->valor_uniforme)-($dados->valor_descontos);
                // Calcular ISSQN
                $dados->valor_issqn = $this->CalculaISSQN($dados->valor_total, $contrato->convenio->percentual_issqn);
                $dados->save();
            }
            return response()->json(array('status'=>'success', 'msg'=>"Contrato Faturado com Sucesso!"), 200);
        else:
            return response()->json(array('status'=>'error', 'msg'=>"Erro ao faturar contrato!"), 200);
        endif;

    }

    public function faturarConvenio(Request $request)
    {
        $convenio = Convenio::find($request->id);

        $Faturamento = new Faturamento();
        $Faturamento->user_id = Auth::user()->id;
        $Faturamento->convenio_id = $request->id;
        $Faturamento->data = Carbon::now();
        $Faturamento->data_inicial = $request->data_inicial;
        $Faturamento->data_final = $request->data_final;
        $Faturamento->forma_pagamento = $convenio->forma_pagamento;

        if($Faturamento->save()):
            return true;
        else:
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        endif;
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

        if($contrato->tipo_faturamento == 'Empresa'){

            $valorTotal = ($contrato->tabela->valor/30)*$qtdDias;
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Entrega de Uniforme');
            //$valorTotal = $valorTotal - Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Falta Trabalho');
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Exame Admissional');
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Exame Demissional');

        }else{

            $valorTotal = ($contrato->valor_bolsa/30)*$qtdDias;
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Entrega de Uniforme');
            $valorTotal = $valorTotal - Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Falta Trabalho');
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Exame Admissional');
            $valorTotal = $valorTotal + Helper::getAtualizacaoContrato($data_inicial, $data_final, $id, 'Exame Demissional');
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

        $faturamento = Faturamento::find($request->id);
        $data_atual = Carbon::now()->format('d/m/Y H:i');
        $EmailDestinatario = EmpresaContato::where('Setor','FINANCEIRO')->where('empresa_id',$faturamento->convenio->empresa_id)->get();

        if($EmailDestinatario->count() < 1){
            return response()->json(array('status'=>'error', 'msg'=>"Nenhum e-mail cadastrado para esse cliente!"), 200);
        }

        if($faturamento->convenio->empresa->tipo_cadastro == 'CNPJ'){
            $cpfCnpj = $faturamento->convenio->empresa->cnpj;
            $nome = $faturamento->convenio->empresa->razao_social;
        }else{
            $cpfCnpj = $faturamento->convenio->empresa->cpf;
            $nome = $faturamento->convenio->empresa->nome_fantasia;
        }

        $assunto = "RELATÓRIO DE FATURAMENTO - " . strtoupper($nome) . " - " . strtoupper($faturamento->convenio->empresa->endereco->cidade->nome_cidade) . " (" . $faturamento->convenio->empresa->endereco->cidade->estado->uf_estado . ") " . strtoupper(Helper::ParteData($faturamento->data_inicial, 'mes'))."/".Helper::ParteData($faturamento->data_inicial, 'ano');

        if($request->tipo == "boleto-nf"){
            $assunto = "NFS E BOLETO - " . strtoupper($nome) . " " . strtoupper($faturamento->convenio->empresa->endereco->cidade->nome_cidade) . " (" . $faturamento->convenio->empresa->endereco->cidade->estado->uf_estado . ") " . strtoupper(Helper::ParteData($faturamento->data_inicial, 'mes'))."/".Helper::ParteData($faturamento->data_inicial, 'ano');
        }

        $i = 1;
        foreach($EmailDestinatario as $destinatario){
            if($i == 1){
                $EmailTo = $destinatario->email;
            }else{
                $arrayEmails[] = $destinatario->email;
            }
            $i++;
        }

        if($i > 2){
            $enviaEmail = Mail::to($EmailTo)->cc($arrayEmails)->bcc("dcr@larmariadelourdes.org")->send(new EmailFaturamento($faturamento, $request->tipo, $assunto));
        }else{
            $enviaEmail = Mail::to($EmailTo)->bcc("dcr@larmariadelourdes.org")->send(new EmailFaturamento($faturamento, $request->tipo, $assunto));
        }

        return response()->json(array('status'=>'success', 'msg'=>"E-mail Enviado com Sucesso!"), 200);

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
