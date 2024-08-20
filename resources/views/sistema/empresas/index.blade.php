@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Empresas</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> Empresas</h4>
      <p class="mg-b-0">Lista de empresas cadastradas no sistema</p>

     <a href="{{ route('sistema.empresa.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar empresa</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">

        <div class="form-busca">

          <form action="{{ route('sistema.empresas.buscar') }}" method="POST" name="BuscaEmpresa" id="BuscaEmpresa">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <label class="form-control-label">Nome Fantasia: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome_fantasia" value="" placeholder="Nome fantasia da empresa">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CNPJ: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="cnpj" id="cnpj" value="">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-3">
                  <div class="form-group">
                  <label class="form-control-label">Tipo: <span class="tx-danger">*</span></label>
                  <select class="form-control" name="tipo_empresa" data-placeholder="Selecione o tipo">
                      <option label="Selecione o tipo"></option>
                      <option value="Matriz">Matriz</option>
                      <option value="Filial">Filial</option>
                  </select>
                  </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i><br/> Pesquisar</button>
              </div>

            </div>
          </form>

        </div>

        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $empresas->count() }} empresas</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>CNPJ/CPF</th>
                <th>Nome/Razão</th>
                <th>Cidade</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($empresas as $empresa)
              <tr>
                <th scope="row">{{ $empresa->id }}</th>
                <td>{{ $empresa->tipo_empresa ?? '' }}</td>
                @if($empresa->tipo_cadastro == 'CNPJ')
                <td>{{ Helper::mask($empresa->cnpj,'##.###.###/####-##') ?? '' }}</td>
                <td>{{ $empresa->razao_social ?? '' }}</td>
                @else
                <td>{{ Helper::mask($empresa->cpf,'###.###.###-##') ?? '' }}</td>
                <td>{{ $empresa->nome_fantasia ?? $empresa->nome_responsavel }}</td>
                @endif
                <td>{{ $empresa->endereco->cidade->nome_cidade ?? '' }} - {{ $empresa->endereco->cidade->estado->uf_estado ?? ''}}</td>
                <td>
                  <a href="{{ url('sistema/empresa/'.$empresa->id.'/equipe') }}"><div class="btn btn-success" title="Gerenciar usuários"><i class="icon ion-person-stalker"></i></div></a>
                  <a href="{{ url('sistema/empresa/'.$empresa->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirEmpresa" data-id="{{ $empresa->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $empresas->links() }}

        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/empresas/index.js?v=1') }}"></script>


@endsection
