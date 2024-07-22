@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Processo Seletivo</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-bank"></i> Candidato: {{ $candidato->nome }}</h6>
      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-briefcase"></i> CPF: {{ $candidato->cpf }}</h6>
      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-calendar"></i> Data de Nascimento: {{ Helper::data_br($candidato->data_nascimento) }}</h6>

      <a href="{{ url()->previous() }}"><button class="btn btn-incluir"><i class="fa fa-arrow-left"></i> Voltar</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Vaga</th>
                <th>Data</th>
                <th>Empresa</th>
                <th>Situação</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($processos_seletivos as $processo)
              <tr>
                <th scope="row">{{ $processo->id }}</th>
                <td>{{ $processo->vaga->tipo_vaga ?? '' }}</td>
                <td>{{ Helper::data_br($processo->vaga->data_inicial ?? '') }}</td>
                <td>{{ $processo->vaga->empresa->nome_fantasia ?? '' }}</td>
                <td>{{ $processo->situacao }}</td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $processos_seletivos->links() }}

        </div>

        </div>

    </div>

  <script src="{{ asset('assets/sistema/js/tabelas/index.js') }}"></script>

@endsection
