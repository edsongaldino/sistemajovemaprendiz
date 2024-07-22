<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Responsavel;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class ResponsavelController extends Controller
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
        $responsavel = new Responsavel();
        $responsavel->aluno_id = $aluno->id;
        $responsavel->nome = $request->nome_responsavel;
        $responsavel->cpf = Helper::limpa_campo($request->cpf_responsavel);
        $responsavel->rg = Helper::limpa_campo($request->rg_responsavel);
        $responsavel->save(); 
        
        return $responsavel;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\responsavel  $responsavel
     * @return \Illuminate\Http\Response
     */
    public function show(responsavel $responsavel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\responsavel  $responsavel
     * @return \Illuminate\Http\Response
     */
    public function edit(responsavel $responsavel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\responsavel  $responsavel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $responsavel = responsavel::findOrFail($request->responsavel_id);
        $responsavel->nome = $request->nome_responsavel;
        $responsavel->cpf = Helper::limpa_campo($request->cpf_responsavel);
        $responsavel->rg = Helper::limpa_campo($request->rg_responsavel);
        $responsavel->save(); 
        
        return $responsavel;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\responsavel  $responsavel
     * @return \Illuminate\Http\Response
     */
    public function destroy(responsavel $responsavel)
    {
        //
    }
}
