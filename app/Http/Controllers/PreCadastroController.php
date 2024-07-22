<?php

namespace App\Http\Controllers;

use App\Estado;
use App\PreCadastro;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Aluno;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailUser;
use Exception;

class PreCadastroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if((New Aluno())->verificaDuplicidade('cpf', Helper::limpa_campo($request->cpf))){
            return redirect()->back()->with('warning', 'Este CPF já consta em nosso banco de dados! Verifique.');
        }

        if((New UserController())->verificaDuplicidade('email', $request->email)){
            return redirect()->back()->with('warning', 'Este e-mail ja está cadastrado! Verifique.');
        }

        $cadastro = new PreCadastro();

        if($request->tipo_cadastro == 'Jovem'){
            $cadastro->tipo_cadastro = $request->tipo_cadastro;
            $cadastro->nome_razao = $request->nome;
            $cadastro->cpf_cnpj = Helper::limpa_campo($request->cpf);
            $cadastro->data_nascimento = $request->data_nascimento;
            $cadastro->email = $request->email;
            $cadastro->telefone = Helper::limpa_campo($request->telefone);
            $cadastro->situacao = 'Aguardando';

            $idade_jovem = Helper::calcula_idade($request->data_nascimento);

        }else{
            $cadastro->tipo_cadastro = $request->tipo_cadastro;
            $cadastro->nome_razao = $request->razao_social;
            $cadastro->cpf_cnpj = Helper::limpa_campo($request->cnpj_cei);
            $cadastro->responsavel = $request->responsavel;
            $cadastro->email = $request->email;
            $cadastro->telefone = Helper::limpa_campo($request->telefone);
            $cadastro->situacao = 'Aguardando';

            $idade_jovem = 0;
        }

        $estados = Estado::all();

        if($cadastro->save()){
            return view('cadastro', compact('cadastro', 'estados', 'idade_jovem'));
        }else{
            return redirect()->route('/')->with('error', 'Tente novamente!');
        }

    }

    public function cadastroAluno(){
        $estados = Estado::all();
        return view('cadastro', compact('estados'));
    }

    public function SalvarDadosAluno(Request $request)
    {

        if((New Aluno())->verificaDuplicidade('cpf', Helper::limpa_campo($request->cpf))){
            return redirect()->back()->with('message', 'Este CPF já consta em nosso banco de dados! Verifique.');
        }

        if((New UserController())->verificaDuplicidade('email', $request->email)){
            return redirect()->back()->with('warning', 'Este e-mail ja está cadastrado! Verifique.');
        }

        $endereco = (new EnderecoController())->salvarEndereco($request);
        $user = (new UserController())->gerarUsuario($request);

        $aluno = new Aluno();
        $aluno->endereco_id = $endereco->id;
        $aluno->polo_id = (new PoloController())->getPoloCidade($endereco);
        $aluno->user_id = $user->id;
        $aluno->nome = $request->nome;
        $aluno->sexo = $request->sexo ?? 'Masculino';
        $aluno->cpf = Helper::limpa_campo($request->cpf);
        $aluno->rg = Helper::limpa_campo($request->rg);
        $aluno->orgao_expedidor = $request->orgao_expedidor;
        $aluno->data_nascimento = $request->data_nascimento;
        $aluno->telefone = Helper::limpa_campo($request->telefone);
        $aluno->whatsapp = Helper::limpa_campo($request->whatsapp);
        $aluno->estado_civil = $request->estado_civil;
        $aluno->situacao = $request->situacao;
        $aluno->escolaridade = $request->escolaridade;
        $aluno->turno = $request->turno_matricula;
        $aluno->contra_turno = 'Não';
        $aluno->situacao = 'Ativo';
        $aluno->tipo_cadastro = 'Candidato';

        if($aluno->save()){

            $curriculo = (new CurriculoAlunoController())->store($request, $aluno);

            if($request->estado_civil == 'Casado'){
                (new ConjugeController())->store($request, $aluno);
            }

            Mail::to($request->email)->send(new SendMailUser($aluno))->cc('contato@larmariadelourdes.org');
            return view('cadastro', compact('aluno'))->with('success', 'Seu cadastro foi realizado!');

        }else{
            $user->delete();
            $endereco->delete();
            return redirect()->back()->with('warning', 'Não conseguimos concluir seu cadastro! Entre em contato com a administração.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PreCadastro  $preCadastro
     * @return \Illuminate\Http\Response
     */
    public function show(PreCadastro $preCadastro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PreCadastro  $preCadastro
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        /*$cadastro = PreCadastro::find($id);
        $idade_jovem = Helper::calcula_idade($cadastro->data_nascimento);*/
        $estados = Estado::all();
        return view('cadastro', compact('estados'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PreCadastro  $preCadastro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreCadastro $preCadastro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PreCadastro  $preCadastro
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreCadastro $preCadastro)
    {
        //
    }
}
