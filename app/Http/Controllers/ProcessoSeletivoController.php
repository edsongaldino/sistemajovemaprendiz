<?php

namespace App\Http\Controllers;

use App\ProcessoSeletivo;
use App\Vaga;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Aluno;
use App\Mail\EmailFechamentoProcessoSeletivo;
use Illuminate\Support\Facades\Mail;

class ProcessoSeletivoController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProcessoSeletivo  $processoSeletivo
     * @return \Illuminate\Http\Response
     */
    public function show(ProcessoSeletivo $processoSeletivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProcessoSeletivo  $processoSeletivo
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcessoSeletivo $processoSeletivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProcessoSeletivo  $processoSeletivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcessoSeletivo $processoSeletivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProcessoSeletivo  $processoSeletivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcessoSeletivo $processoSeletivo)
    {
        //
    }

    public function ConsultaProcessoExterno($id){
        $processo_seletivo = ProcessoSeletivo::where('vaga_id', $id)->get();
        $vaga = Vaga::find($id);
        return view('sistema.vagas.externo.consultaprocesso', compact('processo_seletivo', 'vaga'));
    }

    public function AtualizarProcessoSeletivoExterno(Request $request){

        $processo = ProcessoSeletivo::findOrFail($request->id);
        $QtdAceitos = ProcessoSeletivo::where('vaga_id', $processo->vaga_id)->where('situacao','Aceito')->count();

        if($QtdAceitos >= $processo->vaga->qtde_vagas && $request->resultado == 'Aceito'){
            return redirect()->back()->with('warning', 'Este processo seletivo já atingiu o número máximo de vagas!');
        }else{
            $processo->data_entrevista = $request->data;
            $processo->situacao = $request->resultado;
            $processo->save();
    
            return redirect()->back()->with('success', 'Informações Atualizadas!');
        }
    }

    public function FinalizarProcessoSeletivoExterno(Request $request){

        $vaga = Vaga::findOrFail($request->vaga);
        $vaga->situacao = 'Processo Seletivo - Concluído';
        $destinatario = 'edsongaldino@outlook.com';

        $Delprocesso = ProcessoSeletivo::where('vaga_id',$request->vaga)->where('situacao','<>','Aceito')->delete();
        
        if($vaga->save()){
            Mail::to($destinatario)->cc('edson@lancamentosonline.com.br')->send(new EmailFechamentoProcessoSeletivo($vaga));
            return true;
        }else{
            return false;
        }

    }
}
