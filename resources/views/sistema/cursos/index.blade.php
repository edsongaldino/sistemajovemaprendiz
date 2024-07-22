@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Cursos</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> Cursos</h4>
      <p class="mg-b-0">Lista de cursos cadastrados no sistema</p>

     <a href="{{ route('sistema.curso.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar curso</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $cursos->count() }} pólos</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Nome do curso</th>
                <th>CBO</th>
                <th>Pólo</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($cursos as $curso)
              <tr>
                <th scope="row">{{ $curso->id }}</th>
                <td>{{ $curso->numero }}</td>
                <td>{{ $curso->nome }}</td>
                <td>{{ $curso->cbo }}</td>
                <td>{{ $curso->polo->nome }}</td>
                <td>
                  <a href="{{ url('sistema/curso/'.$curso->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirCurso" data-id="{{ $curso->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/cursos/index.js') }}"></script>


@endsection