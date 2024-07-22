<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ficha de Identificação Nº {{ $candidato->id }} </title>
    <style>
        html body{
            margin: 0;
            padding: 0;
        }

        
        .pagebreak { page-break-before: always; } /* page-break-after works, as well */
        

        .candidato{
            width: 1024px;
            padding: 30px;
            margin: 0 auto;
            text-align: justify;
            font-family: Arial, Helvetica, sans-serif;
        }

        .candidato .topo{
            width: 100%;
            height: 150px;
            float: left;
        }

        .candidato .topo .logo{
            width: 150px;
            height: 150px;
            float: right;
        }

        .candidato .topo .logo img{
            max-width: 120px;
        }

        .candidato .topo .informacoes{
            width: 800px;
            height: 100px;
            float: left;
            text-align: left;
            font-size: 18px;
            padding-top: 15px;
        }

        .candidato .topo .informacoes .titulo{
            font-size: 22px;
        }

        .candidato .bloco{
            width: 100%;
            height: auto;
            line-height: 40px;
            font-size: 14px;
            float: left;
            border: 1px solid #333;
            margin-bottom: 20px;
        }

        .candidato .bloco .titulo{
            width: 100%;
            height: 50px;
            line-height: 50px;
            font-size: 18px;
            float: left;
            font-weight: 900;
            background-color: #dddcdc;
            color: #333;
            text-align: center;
        }
        .candidato .bloco .item{
            width: 94%;
            height: 30px;
            line-height: 30px;
            font-size: 14px;
            float: left;
            padding: 0% 3%;
            border-top:1px solid #333;
        }

        .candidato .bloco .item.resumo{
            width: 94%;
            height: auto;
            line-height: 30px;
            font-size: 14px;
            float: left;
            padding: 0% 3%;
            border-top:1px solid #333;
        }

        .candidato .bloco .item.metade{
            width: 44%;
            height: 30px;
            line-height: 30px;
            font-size: 14px;
            float: left;
            padding: 0% 3%;
            border-top:1px solid #333;
        }

        .candidato .bloco .item.w-30{
            width: 27%;
            padding: 0% 3%;
        }

        .candidato .bloco .item.w-31{
            width: 28%;
            padding: 0% 3%;
        }

        .candidato .bloco .item.w-25{
            width: 24%;
            padding: 0% 3%;
        }

        .candidato .bloco .item.w-20{
            width: 14%;
            padding: 0% 3%;
        }

        .candidato .bloco .item.auto{
            height: auto;
        }

        .candidato .info-footer{
            width: 100%;
            height: 40px;
            line-height: 20px;
            text-align: center;
            color: darkgray;
            float: left;
        }
    </style>
