<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>Programa Jovem Aprendiz - Lar Maria de Lourdes</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="/assets/site/images/favicon.png" type="image/png">

    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="/assets/site/css/magnific-popup.css">

    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="/assets/site/css/slick.css">

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="/assets/site/css/LineIcons.css">

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="/assets/site/css/bootstrap.min.css">

    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="/assets/site/css/default.css">

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="/assets/site/css/style.css">

    <!--====== Jquery js ======-->
    <script src="/assets/site/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="/assets/site/js/vendor/modernizr-3.7.1.min.js"></script>

    <link href="{{ asset('assets/sistema/lib/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->


    <!--====== NAVBAR TWO PART START ======-->

    <section class="navbar-area navbar-cadastro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">

                        <a class="navbar-brand logo-lar" href="#">
                            <img src="/assets/site/images/logo.png" alt="Logo">
                        </a>

                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <section id="cadastro" class="formulario-cadastro">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-30">
                        <h3 class="title">Cadastro Jovem Aprendiz</h3>
                        <p class="text cadastro">Para efetuar o cadastro, preencha todos os campos abaixo</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->

            <div class="row">
                <div class="col-lg-12">

                    <div class="contact-wrapper form-style-two"></div>

                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                                <form name="cadastro-completo-jovem" id="cadastro-completo-jovem" action="{{ route('gravar-cadastro-completo') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="tipo_cadastro" value="Jovem">
                                    <input type="hidden" name="id" value="{{ $cadastro->id ?? '' }}">

                                    <div class="row">

                                        <div class="titulo-modulo">1. Dados Pessoais</div>

                                        <div class="col-md-8">
                                            <div class="form-input mt-10">
                                                <label>Nome completo</label>
                                                <div class="input-items default">
                                                    <input name="nome" type="text" value="{{ $cadastro->nome_completo ?? '' }}" required>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Data de Nascimento</label>
                                                <div class="input-items default">
                                                    <input type="date" name="data_nascimento" id="data_nascimento" placeholder="00/00/0000" value="{{ $cadastro->data_nascimento ?? '' }}" required>
                                                    <i class="lni lni-calendar"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Email</label>
                                                <div class="input-items default">
                                                    <input type="email" name="email" placeholder="Email" value="{{ $cadastro->email ?? '' }}" required>
                                                    <i class="lni lni-envelope"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Telefone</label>
                                                <div class="input-items default">
                                                    <input type="text" name="telefone" class="telefone" placeholder="Telefone" value="{{ $cadastro->whatsapp ?? '' }}" required>
                                                    <i class="lni lni-phone"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Whatsapp</label>
                                                <div class="input-items default">
                                                    <input type="text" name="whatsapp" class="telefone"  placeholder="Whatsapp" value="{{ $cadastro->whatsapp ?? '' }}" required>
                                                    <i class="lni lni-phone"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Sexo</label>
                                                <div class="input-items default">
                                                    <select class="sel" name="sexo" id="sexo" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Masculino" @if( ($cadastro->sexo ?? '') == 'Masculino' ) selected @endif>Masculino</option>
                                                        <option value="Feminino" @if( ($cadastro->sexo ?? '') == 'Feminino' ) selected @endif>Feminino</option>
                                                    </select>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Estado Civil</label>
                                                <div class="input-items default">
                                                    <select class="sel" name="estado_civil" id="estado_civil">
                                                        <option value="">Selecione</option>
                                                        <option value="Solteiro">Solteiro</option>
                                                        <option value="Casado">Casado</option>
                                                        <option value="Divorciado">Divorciado</option>
                                                        <option value="União Estável">União Estável</option>
                                                    </select>
                                                    <i class="lni lni-users"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="titulo-modulo">2. ENDEREÇO</div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>CEP</label>
                                                <div class="input-items default">
                                                    <input name="cep_endereco" id="cep_endereco" type="text" value="{{ $cadastro->cep ?? '' }}" required>
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-input mt-10">
                                                <label>Logradouro</label>
                                                <div class="input-items default">
                                                    <input name="logradouro_endereco" id="logradouro_endereco" type="text" value="" required>
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-input mt-10">
                                                <label>Número</label>
                                                <div class="input-items default">
                                                    <input name="numero_endereco" id="numero_endereco" type="text" value="" required>
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-input mt-10">
                                                <label>Complemento</label>
                                                <div class="input-items default">
                                                    <input name="complemento_endereco" id="complemento_endereco" type="text" value="" required>
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Bairro</label>
                                                <div class="input-items default">
                                                    <input name="bairro_endereco" id="bairro_endereco" type="text" placeholder="" value="" required>
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Estado</label>
                                                <div class="input-items default">
                                                    <select class="sel" name="estado_endereco" id="estado_endereco">
                                                        <option value="">Selecione</option>
                                                        @foreach ($estados as $estado)
                                                        <option value="{{ $estado->id }}">{{ $estado->nome_estado }}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-input mt-10" id="cidade_endereco">
                                                <label>Cidade</label>
                                                <div class="input-items default">
                                                    <select class="sel" name="cidade_endereco" data-placeholder="Selecione a cidade" required>
                                                        <option value="Selecione o estado">Selecione o estado</option>
                                                    </select>
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="titulo-modulo">3. DOCUMENTOS</div>

                                        <div class="col-md-5">
                                            <div class="form-input mt-10">
                                                <label>CPF</label>
                                                <div class="input-items default">
                                                    <input name="cpf" class="cpf" type="text" value="{{ $cadastro->cpf_cnpj ?? '' }}" required>
                                                    <i class="lni lni-licencse"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>RG</label>
                                                <div class="input-items default">
                                                    <input name="rg" type="text" value="" placeholder="Número do RG" required>
                                                    <i class="lni lni-licencse"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-input mt-10">
                                                <label>ÓRGÃO EXPEDIDOR - UF</label>
                                                <div class="input-items default">
                                                    <input name="orgao_expedidor" type="text" value="" required>
                                                    <i class="lni lni-licencse"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Possui carteira de trabalho?</label>
                                                <div class="input-items default">
                                                    <select class="sel" name="possui_ctps" id="possui_ctps" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>
                                                    </select>
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-input mt-10">
                                                <label>Carteira de Trabalho (CTPS)</label>
                                                <div class="input-items default">
                                                    <input class="ctps" name="ctps" id="ctps" type="text" value="" placeholder="Número CTPS" required>
                                                    <i class="lni lni-licencse"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-input mt-10">
                                                <label>Série (CTPS)</label>
                                                <div class="input-items default">
                                                    <input class="ctps" name="serie_ctps" id="serie_ctps" type="text" value="" required>
                                                    <i class="lni lni-licencse"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-12 info-escolaridade">OBS: Para contratação é necessária apresentação da carteira de trabalho.</div>

                                        <div class="titulo-modulo">4. DADOS ESCOLARES</div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Está matriculado atualmente?</label>
                                                <div class="input-items default">
                                                    <select class="sel" name="aluno_matriculado" id="aluno_matriculado" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>
                                                    </select>
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10" id="cidade_escola">
                                                <label>Escolaridade</label>
                                                <div class="input-items default">
                                                    <select class="sel escolaridade" name="escolaridade" id="escolaridade" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Ensino Fundamental (Cursando)">Ensino Fundamental (Cursando)</option>
                                                        <option value="Ensino Fundamental (Completo)">Ensino Fundamental (Completo)</option>
                                                        <option value="Ensino Médio (Cursando)">Ensino Médio (Cursando)</option>
                                                        <option value="Ensino Médio (Completo)">Ensino Médio (Completo)</option>
                                                        <option value="Superior (Cursando)">Superior (Cursando)</option>
                                                        <option value="Superior (Completo)">Superior (Completo)</option>
                                                    </select>
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10" id="cidade_escola">
                                                <label>Qual turno está estudando?</label>
                                                <div class="input-items default">
                                                    <select class="sel turno_matricula" name="turno_matricula" id="turno_matricula">
                                                        <option value="">Selecione</option>
                                                        <option value="Matutino">Matutino</option>
                                                        <option value="Vespertino">Vespertino</option>
                                                        <option value="Noturno">Noturno</option>
                                                    </select>
                                                    <i class="lni lni-map-marker"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-12 info-escolaridade">OBS: caso seja chamado para entrevista, será necessária apresentação do comprovante de frequência.</div>

                                        <div class="titulo-modulo">5. SITUAÇÃO SOCIOECONÔMICA</div>

                                        <div class="col-md-5">
                                            <div class="form-input mt-10">
                                                <label>Possui algum problema de saúde?</label>
                                                <div class="input-items default">
                                                    <select class="sel" name="problema_saude" id="problema_saude" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>
                                                    </select>
                                                    <i class="lni lni-question-circle"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-7">
                                            <div class="form-input mt-10">
                                                <label>Qual?</label>
                                                <div class="input-items default">
                                                    <input class="problema_saude_especificacao" name="problema_saude_especificacao" id="problema_saude_especificacao" type="text" value="" required>
                                                    <i class="lni lni-pencil-alt"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-input mt-10">
                                                <label>Toma Remédio Controlado?</label>
                                                <div class="input-items default">
                                                    <select class="sel" name="remedio_controlado" id="remedio_controlado" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>
                                                    </select>
                                                    <i class="lni lni-question-circle"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-7">
                                            <div class="form-input mt-10">
                                                <label>Especifique</label>
                                                <div class="input-items default">
                                                    <input class="remedio_controlado_especificacao" name="remedio_controlado_especificacao" id="remedio_controlado_especificacao" type="text" value="" required>
                                                    <i class="lni lni-pencil-alt"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-input mt-10">
                                                <label>Tipo de moradia</label>
                                                <div class="input-items default">
                                                    <select class="sel" name="tipo_moradia" id="tipo_moradia" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Própria">Própria</option>
                                                        <option value="Cedida">Cedida</option>
                                                        <option value="Alugada">Alugada</option>
                                                    </select>
                                                    <i class="lni lni-home"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Com quantas pessoas residem na mesma casa?</label>
                                                <div class="input-items default">
                                                    <input name="numero_pessoas_residencia" type="number" value="" required>
                                                    <i class="lni lni-pencil-alt"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-input mt-10">
                                                <label>Renda familiar aproximada</label>
                                                <div class="input-items default">
                                                    <input name="renda_familiar" class="moeda" type="text" value="" required>
                                                    <i class="lni lni-dollar"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Possui curso de informática?</label>
                                                <div class="input-items default">
                                                    <select class="sel" name="curso_informatica" id="curso_informatica" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>
                                                    </select>
                                                    <i class="lni lni-question-circle"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-input mt-10">
                                                <label>Especifique quais cursos e habilidades possui:</label>
                                                <div class="input-items default">
                                                    <input name="descricao_curso" type="text" value="" required>
                                                    <i class="lni lni-pencil-alt"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-input mt-10">
                                                <label>Já trabalhou?</label>
                                                <div class="input-items default">
                                                    <select class="sel" name="ja_trabalhou" id="ja_trabalhou" required>
                                                        <option value="">Selecione</option>
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>
                                                    </select>
                                                    <i class="lni lni-question-circle"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Função exercida</label>
                                                <div class="input-items default">
                                                    <input name="funcao_exercida" class="jovem_trabalhador" id="funcao_exercida" type="text" value="" required>
                                                    <i class="lni lni-licencse"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-input mt-10">
                                                <label>Empresa (Local)</label>
                                                <div class="input-items default">
                                                    <input name="empresa_trabalho" class="jovem_trabalhador" id="empresa_trabalho" type="text" value="" required>
                                                    <i class="lni lni-pencil-alt"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                    </div>


                                    <div class="row" id="responsavel">

                                        <div class="titulo-modulo">6. RESPONSÁVEL LEGAL</div>

                                        <div class="col-md-8">
                                            <div class="form-input mt-10">
                                                <label>Nome completo (Responsável)</label>
                                                <div class="input-items default">
                                                    <input name="nome_responsavel" class="responsavel" type="text" value="" required>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Grau de Parentesco</label>
                                                <div class="input-items default">
                                                    <input name="grau_parentesco_responsavel" class="responsavel" type="text" value="" required>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>CPF</label>
                                                <div class="input-items default">
                                                    <input name="cpf_responsavel" class="responsavel" type="text" value="" required>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>RG</label>
                                                <div class="input-items default">
                                                    <input name="rg_responsavel" class="responsavel" type="text" value="" required>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-10">
                                                <label>Órgão Expedidor</label>
                                                <div class="input-items default">
                                                    <input name="orgao_expedidor_rg_responsavel" class="responsavel" type="text" value="" required>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="titulo-modulo">7. PROPÓSITO / OBJETIVO PROFISSIONAL</div>

                                        <div class="col-md-6">
                                            <div class="form-input mt-10">
                                                <label>Porque decidiu trabalhar?</label>
                                                <div class="input-items default">
                                                    <textarea name="porque_decidiu_trabalhar" id="" cols="30" rows="10"></textarea>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-input mt-10">
                                                <label>O que você espera da empresa, no quesito profissional?</label>
                                                <div class="input-items default">
                                                    <textarea name="oque_espera_empresa" id="" cols="30" rows="10"></textarea>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-input mt-10">
                                                <label>Qual é o seu sonho?</label>
                                                <div class="input-items default">
                                                    <textarea name="seu_sonho" id="" cols="30" rows="10"></textarea>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-input mt-10">
                                                <label>Cite quais os seus pontos fortes e os à desenvolver:</label>
                                                <div class="input-items default">
                                                    <textarea name="ponto_forte_desenvolver" id="" cols="30" rows="10"></textarea>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-input mt-10">
                                                <label>O que você mais gosta de fazer nos seus momentos de lazer?</label>
                                                <div class="input-items default">
                                                    <textarea name="momentos_lazer" id="" cols="30" rows="10"></textarea>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-input mt-10">
                                                <label>Confirme se já tomou vacina da COVID</label>
                                                <div class="input-items default">
                                                    <input class="vacina-covid" type="checkbox" name="confirmacao_vacina" id="confirmacao_vacina" checked required><div class="texto-vacina">Sim, já tomei a vacina para COVID e tenho em mãos o comprovante de vacinação</div>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <p class="form-message"></p>
                                        <div class="col-md-12">
                                            <div class="form-input light-rounded-buttons mt-30">
                                                <input type="submit" class="main-btn light-rounded-two enviar-cadastro" value="Finalizar cadastro - Enviar Dados">
                                            </div> <!-- form input -->
                                        </div>
                                    </div> <!-- row -->
                                </form>
                            </div>
                        </div>
                    </div> <!-- contact wrapper form -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>


    <!--====== FOOTER PART START ======-->

    <section class="footer-area footer-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="footer-logo text-center">
                        <a class="mt-30" href="index.php"><img src="/assets/site/images/logo.png" alt="Logo"></a>
                    </div> <!-- footer logo -->
                    <ul class="social text-center mt-60">
                        <li><a href="https://facebook.com/uideckHQ"><i class="lni lni-facebook-filled"></i></a></li>
                        <li><a href="https://twitter.com/uideckHQ"><i class="lni lni-twitter-original"></i></a></li>
                        <li><a href="https://instagram.com/uideckHQ"><i class="lni lni-instagram-original"></i></a></li>
                        <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                    </ul> <!-- social -->
                    <div class="footer-support text-center">
                        <span class="number">(66) 99995-5284</span>
                        <span class="mail">pja@larmariadelourdes.org</span>
                    </div>
                    <div class="copyright text-center mt-35">
                        <a class="mt-30" href="index.php"><img src="/assets/site/images/logo-datapix.png" alt="Logo"></a>
                    </div> <!--  copyright -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->

    <!--====== PART START ======-->

