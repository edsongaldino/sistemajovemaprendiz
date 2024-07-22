<?php

namespace App\Http\Controllers;

use App\Regiao;
use App\RegiaoResponsavel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegiaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regioes = Regiao::paginate(10);
        $colaboradores = User::select('users.id', 'users.nome', 'users.email', 'perfis.nome as nome_perfil')
            ->join('perfis', 'users.perfil_id', '=', 'perfis.id')
            ->where('perfis.tipo_perfil', '=', 'Gestão')
            ->get();
        return view('sistema.regioes.index', compact('regioes', 'colaboradores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sistema.regioes.adicionar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regiao = new Regiao();
        $regiao->nome = $request->nome;
        $regiao->descricao = $request->descricao;
        $regiao->save();

        return redirect()->route('sistema.regioes')->with('success', 'Dados Cadastrados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Regiao  $regiao
     * @return \Illuminate\Http\Response
     */
    public function show(Regiao $regiao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Regiao  $regiao
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regiao = Regiao::find($id);
        return view('sistema.regioes.editar', compact('regiao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Regiao  $regiao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $polo = Regiao::findOrFail($request->id);
        $polo->nome = $request->nome;
        $polo->descricao = $request->descricao;
        $polo->save();

        return redirect()->route('sistema.regioes')->with('success', 'Dados Atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Regiao  $regiao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $vinculo = RegiaoResponsavel::find($request->id)->get();

        if($vinculo->regiao_id){
            return redirect()->back()->with('error', 'Esta região possui unidades e/ou usuários vinculados');
        }

        $regiao = Regiao::findOrFail($request->id);

        if($regiao->delete()):
            return true;
        endif;
    }


    public function AdicionarResponsavel(Request $request)
    {
        $regiao = new RegiaoResponsavel();
        $regiao->regiao_id = $request->regiao_id;
        $regiao->user_id = $request->user_id;
        $regiao->save();

        return redirect()->route('sistema.regioes')->with('success', 'Responsável Vinculado!');
    }

    public function RegiaoBusca(Request $request)
    {
        $BuscaRegiao = Regiao::where('deleted_at',null);
        $colaboradores = User::select('users.nome', 'users.email', 'perfis.nome as nome_perfil')
            ->join('perfis', 'users.perfil_id', '=', 'perfis.id')
            ->where('perfis.tipo_perfil', '=', 'Gestão')
            ->get();

        if($request->nome){
            $BuscaRegiao->where('nome', 'like', '%' . $request->nome . '%');
        }

        if($request->nome_responsavel){
            $BuscaRegiao->where('nome', 'like', '%' . $request->nome_responsavel . '%');
        }

        $regioes = $BuscaRegiao->paginate(20);

        return view('sistema.regioes.index', compact('regioes','colaboradores'));
    }

}
