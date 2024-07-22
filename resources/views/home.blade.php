<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>Programa Jovem Aprendiz - Lar Maria de Lourdes</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/site/images/favicon.png" type="image/png">

    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="assets/site/css/magnific-popup.css">

    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="assets/site/css/slick.css">

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="assets/site/css/LineIcons.css">

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="assets/site/css/bootstrap.min.css">

    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="assets/site/css/default.css">

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="assets/site/css/style.css">

    <!--====== Jquery js ======-->
    <script src="assets/site/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/site/js/vendor/modernizr-3.7.1.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASwh3fNmWpe5gqQmLyiBGKm-7XuU71vMY"></script>

</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== NAVBAR TWO PART START ======-->

    <section class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">

                        <a class="navbar-brand" href="/">
                            <img src="assets/site/images/logo.png" alt="Logo">
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item active"><a class="page-scroll" href="#home">home</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#about">Conheça o programa</a></li>
                                <!--<li class="nav-item"><a class="page-scroll" href="#portfolio">Onde estamos</a></li>-->
                                <li class="nav-item"><a href="http://www.intelecto.com.br/holerith/empresa/?id=2142" target="_blank">Holerite Online</a></li>
                                <!--<li class="nav-item"><a class="page-scroll" href="#contact">Contato</a></li>-->
                            </ul>
                        </div>

                        <div class="navbar-btn d-none d-sm-inline-block">
                            <ul>
                                <li><a class="solid page-scroll" href="{{ url("cadastro-jovem-aprendiz") }}">Cadastre-se</a></li>
                            </ul>
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== NAVBAR TWO PART ENDS ======-->

    <!--====== SLIDER PART START ======-->

    <section id="home" class="slider_area">
        <div id="carouselThree" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselThree" data-slide-to="0" class="active"></li>
                <li data-target="#carouselThree" data-slide-to="1"></li>
                <li data-target="#carouselThree" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">ESTUDANTE</h1>
                                    <p class="text">O Jovem Aprendiz é uma política pública que incentiva jovens estudantes a procurarem o primeiro emprego, garantindo todos os seus direitos. O modelo une experiência profissional com curso de profissionalização em alguma área específica.</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one page-scroll" href="#about">SAIBA COMO FUNCIONA</a></li>
                                        <li><a class="main-btn rounded-two" href="{{ url("cadastro-jovem-aprendiz") }}">CADASTRE-SE</a></li>
                                    </ul>
                                </div> <!-- slider-content -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <img src="assets/site/images/slider/2.png" alt="Hero">
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->
                </div> <!-- carousel-item -->


            </div>

            <a class="carousel-control-prev" href="#carouselThree" role="button" data-slide="prev">
                <i class="lni lni-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#carouselThree" role="button" data-slide="next">
                <i class="lni lni-arrow-right"></i>
            </a>
        </div>
    </section>

    <!--====== SLIDER PART ENDS ======-->

        <!--====== ABOUT PART START ======-->

        <section id="about" class="about-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="faq-content mt-45">
                            <div class="about-title">
                                <h6 class="sub-title">Conheça o Programa</h6>
                                <h4 class="title">Dúvidas frequentes sobre o <br>programa jovem aprendiz</h4>
                            </div> <!-- faq title -->
                            <div class="about-accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Como funciona o Programa Jovem Aprendiz?</a>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p class="text">O Jovem Aprendiz é uma política pública que incentiva jovens estudantes a procurarem o primeiro emprego, garantindo todos os seus direitos. O modelo une experiência profissional com curso de profissionalização em alguma área específica.

                                                    Assim, ao ser contratado por uma empresa, o jovem é preparado por meio de aulas teóricas e atividades desenvolvidas na rotina do negócio. O contrato de trabalho pode durar até dois anos, com carga horária entre quatro e seis horas diárias, com o máximo de 30h semanais.</p>
                                            </div>
                                        </div>
                                    </div> <!-- card -->
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Quais são os pré-requisitos para ser um jovem aprendiz?</a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p class="text">Para entrar para o mercado de trabalho, é preciso ter entre 14 a 24 anos e estar cursando ou já ter concluído o ensino básico (fundamental ou médio). Também é necessário que o jovem frequente o curso conveniado com a empresa, relacionado à atividade que desempenha, durante seu contrato.</p>
                                            </div>
                                        </div>
                                    </div> <!-- card -->
                                    <div class="card">
                                        <div class="card-header" id="headingThree">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Quem está cursando ensino superior pode participar do jovem aprendiz?</a>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p class="text">Não existe nenhum impedimento para que um jovem que esteja no ensino superior seja contratado como aprendiz. Se o contratado cumprir as demais exigências do programa, o ensino superior não é um problema.</p>
                                            </div>
                                        </div>
                                    </div> <!-- card -->
                                    <div class="card">
                                        <div class="card-header" id="headingFore">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFore" aria-expanded="false" aria-controls="collapseFore">Qual é a diferença entre jovem aprendiz e menor aprendiz?</a>
                                        </div>
                                        <div id="collapseFore" class="collapse" aria-labelledby="headingFore" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p class="text">Não há diferença entre os dois. Antigamente, o nome menor aprendiz era mais comum, mas atualmente o termo jovem aprendiz passou a ser mais usado e também mais adequado, uma vez que a Lei da Aprendizagem define que podem ser contratadas pessoas até 24 anos de idade.</p>
                                            </div>
                                        </div>
                                    </div> <!-- card -->
                                    <div class="card">
                                        <div class="card-header" id="headingFive">
                                            <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Qual o salário de um aprendiz?</a>
                                        </div>
                                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p class="text">A lei define que a empresa que contrata um aprendiz deve pagar, pelo menos, o valor do salário mínimo por hora. Com o reajuste em 2021, o salário mínimo foi definido em R$ 1.100, que corresponde a R$ 5 por hora.

                                                    Quem opta por fazer esse pagamento baseado no valor da hora mínima, tem que seguir a fórmula prevista no Manual da Aprendizagem Profissional, criado pelo Ministério do Trabalho:

                                                    Salário Mensal = (Salário-hora x horas trabalhadas semanais x número de semanas no mês x 7) / 6</p>
                                            </div>
                                        </div>
                                    </div> <!-- card -->
                                </div>
                            </div> <!-- faq accordion -->
                        </div> <!-- faq content -->
                    </div>
                    <div class="col-lg-6">
                        <div class="about-image mt-50">
                            <img src="assets/site/images/about.jpg" alt="about">
                        </div> <!-- faq image -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </section>

        <!--====== ABOUT PART ENDS ======-->


    <!--====== PORTFOLIO PART START ======-->

    <section id="portfolio" class="portfolio-area portfolio-four pb-100" style="display: none;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">Onde estamos</h3>
                        <p class="text">Conheça nossas unidades e veja qual a mais próxima de você</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-map mt-30">
                        <div id="mapa" style="height: 100%;"></div>
                    </div> <!-- row -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PORTFOLIO PART ENDS ======-->

    <!--====== FEATRES TWO PART START ======-->

    <section id="services" class="features-area" style="display: none;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">Vagas disponíveis</h3>
                        <p class="text">Confira nossas vagas disponíveis atualmente e cadastre-se</p>
                    </div> <!-- row -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <div class="features-icon">
                                <div class="qtd-vagas">8</div>
                            </div>
                            <h4 class="features-title"><a href="#" class="area">Auxiliar Administrativo</a></h4>
                        </div>
                        <div class="features-content">
                            <p class="text">Vagas de auxiliar administrativo disponíveis para várias cidades.</p>
                            <a class="features-btn" href="#">CADASTRE-SE</a>
                        </div>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <div class="features-icon">
                                <div class="qtd-vagas">12</div>
                            </div>
                            <h4 class="features-title"><a href="#" class="area">Auxiliar Financeiro</a></h4>
                        </div>
                        <div class="features-content">
                            <p class="text">Vagas de auxiliar financeiro disponíveis para várias cidades.</p>
                            <a class="features-btn" href="#">CADASTRE-SE</a>
                        </div>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <div class="features-icon">
                                <div class="qtd-vagas">5</div>
                            </div>
                            <h4 class="features-title"><a href="#" class="area">Estoquista</a></h4>
                        </div>
                        <div class="features-content">
                            <p class="text">Vagas de estoquista disponíveis para várias cidades.</p>
                            <a class="features-btn" href="#">CADASTRE-SE</a>
                        </div>
                    </div> <!-- single features -->
                </div>

                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <div class="features-icon">
                                <div class="qtd-vagas">3</div>
                            </div>
                            <h4 class="features-title"><a href="#" class="area">Auxiliar Administrativo</a></h4>
                        </div>
                        <div class="features-content">
                            <p class="text">Vagas de auxiliar administrativo disponíveis para várias cidades.</p>
                            <a class="features-btn" href="#">CADASTRE-SE</a>
                        </div>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <div class="features-icon">
                                <div class="qtd-vagas">7</div>
                            </div>
                            <h4 class="features-title"><a href="#" class="area">Auxiliar Financeiro</a></h4>
                        </div>
                        <div class="features-content">
                            <p class="text">Vagas de auxiliar financeiro disponíveis para várias cidades.</p>
                            <a class="features-btn" href="#">CADASTRE-SE</a>
                        </div>
                    </div> <!-- single features -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="single-features mt-40">
                        <div class="features-title-icon d-flex justify-content-between">
                            <div class="features-icon">
                                <div class="qtd-vagas">4</div>
                            </div>
                            <h4 class="features-title"><a href="#" class="area">Estoquista</a></h4>
                        </div>
                        <div class="features-content">
                            <p class="text">Vagas de estoquista disponíveis para várias cidades.</p>
                            <a class="features-btn" href="{{ url("cadastro-jovem-aprendiz") }}">CADASTRE-SE</a>
                        </div>
                    </div> <!-- single features -->
                </div>

            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== FEATRES TWO PART ENDS ======-->

    <section id="cadastro" class="formulario-cadastro" style="display: none;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-30">
                        <h3 class="title">PRÉ-CADASTRO</h3>
                        <p class="text" style="text-align: center !important;">Formulário de cadastro - Jovem Aprendiz</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->

            <div class="row">
                <div class="col-lg-12">

                    <div class="contact-wrapper form-style-two"></div>

                        <div class="nav nav-tabs cad-menu" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="lni lni-user"></i> Jovem Aprendiz</a>
                            <!--<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="lni lni-restaurant"></i> Quero Contratar Aprendizes</a>-->
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active cad-empresa" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <form name="pre-cadastro-jovem" id="pre-cadastro-jovem" action="{{ route('gravar-pre-cadastro') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="tipo_cadastro" value="Jovem">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-input mt-25">
                                                <label>Nome completo</label>
                                                <div class="input-items default">
                                                    <input name="nome" type="text" placeholder="Nome" required>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input mt-25">
                                                <label>CPF</label>
                                                <div class="input-items default">
                                                    <input name="cpf" class="cpf" type="text" placeholder="CPF" required>
                                                    <i class="lni lni-more"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input mt-25">
                                                <label>Data de Nascimento</label>
                                                <div class="input-items default">
                                                    <input type="date" name="data_nascimento" placeholder="00/00/0000" required>
                                                    <i class="lni lni-calendar"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input mt-25">
                                                <label>Email</label>
                                                <div class="input-items default">
                                                    <input type="email" name="email" placeholder="Email" required>
                                                    <i class="lni lni-envelope"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input mt-25">
                                                <label>Telefone</label>
                                                <div class="input-items default">
                                                    <input type="text" class="telefone" name="telefone" placeholder="Telefone" required>
                                                    <i class="lni lni-phone"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <!--
                                        <div class="col-md-12">
                                            <div class="form-input mt-25">
                                                <label>Confirme se já tomou vacina da COVID</label>
                                                <div class="input-items default">
                                                    <input class="vacina-covid" type="checkbox" name="confirmacao_vacina" id="confirmacao_vacina" required><div class="texto-vacina">Sim, já tomei a vacina para COVID e tenho em mãos o comprovante de vacinação</div>
                                                </div>
                                            </div>
                                        </div>
                                        -->

                                        <p class="form-message"></p>
                                        <div class="col-md-12">
                                            <div class="form-input light-rounded-buttons mt-30">
                                                <input type="submit" class="main-btn light-rounded-two" value="Quero ser jovem aprendiz">
                                            </div> <!-- form input -->
                                        </div>
                                    </div> <!-- row -->
                                </form>
                            </div>
                            <div class="tab-pane fade cad-empresa" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <form name="pre-cadastro-empresa" id="pre-cadastro-empresa" action="{{ route('gravar-pre-cadastro') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="tipo_cadastro" value="Empresa">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-input mt-25">
                                                <label>CNPJ/CEI</label>
                                                <div class="input-items default">
                                                    <input name="cnpj_cei" class="cnpj" type="text" placeholder="" required>
                                                    <i class="lni lni-more"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-input mt-25">
                                                <label>Razão Social</label>
                                                <div class="input-items default">
                                                    <input type="text" name="razao_social" placeholder="Razão Social" required>
                                                    <i class="lni lni-restaurant"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input mt-25">
                                                <label>Nome completo (Responsável pela Empresa)</label>
                                                <div class="input-items default">
                                                    <input name="responsavel" type="text" placeholder="Nome" required>
                                                    <i class="lni lni-user"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input mt-25">
                                                <label>Email (Responsável pela Empresa)</label>
                                                <div class="input-items default">
                                                    <input type="email" name="email" placeholder="Email" required>
                                                    <i class="lni lni-envelope"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-input mt-25">
                                                <label>Telefone (Responsável pela Empresa)</label>
                                                <div class="input-items default">
                                                    <input type="text" class="telefone" name="telefone" placeholder="Telefone" required>
                                                    <i class="lni lni-phone"></i>
                                                </div>
                                            </div> <!-- form input -->
                                        </div>

                                        <p class="form-message"></p>
                                        <div class="col-md-12">
                                            <div class="form-input light-rounded-buttons mt-30">
                                                <input type="submit" class="main-btn light-rounded-two" value="Quero contratar aprendizes">
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


    <!--====== CONTACT PART START ======-->

    <section id="contact" class="contact-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-30">
                        <h3 class="title">CONTATO</h3>
                        <p class="text" style="text-align: center !important;">Dúvidas? Entre em contato conosco</p>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="contact-info pt-30">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-1 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-map-marker"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text"> Av. Santa Tereza, 893 - Jupiara<br>Campo Verde - MT, 78840-000</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="single-contact-info contact-color-2 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">pja@larmariadelourdes.org</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-contact-info contact-color-3 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-phone"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">(66) 99995-5284</p>
                            </div>
                        </div> <!-- single contact info -->
                    </div>
                </div> <!-- row -->
            </div> <!-- contact info -->
            <div class="row" style="display: none;">
                <div class="col-lg-12">
                    <div class="contact-wrapper form-style-two pt-115">
                        <h4 class="contact-title pb-10"><i class="lni lni-envelope"></i> Envie-nos <span>uma mensagem.</span></h4>

                        <form id="contact-form" action="assets/site/envia_contato.php" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-input mt-25">
                                        <label>Nome</label>
                                        <div class="input-items default">
                                            <input name="nome" type="text" placeholder="Nome" required>
                                            <i class="lni lni-user"></i>
                                        </div>
                                    </div> <!-- form input -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-input mt-25">
                                        <label>Email</label>
                                        <div class="input-items default">
                                            <input type="email" name="email" placeholder="Email" required>
                                            <i class="lni lni-envelope"></i>
                                        </div>
                                    </div> <!-- form input -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-input mt-25">
                                        <label>Telefone</label>
                                        <div class="input-items default">
                                            <input type="text" class="telefone" name="telefone" placeholder="Telefone" required>
                                            <i class="lni lni-phone"></i>
                                        </div>
                                    </div> <!-- form input -->
                                </div>
                                <div class="col-md-12">
                                    <div class="form-input mt-25">
                                        <label>Mensagem</label>
                                        <div class="input-items default">
                                            <textarea name="mensagem" placeholder="Mensagem" required></textarea>
                                            <i class="lni lni-pencil-alt"></i>
                                        </div>
                                    </div> <!-- form input -->
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="form-input light-rounded-buttons mt-30">
                                        <input type="hidden" name="acao" value="envia-form-contato">
                                        <button type="submit" class="main-btn light-rounded-two">Enviar</button>
                                    </div> <!-- form input -->
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- contact wrapper form -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->

    <!--====== FOOTER PART START ======-->

    <section class="footer-area footer-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="footer-logo text-center">
                        <a class="mt-30" href="index.php"><img src="assets/site/images/logo.png" alt="Logo"></a>
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
                        <a class="mt-30" href="index.php"><img src="assets/site/images/logo-datapix.png" alt="Logo"></a>
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
    <script src="assets/site/js/popper.min.js"></script>
    <script src="assets/site/js/bootstrap.min.js"></script>

    <!--====== Slick js ======-->
    <script src="assets/site/js/slick.min.js"></script>

    <!--====== Magnific Popup js ======-->
    <script src="assets/site/js/jquery.magnific-popup.min.js"></script>

    <!--====== Isotope js ======-->
    <script src="assets/site/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/site/js/isotope.pkgd.min.js"></script>

    <!--====== Scrolling Nav js ======-->
    <script src="assets/site/js/jquery.easing.min.js"></script>
    <script src="assets/site/js/scrolling-nav.js"></script>

    <!--====== Main js ======-->
    <script src="assets/site/js/main.js"></script>


    <script>
        var map;
        var idInfoBoxAberto;
        var infoBox = [];
        var markers = [];
        var localizacao = [];
        //var markerPonto = new google.maps.Marker({});
        var markerPonto;
        var contador = 0;
        var l = 0;
        var contentString;
        var infowindow = new google.maps.InfoWindow({
        //    content: contentString,
            maxWidth: 300
        });

        /*Método que inicia configurações iniciados do mapa*/
        function initialize() {
            var latlng = new google.maps.LatLng(-15.5687317,-55.1682538);

            var options = {
                zoom: 6,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("mapa"), options);

            /*Novo parte - adiciona ponteiro geolocalizador(de acordo com as coordenadas informadas em 'latlng'*/
            geocoder = new google.maps.Geocoder();

            marker = new google.maps.Marker({
                map: map,
                draggable: true,
            });

            marker.setPosition(latlng);

        /*Parte de loop com banco de dados*/
        /*
            $.ajax({
                url : 'verificaAjax.php',
                success : function(msg){
                    if (msg.status == 0) {
                        msg.errorMsg.forEach(ShowResults);
                        //JSON.parse(msg.errorMsg).forEach(ShowResults);

                    }
                },
                error:function (xhr, ajaxOptions, thrownError) {
                    alert("Erro no Processamento dos Dados. Entre em contato com o setor de Tecnologia e informe a mensagem abaixo:\n"+xhr.responseText);
                }

            });

        */

        ShowResults({'razao_social': 'Matriz',
                    'cidade': 'Campo Verde - MT',
                    'telefone': '(66) 3419-1184',
                    'latitude': -15.5687317,
                    'longitude': -55.1682538,
                    });

        ShowResults({'razao_social': 'Pólo - Cuiabá',
                    'cidade': 'Cuiabá - MT',
                    'telefone': '(66) 3419-1184',
                    'latitude': -15.5999831,
                    'longitude': -56.098374,
                    });

        ShowResults({'razao_social': 'Pólo Barra',
                    'cidade': 'Barra do Garças - MT',
                    'telefone': '(66) 3419-1184',
                    'latitude': -15.8982823,
                    'longitude': -52.2681681,
                    });



        }

        // Função para retornar os valores
        function ShowResults(value, index, ar) {
            contentString = '<h2>'+value['razao_social']+'</h2><div class="cidade">'+value['cidade']+'</div><div class="telefone">'+value['telefone']+'</div>';

            localizacao.push({
                nome: value['razao_social'],
                latlng: new google.maps.LatLng(value['latitude'],value['longitude'])
            });


            /*
            markerPonto.position(localizacao[l].latlng);
            markerPonto.icon('img/marcador.png');
            markerPonto.map(map);
            markerPonto.title(localizacao[l].nome);
            */


            var markerPonto = new google.maps.Marker({
                position: localizacao[l].latlng,
        //      icon: 'img/marcador.png',
                map: map,
                title: localizacao[l].nome
            });

        (function(contentString) {
            google.maps.event.addListener(markerPonto, 'click', function() {
            infowindow.setContent('<div style="line-height: 1.35;">' + contentString + '</div>');
            infowindow.open(map, markerPonto);
            });
        })(contentString);

            ++l;


        }

        initialize();
    </script>

    <script src="{{ asset('assets/global/js/cep.js') }}"></script>
    <script src="{{ asset('assets/global/js/busca.js') }}"></script>
    <script src="{{ asset('assets/global/js/jquery.maskMoney.js') }}"></script>
    <script src="{{ asset('/assets/sistema/lib/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <script src="assets/global/js/mascaras.js"></script>

    @include('sweetalert::alert')

</body>

</html>
