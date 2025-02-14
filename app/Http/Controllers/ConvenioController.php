<?php

namespace App\Http\Controllers;

use App\Convenio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Empresa;
use App\Helpers\Helper;
use App\Contrato;
use App\Polo;
use App\Tabela;
use Illuminate\Support\Facades\Auth;

class ConvenioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convenios = Convenio::orderBy('id','desc')->paginate(10);
        $polos = Polo::all();
        return view('sistema.convenios.index', compact('convenios', 'polos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::all();
        $polos = Polo::all();
        $tabelas = Tabela::all();
        return view('sistema.convenios.adicionar', compact('empresas', 'polos', 'tabelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->getConvenioAtivoByTipo($request->empresa_id, $request->tipo_convenio)){
            return redirect()->back()->with('warning', 'Esta empresa já possui um convênio ativo para este modelo! Verifique.');
        }

        if(Auth::check() === false){
            return redirect()->route('login')->with('warning', 'Sua sessão expirou! Efetue login novamente.');
        }

        $convenio = new Convenio();
        $convenio->user_id = Auth::user()->id;
        $convenio->empresa_id = $request->empresa_id;
        $convenio->percentual_issqn = Helper::converte_reais_to_mysql($request->percentual_issqn);
        $convenio->polo_id = $request->polo_id;
        $convenio->tabela_id = $request->tabela_id;
        $convenio->data_inicial = Helper::data_mysql($request->data_inicial);
        $convenio->dia_faturamento = $request->dia_faturamento;
        $convenio->vencimento_boleto = $request->vencimento_boleto;
        $convenio->forma_pagamento = $request->forma_pagamento;
        $convenio->qtde_jovens = $request->qtde_jovens;
        $convenio->tipo_convenio = $request->tipo_convenio;
        $convenio->situacao = $request->situacao;
        $convenio->tipo_emissao_nf = $request->tipo_emissao_nf;
        $convenio->tipo_emissao_cobranca = $request->tipo_emissao_cobranca;
        $convenio->tipo_envio = $request->tipo_envio;
        $convenio->possui_pedido = $request->possui_pedido;
        $convenio->envia_relatorio = $request->envia_relatorio;
        $convenio->save();

        $this->atualizaContrato($convenio->id);

        return redirect()->route('sistema.convenios')->with('success', 'Dados Cadastrados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Convenio  $convenio
     * @return \Illuminate\Http\Response
     */
    public function show(Convenio $convenio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Convenio  $convenio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $convenio = Convenio::find($id);
        $polos = Polo::all();
        $tabelas = Tabela::all();
        return view('sistema.convenios.editar', compact('convenio', 'polos', 'tabelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Convenio  $convenio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $convenio = Convenio::findOrFail($request->id);
        $convenio->polo_id = $request->polo_id;
        $convenio->tabela_id = $request->tabela_id;
        $convenio->percentual_issqn = Helper::converte_reais_to_mysql($request->percentual_issqn);
        $convenio->data_inicial = Helper::data_mysql($request->data_inicial);
        $convenio->dia_faturamento = $request->dia_faturamento;
        $convenio->vencimento_boleto = $request->vencimento_boleto;
        $convenio->forma_pagamento = $request->forma_pagamento;
        $convenio->qtde_jovens = $request->qtde_jovens;
        $convenio->tipo_convenio = $request->tipo_convenio;
        $convenio->situacao = $request->situacao;
        $convenio->tipo_emissao_nf = $request->tipo_emissao_nf;
        $convenio->tipo_emissao_cobranca = $request->tipo_emissao_cobranca;
        $convenio->tipo_envio = $request->tipo_envio;
        $convenio->possui_pedido = $request->possui_pedido;
        $convenio->envia_relatorio = $request->envia_relatorio;
        $convenio->save();

        return redirect()->route('sistema.convenios')->with('success', 'Dados Alterados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Convenio  $convenio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $convenio = Convenio::find($request->id);

        if($convenio->delete()):
            return true;
        else:
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        endif;
    }

    public function atualizaContrato($id){
        $atualiza = Convenio::findOrFail($id);
        $atualiza->numero = date('Ym').$id;
        $atualiza->save();
    }

    public function Print($id){
        $convenio = Convenio::find($id);
        return view('sistema.convenios.imprimir', compact('convenio'));
    }

    public function listarContratos($id){
        $convenio = Convenio::find($id);
        $polos = Polo::all();
        $contratos = Contrato::where('empresa_id', $convenio->empresa_id)->paginate(15);
        return view('sistema.contratos.index', compact('contratos','polos'));

    }

    public function ConvenioBusca(Request $request)
    {
        $polos = Polo::all();
        $buscaConvenios = Convenio::select('convenios.*')->where('convenios.id', '>', 0)->join('empresas', 'empresas.id', '=', 'convenios.empresa_id');

        if($request->polo){
            $buscaConvenios->where('convenios.polo_id', $request->polo);
        }

        if($request->dia_faturamento){
            $buscaConvenios->where('convenios.dia_faturamento', $request->dia_faturamento);
        }

        if($request->cnpj){
            $buscaConvenios->where('empresas.cnpj', Helper::limpa_campo($request->cnpj));
        }

        if($request->cpf){
            $buscaConvenios->where('empresas.cpf', Helper::limpa_campo($request->cpf));
        }

        if($request->razao_social){
            $buscaConvenios->where('empresas.razao_social', 'like', '%' . $request->razao_social . '%');
        }

        $convenios = $buscaConvenios->orderBy('convenios.id','desc')->paginate(20);
        return view('sistema.convenios.index', compact('convenios', 'polos', 'request'));
    }

    private function getConvenioAtivoByTipo($empresa, $tipo_convenio){
        $convenio = Convenio::where('empresa_id',$empresa)->where('tipo_convenio',$tipo_convenio)->where('situacao','Ativo')->get();
        if($convenio->count() > 0){
            return true;
        }else{
            return false;
        }
    }
}
