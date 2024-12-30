<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CONTRATO Nº {{ $contrato->id }} </title>
    <style>
        html body{
            margin: 0;
            padding: 0;
        }


        .pagebreak { page-break-after: always;
                        page-break-inside: avoid; } /* page-break-after works, as well */


        .contrato{
            width: 1024px;
            padding: 30px;
            margin: 0 auto;
            text-align: justify;
            font-family: Arial, Helvetica, sans-serif;
            float: left;
        }

        .contrato .assinatura-lar{
            width: 60%;
            height: auto;
            float: left;
            margin: 0 20%;
            margin-top: 120px;
        }

        .contrato .assinatura-lar .assinatura{
            margin: auto;
            padding-top: 10px;
        }

        .contrato .assinatura-lar .assinatura img{
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .contrato .assinatura-lar .base{
            text-align: center;
            border-top: 2px solid #333;
            font-size: 16px;
        }

        .contrato .assinatura-empresa{
            width: 40%;
            height: auto;
            float: left;
            margin-left: 5%;
            margin-top: 160px;
        }

        .contrato .assinatura-empresa .assinatura{
            margin: auto;
            padding-top: 10px;
        }
        .contrato .assinatura-empresa .base{
            text-align: center;
            border-top: 2px solid #333;
            font-size: 16px;
        }

        .contrato .assinatura-gestor{
            width: 100%;
            height: auto;
            float: left;
            margin-top: 80px;
        }

        .contrato .assinatura-gestor.declaracao{
            width: 100%;
            height: auto;
            float: left;
            margin-top: 250px;
            margin-bottom: 150px;
        }

        .contrato .assinatura-gestor .assinatura{
            margin: auto;
            padding-top: 10px;
            text-align: center;
        }
        .contrato .assinatura-gestor .base{
            width: 50%;
            margin: auto;
            text-align: center;
            border-top: 2px solid #333;
            font-size: 16px;
        }

        .contrato .titulo-testemunhas{
            width: 100%;
            height: 40px;
            text-align: center;
            float: left;
            margin-top: 50px;
        }

        .contrato .assinatura-testemunha{
            width: 40%;
            height: auto;
            float: left;
            margin-left: 5%;
            margin-top: 80px;
        }

        .contrato .assinatura-testemunha.t2{
            width: 40%;
            height: auto;
            float: right;
            margin-right: 5%;
            margin-top: 60px;
        }

        .contrato .assinatura-testemunha.responsavel{
            width: 40%;
            height: auto;
            float: left;
            margin-right: 5%;
            margin-top: 80px;
        }

        .contrato .assinatura-testemunha.ct{
            margin-top: 0px;
            margin-bottom: 160px;
        }

        .contrato .assinatura-testemunha .assinatura{
            margin: auto;
            padding-top: 10px;
        }
        .contrato .assinatura-testemunha .base{
            text-align: center;
            border-top: 2px solid #333;
            font-size: 16px;
        }

        .contrato .assinatura-testemunha .assinatura img{
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .contrato .frase{
            width: 80%;
            float: left;
            margin-left: 10%;
            margin-top: 80px;
            margin-bottom: 80px;
            text-align: center;
            font-style: italic;
            font-size: 18px;
        }

        .contrato.declaracao .frase{
            margin-bottom: 10px;
        }

        .contrato .topo{
            width: 100%;
            height: 150px;
            float: left;
        }

        .contrato .topo .logo{
            width: 150px;
            height: 150px;
            float: left;
        }

        .contrato.declaracao .topo .logo{
            width: 100%;
            height: 150px;
            margin: 0 auto;
            text-align: center;
        }

        .contrato .topo .logo img{
            max-width: 120px;
        }

        .contrato .topo .informacoes{
            width: 800px;
            height: 100px;
            float: left;
            text-align: left;
            font-size: 18px;
            padding-top: 15px;
        }

        .contrato.declaracao .informacoes{
            width: 100%;
            height: 100px;
            float: left;
            text-align: center;
            font-size: 18px;
            padding-top: 15px;
            margin-bottom: 100px;
        }

        .contrato .bloco{
            width: 100%;
            height: auto;
            line-height: 40px;
            font-size: 14px;
            float: left;
            border: 1px solid #333;
            margin-bottom: 20px;
        }

        .contrato .bloco .titulo{
            width: 100%;
            height: 50px;
            line-height: 50px;
            font-size: 18px;
            float: left;
            font-weight: 900;
            background-color: #333;
            color: #ffffff;
            text-align: center;
        }
        .contrato .bloco .item{
            width: 94%;
            height: 30px;
            line-height: 30px;
            font-size: 14px;
            float: left;
            padding: 0% 3%;
            border-top:1px solid #333;
        }

        .contrato .bloco .item.metade{
            width: 44%;
            height: 30px;
            line-height: 30px;
            font-size: 14px;
            float: left;
            padding: 0% 3%;
            border-top:1px solid #333;
        }

        .contrato .bloco .item.auto{
            height: auto;
        }

        .contrato .bloco .item:nth-child(odd) {
            background: #e0e0e0;
        }

        .contrato .info-footer{
            width: 100%;
            height: 40px;
            line-height: 20px;
            text-align: center;
            color: darkgray;
            float: left;
        }

        .contrato .texto-declaracao{
            width: 100%;
        }
    </style>
</head>
<body>
<div class="contrato">

    <div class="topo">
        <div class="logo"><img src="/assets/sistema/img/logo-lar-contrato.png" alt=""></div>
        <div class="informacoes">
            CONTRATO DE APRENDIZAGEM Nº <strong>{{ $contrato->id }}</strong>
        </div>
    </div>

    <h2>REGISTRO PELA EMPRESA</h2>

    <p>Pelo presente instrumento particular de contrato que entre si celebram as partes abaixo identificadas se regerá pela legislação pertinente à aprendizagem profissional, regulamentada pelo Ministério do Trabalho e Emprego, e pelo disposto no art. 136, 403, 428 a 433, 472 da CLT, nos arts. 63 a 67 do Estatuto da Criança e do Adolescente, no art. 7º, XXXIII da Constituição Federal, no art. 45 do Dec. 9.579/18 e pelas cláusulas que adiante seguem;</p>
    
    <!--
    Alteração Solicita por Denilson e, 14 de Novembro de 2023
    @if($contrato->polo->cnpj)
    <div class="bloco">
        <div class="titulo">ENTIDADE FORMADORA</div>
        <div class="item">RAZÃO SOCIAL: <strong>{{ $contrato->polo->nome }}</strong></div>
        <div class="item">CNPJ: <strong>{{ $contrato->polo->cnpj }}</strong></div>
        <div class="item">INSCRIÇÃO ESTADUAL: <strong>{{ $contrato->polo->inscricao_estadual }}</strong></div>
        <div class="item">ENDEREÇO: <strong>{{ $contrato->polo->endereco->logradouro_endereco }} - {{ $contrato->polo->endereco->numero_endereco }}</strong></div>
        <div class="item">CIDADE - UF: <strong>{{ $contrato->polo->endereco->cidade->nome_cidade }} - {{ $contrato->polo->endereco->cidade->estado->uf_estado }}</strong></div>
        <div class="item">CEP: <strong>{{ $contrato->polo->endereco->cep_endereco }}</strong></div>
        <div class="item">TELEFONE: <strong>{{ $contrato->polo->telefone }}</strong></div>
        <div class="item">E-MAIL: <strong>{{ $contrato->polo->email }}</strong></div>
        <div class="item">RESPONSÁVEL: <strong>DIRCEU BELARMINO PEREIRA</strong></div>
    </div>
    @else
    <div class="bloco">
        <div class="titulo">ENTIDADE FORMADORA</div>
        <div class="item">RAZÃO SOCIAL: <strong>ASSOCIAÇÃO ESPÍRITA LAR MARIA DE LOURDES</strong></div>
        <div class="item">CNPJ: <strong>{{ $poloMatriz->cnpj }}</strong></div>
        <div class="item">INSCRIÇÃO ESTADUAL: <strong>{{ $poloMatriz->inscricao_estadual }}</strong></div>
        <div class="item">ENDEREÇO: <strong>{{ $poloMatriz->endereco->logradouro_endereco }} - {{ $poloMatriz->endereco->numero_endereco }}</strong></div>
        <div class="item">CIDADE - UF: <strong>{{ $poloMatriz->endereco->cidade->nome_cidade }} - {{ $poloMatriz->endereco->cidade->estado->uf_estado }}</strong></div>
        <div class="item">CEP: <strong>{{ $poloMatriz->endereco->cep_endereco }}</strong></div>
        <div class="item">TELEFONE: <strong>{{ $poloMatriz->telefone }}</strong></div>
        <div class="item">E-MAIL: <strong>{{ $poloMatriz->email }}</strong></div>
        <div class="item">RESPONSÁVEL: DIRCEU BELARMINO PEREIRA</strong></div>
    </div>
    @endif
    -->

    <div class="bloco">
        <div class="titulo">ENTIDADE FORMADORA</div>
        <div class="item">RAZÃO SOCIAL: <strong>ASSOCIAÇÃO ESPÍRITA LAR MARIA DE LOURDES</strong></div>
        <div class="item">CNPJ: <strong>{{ Helper::mask($poloMatriz->cnpj,'##.###.###/####-##') }}</strong></div>
        <div class="item">INSCRIÇÃO ESTADUAL: <strong>{{ $poloMatriz->inscricao_estadual }}</strong></div>
        <div class="item">ENDEREÇO: <strong>{{ $poloMatriz->endereco->logradouro_endereco }} - {{ $poloMatriz->endereco->numero_endereco }}</strong></div>
        <div class="item">CIDADE - UF: <strong>{{ $poloMatriz->endereco->cidade->nome_cidade }} - {{ $poloMatriz->endereco->cidade->estado->uf_estado }}</strong></div>
        <div class="item">CEP: <strong>{{ Helper::mask($poloMatriz->endereco->cep_endereco,'#####-###') }}</strong></div>
        <div class="item">TELEFONE: <strong>{{ Helper::Phone($poloMatriz->telefone) }}</strong></div>
        <div class="item">E-MAIL: <strong>{{ $poloMatriz->email }}</strong></div>
        <div class="item">RESPONSÁVEL: DIRCEU BELARMINO PEREIRA</strong></div>
    </div>

    <div class="bloco">
        <div class="titulo">ESTABELECIMENTO VINCULADO À COTA DE APRENDIZAGEM E CONTRATANTE</div>
        <div class="item">RAZÃO SOCIAL: <strong>{{ $contrato->empresa->razao_social }}</strong></div>
        @if($contrato->empresa->tipo_cadastro == 'CNPJ')
        <div class="item">CNPJ: <strong>{{ Helper::mask($contrato->empresa->cnpj,'##.###.###/####-##') }}</strong></div>
        @else
        <div class="item">CPF: <strong>{{ Helper::mask($contrato->empresa->cpf,'###.###.###-##') }}</strong></div>
        @endif
        <div class="item">INSCRIÇÃO ESTADUAL: <strong>{{ $contrato->empresa->inscricao_estadual ?? '' }}</strong></div>
        <div class="item">ENDEREÇO: <strong>{{ $contrato->empresa->endereco->logradouro_endereco }} - {{ $contrato->empresa->endereco->numero_endereco }} - {{ $contrato->empresa->endereco->bairro_endereco }}</strong></div>
        <div class="item">CIDADE: <strong>{{ $contrato->empresa->endereco->cidade->nome_cidade }}/{{ $contrato->empresa->endereco->cidade->estado->uf_estado }}</strong></div>
        <div class="item">CEP: <strong>{{ Helper::mask($contrato->empresa->endereco->cep_endereco,'#####-###') }}</strong></div>
        <div class="item">TELEFONE: <strong>{{ Helper::Phone($contrato->empresa->telefone) }}</strong></div>
        <div class="item">RESPONSÁVEL: <strong>{{ $contrato->empresa->nome_responsavel ?? '' }}</strong></div>
        <div class="item">RESPONSÁVEL PELO JOVEM NA EMPRESA: <strong>{{ $contrato->responsavelJovem->nome ?? '' }}</strong></div>
    </div>

    <div class="bloco">
        <div class="titulo">CONTRATADO</div>
        <div class="item">NOME: <strong>{{ $contrato->aluno->nome }}</strong></div>
        <div class="item">RG: <strong>{{ $contrato->aluno->rg }}</strong></div>
        <div class="item">CPF: <strong>{{ Helper::mask($contrato->aluno->cpf,'###.###.###-##') }}</strong></div>
        <div class="item">DATA DE NASCIMENTO: <strong>{{ Helper::data_br($contrato->aluno->data_nascimento) }}</strong></div>
        <div class="item">ENDEREÇO: <strong>{{ $contrato->aluno->endereco->logradouro_endereco }} - {{ $contrato->aluno->endereco->numero_endereco }} - {{ $contrato->aluno->endereco->bairro_endereco }}</strong></div>
        <div class="item">CIDADE/UF: <strong>{{ $contrato->aluno->endereco->cidade->nome_cidade }}/{{ $contrato->aluno->endereco->cidade->estado->uf_estado }}</strong></div>
        <div class="item">CEP: <strong>{{ Helper::mask($contrato->aluno->endereco->cep_endereco,'#####-###') }}</strong></div>
        <div class="item">TELEFONE: <strong>{{ Helper::Phone($contrato->aluno->telefone) }}</strong></div>
        <div class="item">ESCOLARIDADE: <strong>{{ $contrato->aluno->escolaridade }}</strong></div>
        <div class="item">E-MAIL: <strong>{{ $contrato->aluno->user->email ?? '' }}</strong></div>
        <div class="item">RESPONSÁVEL: <strong>{{ $contrato->aluno->responsavel->nome ?? '' }} </strong></div>
        <div class="item">RG (RESPONSÁVEL): <strong>{{ $contrato->aluno->responsavel->rg ?? '' }} </strong></div>
        <div class="item">CPF (RESPONSÁVEL): <strong>{{ Helper::mask($contrato->aluno->responsavel->cpf ?? '','###.###.###-##') }} </strong></div>
    </div>

    <h2>Cláusula Primeira: DO OBJETO</h2>
    <p>PARAGRAFO PRIMEIRO: O objeto do presente Contrato é a admissão do CONTRATADO na condição de aprendiz, pelo ESTABELECIMENTO VINCULADO À COTA DE APRENDIZAGEM E CONTRATANTE, que além de comprometer-se a lhe propiciar a formação técnico-profissional prática, por meio do PROGRAMA DE APRENDIZAGEM, a seguir identificado, assume também a condição de empregador, de acordo com o art. 57, §2º, I, do Decreto 9.579/18 e conforme parceria celebrada com a ENTIDADE FORMADORA. </p>

    <div class="bloco">
        <div class="titulo">PROGRAMA DE APRENDIZAGEM</div>
        <div class="item">NOME DO PROGRAMA: <strong>{{ $contrato->curso->nome ?? '' }}</strong></div>
        <div class="item">FUNÇÃO/ARCO OCUPACIONAL: <strong>{{ $contrato->curso->funcao ?? '' }}</strong></div>
        <div class="item">CÓDIGO CBO: <strong>{{ $contrato->curso->cbo ?? '' }}</strong></div>
        <div class="item metade">INÍCIO DO CONTRATO: <strong>{{ Helper::data_br($contrato->data_inicial) }}</strong></div>
        <div class="item metade">TÉRMINO DO CONTRATO: <strong>{{ Helper::data_br($contrato->data_final) }}</strong></div>
    </div>
    <h2>Cláusula Segunda: DA FORMAÇÃO TEÓRICA E PRÁTICA </h2>
    <p>PARAGRAFO PRIMEIRO A aprendizagem profissional será desenvolvida em dois ambientes, a seguir identificados, onde serão realizadas atividades teóricas e práticas compatíveis com o desenvolvimento físico, psíquico, moral e social do CONTRATADO, em horários e locais que permitam a frequência à escola regular.</p>

    <div class="bloco">
        <div class="item">LOCAL DA FORMAÇÃO TEÓRICA: <strong>{{ $contrato->polo->endereco->logradouro_endereco }}, Nº {{ $contrato->polo->endereco->numero_endereco }}, Bairro: {{ $contrato->polo->endereco->bairro_endereco }}, {{ $contrato->empresa->endereco->cidade->nome_cidade }}/{{ $contrato->empresa->endereco->cidade->estado->uf_estado }}.</strong></div>
        <div class="item">DIA, TURNO E HORÁRIO DA APRENDIZAGEM TEÓRICA: <strong>{{ $contrato->dia_semana_teorico ?? '' }} - {{ $contrato->periodo_teorico ?? '' }}, {{ $contrato->hora_inicial_teorico ?? '' }} às {{ $contrato->hora_final_teorico ?? '' }}</strong></div>
        <div class="item">LOCAL DA FORMAÇÃO PRÁTICA: <strong>{{ $contrato->empresa->endereco->logradouro_endereco }}, Nº {{ $contrato->empresa->endereco->numero_endereco }}, Bairro: {{ $contrato->empresa->endereco->bairro_endereco }}, {{ $contrato->empresa->endereco->cidade->nome_cidade }}/{{ $contrato->empresa->endereco->cidade->estado->uf_estado }}</strong></div>
        <div class="item">TURNO E HORÁRIO DA APRENDIZAGEM PRÁTICA: <strong>{{ $contrato->periodo_pratico ?? '' }}.</strong></div>
        <div class="item">CARGA HORÁRIA DIÁRIA: <strong>{{ $contrato->curso->ch_diaria ?? '' }}</strong></div>
        <div class="item">CARGA HORÁRIA SEMANAL: <strong>{{ $contrato->curso->ch_semanal ?? '' }}</strong></div>
        <div class="item">CARGA HORÁRIA TOTAL: <strong>{{ $contrato->curso->ch_total ?? '' }}</strong></div>
        <div class="item auto">DESCRIÇÃO DAS ATIVIDADES PRÁTICAS DO APRENDIZ:  <strong>Registrar a entrada e saída de documentos; Distinguir documentos; Digitar textos e planilhas; Preencher formulários; Requisitar material; Tirar cópia de documentos; Receber malotes; Distinguir documentos para áreas específicas; Lacrar malote; Classificar documentos; Atualizar documentos em arquivo; Auxiliar no controle de estoque; Conferência de materiais em estoque; Atendimento telefônico e presencial ao cliente; Verificação a entrada e saída de mercadorias; Realizar correio interno; Entregar documentos internamente; Listar entrada e saída de documentos via malote; Informar departamentos sobre chegada de malotes para serem retirados; Elaborar planilha de controle de recebimentos de objetos e documentos; Arquivar documentos; Menores de 18 anos não farão serviços externos, não frequentarão ambientes insalubres e perigosos e não estarão em contato com bebidas alcoólicas de acordo com o Decreto 6.481/2008.</strong></div>
    </div>

    <p>PARAGRAFO SEGUNDO A distribuição da carga horária teórica e prática e o respectivo calendário de toda a formação profissional encontram-se no ANEXO I.</p>
    <h2>Cláusula Terceira: DAS OBRIGAÇÕES DA ENTIDADE FORMADORA</h2>
    <p>PARAGRAFO PRIMEIRO Elaborar programa de aprendizagem garantindo a formação profissional de qualidade ao (à) jovem matriculado (a) em seus cursos, compreendendo atividades teóricas e práticas, metodicamente organizadas em tarefas de complexidade progressiva;</p>
    <p>PARAGRAFO SEGUNDO Acompanhar o desenvolvimento do programa de aprendizagem e manter mecanismos de controle da frequência e aproveitamento dos (das) aprendizes nas atividades teóricas e práticas, de forma a garantir que as atividades práticas estejam contextualizadas no programa de aprendizagem previamente traçado;</p>
    <p>PARAGRAFO TERCEIRO Acompanhar a frequência do (da) jovem aprendiz na escola de origem;</p>
    <p>PARAGRAFO QUARTO Comunicar as irregularidades trabalhistas, praticadas pelas empresas empregadoras contra os (as) jovens, de que tenha conhecimento, à Delegacia Regional do Trabalho/DRT/MT/MTE para a adoção das medidas cabíveis; </p>

    <h2>Cláusula Quarta: DAS OBRIGAÇÕES DO ESTABELECIMENTO VINCULADO À COTA DE APRENDIZAGEM E CONTRATANTE</h2>
    <p>PARAGRAFO PRIMEIRO Garantir ao aprendiz empregado, no mínimo, o salário mínimo/hora mais repouso semanal remunerado, salvo condição mais favorável, remunerando-o com o valor de R$ {{ Helper::converte_valor_real($contrato->valor_bolsa ?? '0.00') }} ({{ $contrato->valor_bolsa_extenso ?? '' }}) por mês.</p>
    <p>PARAGRAFO SEGUNDO Sendo o valor acima estipulado por hora, o cálculo do salário mensal deverá obedecer ao fator semanal considerando o número de dias de cada mês. Se o valor acima estipulado for mês, este deve ser calculado considerando o fator semanal do mês de 31 dias, por ser o mais benéfico;</p>
    <p>PARAGRAFO TERCEIRO Havendo piso salarial do aprendiz expresso em Convenção ou Acordo Coletivo, este deve ser considerado, no mínimo.</p>
    <p>PARAGRAFO QUARTO Registrar na Carteira de Trabalho e Previdência Social, do CONTRATADO o presente Contrato de Aprendizagem, com a data de admissão coincidente com a do início e informar nas páginas de anotações gerais, o prazo e a função.</p>
    <p>PARAGRAFO QUINTO Garantir ao aprendiz empregado (a) todos os direitos trabalhistas e previdenciários que lhes forem devidos tanto durante a parte teórica quanto durante a parte prática do PROGRAMA DE APRENDIZAGEM;</p>
    <p>PARAGRAFO SEXTO Propiciar ao CONTRATADO o desenvolvimento das atividades que integram a prática profissional conforme PROGRAMA DE APRENDIZAGEM.</p>
    <p>PARAGRAFO SÉTIMO Informar a ENTIDADE FORMADORA, por escrito, além das ocorrências de faltas, insuficiência no desempenho e inadaptação, os casos de afastamento e rescisão antecipada.</p>
    <p>PARAGRAFO OITAVO: Entregar a folha ponto do aprendiz até o último dia do mês subsequente.</p>
    <p>PARAGRAFO NONO: Caso receba atestado médico do aprendiz, enviá-lo imediatamente à ENTIDADE FORMADORA.</p>

    <h2>Cláusula Quinta: DAS OBRIGAÇÕES DO CONTRATADO</h2>
    <P>PARAGRAFO PRIMEIRO: Obedecer às normas, regulamentos e regimentos internos vigentes no ESTABELECIMENTO VINCULADO À COTA DE APRENDIZAGEM E CONTRATANTE e na ENTIDADE FORMADORA em que estiver matriculado, executando suas atividades com responsabilidade e com compromisso.</P>
    <p>PARAGRAFO SEGUNDO Matricular-se e frequentar a escola regular, se não concluiu o ensino médio, apresentando obrigatoriamente e periodicamente, atestado de frequência e aproveitamento;</p>
    <p>PARAGRAFO TERCEIRO Participar regularmente das aulas e cumprir com exatidão a carga horária teórica e prática do PROGRAMA DE APRENDIZAGEM de acordo com as cláusulas Segunda e Terceira, respectivamente; Exibir ao ESTABELECIMENTO VINCULADO À COTA DE APRENDIZAGEM E CONTRATANTE, quando solicitado, documentação emitida pela ENTIDADE FORMADORA, comprobatória da frequência e do seu aproveitamento nas atividades teóricas. </p>
    <p>PARAGRAFO QUARTO Comunicar ao ESTABELECIMENTO VINCULADO À COTA DE APRENDIZAGEM E CONTRATANTE e a ENTIDADE FORMADORA os afastamentos em razão de licença-maternidade, acidente de trabalho, serviço militar ou auxílio-doença, devendo enviar atestado médico em até 2 (dois) dias úteis da data de sua emissão.</p>
    <p>PARAGRAFO QUINTO Estar ciente que o ESTABELECIMENTO VINCULADO À COTA DE APRENDIZAGEM E CONTRATANTE e a ENTIDADE FORMADORA possuem um programa de integridade, o qual comtempla um código de ética que deve ser seguido.</p>

    <h2>Cláusula Sexta: DO PRAZO</h2>
    <p>PARAGRAFO PRIMEIRO O presente Contrato vigorará de {{ Helper::data_br($contrato->data_inicial) }} até {{ Helper::data_br($contrato->data_final) }}, não podendo ser prorrogado.</p>

    <h2>Cláusula Sétima: DOS CASOS DE AFASTAMENTO</h2>
    <p>PARAGRAFO PRIMEIRO É assegurado à aprendiz gestante o direito à estabilidade provisória prevista no art. 10, II, “b”, do ACDT.</p>
    <p>PARAGRAFO SEGUNDO Em caso de afastamento da aprendiz CONTRATADA em razão de licença-maternidade, será garantido à jovem o retorno ao mesmo PROGRAMA DE APRENDIZAGEM, caso ainda esteja em curso, devendo a ENTIDADE FORMADORA certificar a aprendiz pelos módulos que concluir com aproveitamento.</p>
    <p>PARAGRAFO TERCEIRO Na hipótese de o Contrato de Aprendizagem alcançar seu termo final durante o período de estabilidade, deverá o ESTABELECIMENTO VINCULADO À COTA DE APRENDIZAGEM E CONTRATANTE promover um aditivo ao contrato juntamente com a ENTIDADE FORMADORA, prorrogando-o até o último dia do período da estabilidade, ainda que tal medida resulte em contrato superior a dois anos ou mesmo que a aprendiz alcance vinte e quatro anos.</p>
    <p>PARAGRAFO QUARTO Em caso de afastamento do aprendiz CONTRATADO em razão de serviço militar, auxílio-doença ou acidente de trabalho ocorrido durante o a execução deste contrato, a reposição dos dias de afastamento, se for de interesse das partes, conforme previsão do art. 472, §2º da CLT, só será possível mediante autorização da ENTIDADE FORMADORA que avaliará a possibilidade de recuperar os prejuízos à formação profissional causados pelo decurso do tempo.</p>
    <p>PARAGRAFO QUINTO Caso o termo final do contrato ocorra durante o período de afastamento e não tenha sido feita a opção do art. 472, §2º da CLT, o contrato deverá ser rescindido na data predeterminada para o seu término.</p>
    <p>PARAGRAFO SEXTO O direito à estabilidade no emprego também se aplica aos casos de acidente de trabalho, devidamente comprovados.</p>

    <h2>Cláusula Oitava: DA DECLARAÇÃO DE MATRÍCULA</h2>
    <p>PARAGRAFO PRIMEIRO A Declaração de Matrícula contendo a duração da Aprendizagem, o curso e a carga horária a qual estará submetido (a) o (a) aprendiz é parte integrante deste contrato.</p>
    
    <h2>Cláusula Nona: DA PROTEÇÃO DOS DADOS</h2>
    <p>PARAGRAFO PRIMEIRO - As Partes comprometem-se a tratar e salvaguardar como privadas e confidenciais todas as informações relativas ao objeto deste instrumento e a não as divulgar a terceiros sem o consentimento prévio e expresso da Parte Reveladora pelo período de 05 (cinco) anos após a rescisão. Assim, as Partes obrigam-se a manter sigilo sobre quaisquer dados, materiais, documentos, especificações técnicas, comerciais ou quaisquer informações do presente contrato, de que venham a ter acesso ou conhecimento, ou ainda que lhe tenham sido confiados, não podendo, sob qualquer pretexto ou desculpa, omissão, culpa ou dolo revelar, reproduzir ou deles dar conhecimento a estranhos dessa contratação.</p>
    <p>PARAGRAFO SEGUNDO - Caso quaisquer atividades relacionadas à execução deste Instrumento requeira o tratamento de dados pessoais, as Partes se obrigam a cumprir as normas de proteção de dados de acordo com a Lei 13.709/2018 (Lei Geral de Proteção de Dados - LGPD), empenhando-se em adotar as melhores práticas de guarda e segurança das informações.</p>
    
    <h2>Cláusula Décima: DA RESCISÃO</h2>
    <p>PARAGRAFO PRIMEIRO O presente contrato será automaticamente rescindido quando for atingido seu termo fixado na Cláusula Sexta ou quando o aprendiz completar 24 anos, o que ocorrer primeiro, ou antecipadamente, nos termos do art. 433 da CLT e seus parágrafos, nos seguintes casos:</p>
    <p>PARAGRAFO SEGUNDO Na hipótese de desempenho insuficiente ou inadaptação do (da) aprendiz, mediante parecer técnico da ENTIDADE FORMADORA; </p>
    <p>PARAGRAFO TERCEIRO Falta disciplinar grave; </p>
    <p>PARAGRAFO QUARTO ausência injustificada à escola que implique em perda do ano letivo; </p>
    <p>PARAGRAFO QUINTO A pedido do aprendiz.</p>

    <p>Fica eleito o foro da comarca de Campo Verde - MT, com renúncia expressa de qualquer outro, por mais privilegiado que seja, para serem dirimidas quaisquer questões ou litígios provenientes do presente instrumento.</p>
    <p>E por estarem assim justos e acordados, as partes firmam o presente Instrumento, na presença das testemunhas idôneas abaixo assinadas.</p>
    <p>{{ $contrato->polo->endereco->cidade->nome_cidade }} – {{ $contrato->polo->endereco->cidade->estado->uf_estado }}, {{ Helper::dataExtenso($contrato->data_inicial) }}.</p>

    <div class="assinatura-lar">
        <div class="assinatura"></div>
       <div class="base"><strong>Instituição Qualificadora</strong><br/>Associação Espírita Lar Maria de Lourdes</div>
    </div>

    <div class="assinatura-empresa">
        <div class="assinatura"></div>
       <div class="base"><strong>{{ $contrato->empresa->nome_responsavel }}</strong><br/>RESPONSÁVEL PELA EMPRESA</div>
    </div>

    <div class="assinatura-empresa">
        <div class="assinatura"></div>
       <div class="base"><strong>{{ $contrato->responsavelJovem->nome ?? '' }}</strong><br/>Responsável pelo Jovem na Empresa</div>
    </div>

    <div class="assinatura-testemunha">
        <div class="assinatura"></div>
       <div class="base"><strong>{{ $contrato->aluno->nome }}</strong><br/>Jovem Aprendiz</div>
    </div>

    @if(Helper::calcula_idade($contrato->aluno->data_nascimento) > 17)
    <div class="assinatura-testemunha responsavel">

    </div>
    @else
    <div class="assinatura-testemunha responsavel">
        <div class="assinatura"></div>
       <div class="base"><strong>{{ $contrato->aluno->nome_responsavel ?? '' }}</strong><br/>Responsável Legal pelo Jovem</div>
    </div>
    @endif

    <div class="assinatura-testemunha">
        <div class="assinatura"></div>
       <div class="base">Testemunha</div>
    </div>

    <div class="assinatura-testemunha">
        <div class="assinatura"></div>
       <div class="base">Testemunha</div>
    </div>

</div>

<div class="contrato declaracao pagebreak">
    <div class="topo">
        <div class="logo"><img src="/assets/sistema/img/logo-lar-contrato.png" alt=""></div>
    </div>

    <div class="informacoes">
        ASSOCIAÇÃO ESPÍRITA LAR MARIA DE LOURDES<br/>
        DECLARAÇÃO DE MATRÍCULA – PROGRAMA JOVEM APRENDIZ<br/>
        CONTRATO Nº <strong>{{ $contrato->numero }}</strong>
    </div>

    <p>Declaramos que o (a) aprendiz {{ $contrato->aluno->nome }} está matriculado (a) no Curso de Aprendizagem Profissional {{ $contrato->curso->funcao ?? '' }} no período de {{ Helper::data_br($contrato->data_inicial) }} a {{ Helper::data_br($contrato->data_final) }} exercendo atividades teóricas e práticas sendo distribuídas:</p>

    <ul>
        <li>1.	Carga Horária INICIAL: 10 Encontros de 04 horas diárias</li>
        <li>
            2.	Carga Horária MÓDULO PROFISSIONALIZANTE:
            <ul>
                <li>a)	Teórica: 50 encontros de 04 horas (200 horas)</li>
                <li>b)	Prática: 110 encontros de 04 horas (440 horas)</li>
            </ul>
        </li>
        <li>
            3.	Carga Horária MÓDULO ESPECÍFICO:
            <ul>
                <li>a)	Teórica: 50 encontros de 04 horas (200 horas)</li>
                <li>b)	Prática: 110 encontros de 04 horas (440 horas)</li>
            </ul>
        </li>
    </ul>

    <p>{{ $contrato->polo->endereco->cidade->nome_cidade }} – {{ $contrato->polo->endereco->cidade->estado->uf_estado }}, {{ Helper::dataExtenso($contrato->data_inicial) }}.</p>

    <!--
    <div class="assinatura-gestor declaracao">
        <div class="assinatura"><img src="/assets/sistema/img/assinatura-lar.png" alt=""></div>
        <div class="base"><strong>Instituição Qualificadora</strong><br/>Associação Espírita Lar Maria de Lourdes</div>
    </div>
    -->

