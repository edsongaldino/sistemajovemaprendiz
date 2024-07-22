@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Tabelas</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> Tabelas</h4>
      <p class="mg-b-0">Lista de tabelas (Contratos)</p>

     <a href="{{ route('sistema.tabela.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar tabela</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listadas {{ $tabelas->count() }} tabelas</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tabela</th>
                <th>Validade</th>
                <th>Valor</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tabelas as $tabela)
              <tr>
                <th scope="row">{{ $tabela->id }}</th>
                <td>{{ $tabela->nome }}</td>
                <td>{{ $tabela->validade }}</td>
                <td>{{ Helper::GetUltimaAtualizacaoValorTabela($tabela) }}</td>
                <td>
                  <a href="{{ url('sistema/tabela/'.$tabela->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirTabela" data-id="{{ $tabela->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $tabelas->links() }}
        </div>
        </div>
    </div>

    <script src="{{ asset('assets/sistema/js/tabelas/index.js') }}"></script>

@endsection