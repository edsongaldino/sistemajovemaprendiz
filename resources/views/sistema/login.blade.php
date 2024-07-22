<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="twitter:site" content="@datapix">
    <meta name="twitter:creator" content="@datapix">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SG-PJA - Lar Maria de Lourdes">
    <meta name="twitter:description" content="Sistema de Gerenciamento do Programa Jovem Aprendiz - Lar Maria de Lourdes">
    <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracket">
    <meta property="og:title" content="Bracket">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Sistema de Gerenciamento do Programa Jovem Aprendiz - Lar Maria de Lourdes">
    <meta name="author" content="ThemePixels">

    <title>SG-PJA - Lar Maria de Lourdes</title>

    <!-- vendor css -->
    <link href="{{ asset('/assets/sistema/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/sistema/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/sistema/css/bracket.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/sistema/css/custom.css') }}">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-login ht-100v">
      <form name="FormLogin" method="POST" action="{{ route('login.do') }}">
      @csrf
      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><img src="{{ asset('/assets/sistema/img/logo.png') }}" alt=""></div>
        <div class="tx-center mg-b-60">Sistema de gestão de contratos</div>

        <div class="form-group">
          <input type="text" class="form-control" placeholder="Seu e-mail" name="email">
        </div><!-- form-group -->
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Insira sua senha" name="password">
          <a href="" class="tx-info tx-12 d-block mg-t-10">Esqueceu sua senha?</a>
        </div><!-- form-group -->
        <button type="submit" class="btn btn-info btn-block">ENTRAR</button>
      </div><!-- login-wrapper -->
      </form>
    </div><!-- d-flex -->

    <script src="{{ asset('/assets/sistema/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/sistema/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('/assets/sistema/lib/bootstrap/bootstrap.js') }}"></script>
    @include('sweetalert::alert')
  </body>
</html>