</div>


<div class="contrato declaracao pagebreak">
    <div class="topo">
        <div class="logo"><img src="/assets/sistema/img/logo-lar-contrato.png" alt=""></div>
    </div>

    <div class="informacoes">
        ANEXO II – TERMO DE AUTORIZAÇÃO DE USO DE IMAGEM
    </div>

    <p>Eu, {{ $contrato->aluno->nome }}, portador da Cédula de Identidade nº {{ $contrato->aluno->rg }}, inscrito no CPF sob nº {{ $contrato->aluno->cpf }}, residente à Rua {{ $contrato->aluno->endereco->logradouro_endereco }}, nº {{ $contrato->aluno->endereco->numero_endereco }}, na cidade de {{ $contrato->aluno->endereco->cidade->nome_cidade }} - {{ $contrato->aluno->endereco->cidade->estado->uf_estado }}, AUTORIZO o uso de minha imagem (ou do menor_________________________________ sob minha responsabilidade) em fotos ou filme, sem finalidade comercial, por tempo indeterminado pela instituição qualificadora ASSOCIAÇÃO ESPÍRITA LAR MARIA DE LOURDES (instituição sem fins lucrativos). </p>
    <p>A presente autorização é concedida a título gratuito, abrangendo o uso da imagem acima mencionada em todo território nacional e no exterior, em todas as suas modalidades e, em destaque, das seguintes formas: (I) home page; (II) cartazes; (III) divulgação em geral. Por esta ser a expressão da minha vontade declaro que autorizo o uso acima descrito sem que nada haja a ser reclamado a título de direitos conexos à minha imagem ou a qualquer outro.</p>

    <p>{{ $contrato->polo->endereco->cidade->nome_cidade }} – {{ $contrato->polo->endereco->cidade->estado->uf_estado }}, {{ Helper::dataExtenso($contrato->data_inicial) }}.</p>

    <div class="assinatura-gestor declaracao">
        <div class="assinatura"></div>
        @if(Helper::calcula_idade($contrato->aluno->data_nascimento) > 17)
        <div class="base"><strong>Assinatura</strong><br/>{{ $contrato->aluno->nome }}</div>
        @else
        <div class="base"><strong>Assinatura</strong><br/>{{ $contrato->aluno->nome_responsavel }}<br/>Responsável Legal pelo Jovem</div>
        @endif

    </div>

