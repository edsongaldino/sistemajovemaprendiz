<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Tipo;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailUser;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function dashboard(){

        if(Auth::check() === true){
            return view('sistema.home');
        }

        return redirect()->route('app.login')->with('warning', 'Efetue Login para acessar');
    }

    public function LembrarSenha(){

        return view('lembrar');

    }

    public function Login(Request $request){
        
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return redirect()->back()->with('warning', 'O e-mail não é válido!');    
        }

        $credencials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credencials)){
            $usuario = Auth::user();
            Session::put('usuario', $usuario);
            return redirect()->route('sistema')->with('success', 'Login Efetuado!');
        }
        return redirect()->back()->with('warning', 'Os dados informados estão incorretos!');
    }

    public function Logout(){
        
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logof Efetuado');
    }

    public function ReenviarSenha(Request $request){

        $User = User::where('email', $request->email)->first();

        if($User){

            //ENVIA PARA O USUÁRIO
            $request->template = "layouts.email.template_senha";
            $request->assunto = "Você solicitou uma nova senha! Programa Jovem Aprendiz";
            $request->destinatario = $User->email;
            $request->nome = $User->nome;
            $request->link = getenv('APP_URL').'/nova-senha/'.base64_encode($User->email);

            Mail::to($request->destinatario)->send(new SendMailUser($request));

            return redirect()->route('login')->with('success', 'Sua nova senha foi enviada no email de cadastro! Verifique a caixa de SPAM');
        }
        
        return redirect()->back()->with('warning', 'Este e-mail não consta em nosso banco de dados! Confira.');

    }

    public function FormAlterarSenha($email){
        $email = base64_decode($email);
        return view('nova-senha')->with(compact('email'));

    }

    public function AlterarSenha(Request $request){

        $user = User::where('email', $request->email)->first();

        if($request->senha == $request->confirmar_senha){
            $user->password = Hash::make($request->senha);
            $user->save();

            return view('home');
        }
        
        return redirect()->back()->with('warning', 'As senhas precisam ser idênticas.');
        

    }


}
