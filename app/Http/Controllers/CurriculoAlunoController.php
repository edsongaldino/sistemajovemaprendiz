<?php

namespace App\Http\Controllers;

use App\CurriculoAluno;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class CurriculoAlunoController extends Controller
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
    public function store(Request $request, $aluno)
    {
        $curriculo = new CurriculoAluno();
        $curriculo->aluno_id = $aluno->id;
        $curriculo->sexo = $request->sexo;
        $curriculo->possui_ctps = $request->possui_ctps ?? 'Não';
        $curriculo->ctps = $request->ctps;
        $curriculo->serie_ctps = $request->serie_ctps;
        $curriculo->aluno_matriculado = $request->aluno_matriculado ?? 'Não';
        $curriculo->problema_saude = $request->problema_saude ?? 'Não';
        $curriculo->problema_saude_especificacao = $request->problema_saude_especificacao;
        $curriculo->remedio_controlado = $request->remedio_controlado ?? 'Não';
        $curriculo->remedio_controlado_especificacao = $request->remedio_controlado_especificacao;
        $curriculo->tipo_moradia = $request->tipo_moradia ?? 'Própria';
        $curriculo->numero_pessoas_residencia = $request->numero_pessoas_residencia;
        $curriculo->renda_familiar = Helper::converte_reais_to_mysql($request->renda_familiar ?? '0.00');
        $curriculo->curso_informatica = $request->curso_informatica ?? 'Não';
        $curriculo->descricao_curso = $request->descricao_curso;
        $curriculo->ja_trabalhou = $request->ja_trabalhou ?? 'Não';
        $curriculo->funcao_exercida = $request->funcao_exercida;
        $curriculo->empresa_trabalho = $request->empresa_trabalho;
        $curriculo->porque_decidiu_trabalhar = $request->porque_decidiu_trabalhar;
        $curriculo->oque_espera_empresa = $request->oque_espera_empresa;
        $curriculo->seu_sonho = $request->seu_sonho;
        $curriculo->ponto_forte_desenvolver = $request->ponto_forte_desenvolver;
        $curriculo->momentos_lazer = $request->momentos_lazer;
        $curriculo->save();

        return $curriculo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CurriculoAluno  $curriculoAluno
     * @return \Illuminate\Http\Response
     */
    public function show(CurriculoAluno $curriculoAluno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CurriculoAluno  $curriculoAluno
     * @return \Illuminate\Http\Response
     */
    public function edit(CurriculoAluno $curriculoAluno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CurriculoAluno  $curriculoAluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CurriculoAluno $curriculoAluno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CurriculoAluno  $curriculoAluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(CurriculoAluno $curriculoAluno)
    {
        //
    }
}
