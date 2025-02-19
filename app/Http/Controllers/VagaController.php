<?php

namespace App\Http\Controllers;

use App\Vaga;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Polo;
use App\Helpers\Helper;
use App\Aluno;
use App\Estado;
use App\ProcessoSeletivo;
use App\Endereco;
use App\Cidade;
use App\Curso;
use App\Empresa;
use App\EmpresaContato;
use App\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailProcessoSeletivo;
use App\Tabela;
use App\User;

class VagaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vagas = Vaga::paginate(10);
        $polos = Polo::all();
        return view('sistema.vagas.index', compact('vagas', 'polos'));
    }

    public function candidatos()
    {
        $alunos = Aluno::where('tipo_cadastro','=', 'Candidato')->orderBy('id','desc')->paginate(20);
        $polos = Polo::all();
        $estados = Estado::all();
        $processo = 'Consulta';
        return view('sistema.vagas.candidatos', compact('alunos', 'polos', 'estados', 'processo'));
    }

    public function CandidatoBusca(Request $request)
    {

        $polos = Polo::all();
        $buscaCandidatos = Aluno::where('alunos.tipo_cadastro','=', 'Candidato')
                            ->select('alunos.*')
                            ->join('enderecos', 'enderecos.id', '=', 'alunos.endereco_id')
                            ->orderBy('alunos.id','desc');
        $search = array();

        if($request->nome){
            $buscaCandidatos->where('alunos.nome', 'like', '%' . $request->nome . '%');
            $search['nome'] = $request->nome;
        }

        if($request->cpf){
            $cpf = Helper::limpa_campo($request->cpf);
            $buscaCandidatos->where('alunos.cpf', $cpf);
            $search['cpf'] = $request->cpf;
        }

        if($request->idade){
            $dataAtual = now();
            $data_nascimento_base = date("Y-m-d", strtotime(date("Y-m-d", strtotime($dataAtual)) . " - $request->idade year"));
            $data_nascimento_base_menor = date("Y-m-d", strtotime(date("Y-m-d", strtotime($data_nascimento_base)) . " - 1 year"));
            $data_nascimento_base_maior = date("Y-m-d", strtotime(date("Y-m-d", strtotime($data_nascimento_base)) . " + 1 year"));
            $buscaCandidatos->whereBetween('alunos.data_nascimento', [$data_nascimento_base_menor, $data_nascimento_base_maior]);
            $search['idade'] = $request->idade;
        }

        if($request->sexo){
            $buscaCandidatos->where('alunos.sexo', $request->sexo);
            $search['sexo'] = $request->sexo;
        }

        if($request->turno){
            $buscaCandidatos->where('alunos.turno', $request->turno);
            $search['turno'] = $request->turno;
        }

        if($request->bairro_endereco){
            $buscaCandidatos->where('enderecos.bairro_endereco', 'like', '%' . $request->bairro_endereco . '%');
            $search['bairro_endereco'] = $request->bairro_endereco;
        }elseif($request->cidade_endereco){
            $buscaCandidatos->where('enderecos.cidade_id', $request->cidade_endereco);
            $search['cidade_endereco'] = $request->cidade_endereco;
        }

        if($request->polo){
            $buscaCandidatos->where('alunos.polo_id', $request->polo);
            $search['polo'] = $request->polo;
        }

        $alunos = $buscaCandidatos->paginate(20);
        $estados = Estado::all();

        if($request->processo){
            $processo = $request->processo;
        }else{
            $processo = 'Consulta';
        }

        $vaga = Vaga::find($request->vaga);

        return view('sistema.vagas.candidatos', compact('alunos', 'polos', 'estados', 'search', 'processo', 'vaga'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $polos = Polo::all();
        return view('sistema.vagas.adicionar', compact('polos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $vaga = new Vaga();
        $vaga->empresa_id = $request->empresa_id;
        $vaga->polo_id = $request->polo_id;
        $vaga->tipo_vaga = $request->tipo_vaga;
        $vaga->qtde_vagas = $request->qtde_vagas;
        $vaga->data_inicial = Helper::data_mysql($request->data_inicial);
        $vaga->situacao = $request->situacao;
        $vaga->save();

        return redirect()->route('sistema.vagas')->with('success', 'Dados da Vaga Cadastrados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vaga  $vaga
     * @return \Illuminate\Http\Response
     */
    public function show(Vaga $vaga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vaga  $vaga
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vaga = Vaga::find($id);
        $polos = Polo::all();
        return view('sistema.vagas.editar', compact('vaga', 'polos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vaga  $vaga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $vaga = Vaga::findOrFail($request->id);
        $vaga->empresa_id = $request->empresa_id;
        $vaga->polo_id = $request->polo_id;
        $vaga->tipo_vaga = $request->tipo_vaga;
        $vaga->qtde_vagas = $request->qtde_vagas;
        $vaga->data_inicial = Helper::data_mysql($request->data_inicial);
        $vaga->situacao = $request->situacao;
        $vaga->save();

        return redirect()->route('sistema.vagas')->with('success', 'Dados Atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vaga  $vaga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $vaga = Vaga::find($request->id);

        if($vaga->delete()):
            return true;
        else:
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        endif;
    }

    public function ProcessoSeletivo($id)
    {
        $candidatos = Aluno::where('tipo_cadastro','=', 'Candidato')->get();
        $vaga = Vaga::find($id);
        $processo_seletivo = ProcessoSeletivo::where('vaga_id', $id)->paginate(10);
        $logs = Log::where('fk_id', $vaga->id)->where('tipo', 'Envio de Processo Seletivo')->get();
        return view('sistema.vagas.processo_seletivo', compact('candidatos', 'vaga', 'processo_seletivo', 'logs'));
    }

    public function ProcessoSeletivoCandidato($id)
    {
        $candidato = Aluno::find($id);
        $processos_seletivos = ProcessoSeletivo::where('aluno_id', $id)->paginate(10);
        return view('sistema.vagas.candidatos.processo_seletivo', compact('processos_seletivos','candidato'));
    }

    public function AddCandidato(Request $request)
    {
        $processo = new ProcessoSeletivo();
        $processo->vaga_id = $request->vaga_id;
        $processo->aluno_id = $request->aluno_id;
        $processo->data_entrevista = date('Y-m-d');
        $processo->situacao = 'Em análise';
        $processo->save();

        return redirect()->back()->with('success', 'Cadidato cadastrado com sucesso!');
    }

    public function DesfazerAceite(Request $request)
    {
        $processo = ProcessoSeletivo::find($request->id);
        $processo->situacao = 'Em análise';

        if($processo->update()):
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        else:
            $response_array['status'] = 'error';
            echo json_encode($response_array);
        endif;
        
    }


    public function EnviarProcesso(Request $request)
    {
        $vaga = Vaga::find($request->vaga_id);
        $EmailDestinatario = EmpresaContato::where('Setor','RH')->where('empresa_id',$vaga->empresa_id)->get();

        if($EmailDestinatario->count() < 1){
            return response()->json(array('status'=>'error', 'msg'=>"Nenhum e-mail cadastrado para esse cliente!"), 200);
        }

        $i = 1;
        foreach($EmailDestinatario as $destinatario){
            if($i == 1){
                $EmailTo = $destinatario->email;
            }else{
                $arrayEmails[] = $destinatario->email;
            }
            $i++;
        }

        if($i > 2){
            $enviaEmail = Mail::to($EmailTo)->cc($arrayEmails)->bcc("dcr@larmariadelourdes.org")->send(new EmailProcessoSeletivo($vaga));
        }else{
            $enviaEmail = Mail::to($EmailTo)->bcc("dcr@larmariadelourdes.org")->send(new EmailProcessoSeletivo($vaga));
        }

        if($enviaEmail){
            //GRava Log
            $log = (new LogController())->gravaLog('Envio de Processo Seletivo', $EmailTo, $vaga->id);
            return redirect()->back()->with('success', 'A lista dos candidatos foi enviada para a empresa!');
        }else{
            return redirect()->back()->with('error', 'Não foi possível enviar, porque a empresa não possui um e-mail cadastrado!');
        }
    }

    public function GerarContrato($id){
        $processo = ProcessoSeletivo::find($id);
        $polos = Polo::all();
        $empresa = Empresa::find($processo->vaga->empresa_id);
        $aluno = Aluno::find($processo->aluno_id);
        $tabelas = Tabela::all();
        $usuarios = User::all();
        $cursos = Curso::all();

        return view('sistema.contratos.adicionar', compact('polos', 'empresa', 'aluno', 'tabelas', 'usuarios', 'cursos'))->with('success', 'Preencha os dados do contrato!');
    }

    public function CurriculoCandidato($id)
    {
        $candidato = Aluno::find($id);
        return view('sistema.vagas.curriculo', compact('candidato'));
    }

    public function editCandidato($id)
    {
        $aluno = Aluno::find($id);
        $estados = Estado::all();
        $polos = Polo::all();
        $endereco = Endereco::find($aluno->endereco_id);
        $cidades = Cidade::where('estado_id','=', $aluno->endereco->cidade->estado_id ?? 51)->orderBy('nome_cidade','asc')->get();
        return view('sistema.vagas.candidatos.editar', compact('estados', 'aluno', 'endereco', 'cidades', 'polos'));
    }

    public function updateCandidato(Request $request){

        $aluno = Aluno::findOrFail($request->id);
        $aluno->polo_id = $request->polo_id;
        $aluno->nome = $request->nome;
        $aluno->sexo = $request->sexo;
        $aluno->cpf = Helper::limpa_campo($request->cpf);
        $aluno->rg = Helper::limpa_campo($request->rg);
        $aluno->orgao_expedidor = $request->orgao_expedidor;
        $aluno->data_nascimento = Helper::data_mysql($request->data_nascimento);
        $aluno->telefone = Helper::limpa_campo($request->telefone);
        $aluno->whatsapp = Helper::limpa_campo($request->whatsapp);
        $aluno->pcd = $request->pcd;
        $aluno->estado_civil = $request->estado_civil;
        $aluno->situacao = $request->situacao;
        $aluno->escolaridade = $request->escolaridade;
        $aluno->turno = $request->turno;
        $aluno->contra_turno = $request->contra_turno;
        $aluno->save();

        //Perfil de Aluno
        $request->perfil_id = 4;

        (new EnderecoController())->updateEndereco($request, $request->endereco_id);

        if($request->user_id){
            if($request->email && $request->password){
                (new UserController())->updateUsuario($request, $request->user_id);
            }
        }else{
            if($request->email){
                $user = (new UserController())->salvarUsuario($request);
            }
        }

        if($request->responsavel_id <> '' && $request->nome_responsavel == ''){
            (new ResponsavelController())->update($request);
        }elseif($request->responsavel_id == '' && $request->nome_responsavel <> ''){
            (new ResponsavelController())->store($request, $aluno);
        }

        if($request->estado_civil == 'Casado' && $request->conjuge_id <> ''){
            (new ConjugeController())->update($request);
        }elseif($request->estado_civil == 'Casado' && $request->conjuge_id == ''){
            (new ConjugeController())->store($request, $aluno);
        }

        

        return redirect()->route('sistema.candidatos')->with('success', 'Dados Atualizados!');

    }

    public function SelecionarCandidatos($id){

        $alunos = Aluno::where('tipo_cadastro','=', 'Candidato')->paginate(20);
        $vaga = Vaga::find($id);
        $processo = 'Seleção';
        $polos = Polo::all();
        $estados = Estado::all();
        return view('sistema.vagas.candidatos', compact('alunos', 'polos', 'estados', 'vaga', 'processo'));

    }

    public function IncluirCandidato(Request $request){

        $processo = ProcessoSeletivo::where('aluno_id', $request->id)->where('vaga_id', $request->vaga)->get();

        if($processo->count() > 0){
            $response_array['status'] = 'error';
            echo json_encode($response_array);
        }else{
            $processo = new ProcessoSeletivo();
            $processo->vaga_id = $request->vaga;
            $processo->aluno_id = $request->id;
            $processo->data_entrevista = date('Y-m-d');
            $processo->situacao = 'Em análise';
            $processo->save();

            if($processo->id):
                $response_array['status'] = 'success';
                echo json_encode($response_array);
            else:
                $response_array['status'] = 'error';
                echo json_encode($response_array);
            endif;
        }

    }

    public function ExcluirCandidato(Request $request){

        $processo = ProcessoSeletivo::find($request->id);

        if($processo->delete()):
            return true;
        else:
            return false;
        endif;

    }


    public function GerarTXT(){

    }

}
