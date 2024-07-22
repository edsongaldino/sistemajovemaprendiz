<?php

namespace App\Http\Controllers;

use App\Conjuge;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class ConjugeController extends Controller
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
        $conjuge = new Conjuge();
        $conjuge->aluno_id = $aluno->id;
        $conjuge->nome = $request->nome_conjuge;
        $conjuge->cpf = Helper::limpa_campo($request->cpf_conjuge);
        $conjuge->rg = Helper::limpa_campo($request->rg_conjuge);
        $conjuge->orgao_expedidor = $request->orgao_expedidor_conjuge;
        $conjuge->save(); 
        
        return $conjuge;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conjuge  $conjuge
     * @return \Illuminate\Http\Response
     */
    public function show(Conjuge $conjuge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conjuge  $conjuge
     * @return \Illuminate\Http\Response
     */
    public function edit(Conjuge $conjuge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conjuge  $conjuge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $conjuge = Conjuge::findOrFail($request->conjuge_id);
        $conjuge->nome = $request->nome_conjuge;
        $conjuge->cpf = Helper::limpa_campo($request->cpf_conjuge);
        $conjuge->rg = Helper::limpa_campo($request->rg_conjuge);
        $conjuge->orgao_expedidor = $request->orgao_expedidor_conjuge;
        $conjuge->save(); 
        
        return $conjuge;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conjuge  $conjuge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conjuge $conjuge)
    {
        //
    }
}
