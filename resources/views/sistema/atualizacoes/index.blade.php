@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Atualizações</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> Atualizações</h4>
      <p class="mg-b-0">Lista de atualizações (Contratos)</p>

     <a href="{{ route('sistema.atualizacao.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar atualização</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listadas {{ $atualizacoes->count() }} atualizações</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID / Data</th>
                <th>Tipo / Motivo</th>
                <th>Módulo Aplicado / Situação</th>
                <th>Valor Percentual</th>
                <th>Usuário Responsável</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($atualizacoes as $atualizacao)
              <tr>
                <td><strong>{{ $atualizacao->id }}</strong><br/><span class="data">{{ Helper::data_br($atualizacao->data_atualizacao) }}</span></td>
                <td><strong>{{ $atualizacao->tipo_atualizacao }}</strong><br/><span class="motivo">{{ $atualizacao->motivo_atualizacao }}</span></td>
                <td>Módulo: <strong>{{ $atualizacao->modulo_atualizacao }}</strong><br/>Situação: <span class="situacao">{{ $atualizacao->situacao_atualizacao }}</span></td>
                <td>{{ $atualizacao->percentual_atualizacao }}</td>
                <td>{{ $atualizacao->user->nome }}</td>
                <td>
                  <a href="#" class="excluirAtualizacao" data-id="{{ $atualizacao->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $atualizacoes->links() }}
        </div>
        </div>
    </div>

    <script src="{{ asset('assets/sistema/js/atualizacoes/index.js') }}"></script>

@endsection