</div>


<div class="contrato declaracao pagebreak">
    <div class="topo">
        <div class="logo"><img src="/assets/sistema/img/logo-lar-contrato.png" alt=""></div>
    </div>

    <div class="informacoes">
        <strong>ASSOCIAÇÃO ESPÍRITA LAR MARIA DE LOURDES</strong><br><br>
        PROGRAMA JOVEM APRENDIZ<br>
        Utilidade Pública Estadual, Lei 6.749 De 18/01/96<br>
        CNPJ: 37.501.038/0001 – 58<br><br><br>
        TERMO DE COMPROMISSO E RESPONSABILIDADE DO USO DE UNIFORME
    </div>

    <p>Eu, {{ $contrato->aluno->nome }}, RG: {{ $contrato->aluno->rg }}, CPF: {{ $contrato->aluno->cpf }}, mediante este instrumento declaro que recebi {{ $uniforme->quantidade ?? ''}} uniformes no tamanho {{ $uniforme->tamanho ?? ''}}, e prometo responsabilizar-me pelo uso e conservação do uniforme a mim confiada, de propriedade da Empresa {{ $contrato->empresa->razao_social }} e sobre o domínio da Associação Espírita Lar Maria de Lourdes, inscrita no CNPJ sob o nº {{ $poloMatriz->cnpj ?? '' }} com sede á {{ $poloMatriz->endereco->logradouro_endereco }}, Nº {{ $poloMatriz->endereco->numero_endereco }}, Bairro: {{ $poloMatriz->endereco->bairro_endereco }}, Cidade de {{ $poloMatriz->endereco->cidade->nome_cidade }} - {{ $poloMatriz->endereco->cidade->estado->uf_estado }}, CEP: {{ $poloMatriz->endereco->cep_endereco }}, pelo prazo de 16 (dezesseis) meses, duração do Contrato, ou quando do rompimento do mesmo, a contar desta data, comprometendo mediante a apresentação de justificativa cabível. Em caso de extravio e /ou danos que acarretem a perda total ou parcial do uniforme, ocasionados por falta de zelo, fica o jovem obrigado a ressarcir o proprietário dos prejuízos.</p>

    <p>{{ $poloMatriz->endereco->cidade->nome_cidade }} – {{ $poloMatriz->endereco->cidade->estado->uf_estado }}, {{ Helper::dataExtenso($contrato->data_inicial) }}.</p>


    <div class="assinatura-gestor declaracao">
        <div class="assinatura"></div>
        @if(Helper::calcula_idade($contrato->aluno->data_nascimento) > 17)
        <div class="base"><strong>Assinatura</strong><br/>{{ $contrato->aluno->nome }}</div>
        @else
        <div class="base"><strong>Assinatura</strong><br/>{{ $contrato->aluno->nome_responsavel }}<br/>Responsável Legal pelo Jovem</div>
        @endif
    </div>

    <div class="frase">"Ser jovem é ter a alegria de viver, conduzi-lo no caminho do bem será sempre a nossa alegria”</div>
    <div class="info-footer">Av. Santa Tereza, 893, Bairro Jupiara - Fone: (66) 3419-1184 <br>E-mail: jovemaprendiz@larmariadelourdes.org</div>

</div>

</body>
</html>
