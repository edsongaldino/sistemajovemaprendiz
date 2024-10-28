<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório Mensal ({{ $faturamento->convenio->empresa->nome_fantasia}})</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
    <style>
        html body {
            padding: 0px;
            margin: 0px;
            font-family: 'Ubuntu';
        }
        #topo-relatorio{
            width: 100%;
            height: 130px;
            background-color: #ececec;
            line-height: 25px;
            padding: 15px;
        }
        #topo-relatorio .logo-lar{
            width: 150px;
            height: 150px;
            float: left;
            padding-right: 20px;
        }

        #topo-relatorio .titulo{
            font-size: 20px;
            font-weight: bold;
        }
        .nome-jovem{
            width: 100%;
            height: 20px;
            line-height: 20px;
            font-size: 14px;
            float: left;
            text-align: left;
            background-color: #ececec;
            padding-left: 10px;
        }
        .linha-relatorio-titulo{
            width:100%;
            height: 30px;
            line-height: 30px;
            float: left;
            font-size: 10px;
            text-align: center;
            border: 1px solid #333;
            background-color: #022e3f;
            color: #FFF;
        }

        .linha-topo-titulo{
            width:100%;
            height: 30px;
            line-height: 30px;
            float: left;
            font-size: 11px;
            border: 1px solid #fafafa;
            text-align: center;
        }

        .linha-topo-titulo .dados-iniciais{
            width:52.4%;
            height: 30px;
            line-height: 30px;
            float: left;
            font-size: 11px;
            text-align: center;
            border: 1px solid #ffffff;
        }

        .linha-topo-titulo .provisionamentos{
            width:12.2%;
            height: 30px;
            line-height: 30px;
            float: left;
            font-size: 11px;
            text-align: center;
            border: 1px solid #333;
            background-color: #2b424b;
            color: #FFF;
        }

        .linha-topo-titulo .despesas{
            width:10.2%;
            height: 30px;
            line-height: 30px;
            float: left;
            font-size: 11px;
            text-align: center;
            border: 1px solid #333;
            background-color: #2b424b;
            color: #FFF;
            margin-left: 11.9%;
        }

        .bgc{
            background-color: #2b424b !important;
        }


        .linha-relatorio-titulo .col-total{
            width: 7%;
            float: left;
        }
        .linha-relatorio-titulo .col-5{
            width: 5%;
            float: left;
            border-right: 1px solid #333;
        }
        .linha-relatorio-titulo .col-4{
            width: 4%;
            float: left;
            border-right: 1px solid #333;
        }
        .linha-relatorio-titulo .col-8{
            width: 8%;
            float: left;
        }

        .linha-relatorio-titulo .col-6{
            width: 6%;
            float: left;
            border-right: 1px solid #333;
        }

        .linha-relatorio{
            width:100%;
            height: 20px;
            line-height: 20px;
            text-align: center;
            float: left;
            border: 1px solid #838282;
            font-size: 12px;
        }
        .linha-relatorio .col-total{
            width: 8%;
            float: left;
        }
        .linha-relatorio .col-5{
            width: 5%;
            float: left;
            border-right: 1px solid #838282;
        }
        .linha-relatorio .col-4{
            width: 4%;
            float: left;
            border-right: 1px solid #838282;
        }
        .linha-relatorio .col-6{
            width: 6%;
            float: left;
            border-right: 1px solid #838282;
        }
        .linha-relatorio .col-8{
            width: 8%;
            float: left;
        }
        .linha-relatorio .col-7{
            width: 7%;
            float: left;
        }

        .linha-rodape{
            width:100%;
            height: 40px;
            line-height: 40px;
            text-align: center;
            float: left;
        }
        .linha-rodape .total-contratos{
            width:30%;
            height: 40px;
            float: right;
        }

        .linha-rodape .total-contratos .titulo{
            width:60%;
            float: left;
            height: 40px;
            background-color: #c5c5c5;
            color: #333;
        }
        .linha-rodape .total-contratos .valor{
            width:40%;
            float: right;
            height: 40px;
            background-color: #9b9a9a;
            color: #333;
            font-size: 20px;
        }

        .linha-rodape .total-geral{
            width:30%;
            height: 40px;
            float: right;
        }
        .linha-rodape .total-geral .titulo{
            width:60%;
            float: left;
            height: 40px;
            background-color: #c5c5c5;
            color: #333;
        }
        .linha-rodape .total-geral .valor{
            width:40%;
            float: right;
            height: 40px;
            background-color: #9b9a9a;
            color: #333;
            font-size: 20px;
        }

        .linha-rodape .total-credito{
            width:20%;
            height: 40px;
            float: right;
        }
        .linha-rodape .total-credito .titulo{
            width:60%;
            float: left;
            height: 40px;
            background-color: #c4dfed;
            color: #333;
        }
        .linha-rodape .total-credito .valor{
            width:40%;
            float: right;
            height: 40px;
            background-color: #96b6d5;
            color: #333;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div id="topo-relatorio">
        <div class="logo-lar"><img src="/assets/sistema/img/logo-lar-contrato.png" width="100%" alt=""></div>
        <div class="titulo">FECHAMENTO DETALHES DA COBRANCA POR EMPRESA JOVEM APRENDIZ</div>
        <div class="data">Data: {{ $data_atual }}</div>
        <div class="usuario">Período Faturado: <b>{{ Helper::data_br($faturamento->data_inicial) }} à {{ Helper::data_br($faturamento->data_final) }}</b></div>
        <div class="Empresa">Empresa: {{ $faturamento->convenio->empresa->razao_social}} - 
            
            @if($faturamento->convenio->empresa->tipo_cadastro == 'CNPJ')
            CNPJ: <b>{{ Helper::mask($faturamento->convenio->empresa->cnpj, '##.###.###/####-##') ?? '' }}</b>
            @else
            CPF: <b>{{ Helper::mask($faturamento->convenio->empresa->cpf, '###.###.###-##') ?? '' }}</b>
            @endif
                    
        </div>
        <div class="usuario">Usuário: {{ $faturamento->usuario->nome}}</div>
    </div>

    <div class="linha-topo-titulo">
        <div class="dados-iniciais"></div>
        <div class="provisionamentos">PROVISIONAMENTOS</div>
        <div class="despesas">DESPESAS</div>
    </div>
    <div class="linha-relatorio-titulo">
        <div class="col-5">Dias</div>
        <div class="col-5">Faltas</div>
        <div class="col-5">Salário</div>
        <div class="col-5">Sal. Líq</div>
        <div class="col-5">Tx. Adm</div>
        <div class="col-5">13º</div>
        <div class="col-5">Férias</div>
        <div class="col-5">1/3 Férias</div>
        <div class="col-4">INSS</div>
        <div class="col-4">FGTS</div>
        <div class="col-4">PER/INS 30%</div>
        <div class="col-4 bgc">INSS</div>
        <div class="col-4 bgc">FGTS</div>
        <div class="col-4 bgc">PIS</div>
        <div class="col-6">Benefícios</div>
        <div class="col-6">Descontos</div>
        <div class="col-5 bgc">Exames</div>
        <div class="col-5 bgc">Uniforme</div>
        <div class="col-5">ISSQN</div>
        <div class="col-6">TOTAL</div>
    </div>

    @foreach ($faturamento->faturamentoContratos as $faturamentoContrato)

    @php
        $qtdFaltas = Helper::getLancamentosFaturamento($faturamentoContrato->id, 'Qtde Falta Trabalho');
        $salario = ($faturamentoContrato->contrato->valor_bolsa/30)*($faturamentoContrato->quantidade_dias);
        $txAdm = $faturamentoContrato->taxa_administrativa;
    @endphp

    <div class="nome-jovem"><strong>Nome Aprendiz:</strong> {{ $faturamentoContrato->contrato->aluno->nome }}</div>
    <div class="linha-relatorio">

        @if($faturamentoContrato->contrato->tipo_faturamento == 'Instituição')

        <div class="col-5">{{ $faturamentoContrato->quantidade_dias }}</div>
        <div class="col-5">{{ $qtdFaltas }}</div>
        <div class="col-5">{{ Helper::converte_valor_real($salario) }}</div>
        <div class="col-5">{{ Helper::calcularDesconto($salario, '7.5') }}</div>
        <div class="col-5">{{ Helper::converte_valor_real($txAdm) }}</div>
        <div class="col-5">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_decimo_terceiro ?? 0 }}</div>
        <div class="col-5">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_ferias ?? 0 }}</div>
        <div class="col-5">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_terco_ferias ?? 0 }}</div>
        <div class="col-4">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_inss ?? 0 }}</div>
        <div class="col-4">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_fgts ?? 0 }}</div>
        <div class="col-4">-</div>
        <div class="col-4">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_inss_provisionamento ?? 0 }}</div>
        <div class="col-4">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_fgts_provisionamento ?? 0 }}</div>
        <div class="col-4">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_pis_provisionamento ?? 0 }}</div>
        <div class="col-6">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_beneficios ?? 0 }}</div>
        <div class="col-6">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_descontos ?? 0 }}</div>
        <div class="col-5">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_exames ?? 0 }}</div>
        <div class="col-5">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_uniforme ?? 0 }}</div>
        <div class="col-5">{{ $faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_issqn ?? 0 }}</div>
        <div class="col-6">{{ Helper::converte_valor_real($faturamentoContrato->FaturamentoContratoInstituicaoDados->valor_total ?? 0) }}</div>
        @else
        <div class="col-5">{{ $faturamentoContrato->quantidade_dias }}</div>
        <div class="col-5">{{ $qtdFaltas }}</div>
        <div class="col-5">{{ Helper::converte_valor_real($salario) }}</div>
        <div class="col-5">-</div>
        <div class="col-5">{{ Helper::converte_valor_real($txAdm) }}</div>
        <div class="col-5">-</div>
        <div class="col-5">-</div>
        <div class="col-5">-</div>
        <div class="col-4">-</div>
        <div class="col-4">-</div>
        <div class="col-4">-</div>
        <div class="col-4">-</div>
        <div class="col-4">-</div>
        <div class="col-4">-</div>
        <div class="col-6">{{ $faturamentoContrato->FaturamentoContratoEmpresaDados->valor_beneficios ?? 0  }}</div>
        <div class="col-6">{{ $faturamentoContrato->FaturamentoContratoEmpresaDados->valor_descontos ?? 0 }}</div>
        <div class="col-5">{{ $faturamentoContrato->FaturamentoContratoEmpresaDados->valor_exames ?? 0 }}</div>
        <div class="col-5">{{ $faturamentoContrato->FaturamentoContratoEmpresaDados->valor_uniforme ?? 0 }}</div>
        <div class="col-5">{{ $faturamentoContrato->FaturamentoContratoEmpresaDados->valor_issqn ?? 0 }}</div>
        <div class="col-6">{{ Helper::converte_valor_real($faturamentoContrato->FaturamentoContratoEmpresaDados->valor_total ?? 0) }}</div>
        @endif
    </div>
    @endforeach

    <div class="linha-rodape">
        <div class="total-geral">
            <div class="titulo">TOTAL GERAL</div>
            <div class="valor">R$ {{ Helper::converte_valor_real(Helper::GetValorTotalFaturado($faturamento->id)) }}</div>
        </div>
        @if(isset($faturamento->credito->id))                 
        <div class="total-credito" title="{{ $faturamento->credito->descricao_credito }}">
            <div class="titulo">TOTAL CRÉDITO</div>
            <div class="valor">R$ {{ Helper::converte_valor_real($faturamento->credito->valor_credito) }}</div>
        </div>
        @endif
        <div class="total-contratos">
            <div class="titulo">TOTAL DE CONTRATOS</div>
            <div class="valor">{{ $faturamento->faturamentoContratos->count() }}</div>
        </div>
    </div>
</body>
</html>
