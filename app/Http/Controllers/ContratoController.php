<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\AtuacaoComercial;
use App\AtualizacoesContrato;
use App\CalendarioAluno;
use App\Contrato;
use App\Curso;
use App\Empresa;
use App\EmpresaContato;
use App\Polo;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Reposicao;
use App\Tabela;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polos = Polo::all();
        $contratos = Contrato::orderBy('id','desc')->paginate(10);
        return view('sistema.contratos.index', compact('contratos', 'polos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $polos = Polo::all();
        $empresas = Empresa::all();
        $alunos = Aluno::all();
        $tabelas = Tabela::all();
        $usuarios = User::where('perfil_id','<>', '4')->where('perfil_id','<>', '5')->get();
        $cursos = Curso::all();
        return view('sistema.contratos.adicionar', compact('polos', 'empresas', 'alunos', 'tabelas', 'usuarios', 'cursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if((New Contrato())->verificaDuplicidade('aluno_id', $request->aluno_id)){
            return redirect()->back()->with('warning', 'Já existe um contrato ativo para este CPF! Verifique.');
        }

        $contrato = new Contrato();
        $contrato->polo_id = $request->polo_id;
        $contrato->empresa_id = $request->empresa_id;
        $contrato->empresa_contato_id = $request->empresa_contato_id;
        $contrato->aluno_id = $request->aluno_id;
        $contrato->convenio_id = $request->convenio_id;
        $contrato->atuacao_comercial = $request->atuacao_comercial;
        $contrato->tipo_faturamento = $request->tipo_faturamento;
        $contrato->tipo = $request->tipo;
        $contrato->tabela_id = $request->tabela_id;
        $contrato->data_inicial = Helper::data_mysql($request->data_inicial);
        $contrato->data_final = Helper::data_mysql($request->data_final);
        $contrato->valor_bolsa = Helper::converte_reais_to_mysql($request->valor_bolsa);
        $contrato->valor_bolsa_extenso = $request->valor_bolsa_extenso;
        $contrato->dia_semana_teorico = $request->dia_semana_teorico;
        $contrato->situacao = 'Ativo';
        $contrato->curso_id = $request->curso_id;
        $contrato->periodo_teorico = $request->periodo_teorico;
        $contrato->hora_inicial_teorico = $request->hora_inicial_teorico;
        $contrato->hora_final_teorico = $request->hora_final_teorico;
        $contrato->periodo_pratico = $request->periodo_pratico;
        $contrato->hora_inicial_pratico = $request->hora_inicial_pratico;
        $contrato->hora_final_pratico = $request->hora_final_pratico;
        $contrato->data_alteracao_curso = Helper::data_mysql($request->data_alteracao_curso);
        if($request->data_ultimo_faturamento){
            $contrato->data_ultimo_faturamento = Helper::data_mysql($request->data_ultimo_faturamento);
        }
        $contrato->save();

        /*Atualiza situação do candidato*/
        $aluno = Aluno::findOrFail($request->aluno_id);
        $aluno->situacao = 'Ativo';
        $aluno->tipo_cadastro = 'Jovem Aprendiz';
        $aluno->save();

        if($request->tipo == 'Reposição'){
            (new Reposicao())->gravarReposicao($contrato, $request->aluno_reposto_id);
        }

        if($request->atuacao_comercial == 'Sim'){
            (new AtuacaoComercial())->gravarAtuacao($request, $contrato);
        }

        return redirect()->route('sistema.contratos')->with('success', 'Dados Cadastrados!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $contrato = Contrato::find($id);
        $atualizacoes = AtualizacoesContrato::where('contrato_id',$id)->paginate(10);
        return view('sistema.contratos.atualizacoes', compact('contrato', 'atualizacoes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contrato = Contrato::find($id);
        $polos = Polo::all();
        //$empresas = Empresa::all();
        //$alunos = Aluno::all();
        $tabelas = Tabela::all();
        $usuarios = User::select('users.*')->join('perfis', 'users.perfil_id', '=', 'perfis.id')->where('perfis.tipo_perfil','=','Gestão')->orWhere('perfis.tipo_perfil','=','Parceiro')->orderBy('users.nome','asc')->get();
        $cursos = Curso::all();
        return view('sistema.contratos.editar', compact('contrato', 'polos', 'tabelas', 'usuarios', 'cursos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $contrato = Contrato::findOrFail($request->id);
        $contrato->polo_id = $request->polo_id;
        $contrato->empresa_id = $request->empresa_id;
        $contrato->empresa_contato_id = $request->empresa_contato_id;
        $contrato->convenio_id = $request->convenio_id;
        $contrato->aluno_id = $request->aluno_id;
        $contrato->atuacao_comercial = $request->atuacao_comercial;
        $contrato->tipo_faturamento = $request->tipo_faturamento;
        $contrato->tipo = $request->tipo;
        $contrato->tabela_id = $request->tabela_id;
        $contrato->data_inicial = Helper::data_mysql($request->data_inicial);
        $contrato->data_final = Helper::data_mysql($request->data_final);
        $contrato->curso_id = $request->curso_id;
        $contrato->valor_bolsa = Helper::converte_reais_to_mysql($request->valor_bolsa);
        $contrato->valor_bolsa_extenso = $request->valor_bolsa_extenso;
        $contrato->dia_semana_teorico = $request->dia_semana_teorico;
        $contrato->periodo_teorico = $request->periodo_teorico;
        $contrato->hora_inicial_teorico = $request->hora_inicial_teorico;
        $contrato->hora_final_teorico = $request->hora_final_teorico;
        $contrato->periodo_pratico = $request->periodo_pratico;
        $contrato->hora_inicial_pratico = $request->hora_inicial_pratico;
        $contrato->hora_final_pratico = $request->hora_final_pratico;
        $contrato->data_alteracao_curso = Helper::data_mysql($request->data_alteracao_curso);
        if($request->data_ultimo_faturamento){
            $contrato->data_ultimo_faturamento = Helper::data_mysql($request->data_ultimo_faturamento);
        }
        $contrato->save();

        if($request->tipo == 'Reposição'){
            (new Reposicao())->gravarReposicao($contrato, $request->aluno_reposto_id);
        }

        if($request->atuacao_comercial == 'Sim'){
            (new AtuacaoComercial())->gravarAtuacao($request, $contrato);
        }

        return redirect()->route('sistema.contratos')->with('success', 'Dados Atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $contrato = Contrato::find($request->id);

        if($contrato->delete()):
            return true;
        else:
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        endif;
    }
    public function Print($id){
        $poloMatriz = Polo::find(3);
        $gestorMatriz = DB::table('polo_user')->select('users.nome')->join('users', 'users.id', '=', 'polo_user.user_id')->where('polo_user.polo_id', $poloMatriz->id)->where('users.perfil_id',2)->first();
        $contrato = Contrato::find($id);
        $gestor = DB::table('polo_user')->select('users.nome')->join('users', 'users.id', '=', 'polo_user.user_id')->where('polo_user.polo_id', $contrato->polo_id)->where('users.perfil_id',2)->first();

        $uniforme = AtualizacoesContrato::where('contrato_id',$id)->where('tipo','Entrega de Uniforme')->first();
        return view('sistema.contratos.imprimir', compact('contrato', 'gestor', 'poloMatriz', 'gestorMatriz', 'uniforme'));

    }

    public function ContratoBusca(Request $request)
    {
        $polos = Polo::all();
        $buscaContratos = Contrato::select('contratos.*')->where('contratos.id', '>', 0)->join('empresas', 'empresas.id', '=', 'contratos.empresa_id')->join('alunos', 'alunos.id', '=', 'contratos.aluno_id');

        if($request->polo){
            $buscaContratos->where('contratos.polo_id', $request->polo);
        }

        if($request->cnpj){
            $buscaContratos->where('empresas.cnpj', Helper::limpa_campo($request->cnpj));
        }

        if($request->razao_social){
            $buscaContratos->where('empresas.razao_social', 'like', '%' . $request->razao_social . '%');
        }

        if($request->cpf){
            $buscaContratos->where('alunos.cpf', Helper::limpa_campo($request->cpf));
        }

        if($request->nome_aluno){
            $buscaContratos->where('alunos.nome', 'like', '%' . $request->nome_aluno . '%');
        }

        if($request->situacao){
            $buscaContratos->where('contratos.situacao', $request->situacao);
        }

        $contratos = $buscaContratos->orderBy('contratos.id','desc')->paginate(20);
        return view('sistema.contratos.index', compact('contratos', 'polos'));
    }

    public function CalendarioPDF($id){
        $contrato = Contrato::find($id);
        $mesesContrato = CalendarioAluno::selectRaw("MONTH(data) as mes")->selectRaw("YEAR(data) as ano")->where('contrato_id',$id)->distinct()->get();
        return view('sistema.contratos.calendarioPDF', compact('contrato', 'mesesContrato'));
    }

    public function getResponsaveis(Request $request)
    {
        $responsaveis = EmpresaContato::where('empresa_id','=', $request->id)->where('setor','=', 'RESPONSÁVEL jOVEM')->orderBy('nome','asc')->get();
        return view('global.getResponsaveis', compact('responsaveis'));
    }

    public function getAlunosReposicao($empresa)
    {
        $alunos = Aluno::select('alunos.id', 'alunos.nome', 'alunos.cpf')
                            ->join('contratos', 'alunos.id', '=', 'contratos.aluno_id')
                            ->where('contratos.empresa_id', $empresa)
                            ->where('contratos.situacao','Encerrado')
                            ->whereNotIn('contratos.id', DB::table('reposicao')->pluck('reposicao.aluno_id')->toArray())
                            ->groupBy('alunos.id')->get();              
        return view('global.getAlunosReposicao', compact('alunos'));
    }

    public function atualizaValorBolsa($tipo, $valorP)
    {
        $contratos = Contrato::where('situacao', 'Ativo')->get();

        foreach($contratos as $contrato){
            if($tipo == 'Acréscimo'){
                $Nvalor = $contrato->valor_bolsa + ($contrato->valor_bolsa / 100 * $valorP);
            }else{
                $Nvalor = $contrato->valor_bolsa - ($contrato->valor_bolsa / 100 * $valorP);
            }
            $contrato->valor_bolsa = $Nvalor;
            $contrato->save(); 
        }
         
        return redirect()->route('sistema.atualizacoes')->with('success', 'Dados Atualizados!');
    }

    public function atualizaSituacao()
    {

        try {
            $contratos = Contrato::where('data_final', "<=", Carbon::now())->get();

            foreach($contratos as $contrato){
                $contrato->situacao = "Encerrado";
                $contrato->save(); 
            }

            return $contratos->count() . " contratos atualizados!";
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
        
    }

}
