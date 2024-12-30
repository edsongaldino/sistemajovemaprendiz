<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\Estado;
use App\Feriado;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Polo;
use Illuminate\Http\Request;

class FeriadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feriados = Feriado::orderBy('data','desc')->paginate(40);
        return view('sistema.configuracoes.feriados.index', compact('feriados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::all();
        $polos = Polo::all();
        return view('sistema.configuracoes.feriados.adicionar', compact('estados', 'polos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $feriado = new Feriado();
        $feriado->cidade_id = $request->cidade_endereco;
        $feriado->estado_id = $request->estado_endereco;
        $feriado->descricao = $request->descricao;
        $feriado->tipo = $request->tipo;
        $feriado->data = Helper::data_mysql($request->data);

        $feriado->save();

        return redirect()->route('sistema.feriados')->with('success', 'Dados Cadastrados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feriado  $feriado
     * @return \Illuminate\Http\Response
     */
    public function Busca(Request $request)
    {

        $BuscaFeriado = Feriado::where('created_at','<>',null);

        if($request->nome){
            $BuscaFeriado->where('descricao', 'like', '%' . $request->nome . '%');
        }

        if($request->data){
            $BuscaFeriado->where('data', $request->data);
        }

        if($request->tipo){
            $BuscaFeriado->where('tipo', $request->tipo);
        }

        $feriados = $BuscaFeriado->orderBy('data','desc')->paginate(20);

        return view('sistema.configuracoes.feriados.index', compact('feriados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feriado  $feriado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estados = Estado::all();
        $feriado = Feriado::find($id);
        $cidades = Cidade::where('estado_id','=', $feriado->estado_id)->orderBy('nome_cidade','asc')->get();
        return view('sistema.configuracoes.feriados.editar', compact('estados','feriado','cidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feriado  $feriado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $feriado = Feriado::findOrFail($request->id);
        $feriado->cidade_id = $request->cidade_endereco;
        $feriado->estado_id = $request->estado_endereco;
        $feriado->descricao = $request->descricao;
        $feriado->tipo = $request->tipo;
        $feriado->data = Helper::data_mysql($request->data);

        $feriado->save();

        return redirect()->route('sistema.feriados')->with('success', 'Dados Atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feriado  $feriado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $feriado = Feriado::find($request->id);

        if($feriado->delete()){
            return true;
        }else{
            return false;
        }
    }
}
