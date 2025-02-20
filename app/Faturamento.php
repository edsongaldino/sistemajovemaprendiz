<?php

namespace App;

use App\Helpers\Helper;
use App\Mail\EmailFaturamento;
use App\Mail\EmailFaturamentoAnexo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Faturamento extends Model
{
    protected $table = 'faturamentos';

    public static function informarPagamento($faturamento_id, $data_pagamento, $forma_pagamento){

        $Faturamento = Faturamento::find($faturamento_id);
        $Faturamento->forma_pagamento = $forma_pagamento;
        $Faturamento->data_pagamento = $data_pagamento;
        $Faturamento->situacao_pagamento = 'Liquidado';
        $Faturamento->update();

        return $Faturamento;
    }

    public function FaturarConvenio($convenio, $data_inicial, $data_final){

        if(isset(Auth::user()->id)){
            $user_id = Auth::user()->id;
        }else{
            $user_id = 1;
        }

        $Faturamento = new Faturamento();
        $Faturamento->user_id = $user_id;
        $Faturamento->convenio_id = $convenio->id;
        $Faturamento->data = Carbon::now();
        $Faturamento->data_inicial = $data_inicial;
        $Faturamento->data_final = $data_final;
        $Faturamento->forma_pagamento = $convenio->forma_pagamento;

        if($Faturamento->save()){
            return $Faturamento;
        }else{
            return false;
        }

    }

    public function EnviaEmail($faturamento_id, $tipo_envio){

        $faturamento = Faturamento::find($faturamento_id);
        $data_atual = Carbon::now()->format('d/m/Y H:i');
        $EmailDestinatario = EmpresaContato::where('Setor','FINANCEIRO')->where('empresa_id',$faturamento->convenio->empresa_id)->get();

        if($EmailDestinatario->count() < 1){
            return response()->json(array('status'=>'error', 'msg'=>"Nenhum e-mail cadastrado para esse cliente!"), 200);
        }

        if($faturamento->convenio->empresa->tipo_cadastro == 'CNPJ'){
            $cpfCnpj = $faturamento->convenio->empresa->cnpj;
            $nome = $faturamento->convenio->empresa->razao_social;
        }else{
            $cpfCnpj = $faturamento->convenio->empresa->cpf;
            $nome = $faturamento->convenio->empresa->nome_fantasia;
        }

        $assunto = "RELATÓRIO DE FATURAMENTO - " . strtoupper($nome) . " - " . strtoupper($faturamento->convenio->empresa->endereco->cidade->nome_cidade) . " (" . $faturamento->convenio->empresa->endereco->cidade->estado->uf_estado . ") " . strtoupper(Helper::ParteData($faturamento->data_inicial, 'mes'))."/".Helper::ParteData($faturamento->data_inicial, 'ano');
        $faturamento->etapa_faturamento = 'Envio Faturamento';
        $tipo_notificacao = "Relatório";
        $fileUrls = [];


        if($tipo_envio == "boleto-nf"){
            $assunto = "NFS E BOLETO - " . strtoupper($nome) . " " . strtoupper($faturamento->convenio->empresa->endereco->cidade->nome_cidade) . " (" . $faturamento->convenio->empresa->endereco->cidade->estado->uf_estado . ") " . strtoupper(Helper::ParteData($faturamento->data_inicial, 'mes'))."/".Helper::ParteData($faturamento->data_inicial, 'ano');
            $faturamento->etapa_faturamento = 'Finalizado';
            $tipo_notificacao = "Emissão";

            $fileUrls[] = ['pdf','PDF_Nota_' . $faturamento->notaFiscal->numero_nf,$faturamento->notaFiscal->link_pdf];
            $fileUrls[] = ['xml','XML_Nota_' . $faturamento->notaFiscal->numero_nf,$faturamento->notaFiscal->link_xml];

            if(isset($faturamento->boleto->codigo_boleto)){
                $fileUrls[] = ['pdf','Boleto_'. $faturamento->boleto->id, 'https://sistema.larjovemaprendiz.ong.br/sistema/faturamento/boleto/'.$faturamento->boleto->id.'/visualizar'];
            };
        }

        $i = 1;
        foreach($EmailDestinatario as $destinatario){
            if($i == 1){
                $EmailTo = $destinatario->email;
            }else{
                $arrayEmails[] = $destinatario->email;
            }
            $i++;
        }

        if($i > 2){
            $enviaEmail = Mail::to($EmailTo)->cc($arrayEmails)->bcc("dcr@larmariadelourdes.org")->send(new EmailFaturamentoAnexo($faturamento, $tipo_envio, $assunto, $fileUrls));
        }else{
            $enviaEmail = Mail::to($EmailTo)->bcc("dcr@larmariadelourdes.org")->send(new EmailFaturamentoAnexo($faturamento, $tipo_envio, $assunto, $fileUrls));
        }

        if($enviaEmail){

            $faturamento->save();
            foreach($EmailDestinatario as $destinatario){
                (New NotificacaoFaturamento())->gravaNotificacao($faturamento->id, $tipo_notificacao, $destinatario->email);
            }

            return true;

        }else{
            return false;
        }
    }

    public static function EnviaEmailComAnexo($faturamento_id, $tipo_envio){

        $faturamento = Faturamento::find($faturamento_id);
        $data_atual = Carbon::now()->format('d/m/Y H:i');
        $EmailDestinatario = EmpresaContato::where('Setor','FINANCEIRO')->where('empresa_id',$faturamento->convenio->empresa_id)->get();

        if($EmailDestinatario->count() < 1){
            return response()->json(array('status'=>'error', 'msg'=>"Nenhum e-mail cadastrado para esse cliente!"), 200);
        }

        if($faturamento->convenio->empresa->tipo_cadastro == 'CNPJ'){
            $cpfCnpj = $faturamento->convenio->empresa->cnpj;
            $nome = $faturamento->convenio->empresa->razao_social;
        }else{
            $cpfCnpj = $faturamento->convenio->empresa->cpf;
            $nome = $faturamento->convenio->empresa->nome_fantasia;
        }

        $assunto = "RELATÓRIO DE FATURAMENTO - " . strtoupper($nome) . " - " . strtoupper($faturamento->convenio->empresa->endereco->cidade->nome_cidade) . " (" . $faturamento->convenio->empresa->endereco->cidade->estado->uf_estado . ") " . strtoupper(Helper::ParteData($faturamento->data_inicial, 'mes'))."/".Helper::ParteData($faturamento->data_inicial, 'ano');
        $faturamento->etapa_faturamento = 'Envio Faturamento';
        $tipo_notificacao = "Relatório";
        $fileUrls = [];


        if($tipo_envio == "boleto-nf"){
            $assunto = "NFS E BOLETO - " . strtoupper($nome) . " " . strtoupper($faturamento->convenio->empresa->endereco->cidade->nome_cidade) . " (" . $faturamento->convenio->empresa->endereco->cidade->estado->uf_estado . ") " . strtoupper(Helper::ParteData($faturamento->data_inicial, 'mes'))."/".Helper::ParteData($faturamento->data_inicial, 'ano');
            $faturamento->etapa_faturamento = 'Finalizado';
            $tipo_notificacao = "Emissão";

            $fileUrls[] = ['pdf','PDF_Nota_' . $faturamento->notaFiscal->numero_nf,$faturamento->notaFiscal->link_pdf];
            $fileUrls[] = ['xml','XML_Nota_' . $faturamento->notaFiscal->numero_nf,$faturamento->notaFiscal->link_xml];

            if(isset($faturamento->boleto->codigo_boleto)){
                $fileUrls[] = ['pdf','Boleto_'. $faturamento->boleto->id, 'https://sistema.larjovemaprendiz.ong.br/sistema/faturamento/boleto/'.$faturamento->boleto->id.'/visualizar'];
            };

        }

        $i = 1;
        foreach($EmailDestinatario as $destinatario){
            if($i == 1){
                $EmailTo = $destinatario->email;
            }else{
                $arrayEmails[] = $destinatario->email;
            }
            $i++;
        }

        if($i > 2){
            //->bcc("dcr@larmariadelourdes.org")
            $enviaEmail = Mail::to($EmailTo)->cc($arrayEmails)->send(new EmailFaturamentoAnexo($faturamento, $tipo_envio, $assunto, $fileUrls));
        }else{
            //->bcc("dcr@larmariadelourdes.org")
            $enviaEmail = Mail::to($EmailTo)->send(new EmailFaturamentoAnexo($faturamento, $tipo_envio, $assunto, $fileUrls));
        }

        if($enviaEmail){

            $faturamento->save();
            foreach($EmailDestinatario as $destinatario){
                (New NotificacaoFaturamento())->gravaNotificacao($faturamento->id, $tipo_notificacao, $destinatario->email);
            }

            return true;

        }else{
            return false;
        }
    }

    public function convenio()
    {
        return $this->belongsTo(Convenio::class, 'convenio_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function boleto()
    {
        return $this->hasOne(FaturamentoBoleto::class)->whereNull('deleted_at');
    }

    public function informePagamento()
    {
        return $this->hasOne(InformePagamento::class)->orderBy('id', 'DESC');
    }

    public function envios()
    {
        return $this->hasMany(NotificacaoFaturamento::class)->orderBy('id', 'DESC');
    }

    public function credito()
    {
        return $this->hasOne(FaturamentoCredito::class)->orderBy('id', 'DESC');
    }

    public function notaFiscal()
    {
        return $this->hasOne(FaturamentoNF::class)->whereNull('deleted_at')->orderBy('id', 'DESC');
    }

    public function faturamentoContratos()
    {
        return $this->hasMany(FaturamentoContrato::class)->whereNull('deleted_at');
    }


}
