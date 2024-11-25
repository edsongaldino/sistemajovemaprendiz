<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\PreCadastroJovem;
use App\Http\Controllers\Controller;
use App\Polo;
use Illuminate\Http\Request;

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
        return view('sistema.cadastros.index', compact('alunos', 'polos'));
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

}
