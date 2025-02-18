<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailFaturamento extends Mailable
{
    use Queueable, SerializesModels;

    public $faturamento;
    public $tipo;
    public $assunto;

    public function __construct($faturamento, $tipo, $assunto)
    {
        $this->faturamento = $faturamento;
        $this->tipo = $tipo;
        $this->assunto = $assunto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email_faturamento')->from('aprendiz@larjovemaprendiz.ong.br', 'Lar Maria de Lourdes - Jovem Aprendiz')->replyTo('dcr@larmariadelourdes.org', 'Lar Maria de Lourdes - Jovem Aprendiz')->subject($this->assunto);
    }

    /*
    return $this->view('emails.email_faturamento')
                    ->from('aprendiz@larjovemaprendiz.ong.br', 'Lar Maria de Lourdes - Jovem Aprendiz')
                    ->replyTo('dcr@larmariadelourdes.org', 'Lar Maria de Lourdes - Jovem Aprendiz');

                    if($this->faturamento->notaFiscal->link_pdf){
                        Storage::put('temp/nf.pdf', $this->faturamento->notaFiscal->link_pdf);
                        $this->attachData(Storage::get('temp/nf.pdf'), 'NotaFiscal'. $this->faturamento->notaFiscal->numero_nf.'.pdf', ['mime' => 'application/pdf',]);
                    };

                    Storage::delete('temp/nf.pdf');

                    $this->subject($this->assunto);*/
}
