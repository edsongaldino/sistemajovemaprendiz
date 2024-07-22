<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailProcessoSeletivo extends Mailable
{
    use Queueable, SerializesModels;

    public $vaga;

    public function __construct($vaga)
    {
        $this->vaga = $vaga;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email_selecao')->from('formulario@larjovemaprendiz.ong.br', 'Programa Jovem Aprendiz')->subject('Processo Seletivo - Jovem Aprendiz');
    }

    public function ConfirmacaoFechamento()
    {
        return $this->view('emails.email_fechamento_selecao')->from('formulario@larjovemaprendiz.ong.br', 'Programa Jovem Aprendiz')->subject('Processo Seletivo Finalizado - Jovem Aprendiz');
    }
}
