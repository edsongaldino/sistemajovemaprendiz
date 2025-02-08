<?php

namespace App\Http\Controllers;

include_once(base_path() . '/vendor/enotas/php-client/src/eNotasGW.php');

use App\Helpers\Helper;
use App\Faturamento;
use App\FaturamentoNF;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use eNotasGW;
use eNotasGW\Api\Exceptions as Exceptions;

class FaturamentoNFController extends Controller
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

    public function client(){
        if(env('APP_ENV') == 'local'){
            $client = new Client(['verify' => 'C:\Program Files\Common Files\SSL\cert.pem']);
        }else{
            $client = new Client();
        }
        return $client;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create($dadosNF, $faturamento)
    {
        $nf = new FaturamentoNF();
        $nf->faturamento_id = $faturamento->id;
        $nf->codigo_nf = $dadosNF['id'];
        $nf->chave_interna = $dadosNF['chave_interna'];
        $nf->status = $dadosNF['status'];

        if($nf->save()):
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
     * @param  \App\FaturamentoNF  $faturamentoNF
     * @return \Illuminate\Http\Response
     */
    public function show(FaturamentoNF $faturamentoNF)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FaturamentoNF  $faturamentoNF
     * @return \Illuminate\Http\Response
     */
    public function edit(FaturamentoNF $faturamentoNF)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FaturamentoNF  $faturamentoNF
     * @return \Illuminate\Http\Response
     */
    public function update($id, $dadosNF)
    {
        $notafiscal = FaturamentoNF::find($id);
        $notafiscal->status = $dadosNF['status'];
        $notafiscal->link_pdf = $dadosNF['link_pdf'];
        $notafiscal->link_xml = $dadosNF['link_xml'];
        $notafiscal->numero_rps = $dadosNF['numero_rps'];
        $notafiscal->numero_nf = $dadosNF['numero_nf'];
        $notafiscal->data_emissao = Helper::data_mysql(Helper::datetime_br($dadosNF['data_emissao']));
        if($notafiscal->save()):
            return true;
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FaturamentoNF  $faturamentoNF
     * @return \Illuminate\Http\Response
     */
    public function destroy(FaturamentoNF $faturamentoNF)
    {
        //
    }

    /*Método utilizado na geração automática*/
    public static function EmitirNFAutomatico($id){
        (New FaturamentoNF())->EmitirNF($id);
    }

    public function EmitirNotaFiscal(Request $request){
        (New FaturamentoNF())->EmitirNF($request->id);
    }

    public function VisualizarNotaFiscal($nfeId){

        header('Content-Type: text/html; charset=utf-8');

        $enotas = new eNotasGW;

        $enotas::configure(array(
            'apiKey' => 'ZWJkNzM3YTQtZjhiNC00Zjc5LTkxZDgtMjZhYTIzZWYwODAw'
        ));

        $empresaId = '76D51A32-28E4-4B24-B416-7D1159FA0800';

        try
        {
            $pdf = eNotasGW::$NFeApi->downloadPdf($empresaId, $nfeId);

            /*
            descomentar para efetuar o download pelo id externo

            $idExterno = '1';
            $pdf = eNotasGW::$NFeApi->downloadPdfPorIdExterno($empresaId, $idExterno);

            */

            $folder = base_path() . "/public/uploads/faturamentos/NotasFiscais";

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $pdfFileName = "{$folder}/NF-{$nfeId}.pdf";
            file_put_contents($pdfFileName, $pdf);
            echo "Download do pdf, arquivo salvo em \"{$pdfFileName}\"";
        }
        catch(Exceptions\invalidApiKeyException $ex) {
            echo 'Erro de autenticação: </br></br>';
            echo $ex->getMessage();
        }
        catch(Exceptions\unauthorizedException $ex) {
            echo 'Acesso negado: </br></br>';
            echo $ex->getMessage();
        }
        catch(Exceptions\apiException $ex) {
            echo 'Erro de validação: </br></br>';
            echo $ex->getMessage();
        }
        catch(Exceptions\requestException $ex) {
            echo 'Erro na requisição web: </br></br>';

            echo 'Requested url: ' . $ex->requestedUrl;
            echo '</br>';
            echo 'Response Code: ' . $ex->getCode();
            echo '</br>';
            echo 'Message: ' . $ex->getMessage();
            echo '</br>';
            echo 'Response Body: ' . $ex->responseBody;
        }

    }


    public function CancelarNotaFiscal(Request $request){

        $notafiscal = FaturamentoNF::find($request->id);

        header('Content-Type: text/html; charset=utf-8');

        $enotas = new eNotasGW;

        $enotas::configure(array(
            'apiKey' => 'ZWJkNzM3YTQtZjhiNC00Zjc5LTkxZDgtMjZhYTIzZWYwODAw'
        ));

        $empresaId = '76D51A32-28E4-4B24-B416-7D1159FA0800';

        try
            {
            eNotasGW::$NFeApi->cancelar($empresaId, $notafiscal->codigo_nf);

            /*
            descomentar caso não possua o id único e queira efetuar o cancelamento pelo id externo

            $idExterno = '1';
            eNotasGW::$NFeApi->cancelarPorIdExterno($empresaId, $idExterno);

            */

            $dadosNF['status'] = 'Cancelamento Solicitado';
            $AtualizarNF = $this->update($notafiscal->id, $dadosNF);

            if($AtualizarNF){
                $response_array['status'] = 'success';
                $response_array['message'] = 'NF Cancelada com sucesso!';
                echo json_encode($response_array);
            }else{
                $response_array['status'] = 'error';
                $response_array['message'] = 'Não foi possível remover a NF do banco';
                echo json_encode($response_array);
            }

        }
        catch(Exceptions\invalidApiKeyException $ex) {
            $response_array['status'] = 'error';
            $response_array['message'] = 'Erro de autenticação: '.$ex->getMessage();
            echo json_encode($response_array);
        }
        catch(Exceptions\unauthorizedException $ex) {
            $response_array['status'] = 'error';
            $response_array['message'] = 'Acesso negado: '.$ex->getMessage();
            echo json_encode($response_array);
        }
        catch(Exceptions\apiException $ex) {
            $response_array['status'] = 'error';
            $response_array['message'] = 'Erro de validação:: '.$ex->getMessage();
            echo json_encode($response_array);
        }
        catch(Exceptions\requestException $ex) {
            $response_array['status'] = 'error';
            $response_array['message'] = 'Erro na requisição web: '.$ex->getMessage();
            echo json_encode($response_array);
        }

    }

    public function AtualizarNotaFiscal(){

        $notas = FaturamentoNF::where('status', '<>', 'Autorizada')->where('status', '<>', 'Cancelada')->get();

        foreach($notas as $notafiscal){
            header('Content-Type: text/html; charset=utf-8');

            $enotas = new eNotasGW;

            $enotas::configure(array(
                'apiKey' => 'ZWJkNzM3YTQtZjhiNC00Zjc5LTkxZDgtMjZhYTIzZWYwODAw'
            ));

            $empresaId = '76D51A32-28E4-4B24-B416-7D1159FA0800';

            try
            {
                $dadosNFe = eNotasGW::$NFeApi->consultar($empresaId, $notafiscal->codigo_nf);
                $dadosNF['status'] = $dadosNFe->status;
                $dadosNF['link_pdf'] = $dadosNFe->linkDownloadPDF ?? '';
                $dadosNF['link_xml'] = $dadosNFe->linkDownloadXML ?? '';
                $dadosNF['numero_rps'] = $dadosNFe->numeroRps ?? '';
                $dadosNF['numero_nf'] = $dadosNFe->numero ?? '';
                $dadosNF['data_emissao'] = $dadosNFe->dataAutorizacao ?? '';
                $AtualizarNF = $this->update($notafiscal->id, $dadosNF);

                if($AtualizarNF){
                    $response_array['status'] = 'success';
                    echo json_encode($response_array);
                }else{
                    $response_array['status'] = 'error';
                    echo json_encode($response_array);
                }

            }
            catch(Exceptions\invalidApiKeyException $ex) {
                echo 'Erro de autenticação: </br></br>';
                echo $ex->getMessage();
            }
            catch(Exceptions\unauthorizedException $ex) {
                echo 'Acesso negado: </br></br>';
                echo $ex->getMessage();
            }
            catch(Exceptions\apiException $ex) {
                echo 'Erro de validação: </br></br>';
                echo $ex->getMessage();
            }
            catch(Exceptions\requestException $ex) {
                echo 'Erro na requisição web: </br></br>';

                echo 'Requested url: ' . $ex->requestedUrl;
                echo '</br>';
                echo 'Response Code: ' . $ex->getCode();
                echo '</br>';
                echo 'Message: ' . $ex->getMessage();
                echo '</br>';
                echo 'Response Body: ' . $ex->responseBody;
            }
        }

    }

    public function ConsultarNotaFiscal($nfeId){

        $notafiscal = FaturamentoNF::where('codigo_nf', $nfeId)->first();

        header('Content-Type: text/html; charset=utf-8');

        $enotas = new eNotasGW;

        $enotas::configure(array(
            'apiKey' => 'ZWJkNzM3YTQtZjhiNC00Zjc5LTkxZDgtMjZhYTIzZWYwODAw'
        ));

        $empresaId = '76D51A32-28E4-4B24-B416-7D1159FA0800';

        try
        {
            $dadosNFe = eNotasGW::$NFeApi->consultar($empresaId, $notafiscal->codigo_nf);

            $dadosNF['status'] = $dadosNFe->status;
            $dadosNF['link_pdf'] = $dadosNFe->linkDownloadPDF ?? '';
            $dadosNF['link_xml'] = $dadosNFe->linkDownloadXML ?? '';
            $dadosNF['numero_rps'] = $dadosNFe->numeroRps ?? '';
            $dadosNF['numero_nf'] = $dadosNFe->numero ?? '';
            $dadosNF['data_emissao'] = $dadosNFe->dataAutorizacao ?? '';
            $AtualizarNF = $this->update($notafiscal->id, $dadosNF);

            if($AtualizarNF){
                $response_array['status'] = 'success';
                echo json_encode($response_array);
            }else{
                $response_array['status'] = 'error';
                echo json_encode($response_array);
            }

        }
        catch(Exceptions\invalidApiKeyException $ex) {
            echo 'Erro de autenticação: </br></br>';
            echo $ex->getMessage();
        }
        catch(Exceptions\unauthorizedException $ex) {
            echo 'Acesso negado: </br></br>';
            echo $ex->getMessage();
        }
        catch(Exceptions\apiException $ex) {
            echo 'Erro de validação: </br></br>';
            echo $ex->getMessage();
        }
        catch(Exceptions\requestException $ex) {
            echo 'Erro na requisição web: </br></br>';

            echo 'Requested url: ' . $ex->requestedUrl;
            echo '</br>';
            echo 'Response Code: ' . $ex->getCode();
            echo '</br>';
            echo 'Message: ' . $ex->getMessage();
            echo '</br>';
            echo 'Response Body: ' . $ex->responseBody;
        }

    }

}
