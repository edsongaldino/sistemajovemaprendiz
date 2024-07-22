<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use CodePhix\Asaas\Asaas;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class IntegracaoAsaasController extends Controller
{
    //

    public function client(){
        if(env('APP_ENV') == 'local'){
            $client = new Client(['verify' => 'C:\Program Files\Common Files\SSL\cert.pem']);
        }else{
            $client = new Client();
        }
        return $client;
    }

    public function NovoCliente($empresa){

        $res = $this->client()->request('POST', "https://www.asaas.com/api/v3/customers", [
            'json' => [
                "name" => $empresa->razao_social,
                "email" => $empresa->email_responsavel,
                "phone" => $empresa->telefone,
                "mobilePhone" => $empresa->telefone_responsavel,
                "cpfCnpj" => $empresa->cnpj,
                "postalCode" => $empresa->endereco->cep_endereco,
                "address" => $empresa->endereco->logradouro_endereco,
                "addressNumber" => $empresa->endereco->numero_endereco,
                "complement" => $empresa->endereco->complemento_endereco ?? '',
                "province" => $empresa->endereco->bairro_endereco,
                "externalReference" => $empresa->id,
                "notificationDisabled" => true,
                "additionalEmails" => $empresa->contatos->first()->email,
                "municipalInscription" => $empresa->inscricao_municipal,
                "stateInscription" => $empresa->inscricao_estadual,
                "observations" => $empresa->nome_fantasia
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => env('ASASS_API_KEY'),
            ]
        ]);

        return($res);
    }

    public function UpdateCliente($empresa){

        $res = $this->client()->request('POST', "https://www.asaas.com/api/v3/customers/".$empresa->codigo_asaas, [
            'json' => [
                "name" => $empresa->razao_social,
                "email" => $empresa->email_responsavel,
                "phone" => $empresa->telefone,
                "mobilePhone" => $empresa->telefone_responsavel,
                "cpfCnpj" => $empresa->cnpj,
                "postalCode" => $empresa->endereco->cep_endereco,
                "address" => $empresa->endereco->logradouro_endereco,
                "addressNumber" => $empresa->endereco->numero_endereco,
                "complement" => $empresa->endereco->complemento_endereco ?? '',
                "province" => $empresa->endereco->bairro_endereco,
                "externalReference" => $empresa->id,
                "notificationDisabled" => true,
                "additionalEmails" => $empresa->contatos->first()->email,
                "municipalInscription" => $empresa->inscricao_municipal,
                "stateInscription" => $empresa->inscricao_estadual,
                "observations" => $empresa->nome_fantasia
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => env('ASASS_API_KEY'),
            ]
        ]);

        return($res);
    }

    public function NovaCobranca($faturamento){

        $res = $this->client()->request('POST', "https://www.asaas.com/api/v3/payments", [
            'json' => [
                "customer" => $faturamento->contrato->empresa->codigo_asaas,
                "billingType" => "BOLETO",
                "dueDate" => Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($faturamento->data)))->addDays(30),
                "value" => $faturamento->valor,
                "description" => 'Boleto referente ao faturamento Nº '.$faturamento->id.' com vencimento em '.Helper::data_br($faturamento->data_vencimento),
                "externalReference" => $faturamento->id,
                "discount" => [
                    "value" => 0,
                    "dueDateLimitDays" => 0
                ],
                "fine" => [
                    "value" => 2
                ],
                "interest" => [
                    "value" => 2
                ],
                "postalService" => false
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => env('ASASS_API_KEY'),
            ]
        ]);

        return($res);

    }

    public function AtualizarCobranca($faturamento){

        $res = $this->client()->request('POST', "https://www.asaas.com/api/v3/payments", [
            'json' => [
                "customer" => $faturamento->contrato->empresa->codigo_asaas,
                "billingType" => "BOLETO",
                "dueDate" => Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($faturamento->data)))->addDays(30),
                "value" => $faturamento->valor,
                "description" => 'Boleto referente ao faturamento Nº '.$faturamento->id.' com vencimento em '.Helper::data_br($faturamento->data_vencimento),
                "externalReference" => $faturamento->id,
                "discount" => [
                    "value" => 0,
                    "dueDateLimitDays" => 0
                ],
                "fine" => [
                    "value" => 2
                ],
                "interest" => [
                    "value" => 2
                ],
                "postalService" => false
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => env('ASASS_API_KEY'),
            ]
        ]);

        return($res);

    }

    public function CancelarCobranca($codigo_boleto_asaas){

        $res = $this->client()->request('DELETE', "https://www.asaas.com/api/v3/payments/".$codigo_boleto_asaas, [
            'json' => [
                "deleted" => true,
                "id" => "$codigo_boleto_asaas",
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => env('ASASS_API_KEY'),
            ]
        ]);

        return($res);

    }

    public function AgendarNF($faturamento){

        $res = $this->client()->request('POST', "https://www.asaas.com/api/v3/invoices", [
            'json' => [
                "payment" => $faturamento->boleto->codigo_boleto_asaas,
                "installment" => null,
                "customer" => $faturamento->contrato->empresa->codigo_asaas,
                "serviceDescription" => 'Nota referente ao faturamento Nº '.$faturamento->id.' com vencimento em '.Helper::data_br($faturamento->boleto->data_vencimento),
                "observations" => 'Mensalidade referente ao mês atual',
                "value" => $faturamento->valor,
                "deductions" => 0,
                "taxes" => [
                    "retainIss" => false,
                    "iss" => 0,
                    "cofins" => 0,
                    "csll" => 0,
                    "inss" => 0,
                    "ir" => 0,
                    "pis" => 0
                ],
                "externalReference" => null,
                "effectiveDate" => date('Y-m-d'),
                "municipalServiceId" => null,
                "municipalServiceCode" => '27.01',
                "municipalServiceName" => 'Serviço de assistência social'
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => env('ASASS_API_KEY'),
            ]
        ]);

        return($res);

    }

    public function CancelarNF($nota_fiscal){

        $res = $this->client()->request('POST', "https://www.asaas.com/api/v3/invoices/".$nota_fiscal->codigo_nf_asaas."/cancel", [
            'headers' => [
                'Content-Type' => 'application/json',
                'access_token' => env('ASASS_API_KEY'),
            ]
        ]);

        return($res);

    }

}
