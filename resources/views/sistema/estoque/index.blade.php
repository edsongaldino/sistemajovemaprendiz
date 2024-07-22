@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Estoque</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> Estoque</h4>
      <p class="mg-b-0">Lista de produtos cadastrados no sistema</p>

     <a href="{{ route('sistema.produto.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar produto</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $produtos->count() }} pólos</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome do produto</th>
                <th>Tipo</th>
                <th>Quantidade</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($produtos as $produto)
              <tr>
                <th scope="row">{{ $produto->id }}</th>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->tipo }}</td>
                <td>{{ $produto->quantidade }}</td>
                <td>
                  <a href="{{ url('sistema/produto/'.$produto->id.'/movimentacao') }}"><div class="btn btn-warning"><i class="icon ion-eye"></i> Movimentações do Produto</div></a>
                  <a href="{{ url('sistema/produto/'.$produto->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirProduto" data-id="{{ $produto->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/produtos/index.js') }}"></script>


@endsection