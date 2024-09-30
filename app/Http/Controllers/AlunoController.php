<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Conjuge;
use App\Estado;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Polo;
use App\Endereco;
use App\Cidade;
use App\Contrato;
use App\Responsavel;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polos = Polo::all();
        $alunos = Aluno::where('tipo_cadastro','=', 'Jovem Aprendiz')->simplePaginate(20);
        return view('sistema.alunos.index', compact('alunos', 'polos'));
    }

    public function AlunoBusca(Request $request)
    {
        $polos = Polo::all();
        $buscaAlunos = Aluno::where('tipo_cadastro','=', 'Jovem Aprendiz');

        if($request->nome){
            $buscaAlunos->where('nome', 'like', '%' . $request->nome . '%');
        }

        if($request->cpf){
            $cpf = Helper::limpa_campo($request->cpf);
            $buscaAlunos->where('cpf', $cpf);
        }

        if($request->cpf){
            $cpf = Helper::limpa_campo($request->cpf);
            $buscaAlunos->where('cpf', $cpf);
        }

        if($request->polo){
            $buscaAlunos->where('polo_id', $request->polo);
        }

        $alunos = $buscaAlunos->paginate(20);
        return view('sistema.alunos.index', compact('alunos', 'polos'));
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
        return view('sistema.alunos.adicionar', compact('estados', 'polos'));
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

        $endereco = (new EnderecoController())->salvarEndereco($request);

        //Perfil de Aluno
        $request->perfil_id = 4;

        $user = (new UserController())->salvarUsuario($request);

        $aluno = new Aluno();
        $aluno->endereco_id = $endereco->id;
        $aluno->polo_id = $request->polo_id;
        $aluno->user_id = $user->id;
        $aluno->nome = $request->nome;
        $aluno->sexo = $request->sexo;
        $aluno->cpf = Helper::limpa_campo($request->cpf);
        $aluno->rg = Helper::limpa_campo($request->rg);
        $aluno->orgao_expedidor = $request->orgao_expedidor;
        $aluno->data_nascimento = Helper::data_mysql($request->data_nascimento);
        $aluno->telefone = Helper::limpa_campo($request->telefone);
        $aluno->whatsapp = Helper::limpa_campo($request->whatsapp);
        $aluno->estado_civil = $request->estado_civil;
        $aluno->pcd = $request->pcd;
        $aluno->situacao = $request->situacao;
        $aluno->escolaridade = $request->escolaridade;
        $aluno->turno = $request->turno;
        $aluno->contra_turno = $request->contra_turno;
        $aluno->situacao = 'Ativo';
        $aluno->tipo_cadastro = 'Jovem Aprendiz';
        $aluno->save();

        if($request->estado_civil == 'Casado'){
            (new ConjugeController())->store($request, $aluno);
        }

        return redirect()->route('sistema.alunos')->with('success', 'Dados Cadastrados!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $alunos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aluno = Aluno::find($id);
        $estados = Estado::all();
        $polos = Polo::all();
        $endereco = Endereco::find($aluno->endereco_id);
        $cidades = Cidade::where('estado_id','=', $aluno->endereco->cidade->estado_id ?? 51)->orderBy('nome_cidade','asc')->get();
        return view('sistema.alunos.editar', compact('estados', 'aluno', 'endereco', 'cidades', 'polos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
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
        $aluno->situacao = 'Ativo';
        $aluno->tipo_cadastro = 'Jovem Aprendiz';
        $aluno->save();

        //Perfil de Aluno
        $request->perfil_id = 4;

        (new EnderecoController())->updateEndereco($request, $request->endereco_id);
        (new UserController())->updateUsuario($request, $request->user_id);

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

        return redirect()->route('sistema.alunos')->with('success', 'Dados Atualizados!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $aluno = Aluno::find($request->id);

        DB::beginTransaction();
        $endereco = Endereco::findOrFail($aluno->endereco_id);
        $user = Endereco::findOrFail($aluno->user_id);

        if($endereco->delete() && $user->delete()):
            $aluno->delete();
            DB::commit();
            return true;
        else:
            DB::rollBack();
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        endif;
    }

    public function consultaCPF($cpf){

        $alunoContrato = Contrato::select('contratos.*')->where('contratos.situacao', 'Ativo')->where('alunos.cpf', Helper::limpa_campo($cpf))->join('alunos', 'alunos.id', '=', 'contratos.aluno_id')->count();

        if($alunoContrato > 0){
            return response()->json('Existe');
        }

        $aluno = Aluno::where('cpf','=', $cpf)->get();
        if($aluno){
            $retorno = $aluno;
        }else{
            $retorno = null;
        }
        return response()->json($retorno);

    }

    public function updatePoloAluno(){
        $getAluno = Aluno::where('polo_atualizado', 0)->limit(100)->get();

        foreach($getAluno as $alunoA){
            $aluno = Aluno::findOrFail($alunoA->id);
            $aluno->polo_id = (new PoloController())->getPoloCidade($aluno->endereco);
            $aluno->polo_atualizado = 1;
            $aluno->save();
        }
    }

}
