<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailUser extends Mailable
{
    use Queueable, SerializesModels;

    public $aluno;

    public function __construct($aluno)
    {
        $this->aluno = $aluno;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmacao')->from('contato@larmariadelourdes.org', 'Programa Jovem Aprendiz')->replyTo('contato@larmariadelourdes.org', 'Programa Jovem Aprendiz')->subject('Recebemos seu formulário!');
    }
}
