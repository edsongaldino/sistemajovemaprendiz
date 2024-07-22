<?php
namespace App\Http\Controllers;

use App\EstoqueProduto;
use App\Http\Controllers\Controller;
use CodePhix\Asaas\Asaas;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EstoqueProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = EstoqueProduto::all();
        return view('sistema.estoque.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sistema.estoque.adicionar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produto = new EstoqueProduto();
        $produto->estoque_id = 1;
        $produto->tipo = $request->tipo;
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->categoria = $request->categoria;
        $produto->tamanho_uniforme = $request->tamanho_uniforme;
        $produto->save();

        return redirect()->route('sistema.estoque')->with('success', 'Dados Cadastrados!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EstoqueProduto  $estoqueProduto
     * @return \Illuminate\Http\Response
     */
    public function show(EstoqueProduto $estoqueProduto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EstoqueProduto  $estoqueProduto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = EstoqueProduto::find($id);
        return view('sistema.estoque.editar', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EstoqueProduto  $estoqueProduto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $produto = EstoqueProduto::findOrFail($request->id);
        $produto->tipo = $request->tipo;
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->categoria = $request->categoria;
        $produto->tamanho_uniforme = $request->tamanho_uniforme;
        $produto->save();

        return redirect()->route('sistema.estoque')->with('success', 'Dados Atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EstoqueProduto  $estoqueProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstoqueProduto $estoqueProduto)
    {
        //
    }

    public function clientes(){

        $response = Http::get('https://www.asaas.com/api/v3/customers', [
            'Content-Type' => 'application/json',
            'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAyMDAxMTM6OiRhYWNoX2E0ZTI3MDNhLWFiNjAtNDQ0OC1iODhlLTY5ZTUzMGJlZGYyZg==',
        ]);
        $quizzes = json_decode($response->body());

        dd($quizzes);

    }

    public function clientesSSL(){

        $client  = new \GuzzleHttp\Client(['verify' =>false]); //ssl verifyication
        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://jsonplaceholder.typicode.com/posts');
        $promise = $client->sendAsync($request)->then(function ($response) {
            $sd=$response->getBody()->getContents();
            $datas=json_decode($sd);
            return response()->json($datas);
            // return view('show',compact('datas'));
        });
        return $promise->wait();

    }

    public function NovoCliente(){

        $client = new Client();
        $res = $client->request('POST', "https://www.asaas.com/api/v3/customers", [
            'json' => [
                "name" => "Marcelo Almeida",
                "email" => "marcelo.almeida@gmail.com",
                "phone" => "4738010919",
                "mobilePhone" => "4799376637",
                "cpfCnpj" => "24971563792",
                "postalCode" => "01310-000",
                "address" => "Av. Paulista",
                "addressNumber" => "150",
                "complement" => "Sala 201",
                "province" => "Centro",
                "externalReference" => "12987382",
                "notificationDisabled" => false,
                "additionalEmails" => "marcelo.almeida2@gmail.com,marcelo.almeida3@gmail.com",
                "municipalInscription" => "46683695908",
                "stateInscription" => "646681195275",
                "observations" => "ótimo pagador, nenhum problema até o momento"

            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAyMDAxMTM6OiRhYWNoX2E0ZTI3MDNhLWFiNjAtNDQ0OC1iODhlLTY5ZTUzMGJlZGYyZg==',
            ]
        ]);

        dd($res);

    }

    public function NovaCobranca(){

        $client = new Client();
        $res = $client->request('POST', "https://www.asaas.com/api/v3/payments", [
            'json' => [
                "customer" => "37819749",
                "billingType" => "BOLETO",
                "dueDate" => "2022-09-10",
                "value" => 100,
                "description" => "Pedido 056984",
                "externalReference" => "056984",
                "discount" => [
                    "value" => 10,
                    "dueDateLimitDays" => 0
                ],
                "fine" => [
                    "value" => 1
                ],
                "interest" => [
                    "value" => 2
                ],
                "postalService" => false

            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAyMDAxMTM6OiRhYWNoX2E0ZTI3MDNhLWFiNjAtNDQ0OC1iODhlLTY5ZTUzMGJlZGYyZg==',
            ]
        ]);

        dd($res);

    }

}
