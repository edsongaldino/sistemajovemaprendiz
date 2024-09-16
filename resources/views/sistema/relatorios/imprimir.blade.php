<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório TIPO</title>
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
            height: auto;
            line-height: 30px;
            float: left;
            font-size: 11px;
            text-align: center;
            border: 1px solid #333;
            background-color: #022e3f;
            color: #FFF;
            display: flex;
            justify-content: center;
            align-items: center;
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
        .linha-relatorio-titulo .col-10{
            width: 10%;
            float: left;
            border-right: 1px solid #333;
        }
        .linha-relatorio-titulo .col-12{
            width: 12%;
            float: left;
            border-right: 1px solid #333;
        }
        .linha-relatorio-titulo .col-20{
            width: 20%;
            float: left;
            border-right: 1px solid #333;
        }
        .linha-relatorio-titulo .col-30{
            width: 30%;
            float: left;
            border-right: 1px solid #333;
        }
        .linha-relatorio-titulo .col-8{
            width: 8%;
            float: left;
            border-right: 1px solid #333;
        }


        .linha-relatorio{
            width:100%;
            height: auto;
            text-align: center;
            float: left;
            border: 1px solid #838282;
            font-size: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .linha-relatorio .col-total{
            width: 8%;
            float: left;
        }
        .linha-relatorio .col-10{
            width: 10%;
            float: left;
            padding: 5px 0;
            height: auto 100% !important;
            position: relative;
        }
        .linha-relatorio .col-12{
            width: 12%;
            float: left;
            padding: 5px 0;
            height: auto 100% !important;
            position: relative;
        }
        .linha-relatorio .col-20{
            width: 20%;
            float: left;
            padding: 5px 0;
            height: auto 100% !important;
            position: relative;
        }
        .linha-relatorio .col-30{
            width: 30%;
            float: left;
            padding: 5px 0;
            height: auto 100% !important;
            position: relative;
        }
        .linha-relatorio .col-8{
            width: 8%;
            float: left;
            padding: 5px 0;
            height: auto 100% !important;
            position: relative;
        }

        .linha-relatorio .i{
            background-color: #ececec;
        }
        .linha-relatorio .a{
            background-color: #dad6d6;
        }

        .linha-rodape{
            width:100%;
            height: 40px;
            line-height: 40px;
            text-align: center;
            float: left;
        }
        .linha-rodape .total-contratos{
            width:40%;
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

        .total-polo{
            width: 100%;
            height: 40px;
            line-height: 40px;
            font-size: 20px;
            text-align: center;
            float: left;
            text-transform: uppercase;
            margin-bottom: 20px;
            border-bottom: 1px solid #022e3f;
        }

        .total-polo .texto-totalizador{
            width: 80%;
            float: left;
            text-align: right;
            font-size: 16px;
            background-color: aliceblue;
            color: #022e3f;
            font-weight: bold;
            padding-right: 2%;
        }
        .total-polo .total{
            width: 10%;
            float: left;
            text-align: center;
            font-size: 16px;
            background-color: #4090af;
            color: #FFF;
        }
        .total-polo .total-juros{
            width: 8%;
            float: left;
            text-align: center;
            font-size: 14px;
            background-color: #022e3f;
            color: #FFF;
        }
    </style>
</head>
<body>
    <div id="topo-relatorio">
        <div class="logo-lar"><img src="/assets/sistema/img/logo-lar-contrato.png" width="100%" alt=""></div>
        <div class="titulo">RELATÓRIO DE FATURAMENTOS ({{ Helper::GetTipoRelatorioByID($request->tipo_relatorio) }})</div>
        <div class="data">Data: {{ $data_atual }}</div>
        <div class="usuario">Período: <b>{{ Helper::data_br($request->data_inicial) }} à {{ Helper::data_br($request->data_final) }}</b></div>
        <div class="usuario">Usuário: {{ Auth::user()->nome }}</div>
    </div>

    <div class="linha-relatorio-titulo">
        <div class="col-8">Data de Emissão</div>
        <div class="col-12">Nº NF</div>
        <div class="col-10">CNPJ</div>
        <div class="col-30">Razão Social</div>
        <div class="col-8">Vencimento</div>
        <div class="col-8">Situação</div>
        <div class="col-8">Tipo</div>
        <div class="col-8">Valor NF</div>
        <div class="col-8">Juros/Multa</div>
    </div>
    @php $polo = 0; $i = 0; @endphp
    @foreach ($faturamentos as $faturamento)
        
        @if($polo <> $faturamento->convenio->polo_id)

            @if($polo <> 0)
            <div class="total-polo">
                <div class="texto-totalizador">Total Geral</div>
                <div class="total">{{ Helper::converte_valor_real($valorTotal) }}</div>
                <div class="total-juros">{{ Helper::converte_valor_real($totalJuros) }}</div>
            </div>
            @endif

            @php 
                $poloAtual = $faturamento->convenio->polo_id; 
                $valorTotal=0;
                $totalJuros=0;  
                $mostrarTotalizadorPolo = 'Sim';
            @endphp
            <div class="topo-polo">{{ $faturamento->convenio->polo->nome}} - {{ $faturamento->convenio->polo->endereco->cidade->nome_cidade}} ({{ $faturamento->convenio->polo->endereco->cidade->estado->uf_estado}})</div>
        @endif
        <div class="linha-relatorio">
            <div class="col-8">{{ Helper::datetime_br($faturamento->data) ?? '' }}</div>
            <div class="col-10">{{ $faturamento->notaFiscal->numero_nf ?? '' }}</div>
            <div class="col-12">{{ $faturamento->convenio->empresa->cnpj ?? '' }}</div>
            <div class="col-30">{{ $faturamento->convenio->empresa->razao_social ?? '' }}</div>
            <div class="col-8">{{ Helper::data_br($faturamento->boleto->data_vencimento ?? '')}}</div>
            <div class="col-8">{{ $faturamento->boleto->status ?? '' }}</div>
            <div class="col-8">{{ $faturamento->forma_pagamento ?? '' }}</div>
            <div class="col-8">R$ {{ Helper::converte_valor_real(Helper::GetValorTotalFaturado($faturamento->id)) }}</div>
            <div class="col-8">{{ Helper::converte_valor_real($faturamento->boleto->valor_juros ?? '') }}</div>
        </div>
        @php 
        $valorTotal = $valorTotal + Helper::GetValorTotalFaturado($faturamento->id);
        $totalJuros = $totalJuros + $faturamento->boleto->valor_juros;
        $polo = $faturamento->convenio->polo_id; 
        $i++;
        @endphp

    @endforeach

    <div class="total-polo">
        <div class="texto-totalizador">Total Geral</div>
        <div class="total">{{ Helper::converte_valor_real($valorTotal) }}</div>
        <div class="total-juros">{{ Helper::converte_valor_real($totalJuros) }}</div>
    </div>

</body>
</html>
