<?php

namespace App\Http\Controllers;

use App\AtualizacoesContrato;
use App\Contrato;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtualizacoesContratoController extends Controller
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

        $atualizacao = new AtualizacoesContrato();
        $atualizacao->user_id = Auth::user()->id;
        $atualizacao->contrato_id = $request->contrato_id;
        $atualizacao->tipo = $request->tipo;
        $atualizacao->data = $request->data;

        switch($request->tipo){

            case "Falta Trabalho":
                $atualizacao->falta_justificada = $request->falta_justificada;
                break;

            case "Entrega de Uniforme":
                $atualizacao->quantidade = $request->quantidade;
                $atualizacao->tamanho = $request->tamanho;
                $atualizacao->valor = $request->valor;
                break;

            case "Exame Admissional":
                $atualizacao->valor = $request->valor;
                break;

            case "Exame Demissional":
                $atualizacao->valor = $request->valor;
                break;

            case "Atualização Contratual":
                $atualizacao->motivo_desligamento = $request->motivo_desligamento;
                $atualizacao->situacao_contrato = $request->situacao_contrato;

                /*Atualiza situação do contrato*/
                $contrato = Contrato::findOrFail($request->contrato_id);

                if($atualizacao->situacao_contrato == 'Ativo'){
                    $contrato->situacao = 'Ativo';
                }else{
                    $contrato->situacao = 'Encerrado';
                }
                
                $contrato->save();

                break;

        }

        if($atualizacao->save()):
            return redirect('sistema/contrato/'.$request->contrato_id.'/atualizacoes')->with('success', 'Atualização incluída com sucesso!');
        else:
            return redirect('sistema/contrato/'.$request->contrato_id.'/atualizacoes')->with('warning', 'Erro ao incluir atualização!');
        endif;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AtualizacoesContrato  $atualizacoesContrato
     * @return \Illuminate\Http\Response
     */
    public function show(AtualizacoesContrato $atualizacoesContrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AtualizacoesContrato  $atualizacoesContrato
     * @return \Illuminate\Http\Response
     */
    public function edit(AtualizacoesContrato $atualizacoesContrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AtualizacoesContrato  $atualizacoesContrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AtualizacoesContrato $atualizacoesContrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AtualizacoesContrato  $atualizacoesContrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $atualizacao = AtualizacoesContrato::find($request->id);

        if($atualizacao->delete()):
            return true;
        else:
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        endif;
    }
}