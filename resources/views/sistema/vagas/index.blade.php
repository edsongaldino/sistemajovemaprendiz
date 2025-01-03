@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Alunos</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5">Vagas</h4>
      <p class="mg-b-0">Lista de vagas cadastradas no sistema</p>

      <a href="{{ route('sistema.vaga.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-briefcase"></i> Adicionar vaga</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $vagas->count() }} vagas</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Pólo</th>
                <th>Empresa</th>
                <th>Tipo</th>
                <th>Quantidade</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($vagas as $vaga)
              <tr>
                <th scope="row">{{ $vaga->id }}</th>
                <td>{{ $vaga->polo->nome }}</td>
                <td>{{ $vaga->empresa->nome_fantasia ?? '' }}</td>
                <td>{{ $vaga->tipo_vaga }}</td>
                <td>{{ $vaga->qtde_vagas }}</td>
                <td>
                  <a href="{{ url('sistema/vaga/'.$vaga->id.'/processo-seletivo') }}"><div class="btn btn-success"><i class="icon ion-person-stalker"></i> Processo Seletivo</div></a>
                  <a href="{{ url('sistema/vaga/'.$vaga->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirVaga" data-id="{{ $vaga->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $vagas->links() }}

        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/vagas/index.js') }}"></script>


@endsection