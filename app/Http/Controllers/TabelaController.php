<?php

namespace App\Http\Controllers;

use App\Atualizacoes;
use App\AtualizacoesTabela;
use App\Tabela;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class TabelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabelas = Tabela::paginate(10);
        return view('sistema.tabelas.index', compact('tabelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sistema.tabelas.adicionar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tabela = new Tabela();
        $tabela->nome = $request->nome;
        $tabela->valor = Helper::converte_reais_to_mysql($request->valor);
        $tabela->validade = Helper::data_mysql($request->validade);
        $tabela->descricao = $request->descricao;
        $tabela->save(); 

        return redirect()->route('sistema.tabelas')->with('success', 'Dados Cadastrados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tabela  $tabela
     * @return \Illuminate\Http\Response
     */
    public function show(Tabela $tabela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tabela  $tabela
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tabela = Tabela::find($id);
        $atualizacoesTabela = AtualizacoesTabela::where('tabela_id', $id)->first();
        return view('sistema.tabelas.editar', compact('tabela','atualizacoesTabela'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tabela  $tabela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $tabela = Tabela::findOrFail($request->id);
        $tabela->nome = $request->nome;
        //$tabela->valor = Helper::converte_reais_to_mysql($request->valor);
        $tabela->validade = Helper::data_mysql($request->validade);
        $tabela->descricao = $request->descricao;
        $tabela->save();  

        return redirect()->route('sistema.tabelas')->with('success', 'Dados Atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tabela  $tabela
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tabela = Tabela::find($request->id);

        if($tabela->delete()):
            return true;
        else:
            $response_array['status'] = 'success';    
            echo json_encode($response_array);
        endif;
    }

    public function atualizaTabela(Atualizacoes $atualizacao)
    {
        $tabelas = Tabela::all();

        foreach($tabelas as $tabela){
            
            if($atualizacao->tipo_atualizacao == 'Acréscimo'){
                $Nvalor = $tabela->valor + ($tabela->valor / 100 * $atualizacao->percentual_atualizacao);
            }else{
                $Nvalor = $tabela->valor - ($tabela->valor / 100 * $atualizacao->percentual_atualizacao);
            }

            $AtualizacaoTabela = new AtualizacoesTabela();
            $AtualizacaoTabela->atualizacao_id = $atualizacao->id;
            $AtualizacaoTabela->tabela_id = $tabela->id;
            $AtualizacaoTabela->valor_atual = $tabela->valor;
            $AtualizacaoTabela->novo_valor = $Nvalor;
            $AtualizacaoTabela->save(); 
        }
         
        return redirect()->route('sistema.atualizacoes')->with('success', 'Dados Atualizados!');
    }
}
