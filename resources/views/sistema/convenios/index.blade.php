@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Convênios</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> convenios</h4>
      <p class="mg-b-0">Lista de convênios cadastrados no sistema</p>

     <a href="{{ route('sistema.convenio.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar convênio</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">

        <div class="form-busca">

          <form action="{{ route('sistema.convenios.buscar') }}" method="POST" name="BuscaConvenio" id="BuscaConvenio">

            @csrf
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                <label class="form-control-label">Nome Fantasia (Empresa): <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome_fantasia" value="" placeholder="Nome Fantasia (Empresa)">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CNPJ: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="cnpj" id="cnpj" value="">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-2">
                  <div class="form-group">
                  <label class="form-control-label">Pólo: <span class="tx-danger">*</span></label>
                  <select class="form-control" name="polo" data-placeholder="Selecione o Pólo">
                      <option label="Selecione o pólo"></option>
                      @foreach ($polos as $polo)
                      <option value="{{ $polo->id }}">{{ $polo->nome }}</option>
                      @endforeach
                  </select>
                  </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Dia Faturamento: <span class="tx-danger">*</span></label>
                <input class="form-control" type="number" name="dia_faturamento" id="dia_faturamento" value="">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i><br/> Pesquisar</button>
              </div>

            </div>
          </form>

        </div>

        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $convenios->count() }} convênios</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Tipo</th>
                <th>Empresa</th>
                <th>Data de Faturamento</th>
                <th>Qtde de Jovens</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($convenios as $convenio)
              <tr>
                <th scope="row">{{ $convenio->id }}</th>
                <td>{{ $convenio->numero ?? '' }}</td>
                <td>{{ $convenio->tipo_convenio ?? '' }}</td>
                <td>{{ $convenio->empresa->nome_fantasia ?? '' }}</td>
                <td>{{ $convenio->dia_faturamento ?? '' }}</td>
                <td>{{ $convenio->qtde_jovens ?? '' }}</td>
                <td>
                  <a href="{{ url('sistema/convenio/'.$convenio->id.'/imprimir') }}" target="_blank"><div class="btn btn-warning" title="Imprimir Contrato de Convênio"><i class="fa fa-print" aria-hidden="true"></i></div></a>
                  <a href="{{ url('sistema/convenio/'.$convenio->id.'/contratos') }}" target="_blank"><div class="btn btn-success" title="Listas Contratos desse convênio"><i class="fa fa-user" aria-hidden="true"></i></div></a>
                  <a href="{{ url('sistema/convenio/'.$convenio->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirConvenio" data-id="{{ $convenio->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>

          {{ $convenios->links() }}

        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/convenios/index.js') }}"></script>


@endsection
