<?php

namespace App;

use App\Helpers\Helper;
use App\Http\Controllers\FaturamentoBoletoController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaturamentoBoleto extends Model
{
    protected $table = 'faturamento_boletos';
    use SoftDeletes;
    protected $fillable = [
        'faturamento_id',
        'data_vencimento',
        'data_pagamento',
        'codigo_boleto',
        'status'
    ];

    public function gerarBoleto($id){

        $faturamento = Faturamento::find($id);

        //Calcula data de vencimento do boleto
        $data_vencimento = Helper::GetDataVencimentoFaturamento($faturamento);

        if($faturamento->convenio->empresa->tipo_cadastro == 'CNPJ'){
            $cpfCnpj = $faturamento->convenio->empresa->cnpj;
            $nome = $faturamento->convenio->empresa->razao_social;
        }else{
            $cpfCnpj = $faturamento->convenio->empresa->cpf;
            $nome = $faturamento->convenio->empresa->nome_fantasia;
        }

            #Dados do boleto
            $fields = array(
            'boleto.conta.token'=> 'api-key_AcPcTRk_oMgFszHfxxsNd73lXoh6LKujV4MoMZ_Hn7s=',
            'boleto.emissao'=> date("Y-m-d"),
            'boleto.vencimento'=> date('Y-m-d', strtotime($data_vencimento)),
            'boleto.documento'=> $faturamento->id,
            'boleto.titulo'=> 'DM',
            'boleto.valor'=> Helper::converte_reais_to_mysql(Helper::converte_valor_real(Helper::GetValorTotalFaturado($faturamento->id))),
            'boleto.pagador.nome'=> $nome,
            'boleto.pagador.cprf'=> $cpfCnpj,
            'boleto.pagador.endereco.cep'=> substr($faturamento->convenio->empresa->endereco->cep_endereco ?? '', 0, 5) . '-' . substr($faturamento->convenio->empresa->endereco->cep_endereco ?? '', 5, 3),
            'boleto.pagador.endereco.uf'=> $faturamento->convenio->empresa->endereco->cidade->estado->uf_estado ?? '',
            'boleto.pagador.endereco.localidade'=> $faturamento->convenio->empresa->endereco->cidade->nome_cidade ?? '',
            'boleto.pagador.endereco.bairro'=> $faturamento->convenio->empresa->endereco->bairro_endereco ?? '',
            'boleto.pagador.endereco.logradouro'=> $faturamento->convenio->empresa->endereco->logradouro_endereco ?? '',
            'boleto.pagador.endereco.numero'=> $faturamento->convenio->empresa->endereco->numero_endereco ?? '',
            'boleto.pagador.endereco.complemento'=> $faturamento->convenio->empresa->endereco->complemento_endereco ?? '',
            'boleto.instrucao'=> array(
                                        '*O DEPOSITO NAO QUITA ESTE BOLETO*',
                                        'BOLETO REFERENTE AO PERÍODO '.strtoupper(Helper::ParteData($faturamento->data_final,'mes')).'/'.Helper::ParteData($faturamento->data_final,'ano'),
                                        'COBRANÇA REFERENTE À NOTA FISCAL DE Nº ' . $faturamento->notaFiscal->numero_nf
                                )
            );
            //NOTA '.$faturamento->notaFiscal->id ?? '0'.'
            #Aplicando formato de formulário

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

            #Definindo conteúdo da requisição e tipos de respostas aceitas

            #Pode responder com o boleto ou mensagem de erro
            $accept_header = 'Accept: application/pdf, application/json';

            #Estou enviando esse formato de dados
            $content_type_header = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';

            $headers = array($accept_header, $content_type_header);

            #Configurações do envio

            $url = 'https://app.boletocloud.com/api/v1/boletos';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_USERPWD, "api-key_HeCKi5xqoukVnyGke8dahDzRLgDiiiuO7Azdo3lw6Xg="); #API TOKEN
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

            $created = 201; #Constante que indica recurso criado (Boleto Criado)

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
                    $token = explode(":", $h);
                    $boleto_cloud_token = trim($token[1]);
                }
                if(preg_match('/Location:/i', $h)) {
                    $url = explode(":", $h);
                    $location = trim($url[1]);
                }
            }

            #Processando sucesso ou falha

            if($http_code == $created){
                #Versão da plataforma: $boleto_cloud_version
                #Token do boleto disponibilizado: $boleto_cloud_token
                #Localização do boleto na plataforma: $location
                #Enviando boleto como resposta:
                //header('Content-type: application/pdf');
                //header('Content-Disposition: inline; filename=arquivo-api-boleto-post-teste.pdf');
                //echo $body; #Visualização no navegador

                $dadosBoleto['id'] = $boleto_cloud_token;
                $dadosBoleto['status'] = 'Emitido';
                $dadosBoleto['url_boleto'] = $location;
                $dadosBoleto['data_vencimento'] = $data_vencimento;

                $boleto = (New FaturamentoBoletoController())->create($dadosBoleto, $faturamento);

                if($boleto){

                    $faturamento->etapa_faturamento = 'Envio Faturamento';
                    $faturamento->save();
                    $response_array['status'] = 'success';
                    echo json_encode($response_array);

                }else{
                    $response_array['status'] = 'error';
                    echo json_encode($response_array);
                }

            }else{
                #Versão da plataforma: $boleto_cloud_version
                #Códgio de erro HTTP: $http_code
                #Enviando erro como resposta:
                dd($body);
                header('Content-Type: application/json; charset=utf-8');
                echo $body; #Visualização no navegador
            }

            /*
            * Para saber mais sobre tratamento de erros veja a seção Status & Erros
            **/
    }

}
