  <!-- ########## START: LEFT PANEL ########## -->
  <div class="br-logo"><img src="{{ asset('/assets/sistema/img/logo-2.png') }}" alt=""></div>
  <div class="br-sideleft overflow-y-auto">

  <label class="sidebar-label pd-x-15 mg-t-20"></label>

    <div class="br-sideleft-menu">
      <a href="{{ route('sistema') }}" class="br-menu-link active">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
          <span class="menu-item-label">Home</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->

      @if(Auth::user()->perfil_id == 1)
      <a href="#" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-gear tx-20"></i>
          <span class="menu-item-label">Configurações</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->
      <ul class="br-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('sistema.usuarios') }}" class="nav-link">Usuários</a></li>
        <li class="nav-item"><a href="{{ route('sistema.perfis') }}" class="nav-link">Perfis/Permissões</a></li>
        <li class="nav-item"><a href="{{ route('sistema.regioes') }}" class="nav-link">Regiões</a></li>
        <li class="nav-item"><a href="{{ route('sistema.atualizacoes') }}" class="nav-link">Atualizacoes</a></li>
        <li class="nav-item"><a href="{{ route('sistema.feriados') }}" class="nav-link">Feriados</a></li>
      </ul>
      @endif

      @if(Auth::user()->perfil_id == 1 || Auth::user()->perfil_id == 2)

      <a href="{{ route('sistema.cadastros') }}" class="br-menu-link pre-cadastro">
        <div class="br-menu-item">
          <i class="fa fa-address-card" aria-hidden="true"></i>
          <span class="menu-item-label">Pré-cadastros</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->

      <a href="{{ route('sistema.polos') }}" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-bank tx-20"></i>
          <span class="menu-item-label">Pólos & Unidades</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->
      @endif

      @if(Auth::user()->perfil_id == 1 || Auth::user()->perfil_id == 2 || Auth::user()->perfil_id == 7)
      <a href="{{ route('sistema.empresas') }}" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-users tx-20"></i>
          <span class="menu-item-label">Empresas</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->
      @endif

      @if(Auth::user()->perfil_id == 1 || Auth::user()->perfil_id == 2 || Auth::user()->perfil_id == 7)
      <a href="{{ route('sistema.parceiros') }}" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-handshake-o tx-20"></i>
          <span class="menu-item-label">Parceiros</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->
      @endif

      @if(Auth::user()->perfil_id == 1 || Auth::user()->perfil_id == 2)
      <a href="{{ route('sistema.alunos') }}" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-id-badge tx-20"></i>
          <span class="menu-item-label">Alunos</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->

      <a href="" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-address-card tx-20"></i>
          <span class="menu-item-label">Oferta - Vagas</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->
      <ul class="br-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('sistema.vagas') }}" class="nav-link">Oferta - Vagas</a></li>
        <li class="nav-item"><a href="{{ route('sistema.candidatos') }}" class="nav-link">Candidatos (Jovens)</a></li>
      </ul>
      @elseif(Auth::user()->perfil_id == 5)
      <a href="{{ route('sistema.minha-empresa') }}" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-users tx-20"></i>
          <span class="menu-item-label">Minha empresa</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->

      <a href="{{ route('sistema.alunos') }}" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-id-badge tx-20"></i>
          <span class="menu-item-label">Candidatos</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->

      <a href="{{ route('sistema.alunos') }}" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-id-badge tx-20"></i>
          <span class="menu-item-label">Contratos/Aprendizes</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->

      @endif

      @if(Auth::user()->perfil_id == 1)
      <a href="#" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-graduation-cap tx-20"></i>
          <span class="menu-item-label">Cursos</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->

      <ul class="br-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('sistema.cursos') }}" class="nav-link">Listar cursos</a></li>
        <li class="nav-item"><a href="{{ route('sistema.curso.adicionar') }}" class="nav-link">Adicionar curso</a></li>
      </ul>
      @endif


      @if(Auth::user()->perfil_id == 1 || Auth::user()->perfil_id == 2 || Auth::user()->perfil_id == 7)
      <a href="#" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-briefcase tx-20"></i>
          <span class="menu-item-label">Convênio/Contratos</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->

      <ul class="br-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{ route('sistema.convenios') }}" class="nav-link">Convênios</a></li>
        <li class="nav-item"><a href="{{ route('sistema.tabelas') }}" class="nav-link">Tabelas</a></li>
        <li class="nav-item"><a href="{{ route('sistema.contratos') }}" class="nav-link">Listar Contratos</a></li>
        <li class="nav-item"><a href="{{ route('sistema.contrato.adicionar') }}" class="nav-link">Adicionar Contrato</a></li>
      </ul>
      @endif

      @if(Auth::user()->perfil_id == 1 || Auth::user()->perfil_id == 7)
      <a href="{{ route('sistema.financeiro') }}" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-money tx-20"></i>
          <span class="menu-item-label">Financeiro</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->
      @endif

      @if(Auth::user()->perfil_id == 1 || Auth::user()->perfil_id == 2 || Auth::user()->perfil_id == 3)
      <a href="{{ route('sistema.estoque') }}" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-cubes tx-20"></i>
          <span class="menu-item-label">Estoque</span>
        </div><!-- menu-item -->
      </a><!-- br-menu-link -->
      @endif

      <!--
      <a href="{{ route('eventos') }}" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-bullhorn tx-20"></i>
          <span class="menu-item-label">Eventos</span>
        </div>
      </a>
      -->

      @if(Auth::user()->perfil_id == 1 || Auth::user()->perfil_id == 7)
      <a href="{{ route('relatorios') }}" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon fa fa-bar-chart tx-20"></i>
          <span class="menu-item-label">Relatórios</span>
        </div>
      </a>
      @endif



    </div><!-- br-sideleft-menu -->

    <br>
  </div><!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<div class="br-header">
  <div class="br-header-left">
    <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
    <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    <div class="input-group hidden-xs-down wd-170 transition">
      <input id="searchbox" type="text" class="form-control" placeholder="Buscar">
      <span class="input-group-btn">
        <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
      </span>
    </div><!-- input-group -->
  </div><!-- br-header-left -->
  <div class="br-header-right">
    <nav class="nav">

      <div class="dropdown">
        <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
          <i class="icon ion-ios-bell-outline tx-24"></i>
          <!-- start: if statement -->
          <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
          <!-- end: if statement -->
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
          <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
            <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Notificações</label>
            <a href="" class="tx-11">Atualizações</a>
          </div><!-- d-flex -->

          <div class="media-list">
            <!-- loop starts here -->
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="/assets/sistema/img/img8.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Administrador</strong> Novas atualizações de segurança foram implementadas</p>
                  <span class="tx-12">03 de Maio de 2021 8:45</span>
                </div>
              </div><!-- media -->
            </a>
            <!-- loop ends here -->

            <div class="pd-y-10 tx-center bd-t">
              <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Ver todas as notificações</a>
            </div>
          </div><!-- media-list -->
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
      <div class="dropdown">
        <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
          <span class="logged-name hidden-md-down">Administrador</span>
          <img src="/assets/sistema/img/img1.jpg" class="wd-32 rounded-circle" alt="">
          <span class="square-10 bg-success"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-200">
          <ul class="list-unstyled user-profile-nav">
            <li><a href=""><i class="icon ion-ios-person"></i> Editar Perfil</a></li>
            <li><a href="{{ route('logout') }}"><i class="icon ion-power"></i> Sair</a></li>
          </ul>
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
    </nav>

  </div><!-- br-header-right -->
</div><!-- br-header -->
<!-- ########## END: HEAD PANEL ########## -->

<div class="br-mainpanel">
