<?php

namespace App\Http\Controllers;

use App\EstoqueMovimentacao;
use App\EstoqueProduto;
use App\Http\Controllers\Controller;
use App\Polo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstoqueMovimentacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $polos = Polo::all();
        $produto = EstoqueProduto::find($id);
        $movimentacoes = EstoqueMovimentacao::where('estoque_produto_id', $id)->get();
        return view('sistema.estoque.movimentacao', compact('movimentacoes', 'produto', 'polos'));
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

        $produto = EstoqueProduto::find($request->estoque_produto_id);

        if($request->tipo == 'Entrada'){
            $produto->quantidade += $request->quantidade;
            $produto->save();
        }else{
            if($produto->quantidade < $request->quantidade){
                return redirect()->back()->with('warning', 'Não existe quantidade disponível do produto para essa movimentação!');
            }else{
                $produto->quantidade = $produto->quantidade - $request->quantidade;
                $produto->save();
            }
        }

        $movimentacao = new EstoqueMovimentacao();
        $movimentacao->estoque_produto_id = $request->estoque_produto_id;
        $movimentacao->user_id = Auth::user()->id;
        $movimentacao->tipo = $request->tipo;
        $movimentacao->data = Carbon::now();
        $movimentacao->descricao = $request->descricao;
        $movimentacao->quantidade = $request->quantidade;
        $movimentacao->polo_destino = $request->polo_destino;
        $movimentacao->save();

        return redirect()->back()->with('success', 'Movimentação realizada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EstoqueMovimentacao  $estoqueMovimentacao
     * @return \Illuminate\Http\Response
     */
    public function show(EstoqueMovimentacao $estoqueMovimentacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EstoqueMovimentacao  $estoqueMovimentacao
     * @return \Illuminate\Http\Response
     */
    public function edit(EstoqueMovimentacao $estoqueMovimentacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EstoqueMovimentacao  $estoqueMovimentacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstoqueMovimentacao $estoqueMovimentacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EstoqueMovimentacao  $estoqueMovimentacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstoqueMovimentacao $estoqueMovimentacao)
    {
        //
    }
}
