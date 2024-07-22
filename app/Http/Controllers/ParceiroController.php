<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Parceiro;
use App\Http\Controllers\Controller;
use App\Polo;
use App\User;
use Exception;
use Illuminate\Http\Request;

class ParceiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parceiros = Parceiro::paginate(10);
        $polos = Polo::all();
        return view('sistema.parceiros.index', compact('parceiros', 'polos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $polos = Polo::all();
        return view('sistema.parceiros.adicionar', compact('polos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->verificaDuplicidade('email', $request->email)){
            return redirect()->back()->with('warning', 'Este e-mail ja está cadastrado! Verifique.'); 
        }

        //Perfil de Aluno
        $request->perfil_id = 8;

        $user = (new UserController())->salvarUsuario($request);

        $Parceiro = new Parceiro();
        $Parceiro->user_id = $user->id;
        $Parceiro->cpf = $request->cpf;
        $Parceiro->nome = $request->nome;
        $Parceiro->save();

        return redirect()->route('sistema.parceiros')->with('success', 'Dados Cadastrados! Faça seu login.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parceiro  $parceiro
     * @return \Illuminate\Http\Response
     */
    public function show(Parceiro $parceiro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parceiro  $parceiro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parceiro = Parceiro::find($id);
        $polos = Polo::all();
        return view('sistema.parceiros.editar', compact('parceiro', 'polos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parceiro  $parceiro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Parceiro = Parceiro::findOrFail($request->id);
        $User = User::findOrFail($Parceiro->user_id);

        if($request->email <> $User->email){
            if($this->verificaDuplicidade('email', $request->email)){
                return redirect()->back()->with('warning', 'Você não pode alterar seu cadastro para este e-mail, pois ele já consta em nosso banco de dados! Verifique.'); 
            }
        }

        (new UserController())->updateUsuario($request, $User->id);
        $Parceiro->cpf = $request->cpf;
        $Parceiro->nome = $request->nome;
        $Parceiro->save();

        return redirect()->route('sistema.parceiros')->with('success', 'Dados atualizados!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parceiro  $parceiro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Parceiro = Parceiro::findOrFail($request->id);
        $User = User::findOrFail($Parceiro->user_id);

        try {
            $User->delete();
            $Parceiro->delete();
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    public function ParceiroBusca(Request $request)
    {
        $polos = Polo::all();
        $buscaParceiro = Parceiro::where('id','>', '0');

        if($request->nome){
            $buscaParceiro->join()->where('nome', 'like', '%' . $request->nome . '%');
        }

        if($request->perfil){
            $buscaParceiro->where('perfil_id', $request->perfil);
        }

        if($request->cpf){
            $cpf = Helper::limpa_campo($request->cpf);
            $buscaParceiro->where('cpf', $cpf);
        }

        $parceiros = $buscaParceiro->paginate(20);

        return view('sistema.parceiros.index', compact('parceiros', 'polos'));
    }

    public function verificaDuplicidade($campo, $valor){

        $Parceiro = User::where($campo, $valor)->first();

        if(isset($Parceiro)){
            return $Parceiro;
        }else{
            return false;
        }
    }
}
