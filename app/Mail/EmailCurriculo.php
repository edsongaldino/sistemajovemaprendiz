<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailCurriculo extends Mailable
{
    use Queueable, SerializesModels;

    public $cadastro;
    public $assunto;

    public function __construct($cadastro, $assunto)
    {
        $this->cadastro = $cadastro;
        $this->assunto = $assunto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email_curriculo')->from('aprendiz@larjovemaprendiz.ong.br', 'Lar Maria de Lourdes - Jovem Aprendiz')->replyTo('aprendiz@larmariadelourdes.org', 'Lar Maria de Lourdes - Jovem Aprendiz')->subject($this->assunto);
    }
}
