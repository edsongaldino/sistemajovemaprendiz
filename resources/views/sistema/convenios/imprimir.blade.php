<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CONVÊNIO Nº {{ $convenio->numero ?? '' }} </title>
    <style>
        html body{
            margin: 0;
            padding: 0;
        }

        .contrato{
            width: 1024px;
            padding: 30px;
            margin: 0 auto;
            text-align: justify;
            font-family: Arial, Helvetica, sans-serif;
        }

        .contrato .titulo{
            width: 100%;
            padding: 30px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 22px;
            font-weight: bold;
        }

        .contrato .assinatura-lar{
            width: 40%;
            height: auto;
            float: left;
            margin-left: 5%;
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
            float: right;
            margin-right: 5%;
            margin-top: 120px;
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
            margin-top: 80px;
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

        .contrato .titulo-testemunhas{
            width: 100%;
            height: 40px;
            text-align: center;
            float: left;
            margin-top: 80px;
        }
    </style>
</head>
<body>
   <div class="contrato">
    <div class="topo">
        <div class="logo"><img src="/assets/sistema/img/logo-lar-contrato.png" alt=""></div>
        <div class="informacoes">
            CONVÊNIO Nº <strong>{{ $convenio->numero ?? '' }}</strong><br/>
            CONVÊNIO QUE ENTRE SI CELEBRAM DE UM LADO, A ASSOCIAÇÃO ESPÍRITA LAR MARIA DE LOURDES E DE OUTRO <strong>{{ $convenio->empresa->razao_social ?? '' }}</strong>
        </div>
    </div>
    <div class="titulo">REGISTRO PELA EMPRESA</div>
    <p>CONVENIANTE: ASSOCIAÇÃO ESPÍRITA LAR MARIA DE LOURDES, CNPJ: 37.501.038/0001-58 e Inscrição Estadual: Isento com sede à Av. Santa Tereza, Nº 893, JUPIARA, CAMPO VERDE – MT, CEP: 78.840-000, com registro no Conselho Municipal dos Direitos da Criança e do Adolescente de Campo Verde – MT, tendo as atividades teóricas na ASSOCIAÇÃO ESPÍRITA LAR MARIA DE LOURDES – CNPJ: 37.501.038/0001-58 e Inscrição Estadual: Isento, com sede à Avenida Santa Tereza, Nº 893, Bairro: Jupiara, Cidade de Campo Verde – MT, CEP: 78.840-000, com registro no Conselho Municipal dos Direitos da Criança e do Adolescente de Campo Verde - MT, neste ato representada por seu Presidente, DIRCEU BELARMINO PEREIRA, brasileiro, divorciado, pedagogo, inscrito no CPF n° 483.500.281-49, e no RG nº 07155182 SSP/MT, residente e domiciliado na Av. Santa Tereza, nº 893, Bairro: Jupiara, no município de Campo Verde – MT, que por sua vez se faz representar por EVERALDO GONÇALVES DE OLIVEIRA, brasileiro, divorciado, Gerente Financeiro, inscrito no CPF nº 570.706.041-04, e no RG nº 959780 SSP/MT, residente e domiciliado na Rua I, lote 35, quadro 08, Bairro: Greenville, no município de Campo Verde – MT, ou DENILSON BELARMINO PEREIRA, brasileiro, casado, Assessor Administrativo, inscrito no CPF nº 482.354.821-34, e no RG nº 0720523-6 SESP/MT, residente e domiciliado na Rua Portugal, nº 08, Bairro: Ponte Nova, no município de Várzea Grande – MT.</p>
    <p>CONVENIADA: {{ $convenio->empresa->razao_social ?? '' }}, CNPJ: {{ $convenio->empresa->cnpj ?? '' }} e Inscrição Estadual: {{ $convenio->empresa->inscricao_estadual ?? '' }}, situada na  {{ $convenio->empresa->endereco->logradouro_endereco ?? '' }}, Nº {{ $convenio->empresa->endereco->numero_endereco ?? '' }}, Bairro: {{ $convenio->empresa->endereco->bairro_endereco ?? '' }}, CEP: {{ $convenio->empresa->endereco->cep_endereco ?? '' }}, {{ $convenio->empresa->endereco->cidade->nome_cidade ?? '' }} - {{ $convenio->empresa->endereco->cidade->estado->uf_estado ?? '' }}, adiante denominado CONVENIADA, neste ato representado por seu representante/Procurador legal {{ $convenio->empresa->nome_responsavel ?? '' }}, portador (a) do RG: {{ $convenio->empresa->rg_responsavel }}/{{ $convenio->empresa->emissor_rg_responsavel }}, CPF: {{ $convenio->empresa->cpf_responsavel }}, celebram o presente convênio na forma das cláusulas a seguir explicitadas.</p>
    <h2>CLÁUSULA PRIMEIRA - DO OBJETO</h2>
    <p>Parágrafo Primeiro - O presente Convênio tem por objeto promover o desenvolvimento pessoal e profissional de jovens carentes, com idade, preferencialmente, entre 14 (quatorze) e 24(vinte e quatro) anos na condição de assistidos, por intermédio de ações que lhes assegurem a aquisição de hábitos, experiências e atitudes indispensáveis à formação humana e social, formação técnico-profissional metódica, bem como a inserção no mercado de trabalho formal.</p>
    <p>Parágrafo Segundo - A CONVENIANTE encaminhará, {{ $convenio->qtde_jovens }}@if($convenio->qtde_jovens > 1) jovens, pertencentes preferencialmente à famílias com baixa renda @else jovem, pertencente preferencialmente à família com baixa renda @endif, assistindo-o no aprendizado prático para a CONVENIADA, com quem o jovem manterá vínculo empregatício.</p>
    <p>Parágrafo terceiro - A atividade laborativa de que trata o Parágrafo Primeiro estará sujeita à legislação trabalhista, Lei nº. 8.069, de 13/07/90; na Consolidação das Leis do Trabalho-CLT, em seus artigos que regulam o trabalho do Jovem na condição de aprendiz, com a nova redação dada pela Lei nº. 10.097, de 19/12/2000, o Decreto 5.598 de 01/12/2005 e demais disposições legais e regulamentares que regem o trabalho do Jovem, de modo geral e no que lhe forem aplicáveis.</p>
    <p>Parágrafo quarto - O jovem poderá efetuar os seguintes serviços: APRENDIZ DE AUXILIAR EM SERVIÇOS ADMINISTRATIVOS, com duração total de 16 (dezesseis) meses, sendo a jornada diária de 4(quatro) horas por dia, no total de 20(vinte) semanais,  totalizando 1.280 horas, exercidas na prática 880horas e na teórica 400horas.    Desenvolvidas em atividades teóricas de forma presencial e semipresencial, metodicamente organizadas conforme proposta pedagógica. E em atividades práticas de complexidade progressiva desenvolvidas no ambiente de trabalho.</p>
    <p>Parágrafo quinto - É vedado aos jovens executarem serviços particulares, manipularem valores em dinheiro e/ou executarem tarefas não compatíveis com sua função na empresa, assim como as atividades proibidas pela Portaria nº 88 de 28/04/2009 / SIT – Secretaria de Inspeção do Trabalho publicada no D.O.U. 29/04/2009.</p>                                                
    <h2>CLÁUSULA SEGUNDA  - DAS OBRIGAÇÕES DAS PARTES</h2>
    <h3>Parágrafo Primeiro - Constituem obrigações da CONVENIADA:</h3>
    <p>I. Colaborar com a CONVENIANTE na supervisão e na avaliação dos jovens colocados à sua disposição, assegurando aos seus prepostos o acesso aos locais onde prestam serviço;</p>
    <p>II. Participar do aprendizado teórico quando houver solicitação da conveniante, desde que a conveniada esteja apta tecnicamente para tal;</p>
    <p>III. Receber, acompanhar, orientar, esclarecer e estimular o jovem durante o aprendizado prático, garantindo que esse aprendizado se faça por etapas, do mais simples para o mais complexo;</p>
    <p>IV. Designar preceptor que prestará ao jovem às informações iniciais sobre a CONVENIADA e o objetivo do trabalho a ser realizado, bem como o acompanhará no âmbito da Unidade, cabendo àquele informar a respeito do comportamento, atitudes, desempenho, educação e progresso dos adolescentes quando solicitado pela CONVENIANTE e sempre que julgar necessário;</p>
    <p>V. Fazer o controle e a anotação diária do horário de trabalho cumprido pelo jovem, exigindo a sua assinatura em folha de frequência, remetendo mensalmente à CONVENIANTE os respectivos controles, até o décimo dia útil do mês subsequente, para acompanhamento;</p>
    <p>VI Responsabilizar-se pelas obrigações sociais e trabalhistas pertinentes aos jovens encaminhados pela CONVENIANTE, tais como: pagamento de salários, INSS, FGTS, férias, PIS, acidente de trabalho, 13º salário, aviso prévio, rescisão do contrato de trabalho e outros na forma da legislação aplicável;</p>
    <p>VII. Comunicar via e-mail, o desligamento de jovens por um prazo de 3 (três) dias úteis, a partir do pedido de desligamento do jovem ou da constatação da falta grave, (no caso de falta grave a CONVENIANTE deverá acompanhar a situação e dar o suporte necessário para este encaminhamento, para que sejam tomadas as providências nos termos do art.433, da CLT;</p>
    <p>VIII. Comunicar à CONVENIANTE, imediatamente e por escrito, as irregularidades porventura cometidas pelo jovem;</p>
    <p>IX. Estabelecer jornada máxima de 20 (vinte) horas semanais e jornada diária compatível com o horário escolar do adolescente, não superior a 4 (quatro) horas, conforme contrato de aprendizagem  com o jovem;</p>
    <p>X. Promover o acompanhamento e a fiscalização da execução do Convênio, visando ao seu perfeito cumprimento, anotando em registro próprio às falhas detectadas e comunicando à CONVENIANTE as ocorrências de quaisquer fatos que exijam medidas corretivas por parte desta;</p>
    <p>XI. Efetuar pagamento do boleto mensal à CONVENIANTE, de acordo com as condições de preço e de prazo estabelecidos neste Convênio;</p>
    <p>XII. Repassar pontualmente à CONVENIANTE os valores estabelecidos na planilha de custo, que passa a fazer parte deste instrumento contratual;</p>
    <h3>Parágrafo Segundo - Compete à CONVENIANTE:</h3>
    <p>I. Executar o Programa de Aprendizagem, ministrando o aprendizado teórico, orientando e supervisionando a execução do aprendizado prático na empresa;</p>
    <p>II. Selecionar jovem, prepará-los e encaminhá-los à CONVENIADA devidamente uniformizados.</p>
    <p>III. Supervisionar as atividades dos jovens, em colaboração com a CONVENIADA, por meio de entrevistas, reuniões e visitas ao local de trabalho, estas previamente acordadas com a mesma;</p>
    <p>IV. Acompanhar periodicamente as atividades escolares dos jovens, fiscalizando a matrícula e frequência escolar dos aprendizes que não tiverem concluído o ensino obrigatório;</p>
    <p>V. Ministrar conteúdos teóricos de formação técnico-profissional e oferecer aos adolescentes orientações gerais sobre higiene e segurança do trabalho, bem como noções de cidadania, ética e convivência comunitária;</p>
    <p>VI. Substituir os jovens mediante solicitação da CONVENIADA, depois de esgotada todas as possibilidades de permanência de acordo com a legislação vigente;</p>
    <p>VII. Manter a CONVENIADA informada sobre quaisquer eventos que dificultem ou interrompam o curso normal do Convênio;</p>
    <p>VIII. Apresentar a inscrição de seu Programa de Aprendizagem junto ao Conselho Municipal dos Direitos da Criança e do Adolescente, na forma do parágrafo único, do art. 90 da Lei n. 8.069, de 13 de julho de 1.990;</p>
    <p>IX. Estruturar o Programa de Aprendizagem contemplando os requisitos da Portaria 723 e 1003, de 23/04/2012 e 04/12/2008, do Ministério do Trabalho e Emprego;</p>
    <p>X. Selecionar e contratar instrutores;</p>
    <p>XI. Garantir a articulação e complementaridade entre a aprendizagem teórica e a prática;</p>
    <p>XII. Avaliar o processo de aprendizagem e fornecer certificado definindo as competências, os conteúdos e as habilidades adquiridas durante o Programa de Aprendizagem;</p>
    <p>XIII. Desenvolver o Programa de Aprendizagem em ambientes adequados que ofereçam as condições de segurança e saúde, em conformidade com as regras do art.405, da CLT, e das Normas Regulamentares aprovadas pela Portaria No 3.214/78;</p>
    <p>XIV. Desenvolver o Programa de Aprendizagem em horários compatíveis com a agenda escolar de cada aprendiz, de modo a não prejudicar a sua frequência às aulas do ensino regular.</p>
    <h3>CLÁUSULA TERCEIRA - DO VALOR</h3>
    <h3>Parágrafo Primeiro - A CONVENIADA repassará à CONVENIANTE a importância mensal estabelecida na planilha de custo que segue em anexo e que passa a ser parte integrante deste Instrumento Contratual, calculada com base em cada jovem colocado à sua disposição.</h3>
    <p>Parágrafo Segundo - Os preços poderão ser revistos sempre que ocorrerem fatos supervenientes e imprevisíveis, não imputados às partes. Os reajustes quando ocorrerem, seguirão a variação percentual (%) do salário mínimo do Governo Federal.</p>
    <p>Parágrafo Terceiro - No caso dos ressarcimentos de despesas com formação e despesas administrativas, mencionados da planilha de custo (Seleção Habilitação), será devida sempre proporcionalmente.</p>
    <p>Parágrafo Quarto - Os valores com o ressarcimento em Seleção e Habilitação acordados na planilha de custo seguirão a variação do salário mínimo.</p>
    <h3>CLÁUSULA QUARTA - DA TRANSFERÊNCIA DE RECURSOS</h3>
    <p>Parágrafo Primeiro - A CONVENIANTE emitirá e enviará à CONVENIADA, até o dia 20 (VINTE) do mês corrente, documento de cobrança referente aos custos apurados conforme cláusula anterior, que deverá ser pago pela CONVENIADA até o dia 25 (Vinte e cinco) do mesmo mês. O valor da fatura deverá ser pago somente através de Boleto Bancário. </p>
    <p>Parágrafo Segundo - No caso de não pagamento à CONVENIANTE, até as datas estabelecidas no presente Convênio, a CONVENIADA pagará à CONVENIANTE o índice de correção monetária diária baseada no IGP-M, além de 2% (dois) por cento de multa e 1% (um) por cento de juros de mora mensal.</p>
    <p>Parágrafo Terceiro - Os valores acordados neste Instrumento que tenham sido apurados em face da remessa do documento de cobrança sem a observância das formalidades previstas neste capítulo, deverão ser apresentados na fatura do mês subsequente.</p>
    
    <h3>CLÁUSULA QUINTA - DA VIGÊNCIA</h3>
    <p>Parágrafo Primeiro - Este Convênio terá a duração por tempo indeterminado, a partir da data de sua assinatura, podendo ser aditado, no interesse das partes, por meio de Termo Aditivo.</p>
    <!--<p>CLÁUSULA NONA - Nos intervalos entre o término do Instrumento Contratual do aprendiz e entrada de outro jovem à empresa, a CONVENIADA, ficará obrigada a repassar os valores integrais referentes aos ressarcimentos das despesas administrativas e formação do jovem aprendiz neste período à CONVENIANTE, conforme Convênio firmado e vigente entre as partes, salvo, solicitação de cancelamento do Convênio ou Aditivo do Convênio diminuindo o número de jovens requerida pela empresa, no prazo de 30 (trinta) dias antes ao término do contrato com o aprendiz. </p>-->
    <h3>CLÁUSULA SEXTA - DA DENÚNCIA</h3>
    <p>Parágrafo Primeiro - É facultado às partes denunciar o presente Convênio a qualquer tempo, mediante simples aviso por escrito, com antecedência mínima de 30 (trinta) dias, desde que seja cumprido o pagamento dos valores acordados até aquela data e sempre levar em consideração o jovem, este não poderá ser prejudicado, devendo ser mantido seus direitos trabalhistas até o final de seu contrato.</p>
    
    <h3>CLÁUSULA SÉTIMA - DAS DISPOSICÕES GERAIS</h3>
    <p>Parágrafo Primeiro - Os Jovens que serão encaminhados à CONVENIADA devem ter idade mínima de 14 (quatorze) anos, e devem estar frequentando ensino regular ou supletivo de 1º e 2º graus, comprovados por documentos específicos.</p>
    <p>Parágrafo Segundo - Os Jovens cumprirão jornada de trabalho de 20 (vinte) horas semanais, de 2ª (Segundas-feiras) a 6ª (Sexta-feira), em período VESPERTINO OU MATUTINO, sendo expressamente proibidas horas extras e/ou compensação de horas.</p>
    <p>Parágrafo Terceiro - O horário de trabalho deve ser compatível com o horário escolar dos Jovens.</p>
    <p>Parágrafo Quarto - Em caso de perda, extravio ou furto de valores ou títulos representativos de quaisquer montantes, pelos jovens, a CONVENIANTE se exime de qualquer responsabilidade.</p>
    <p>Parágrafo Quinto - O jovem será dispensado, podendo ocorrer à reposição, a critério da CONVENIANTE:</p>
    <ul>
        <li>I. A seu pedido, com assistência de seu representante legal;</li>
        <li>II. Por abandono dos estudos;</li>
        <li>III. Por frequência irregular às atividades escolares, que implique perda do ano letivo;</li>
        <li>IV. Por falta disciplinar grave;</li>
        <li>V. Por desempenho insuficiente;</li>
        <li>VI. Por inadaptação do aprendiz;</li>
        <li>VII. Nos casos previstos na cláusula décima quarta.</li>
    </ul>
    <p>Parágrafo Sexto - Caso a CONVENIADA opte pela reposição, poderá fazer a seleção de outro aprendiz ou esta poderá ser providenciada pela CONVENIANTE. </p>
    <p>Parágrafo Sétimo - A CONVENIADA se responsabilizará pelas demandas trabalhistas e previdenciárias relativas aos jovens alcançados por este Convênio, sempre respeitando o direito de regresso caso a demanda judicial verse acerca de situações ocorridas e vivenciadas na CONVENIANTE que gere qualquer tipo de dano extrapatrimonial.</p>
    <h3>CLÁUSULA OITAVA - DA LEGISLAÇÃO APLICÁVEL</h3>
    <p>Parágrafo Primeiro - Aplicam-se à execução do presente Convênio as Leis 8.666, de 21.06.1993; 8.069, de 13.07.1990 - Estatuto da Criança e do Adolescente; o Decreto-lei No 5.452, de 01.05.1943 - Consolidação das Leis do Trabalho - e demais normas legais pertinentes.</p>
    <h3>CLÁUSULA NONA - DO FORO</h3>
    <p>Parágrafo Primeiro - Fica eleito o foro da comarca de Campo Verde – MT, com renúncia expressa de qualquer outro, por mais privilegiado que seja, para serem dirimidas quaisquer questões ou litígios provenientes do presente instrumento.</p>
    <p>E por estarem assim justos e acordados, as partes firmam o presente Instrumento, na presença das testemunhas idôneas abaixo assinadas.</p>
    <p>Campo Verde - MT, {{ Helper::dataExtenso($convenio->data_inicial) }}.</p>

    <div class="assinatura-lar">
        <div class="assinatura"></div>
       <div class="base">ASSOCIAÇÃO ESPÍRITA LAR MARIA DE LOURDES</div> 
    </div>

    <div class="assinatura-empresa">
        <div class="assinatura"></div>
       <div class="base"><strong>{{ $convenio->empresa->nome_responsavel }}</strong><br/>RESPONSÁVEL PELA EMPRESA</div> 
    </div>

    <div class="titulo-testemunhas">Testemunhas:</div>

    <div class="assinatura-testemunha">
        <div class="assinatura"></div>
       <div class="base"></div> 
    </div>

    <div class="assinatura-testemunha t2">
        <div class="assinatura"></div>
       <div class="base"></div> 
    </div>

    <div class="frase">“Ser jovem e ter alegria de viver, conduzi-lo no caminho do bem será sempre nossa alegria”</div>

</div> 
</body>
</html>