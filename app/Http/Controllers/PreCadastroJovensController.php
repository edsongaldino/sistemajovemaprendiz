<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Estado;
use App\Helpers\Helper;
use App\PreCadastroJovem;
use App\Http\Controllers\Controller;
use App\Mail\EmailCurriculo;
use App\Mail\SendMailUser;
use App\Polo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */

class PreCadastroJovensController extends Controller
{

    /**
    *  @OA\GET(
    *      path="/api/lista-pre-cadastro",
    *      summary="Lista todos os jovens cadastrados",
    *      description="Lista todos os jovens cadastrados",
    *      tags={"Pre Cadastros"},
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *
    *  )
    */
    public function listaCadastros()
    {
        $preCadastros = PreCadastroJovem::get()->take(50);
        return response()->json(['data' => $preCadastros]);
    }


    /**
    *  @OA\POST(
    *      path="/api/gravar-pre-cadastro",
    *      summary="Grava dados do jovem aprendiz",
    *      description="Grava dados do jovem aprendiz",
    *      tags={"Pre Cadastros"},
    *      @OA\RequestBody(
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="multipart/form-data",
    *             @OA\Schema(
    *                  @OA\Property(property="nomeCompleto", type="string"),
    *                  @OA\Property(property="dataNascimento", type="date"),
    *                  @OA\Property(property="email", type="string"),
    *                  @OA\Property(property="periodoEstudo", type="string"),
    *                  @OA\Property(property="whatsapp", type="string"),
    *                  @OA\Property(property="sexo", type="string"),
    *                  @OA\Property(property="cep", type="string"),
    *                  @OA\Property(property="estado", type="string"),
    *                  @OA\Property(property="cidade", type="string"),
    *                  @OA\Property(property="bairro", type="string"),
    *                  required={"nomeCompleto", "dataNascimento", "email", "periodoEstudo", "whatsapp", "cidade", "estado"}
    *             )
    *         )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="OK",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *      ),
    *
    *  )
    */
    public function preCadastroAluno(Request $request){


        $cadastro = new PreCadastroJovem();

        $cadastro->nome_completo = $request->nomeCompleto;
        $cadastro->data_nascimento = $request->dataNascimento;
        $cadastro->periodo_estudo = $request->periodoEstudo;
        $cadastro->email = $request->email;
        $cadastro->whatsapp = Helper::limpa_campo($request->whatsapp);
        $cadastro->sexo = $request->sexo;
        $cadastro->cep = $request->cep;
        $cadastro->estado = $request->estado;
        $cadastro->cidade = $request->cidade;
        $cadastro->bairro = $request->bairro;
        $cadastro->situacao = 'Aguardando';

        if($cadastro->save()){
            return response()->json([
                'Status' => "Sucesso",
                'Mensagem' => "O pré-cadastro do jovem foi efetuado com sucesso"
              ]);
        }else{
            return response()->json([
                'Status' => "Erro",
                'Mensagem' => "Não foi possível efetuar o cadastro"
              ]);
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cadastros = PreCadastroJovem::orderBy('id','Desc')->paginate(40);
        $polos = Polo::all();
        return view('sistema.cadastros.index', compact('cadastros', 'polos'));
    }

    public function CadastroBusca(Request $request)
    {
        $polos = Polo::all();
        $buscaAlunos = PreCadastroJovem::where('tipo_cadastro','=', 'Jovem Aprendiz');

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
        return view('sistema.cadastros.index', compact('alunos', 'polos', 'request'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alunos  $alunos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cadastro = PreCadastroJovem::find($id);
        return view('sistema.cadastros.editar', compact('cadastro'));
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
        $cadastro = PreCadastroJovem::findOrFail($request->id);
        $cadastro->nome_completo = $request->nome;
        $cadastro->data_nascimento = Helper::data_mysql($request->data_nascimento);
        $cadastro->periodo_estudo = $request->periodo_estudo;
        $cadastro->email = $request->email;
        $cadastro->whatsapp = Helper::limpa_campo($request->whatsapp);
        $cadastro->sexo = $request->sexo;
        $cadastro->cep = $request->cep;
        $cadastro->estado = $request->estado;
        $cadastro->cidade = $request->cidade;
        $cadastro->bairro = $request->bairro;
        $cadastro->situacao = $request->situacao;

        if($cadastro->save()){
            return redirect()->route('sistema.cadastros')->with('success', 'Dados Atualizados!');
        }else{
            return redirect()->route('sistema.cadastros')->with('error', 'Erro ao atualizar dados!');
        }

    }

    public function EnviarLinkCurriculo(Request $request){

        $cadastro = PreCadastroJovem::find($request->id);

        if($cadastro->email == ''){
            return response()->json(array('status'=>'error', 'msg'=>"Nenhum e-mail cadastrado para esse cliente!"), 200);
        }

        $assunto = "Confirmação de cadastro - Preenchimento de Currículo (Jovem Aprendiz)";

        $enviaEmail = Mail::to($cadastro->email)->bcc("administrativo@larmariadelourdes.org")->send(new EmailCurriculo($cadastro, $assunto));

        if($enviaEmail){
            return response()->json(array('status'=>'success', 'msg'=>"O e-mai foi enviado com sucesso!"), 200);
        }

    }

    public function PreencherCurriculo($id){
        $cadastro = PreCadastroJovem::find($id);
        $estados = Estado::all();
        return view('cadastro', compact('estados', 'cadastro'));
    }

    public function SalvarCurriculo(Request $request)
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

}
