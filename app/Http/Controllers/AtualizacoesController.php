<?php

namespace App\Http\Controllers;

use App\Atualizacoes;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Tabela;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtualizacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atualizacoes = Atualizacoes::orderBy('id','desc')->paginate(10);
        return view('sistema.atualizacoes.index', compact('atualizacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_atual = Carbon::now();
        return view('sistema.atualizacoes.adicionar', compact('data_atual'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $atualizacao = new Atualizacoes();
        $atualizacao->user_id = Auth::user()->id;
        $atualizacao->tipo_atualizacao = $request->tipo_atualizacao;
        $atualizacao->modulo_atualizacao = $request->modulo_atualizacao;
        $atualizacao->situacao_atualizacao = $request->situacao_atualizacao;
        $atualizacao->data_atualizacao = $request->data_atualizacao;
        $atualizacao->percentual_atualizacao = Helper::converte_reais_to_mysql($request->percentual_atualizacao);
        $atualizacao->motivo_atualizacao = $request->motivo_atualizacao;
        $atualizacao->situacao_atualizacao = $request->situacao_atualizacao;
        $atualizacao->save(); 

        
        if($atualizacao->modulo_atualizacao == 'Tabela'){
            (new TabelaController())->atualizaTabela($atualizacao);
        }

        if($atualizacao->modulo_atualizacao == 'Salário'){
            (new ContratoController())->atualizaValorBolsa($atualizacao->tipo_atualizacao, $atualizacao->percentual_atualizacao);
        }
        

        return redirect()->route('sistema.atualizacoes')->with('success', 'Dados Cadastrados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atualizacoes  $atualizacoes
     * @return \Illuminate\Http\Response
     */
    public function show(Atualizacoes $atualizacoes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atualizacoes  $atualizacoes
     * @return \Illuminate\Http\Response
     */
    public function edit(Atualizacoes $atualizacoes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atualizacoes  $atualizacoes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atualizacoes $atualizacoes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atualizacoes  $atualizacoes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $atualizacao = Atualizacoes::find($request->id);

        if($atualizacao->delete()):
            return true;
        else:
            $response_array['status'] = 'success';    
            echo json_encode($response_array);
        endif;
    }
}
