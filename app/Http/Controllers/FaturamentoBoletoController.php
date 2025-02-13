<?php

namespace App\Http\Controllers;

use App\FaturamentoBoleto;
use App\Faturamento;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaturamentoBoletoController extends Controller
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
    public static function create($dadosBoleto, $faturamento)
    {

        $boleto = new FaturamentoBoleto();
        $boleto->faturamento_id = $faturamento->id;
        $boleto->data_vencimento = $dadosBoleto['data_vencimento'];
        $boleto->codigo_boleto = $dadosBoleto['id'];
        $boleto->status = $dadosBoleto['status'];
        $boleto->url_boleto = $dadosBoleto['url_boleto'];
        $boleto->valor = $faturamento->faturamentoContratos->sum('valor');

        if($boleto->save()):

            $faturamento->data_vencimento = $boleto->data_vencimento;
            $faturamento->update();
            return true;

        endif;
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
     * @param  \App\FaturamentoBoleto  $faturamentoBoleto
     * @return \Illuminate\Http\Response
     */
    public function show(FaturamentoBoleto $faturamentoBoleto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FaturamentoBoleto  $faturamentoBoleto
     * @return \Illuminate\Http\Response
     */
    public function edit(FaturamentoBoleto $faturamentoBoleto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FaturamentoBoleto  $faturamentoBoleto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FaturamentoBoleto $faturamentoBoleto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FaturamentoBoleto  $faturamentoBoleto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $boleto = FaturamentoBoleto::find($request->id);

        if($boleto->codigo_boleto_asaas){
            $DeletaCobranca = (new IntegracaoAsaasController())->CancelarCobranca($boleto->codigo_boleto_asaas);
        }

        $resp_cob = json_decode($DeletaCobranca->getBody(),true);

        if($resp_cob['id']){
            if($boleto->delete()):
                $response_array['status'] = 'success';
                echo json_encode($response_array);
            else:
                $response_array['status'] = 'error';
                echo json_encode($response_array);
            endif;
        }else{
            $response_array['status'] = 'error';
            echo json_encode($response_array);
        }
    }

    /*Método utilizado na geração automática*/
    public static function GerarBoletoAutomatico($id){
        (New FaturamentoBoleto())->gerarBoleto($id);
    }

    public function GerarBoleto(Request $request){
        (New FaturamentoBoleto())->gerarBoleto($request->id);
    }

    public function VisualizarBoleto($id){

        $Boleto = FaturamentoBoleto::find($id);

        //URL do serviço /boleto + /token
        $url = 'https://app.boletocloud.com/api/v1/boletos/'.$Boleto->codigo_boleto;

        // curl - http://php.net/manual/pt_BR/book.curl.php
        #Inicializa a sessão
        $ch = curl_init();

        //Opções relacionadas a requisição: http://php.net/manual/pt_BR/function.curl-setopt.php
        #Define a url
        curl_setopt($ch, CURLOPT_URL, $url);
        #Define o tipo de autenticação HTTP Basic
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        #Define o API Token para realizar o acesso ao serviço
        curl_setopt($ch, CURLOPT_USERPWD, "api-key_HeCKi5xqoukVnyGke8dahDzRLgDiiiuO7Azdo3lw6Xg=");
        #True para enviar o conteúdo do arquivo direto para o navegador
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        #Define que os headers estarão na resposta
        curl_setopt($ch, CURLOPT_HEADER, true);

        //Necessário para requisição HTTPS
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        #Executa a chamada
        $response = curl_exec($ch);

        #Principais meta-dados da resposta
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

        #Encerra a sessão
        curl_close($ch);

        #Separando header e body contidos na resposta
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        $header_array = explode("\r\n", $header);

        #Principais headers deste exemplo
        $boleto_cloud_version = '';

        foreach($header_array as $h) {
            if(preg_match('/X-BoletoCloud-Version:/i', $h)) {
                $boleto_cloud_version = $h;
            }
        }

        #Processando sucesso ou falha

        if($http_code == 200){#OK - SUCESSO
            #Versão da plataforma: $boleto_cloud_version
            #Enviando boleto como resposta:
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename=arquivo-api-boleto-get-teste.pdf');
            echo $body; #Visualização no navegador
        }else{//ERRO
            #Versão da plataforma: $boleto_cloud_version
            #Códgio de erro HTTP: $http_code
            #Enviando erro JSON como resposta:
            header('Content-Type: application/json; charset=utf-8');
            echo $body; #Visualização no navegador
        }

        /*
        * Para saber mais sobre tratamento de erros veja a seção Status & Erros
        **/
    }

    public function CancelarBoleto(Request $request){

        $Boleto = FaturamentoBoleto::find($request->id);

        //URL do serviço /boleto + /token
        $url = 'https://app.boletocloud.com/api/v1/boletos/'.$Boleto->codigo_boleto.'/baixa';

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => "{\"boleto\":{\"baixa\":{\"motivo\":\"Cancelamento do plano\"}}}",
        CURLOPT_USERPWD => 'api-key_HeCKi5xqoukVnyGke8dahDzRLgDiiiuO7Azdo3lw6Xg=',
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            dd($err );
            $response_array['status'] = 'error';
            echo json_encode($response_array);
        } else {
            $Boleto->status = "CANCELADO";
            $Boleto->update();
            $Boleto->delete();
            $response_array['status'] = 'success';
            echo json_encode($response_array);
        }

    }

    public function AlterarVencimentoBoleto(Request $request){

        $Boleto = FaturamentoBoleto::find($request->ModalBoleto_id);

        //URL do serviço /boleto + /token
        $url = 'https://app.boletocloud.com/api/v1/boletos/'.$Boleto->codigo_boleto.'/vencimento';

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => '{"boleto":{"vencimento":"'. $request->nova_data .'"}}',
        CURLOPT_USERPWD => 'api-key_HeCKi5xqoukVnyGke8dahDzRLgDiiiuO7Azdo3lw6Xg=',
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if($http_code == 200){
            $Boleto->data_vencimento = $request->nova_data;

            if($Boleto->update()){
                $faturamento = Faturamento::find($Boleto->id);
                $faturamento->data_vencimento = $Boleto->data_vencimento;
                $faturamento->update();
            }

            return redirect()->back()->with('success', 'Data de vencimento alterada com sucesso!');
        } else {
            return redirect()->back()->with('success', 'Não foi possível alterar a data de vencimento. Verifique os critérios para atualização.');
        }

    }

    public function GerarRemessa(){

        #Token da conta bancária cadastrada
        $fields = array(
        'remessa.conta.token'=> 'api-key_AcPcTRk_oMgFszHfxxsNd73lXoh6LKujV4MoMZ_Hn7s='
        );

        $fields_string = '';

        foreach($fields as $key=>$value) {
            if(is_array($value)){
                foreach($value as $v){
                    $fields_string .= urlencode($key).'='.urlencode($v).'&';
                }
            }else{
                $fields_string .= urlencode($key).'='.urlencode($value).'&';
            }
        }

        $data = rtrim($fields_string, '&');
        $accept_header = 'Accept: application/pdf, application/json';
        $content_type_header = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
        $headers = array($accept_header, $content_type_header);

        $url = 'https://app.boletocloud.com/api/v1/arquivos/cnab/remessas';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERPWD, "api-key_HeCKi5xqoukVnyGke8dahDzRLgDiiiuO7Azdo3lw6Xg="); #TOKEN do usuário
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);# Basic Authorization
        curl_setopt($ch, CURLOPT_HEADER, true);#Define que os headers estarÃ£o na resposta
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); #Para uso com https
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); #Para uso com https

        $response = curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

        curl_close($ch);

        $created = 201;

        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        $header_array = explode("\r\n", $header);

        $boleto_cloud_version = '';
        $boleto_cloud_token = '';
        $location = '';
        $file_name = '';

        foreach($header_array as $h) {
            if(preg_match('/X-BoletoCloud-Version:/i', $h)) {
                $boleto_cloud_version = $h;
            }
            if(preg_match('/X-BoletoCloud-Token:/i', $h)) {
                $boleto_cloud_token = $h;
            }
            if(preg_match('/Location:/i', $h)) {
                $location = $h;
            }
            if(preg_match('/Content-Disposition: .*filename=([^ ]+)/i', $h)) {
                $file_name = preg_replace('/Content-Disposition:.*filename=/i', '', $h);
            }
        }

        if($http_code == $created){

            header('Content-type: application/text');
            header('Content-Disposition: attachment; filename="'.$file_name.'"' );
            header('Content-Length: ' . strlen($body));

            echo $body;

        }else{
            header('Content-Type: application/text; charset=utf-8');
            echo "NENHUMA REMESSA DISPONÍVEL.";
        }

    }

    public function ImportarRetorno(Request $request){


        //dd($request->file('arquivo_retorno'));

        if($request->file('arquivo_retorno')):
            $upload = $request->file('arquivo_retorno')->storeAs('faturamentos', 'Retorno.CRT', 'uploads');
        endif;

        //dd($request->arquivo_retorno);
        $accept_header = 'Accept: application/json';

        #Estou enviando esse formato de dados
        $headers = array($accept_header);

        #Configurações do envio
        $url = 'https://app.boletocloud.com/api/v1/arquivos/cnab/retornos';

        $arquivo = new \CurlFile(public_path().'/uploads/'.$upload,'file/exgpd',$upload);

        $data = array(
            'arquivo' => $arquivo,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT,'Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15');
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('User-Agent: Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15','Referer: http://someaddress.tld','Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERPWD, "api-key_HeCKi5xqoukVnyGke8dahDzRLgDiiiuO7Azdo3lw6Xg="); #TOKEN do usuário
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);# Basic Authorization
        curl_setopt($ch, CURLOPT_HEADER, true);#Define que os headers estarão na resposta
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); #Para uso com https
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); #Para uso com https

        #Envio

        $response = curl_exec($ch);

        #Principais meta-dados da resposta

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

        #Fechar processo de comunicação
        curl_close($ch);

        #Processando a resposta

        $created = 201; #Constante que indica recurso criado (Retorno criado na Plataforma)

        #Separando header e body na resposta

        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        $header_array = explode("\r\n", $header);

        #Principais headers
        $boleto_cloud_version = '';
        $boleto_cloud_token = '';
        $location = '';

        foreach($header_array as $h) {
            if(preg_match('/X-BoletoCloud-Version:/i', $h)) {
                $boleto_cloud_version = $h;
            }
            if(preg_match('/X-BoletoCloud-Token:/i', $h)) {
                $boleto_cloud_token = $h;
            }
            if(preg_match('/Location:/i', $h)) {
                $location = $h;
            }
        }

        #Processando sucesso ou falha
        if($http_code == $created){
            #Versão da plataforma: $boleto_cloud_version
            #Token do boleto disponibilizado: $boleto_cloud_token
            #Localização do boleto na plataforma: $location
            #Enviando boleto como resposta:
            header('Content-Type: application/json; charset=utf-8');
            echo $body; #Visualização no navegador
            return redirect()->back()->with('success', 'O arquivo foi enviado com sucesso! Aguarde o processamento.');
        }else{
        #EM CASO DE ERRO 500 ---> LEMBRE-SE QUE É PRECISO TER UMA CONTA BANCÁRIA CADASTRADA!!
        #E COM CONVÊNIO E DADOS IGUAIS AO DA CONTA BANCÁRIA DO ARQUIVO RELACIONADO
            #Versão da plataforma: $boleto_cloud_version
            #Códgio de erro HTTP: $http_code
            #Enviando erro como resposta:
            header('Content-Type: application/json; charset=utf-8');
            echo $body; #Visualização no navegador
            return redirect()->back()->with('warning', 'O arquivo não foi processado! Contacte o administrador do sistema.');
        }

    }


    public static function CronAtualizarBoletos($dataInformada){

        if($dataInformada != "null"){
            $data = $dataInformada;
        }else{
            $data = Carbon::now()->addDay(-1)->format('Y-m-d');
        }

        //URL do serviço /boleto + /token
        $url = 'https://app.boletocloud.com/api/v1/arquivos/cnab/retornos?data='.$data.'&conta=api-key_AcPcTRk_oMgFszHfxxsNd73lXoh6LKujV4MoMZ_Hn7s=';

        // curl - http://php.net/manual/pt_BR/book.curl.php
        #Inicializa a sessão
        $ch = curl_init();

        //Opções relacionadas a requisição: http://php.net/manual/pt_BR/function.curl-setopt.php
        #Define a url
        curl_setopt($ch, CURLOPT_URL, $url);
        #Define o tipo de autenticação HTTP Basic
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        #Define o API Token para realizar o acesso ao serviço
        curl_setopt($ch, CURLOPT_USERPWD, "api-key_HeCKi5xqoukVnyGke8dahDzRLgDiiiuO7Azdo3lw6Xg=");
        #True para enviar o conteúdo do arquivo direto para o navegador
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        #Define que os headers estarão na resposta
        curl_setopt($ch, CURLOPT_HEADER, true);

        //Necessário para requisição HTTPS
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        #Executa a chamada
        $response = curl_exec($ch);

        #Principais meta-dados da resposta
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

        #Encerra a sessão
        curl_close($ch);

        #Separando header e body contidos na resposta
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        $header_array = explode("\r\n", $header);

        #Principais headers deste exemplo
        $boleto_cloud_version = '';

        foreach($header_array as $h) {
            if(preg_match('/X-BoletoCloud-Version:/i', $h)) {
                $boleto_cloud_version = $h;
            }
        }

        #Processando sucesso ou falha

        if($http_code == 200){#OK - SUCESSO
            #Versão da plataforma: $boleto_cloud_version
            #Enviando boleto como resposta:
            //header('Content-type: application/json');

            $json = json_decode($body, true);

            foreach($json["retornos"]["arquivos"] as $arquivo){

                //URL do serviço /boleto + /token
                $url = 'https://app.boletocloud.com/api/v1/arquivos/cnab/retornos/'.$arquivo["token"];

                // curl - http://php.net/manual/pt_BR/book.curl.php
                #Inicializa a sessão
                $ch = curl_init();

                //Opções relacionadas a requisição: http://php.net/manual/pt_BR/function.curl-setopt.php
                #Define a url
                curl_setopt($ch, CURLOPT_URL, $url);
                #Define o tipo de autenticação HTTP Basic
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                #Define o API Token para realizar o acesso ao serviço
                curl_setopt($ch, CURLOPT_USERPWD, "api-key_HeCKi5xqoukVnyGke8dahDzRLgDiiiuO7Azdo3lw6Xg=");
                #True para enviar o conteúdo do arquivo direto para o navegador
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                #Define que os headers estarão na resposta
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
                //Necessário para requisição HTTPS
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                #Executa a chamada
                $response = curl_exec($ch);

                #Principais meta-dados da resposta
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

                #Encerra a sessão
                curl_close($ch);

                #Separando header e body contidos na resposta
                $header = substr($response, 0, $header_size);
                $body = substr($response, $header_size);
                $header_array = explode("\r\n", $header);


                if($http_code == 200){#OK - SUCESSO
                    header('Accept: application/json;');
                    $json = json_decode($body);

                    foreach($json->arquivo->titulos as $titulo){

                        foreach($titulo->ocorrencias as $ocorrencia){

                            echo $ocorrencia->situacao."<br/>";
                            echo $ocorrencia->info->valorPago ?? null;
                            echo "<br/>".$titulo->token."<br/><br/>";
                            echo $ocorrencia->info->dataDeCredito ?? null;
                            
                            $data_pagamento = $ocorrencia->info->dataDeCredito ?? null;

                            if(isset($titulo->token)){

                                $FaturamentoBoleto = FaturamentoBoleto::where('codigo_boleto', $titulo->token)->first();

                                $boleto = FaturamentoBoleto::findOrFail($FaturamentoBoleto->id);
                                $boleto->status = $ocorrencia->situacao;
                                $boleto->valor_pago = $ocorrencia->info->valorPago ?? null;
                                $boleto->valor_juros = $ocorrencia->info->jurosMora ?? null;
                                $boleto->data_pagamento = $data_pagamento;
                                $boleto->save();

                                if($ocorrencia->situacao == 'LIQUIDACAO'){
                                    //Informa Pagamento
                                    Faturamento::InformarPagamento($FaturamentoBoleto->faturamento_id,$data_pagamento, 'Boleto');
                                }

                            }
                            
                        }
                    }

                    echo "Boletos Atualizados"; #Visualização no navegador
                }else{
                    header('Content-Type: application/json; charset=utf-8');
                    echo $body; #Visualização no navegador
                }

            }

        }else{//ERRO
            #Versão da plataforma: $boleto_cloud_version
            #Códgio de erro HTTP: $http_code
            #Enviando erro JSON como resposta:
            header('Content-Type: application/json; charset=utf-8');
            echo $body; #Visualização no navegador
        }

        /*
        * Para saber mais sobre tratamento de erros veja a seção Status & Erros
        **/
    }


    public function AtualizarBoletos(){

        $boletos = FaturamentoBoleto::where('status','<>','LIQUIDACAO')->get()->random(1);

        foreach($boletos as $boleto){
            //URL do serviço /boleto + /token
            $url = 'https://app.boletocloud.com/api/v1/arquivos/cnab/retornos/'.$boleto->codigo_boleto;

            // curl - http://php.net/manual/pt_BR/book.curl.php
            #Inicializa a sessão
            $ch = curl_init();

            //Opções relacionadas a requisição: http://php.net/manual/pt_BR/function.curl-setopt.php
            #Define a url
            curl_setopt($ch, CURLOPT_URL, $url);
            #Define o tipo de autenticação HTTP Basic
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            #Define o API Token para realizar o acesso ao serviço
            curl_setopt($ch, CURLOPT_USERPWD, "api-key_HeCKi5xqoukVnyGke8dahDzRLgDiiiuO7Azdo3lw6Xg=");
            #True para enviar o conteúdo do arquivo direto para o navegador
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            #Define que os headers estarão na resposta
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
            //Necessário para requisição HTTPS
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            #Executa a chamada
            $response = curl_exec($ch);

            #Principais meta-dados da resposta
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

            #Encerra a sessão
            curl_close($ch);

            #Separando header e body contidos na resposta
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            $header_array = explode("\r\n", $header);

            if($http_code == 200){#OK - SUCESSO
                header('Accept: application/json;');
                $json = json_decode($body);
                foreach($json->arquivo->titulos as $titulo){
                    foreach($titulo->ocorrencias as $ocorrencia){
                        echo $ocorrencia->situacao."<br/>";
                        echo $ocorrencia->info->valorPago ?? null;
                        echo $ocorrencia->info->jurosMora ?? null;

                        $data_pagamento = strtotime($ocorrencia->info->dataDeCredito ?? null);

                        $boleto = FaturamentoBoleto::findOrFail($boleto->id);
                        $boleto->status = $ocorrencia->situacao;
                        $boleto->valor_pago = $ocorrencia->info->valorPago ?? null;
                        $boleto->valor_juros = $ocorrencia->info->jurosMora ?? null;
                        $boleto->save();

                        if($ocorrencia->situacao == 'LIQUIDACAO'){
                        Faturamento::InformarPagamento($boleto->faturamento_id,$data_pagamento, 'Boleto');
                        }

                    }
                }
            }else{
                header('Content-Type: application/json; charset=utf-8');
                dd($body);
            }
        }


    }

    public function AtualizarBoletosGeral(){

        $boletos = FaturamentoBoleto::all()->random(1);

        foreach($boletos as $boleto){
            //URL do serviço /boleto + /token
            $url = 'https://app.boletocloud.com/api/v1/arquivos/cnab/retornos/'.$boleto->codigo_boleto;

            // curl - http://php.net/manual/pt_BR/book.curl.php
            #Inicializa a sessão
            $ch = curl_init();

            //Opções relacionadas a requisição: http://php.net/manual/pt_BR/function.curl-setopt.php
            #Define a url
            curl_setopt($ch, CURLOPT_URL, $url);
            #Define o tipo de autenticação HTTP Basic
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            #Define o API Token para realizar o acesso ao serviço
            curl_setopt($ch, CURLOPT_USERPWD, "api-key_HeCKi5xqoukVnyGke8dahDzRLgDiiiuO7Azdo3lw6Xg=");
            #True para enviar o conteúdo do arquivo direto para o navegador
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            #Define que os headers estarão na resposta
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
            //Necessário para requisição HTTPS
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            #Executa a chamada
            $response = curl_exec($ch);

            #Principais meta-dados da resposta
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

            #Encerra a sessão
            curl_close($ch);

            #Separando header e body contidos na resposta
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            $header_array = explode("\r\n", $header);


            if($http_code == 200){#OK - SUCESSO
                header('Accept: application/json;');
                $json = json_decode($body);
                foreach($json->arquivo->titulos as $titulo){
                    foreach($titulo->ocorrencias as $ocorrencia){
                        echo $ocorrencia->situacao."<br/>";
                        echo $ocorrencia->info->valorPago ?? null;
                        echo $ocorrencia->info->jurosMora ?? null;

                        $boleto = FaturamentoBoleto::findOrFail($boleto->id);
                        $boleto->status = $ocorrencia->situacao;
                        $boleto->valor_pago = $ocorrencia->info->valorPago ?? null;
                        $boleto->valor_juros = $ocorrencia->info->jurosMora ?? null;
                        $boleto->save();

                        $data_pagamento = strtotime($ocorrencia->info->dataDeCredito ?? null);

                        if($ocorrencia->situacao == 'LIQUIDACAO'){
                        Faturamento::InformarPagamento($boleto->faturamento_id,$data_pagamento, 'Boleto');
                        }

                    }
                }
            }else{
                header('Content-Type: application/json; charset=utf-8');
                echo json_decode($body); #Visualização no navegador
            }
        }

    }

}