<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-">

                </div>
            </div>
        </div>
    </section>
-->

    <!--====== PART ENDS ======-->


    <!--====== Bootstrap js ======-->
    <script src="/assets/site/js/popper.min.js"></script>
    <script src="/assets/site/js/bootstrap.min.js"></script>

    <!--====== Slick js ======-->
    <script src="/assets/site/js/slick.min.js"></script>

    <!--====== Magnific Popup js ======-->
    <script src="/assets/site/js/jquery.magnific-popup.min.js"></script>

    <!--====== Ajax Contact js ======-->
    <script src="/assets/site/js/ajax-contact.js"></script>

    <!--====== Isotope js ======-->
    <script src="/assets/site/js/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/site/js/isotope.pkgd.min.js"></script>

    <!--====== Scrolling Nav js ======-->
    <script src="/assets/site/js/jquery.easing.min.js"></script>
    <script src="/assets/site/js/scrolling-nav.js"></script>

    <!--====== Main js ======-->
    <script src="/assets/site/js/main.js"></script>

    <script src="{{ asset('assets/global/js/cep.js') }}"></script>
    <script src="{{ asset('assets/global/js/busca.js') }}"></script>
    <script src="{{ asset('assets/global/js/jquery.maskMoney.js') }}"></script>
    <script src="{{ asset('/assets/sistema/lib/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <script src="/assets/global/js/mascaras.js"></script>
    <script type="text/javascript" src="{{ asset('assets/sistema/lib/sweetalert/dist/sweetalert.min.js') }}" ></script>
    @include('sweetalert::alert')

    @if($idade_jovem ?? '' < 18):
       <script>
           $(".responsavel").prop('disabled', false);
       </script>
    @else
        <script>
            $(".responsavel").prop('disabled', true);
        </script>
    @endif

</body>

</html>
