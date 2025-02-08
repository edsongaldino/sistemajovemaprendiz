<?php

namespace App;

use App\Helpers\Helper;
use App\Http\Controllers\FaturamentoNFController;
use eNotasGW;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use eNotasGW\Api\Exceptions as Exceptions;

class FaturamentoNF extends Model
{
    protected $table = 'faturamento_nf';
    use SoftDeletes;

    public function EmitirNF($id){

        $faturamento = Faturamento::find($id);

        header('Content-Type: text/html; charset=utf-8');

        $enotas = new eNotasGW;

        $enotas::configure(array(
            'apiKey' => 'ZWJkNzM3YTQtZjhiNC00Zjc5LTkxZDgtMjZhYTIzZWYwODAw'
        ));

        $empresaId = '76D51A32-28E4-4B24-B416-7D1159FA0800';
        $idExterno = uniqid($faturamento->id);
        $texto_pedido = "";
        $texto_dadosbancarios= "";

        if(isset($faturamento->numero_pedido)){
            $texto_pedido = " Nº DO PEDIDO: " . $faturamento->numero_pedido;
        }

        if(isset($faturamento->dados_bancarios)){
            $texto_dadosbancarios = " " . $faturamento->dados_bancarios;
        }   
        
        if($faturamento->convenio->empresa->tipo_cadastro == 'CNPJ'){
            $cpfCnpj = $faturamento->convenio->empresa->cnpj;
            $nome = $faturamento->convenio->empresa->razao_social;
            $tipoPessoa = 'J';
        }else{
            $cpfCnpj = $faturamento->convenio->empresa->cpf;
            $nome = $faturamento->convenio->empresa->nome_fantasia;
            $tipoPessoa = 'F';
        }

        try
        {
            $nfeId = $enotas::$NFeApi->emitir($empresaId, array(
                'tipo' => 'NFS-e',
                'idExterno' => $idExterno,
                'ambienteEmissao' => 'Producao', //'Homologacao' ou 'Producao'
                'cliente' => array(
                    'nome' => $nome,
                    'email' => $faturamento->convenio->empresa->email_responsavel,
                    'cpfCnpj' => $cpfCnpj,
                    'tipoPessoa' => $tipoPessoa, //F - pessoa física | J - pessoa jurídica
                    'endereco' => array(
                        'uf' => $faturamento->convenio->empresa->endereco->cidade->estado->uf_estado,
                        'cidade' => $faturamento->convenio->empresa->endereco->cidade->nome_cidade,
                        'logradouro' => $faturamento->convenio->empresa->endereco->logradouro_endereco,
                        'numero' => $faturamento->convenio->empresa->endereco->numero_endereco,
                        'complemento' => $faturamento->convenio->empresa->endereco->complemento_endereco,
                        'bairro' => $faturamento->convenio->empresa->endereco->bairro_endereco,
                        'cep' => $faturamento->convenio->empresa->endereco->cep_endereco
                    ),
                    'inscricaoMunicipal' => $faturamento->convenio->empresa->inscricao_municipal,
                    'inscricaoEstadual' => $faturamento->convenio->empresa->inscricao_estadual
                ),
                'servico' => array(
                    'descricao' => 'DESPESAS REFERENTE A CAPACITACAO DE '.$faturamento->faturamentoContratos->count().' JOVENS APRENDIZ CONFORME CLAUSULA 4, PARAGRAFO 2 E CLAUSULAS 6 E 7 DO CONVENIO. NOTA FISCAL REFERENTE AO MES DE '.strtoupper(Helper::ParteData($faturamento->data_final,'mes')).'/'.Helper::ParteData($faturamento->data_final,'ano').''.$texto_pedido.$texto_dadosbancarios,
                    'aliquotaIss' => 0,
                    'issRetidoFonte' => false,
                    'cnae' => '8800600',
                    'codigoServicoMunicipio' => '2701',
                    'descricaoServicoMunicipio' => 'SERVIÇOS DE ASSISTÊNCIA SOCIAL SEM ALOJAMENTO',
                    'itemListaServicoLC116' => '2701',
                    //'ufPrestacaoServico' => 'string',
                    'municipioPrestacaoServico' => '5102678'
                    /*
                    'valorCofins' => 0,
                    'valorCsll' => 0,
                    'valorInss' => 0,
                    'valorIr' => 0,
                    'valorPis' => 0
                    */
                ),
                'naturezaOperacao' => '5',
                //Fazer a soma do valor total + ISSQN
                'valorTotal' => Helper::GetValorTotalFaturado($faturamento->id)
            ));

            $dadosNF['id'] = $nfeId;
            $dadosNF['chave_interna'] = $idExterno;
            $dadosNF['status'] = 'Aguardando Emissão';
            
            (New FaturamentoNFController())->create($dadosNF, $faturamento);

            //Calcula data de vencimento do faturamento
            if($faturamento->forma_pagamento == "Depósito"){
                $data_vencimento = Helper::GetDataVencimentoFaturamento($faturamento); 
                $faturamento->data_vencimento = $data_vencimento;
                $faturamento->save();
            }  
            
            if(isset($nfeId)){
                $faturamento->etapa_faturamento = 'Boleto';
                $faturamento->save();
            }

            $response_array['status'] = 'success';
            $response_array['message'] = 'NF emitida com sucesso!';
            echo json_encode($response_array);

        }
        catch(Exceptions\invalidApiKeyException $ex) {
            $response_array['status'] = 'error';
            $response_array['message'] = $ex->getMessage();
            echo json_encode($response_array);
        }
        catch(Exceptions\unauthorizedException $ex) {
            $response_array['status'] = 'error';
            $response_array['message'] = $ex->getMessage();
            echo json_encode($response_array);
        }
        catch(Exceptions\apiException $ex) {
            $response_array['status'] = 'error';
            $response_array['message'] = $ex->getMessage();
            echo json_encode($response_array);
        }
        catch(Exceptions\requestException $ex) {

            $response_array['status'] = 'error';
            $response_array['message'] = $ex->getMessage();
            echo json_encode($response_array);

            /*
            echo 'Erro na requisição web: </br></br>';

            echo 'Requested url: ' . $ex->requestedUrl;
            echo '</br>';
            echo 'Response Code: ' . $ex->getCode();
            echo '</br>';
            echo 'Message: ' . $ex->getMessage();
            echo '</br>';
            echo 'Response Body: ' . $ex->responseBody;
            */
        }

    }
}