</head>
<body>
<div class="candidato">

    <div class="topo">
        <div class="logo"><img src="/assets/sistema/img/logo-lar.png" alt=""></div>
        <div class="informacoes">
            <strong class="titulo">FICHA DE IDENTIFICAÇÃO DO CANDIDADO</strong><br/>
            CÓDIGO DE IDENTIFICAÇÃO: <strong>{{ $candidato->id }}</strong><br>
            DATA DE CADASTRO: <strong>{{ Helper::datetime_br($candidato->created_at) }}</strong>
        </div>
    </div>

    <div class="bloco">
        <div class="titulo">DADOS DO CANDIDATO</div>
        <div class="item">NOME: <strong>{{ $candidato->nome ?? '' }}</strong></div>
        <div class="item metade">DATA DE NASCIMENTO: <strong>{{ Helper::datetime_br($candidato->data_nascimento ?? '') }}</strong></div>
        <div class="item metade">IDADE: <strong>{{ Helper::calcula_idade($candidato->data_nascimento) }} anos</strong></div>
        <div class="item">ENDEREÇO: <strong>{{ $candidato->endereco->logradouro_endereco ?? '' }}, {{ $candidato->endereco->numero_endereco ?? '' }}, {{ $candidato->endereco->bairro_endereco ?? '' }}, {{ $candidato->endereco->complemento_endereco ?? '' }}</strong></div>
        <div class="item">CIDADE - UF: <strong>{{ $candidato->endereco->cidade->nome_cidade ?? '' }} - {{ $candidato->endereco->cidade->estado->uf_estado ?? '' }}</strong></div>
        <div class="item">CEP: <strong>{{ Helper::mask($candidato->endereco->cep_endereco ?? '','#####-###') }}</strong></div>
        <div class="item">TELEFONE: <strong>{{ Helper::Phone($candidato->telefone ?? '','#####-###') }}</strong></div>
        <div class="item">E-MAIL: <strong>{{ $candidato->user->email ?? '' }}</strong></div>
    </div>


    <div class="bloco">
        <div class="titulo">DOCUMENTOS</div>
        <div class="item metade">CPF: <strong>{{ Helper::mask($candidato->cpf ?? '','###.###.###-##') }}</strong></div>
        <div class="item w-25">Cart. Identiade (RG): <strong>{{ $candidato->rg ?? '' }}</strong></div>
        <div class="item w-20">Órgão Exp: <strong>{{ $candidato->orgao_expedidor ?? '' }}</strong></div>
        <div class="item w-30">Carteira de Trabalho: <strong>{{ $candidato->curriculo->ctps ?? '' }}</strong></div>
        <div class="item w-30">Série: <strong>{{ $candidato->curriculo->serie_ctps ?? '' }}</strong></div>
        <div class="item w-31">PIS: <strong>{{ $candidato->pis ?? '' }}</strong></div>
    </div>

    <div class="bloco resumo_curricular">
        <div class="titulo">RESUMO CURRICULAR</div>
        <div class="item resumo">PORQUE DECIDIU TRABALHAR? - <strong>{{ $candidato->curriculo->porque_decidiu_trabalhar ?? '' }}</strong></div>
        <div class="item resumo">O QUE ESPERA A EMPRESA QUANTO AO QUESITO PROFISSIONAL? - <strong>{{ $candidato->curriculo->oque_espera_empresa ?? '' }}</strong></div>
        <div class="item resumo">QUAL SEU SONHO?  - <strong>{{ $candidato->curriculo->seu_sonho ?? '' }}</strong></div>
        <div class="item resumo">QUAL SEU PONTO FORTE E O A DESENVOLVER? - <strong>{{ $candidato->curriculo->ponto_forte_desenvolver ?? '' }}</strong></div>
        <div class="item resumo">O QUE FAZ NOS MOMENTOS DE LAZER? - <strong>{{ $candidato->curriculo->momentos_lazer ?? '' }}</strong></div>
        <div class="item resumo">TEM PROBLEMA DE SAUDE? - <strong>{{ $candidato->curriculo->problema_saude ?? '' }}</strong>( {{ $candidato->curriculo->problema_saude_especificacao ?? '' }} )</div>
        <div class="item resumo">TOMA REMEDIO CONTROLADO? - <strong>{{ $candidato->curriculo->remedio_controlado ?? '' }}</strong>({{ $candidato->curriculo->remedio_controlado_especificacao ?? '' }})</div>
        <div class="item resumo">NÚMERO DE PESSOAS NA RESIDÊNCIA? - <strong>{{ $candidato->curriculo->numero_pessoas_residencia ?? '' }}</strong></div>
        <div class="item resumo">RENDA FAMILIAR: - <strong>{{ $candidato->curriculo->renda_familiar ?? '' }}</strong></div>
        <div class="item resumo">TEM CURSO DE INFORMATICA? - <strong>{{ $candidato->curriculo->curso_informatica ?? '' }}</strong>( {{ $candidato->curriculo->descricao_curso ?? '' }} )</div>
        
    </div>

    @if(($candidato->curriculo->ja_trabalhou ?? '') == 'Sim')    
    <div class="bloco resumo_curricular">
        <div class="titulo">EXPERIÊNCIA PROFISSIONAL</div>
        <div class="item">{{ $candidato->curriculo->funcao_exercida ?? '' }}</div>
    </div>
    @endif

</div> 

</body>
</html>