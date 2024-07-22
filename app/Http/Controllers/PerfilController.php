<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Permissao;
use App\Sessao;
use Illuminate\Http\Request;
use App\User;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfis = Perfil::all();
        return view('sistema.configuracoes.perfis.index', compact('perfis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessoes = Sessao::all();
        return view('sistema.configuracoes.perfis.adicionar', compact('sessoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $perfil = new Perfil();
        $perfil->nome = $request->nome;
        $perfil->tipo_perfil = $request->tipo_perfil;
        $perfil->save();
        
        if($request->tipo_perfil == "Gestão"){
            $sessoes = Sessao::all();

            foreach($sessoes as $sessao){

                $sessoes = $request->{$sessao->chave};
                $countS = count($sessoes);
        
                for ($i = 0; $i < $countS; $i++) {
        
                    $permissoes = $request->{$sessao->chave_permissao};
                    $countP = count($permissoes);
        
                    for ($iP = 0; $iP < $countP; $iP++) {
                        //vincula o perfil as permissões marcadas
                        $permissoes_perfil = new Permissao();
                        $permissoes_perfil->perfil_id = $perfil->id;
                        $permissoes_perfil->sessao_id = $sessoes[$i];
                        $permissoes_perfil->nome = $permissoes[$iP];
                        $permissoes_perfil->save();
        
                    }
                }

            }
        }
        

        return redirect()->route('sistema.perfis')->with('success', 'Dados Cadastrados!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perfil = Perfil::find($id);
        $sessoes = Sessao::all();

        $perfil_permissoes = Permissao::where('perfil_id', $id)->get();
        foreach($perfil_permissoes AS $permissoes){
            $permissaoPerfil[] = $permissoes->id;
        }

        return view('sistema.configuracoes.perfis.editar', compact('sessoes', 'perfil'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $perfil = Perfil::findOrFail($request->id);
        $perfil->nome = $request->nome;
        $perfil->tipo_perfil = $request->tipo_perfil;
        $perfil->save();


        if($request->tipo_perfil == "Gestão"){
            Permissao::where('perfil_id', $request->id)->delete();
        
            $sessoes = Sessao::all();
    
            foreach($sessoes as $sessao){
    
                $sessoes = $request->{$sessao->chave};
                $countS = count($sessoes);
        
                for ($i = 0; $i < $countS; $i++) {
        
                    $permissoes = $request->{$sessao->chave_permissao};
                    $countP = count($permissoes);
        
                    for ($iP = 0; $iP < $countP; $iP++) {
                        //vincula o perfil as permissões marcadas
                        $permissoes_perfil = new Permissao();
                        $permissoes_perfil->perfil_id = $perfil->id;
                        $permissoes_perfil->sessao_id = $sessoes[$i];
                        $permissoes_perfil->nome = $permissoes[$iP];
                        $permissoes_perfil->save();
        
                    }
                }
    
            }
        }else{
            Permissao::where('perfil_id', $request->id)->delete();
        }
        
        return redirect()->route('sistema.perfis')->with('success', 'Dados Atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
