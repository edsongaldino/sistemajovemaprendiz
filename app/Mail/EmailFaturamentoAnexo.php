<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class EmailFaturamentoAnexo extends Mailable
{
    use Queueable, SerializesModels;

    public $faturamento;
    public $tipo;
    public $assunto;
    public $fileUrls;

    public function __construct($faturamento, $tipo, $assunto, $fileUrls)
    {
        $this->faturamento = $faturamento;
        $this->tipo = $tipo;
        $this->assunto = $assunto;
        $this->fileUrls = $fileUrls;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.email_faturamento')->from('aprendiz@larjovemaprendiz.ong.br', 'Lar Maria de Lourdes - Jovem Aprendiz')->replyTo('dcr@larmariadelourdes.org', 'Lar Maria de Lourdes - Jovem Aprendiz')->subject($this->assunto);

        $tempPaths = [];

        foreach ($this->fileUrls as $url) {
            $fileName = basename(parse_url($url, PHP_URL_PATH)); // Obtém o nome original do arquivo
            $tempPath = storage_path("app/temp_{$fileName}");

            // Faz a requisição HTTP para baixar o arquivo como binário
            $response = Http::withOptions(['stream' => true])->get($url);

            if ($response->successful()) {

                // Escreve o conteúdo no arquivo sem alterar o encoding
                file_put_contents($tempPath, $response->body());
                
                $tempPaths[] = $tempPath;

                // Anexa o arquivo ao e-mail
                $email->attach($tempPath, [
                    'as' => $fileName, // Mantém o nome original
                    'mime' => mime_content_type($tempPath), // Detecta o tipo do arquivo
                ]);

                // Exclui os arquivos temporários após o envio (se não estiver usando filas)
                /*
                register_shutdown_function(function () use ($tempPaths) {
                    foreach ($tempPaths as $tempPath) {
                        if (file_exists($tempPath)) {
                            unlink($tempPath);
                        }
                    }
                });
                */
                
            }
        }

        return $email;
    }

}
