<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\User;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Polo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::where('perfil_id','<>', '4')->paginate(10);
        $perfis = Perfil::all();
        $polos = Polo::all();
        return view('sistema.usuarios.index', compact('usuarios', 'perfis', 'polos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfis = Perfil::all();
        return view('sistema.usuarios.adicionar', compact('perfis'));
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

        $User = new User();
        $User->perfil_id = $request->perfil_id;
        $User->nome = $request->nome;
        $User->email = $request->email;
        $User->data_nascimento = Helper::data_mysql($request->data_nascimento);
        $User->telefone = Helper::limpa_campo($request->telefone);
        $User->password = Hash::make($request->password);
        $User->save();

        return redirect()->route('sistema.usuarios')->with('success', 'Dados Cadastrados! Faça seu login.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $perfis = Perfil::all();
        return view('sistema.usuarios.editar', compact('usuario', 'perfis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $User = User::findOrFail($request->id);

        if($request->email <> $User->email){
            if($this->verificaDuplicidade('email', $request->email)){
                return redirect()->back()->with('warning', 'Você não pode alterar seu cadastro para este e-mail, pois ele já consta em nosso banco de dados! Verifique.'); 
            }
        }

        $User->perfil_id = $request->perfil_id;
        $User->nome = $request->nome;
        $User->email = $request->email;
        $User->data_nascimento = Helper::data_mysql($request->data_nascimento);
        $User->telefone = Helper::limpa_campo($request->telefone);
        
        if($request->password){
            if($request->password <> $request->password2){
                return redirect()->back()->with('warning', 'As duas senhas precisam ser idênticas! Verifique.'); 
            }
            $User->password = Hash::make($request->password);
        }
        $User->save();

        return redirect()->route('sistema.usuarios')->with('success', 'Dados atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $usuario = User::findOrFail($request->id);
        if($usuario->delete()):
            return true;
        endif;
    }

    public function getFoto($id)
    {
        $this->user = User::find($id);
        $arquivo = Storage::get($this->user->foto); 
        return $arquivo;
    }


    public function verificaDuplicidade($campo, $valor){

        $User = User::where($campo, $valor)->first();

        if(isset($User)){
            return $User;
        }else{
            return false;
        }
    }

    public function salvarUsuario(Request $request){

        $User = new User();
        $User->perfil_id = $request->perfil_id;
        $User->nome = $request->nome;
        $User->email = $request->email;
        $User->data_nascimento = Helper::data_mysql($request->data_nascimento);
        $User->telefone = Helper::limpa_campo($request->telefone);
        
        if($request->password){
            if($request->password <> $request->password2){
                return redirect()->back()->with('warning', 'As duas senhas precisam ser idênticas! Verifique.'); 
            }
            $User->password = Hash::make($request->password);
        }
        $User->save();

        return $User;
    }

    public function gerarUsuario(Request $request){

        $User = new User();
        $User->perfil_id = 4;
        $User->nome = $request->nome;
        $User->email = $request->email;
        $User->data_nascimento = $request->data_nascimento;
        $User->telefone = Helper::limpa_campo($request->telefone);
        $User->password = Hash::make($request->cpf);
        
        $User->save();

        return $User;
    }

    public function updateUsuario(Request $request, $id){

        $User = User::findOrFail($id);
        $User->perfil_id = $request->perfil_id;
        $User->nome = $request->nome;
        $User->email = $request->email;
        $User->data_nascimento = Helper::data_mysql($request->data_nascimento);
        $User->telefone = Helper::limpa_campo($request->telefone);
        
        if($request->password){
            if($request->password <> $request->password2){
                return redirect()->back()->with('warning', 'As duas senhas precisam ser idênticas! Verifique.'); 
            }
            $User->password = Hash::make($request->password);
        }else{
            $User->password = Hash::make('259864');
        }
        $User->save();

        return $User;
    }

    public function UserBusca(Request $request)
    {
        $polos = Polo::all();
        $perfis = Perfil::all();
        $buscaUsers = User::where('perfil_id','<>', '4');

        if($request->nome){
            $buscaUsers->where('nome', 'like', '%' . $request->nome . '%');
        }

        if($request->perfil){
            $buscaUsers->where('perfil_id', $request->perfil);
        }

        if($request->cpf){
            $cpf = Helper::limpa_campo($request->cpf);
            $buscaUsers->where('cpf', $cpf);
        }

        $usuarios = $buscaUsers->paginate(20);

        return view('sistema.usuarios.index', compact('usuarios', 'polos', 'perfis'));
    }

}
