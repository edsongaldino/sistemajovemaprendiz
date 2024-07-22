<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use eNotasGW;
use Illuminate\Http\Request;
use eNotasGW\Api\Exceptions as Exceptions;


class EnotasController extends Controller
{
    public function EmitirNF(){

        new eNotasGW;
        
        eNotasGW::configure(array(
            'apiKey' => 'ZWJkNzM3YTQtZjhiNC00Zjc5LTkxZDgtMjZhYTIzZWYwODAw'
        ));
        
        $empresaId = '76D51A32-28E4-4B24-B416-7D1159FA0800';
        $idExterno = '1238';
        
        $nfeId = eNotasGW::$NFeApi->emitir($empresaId, array(
            'tipo' => 'NFS-e',
            'idExterno' => $idExterno,
            'ambienteEmissao' => 'Homologacao', //'Homologacao' ou 'Producao'		
            'cliente' => array(
                'nome' => 'Fulano de Tal',
                'email' => 'fulano@mail.com',
                'cpfCnpj' => '23857396237',
                'tipoPessoa' => 'F', //F - pessoa física | J - pessoa jurídica
                'endereco' => array(
                    'uf' => 'MG', 
                    'cidade' => 'Belo Horizonte',
                    'logradouro' => 'Rua 01',
                    'numero' => '112',
                    'complemento' => 'AP 402',
                    'bairro' => 'Savassi',
                    'cep' => '32323111'
                )
            ),
            'servico' => array(
                'descricao' => 'Discriminação do Serviço prestado'
            ),
            'valorTotal' => 10.05
        ));

        dd($nfeId);
        
        return("ID da NFe: {$nfeId}");

    }
}
