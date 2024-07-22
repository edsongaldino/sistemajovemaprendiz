<?php

namespace App\Http\Controllers;

use App\Endereco;
use Illuminate\Http\Request;
use App\Cidade;
use App\Helpers\Helper;

class EnderecoController extends Controller
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
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function show(Endereco $endereco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function edit(Endereco $endereco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Endereco $endereco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Endereco $endereco)
    {
        //
    }


    public function salvarEndereco(Request $request){

        $endereco = new Endereco();
        $endereco->cidade_id = $request->cidade_endereco;
        $endereco->cep_endereco = Helper::limpa_campo($request->cep_endereco);
        $endereco->logradouro_endereco = $request->logradouro_endereco;
        $endereco->numero_endereco = $request->numero_endereco;
        $endereco->complemento_endereco = $request->complemento_endereco;
        $endereco->bairro_endereco = $request->bairro_endereco;
        $endereco->save();

        return $endereco;
    }

    public function getCidades(Request $request)
    {
        $estado_id = $request->id;
        $cidades = Cidade::where('estado_id','=', $estado_id)->orderBy('nome_cidade','asc')->get();
        return view('global.getCidades', compact('cidades'));
    }

    public function getBairros(Request $request)
    {
        $cidade_id = $request->id;
        $bairros = Endereco::where('cidade_id','=', $cidade_id)->groupBy('bairro_endereco')->orderBy('bairro_endereco','asc')->get();

        return view('global.getBairros', compact('bairros'));
    }

    public function updateEndereco(Request $request, $id){

        $endereco = Endereco::find($id);

        if(!$endereco){
            $endereco = new Endereco(); 
        }
        $endereco->cidade_id = $request->cidade_endereco;
        $endereco->cep_endereco = Helper::limpa_campo($request->cep_endereco);
        $endereco->logradouro_endereco = $request->logradouro_endereco;
        $endereco->numero_endereco = $request->numero_endereco;
        $endereco->complemento_endereco = $request->complemento_endereco;
        $endereco->bairro_endereco = $request->bairro_endereco;
        $endereco->save();

        return $endereco;
    }

}
