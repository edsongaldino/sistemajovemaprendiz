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
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> Feriados</h4>
      <p class="mg-b-0">Lista de feriados cadastrados no sistema</p>

     <a href="{{ route('sistema.feriado.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar feriado</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">


        <div class="form-busca">

          <form action="{{ route('sistema.feriado.buscar') }}" method="POST" name="Buscaferiado" id="Buscaferiado">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <label class="form-control-label">Nome do Feriado: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome" value="" placeholder="Nome do pólo">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Tipo do Feriado: <span class="tx-danger">*</span></label>
                <select class="form-control" name="regiao" data-placeholder="Selecione o tipo">
                  <option label="Selecione o tipo"></option>
                  <option value="Nacional">Nacional</option>
                  <option value="Estadual">Estadual</option>
                  <option value="Municipal">Municipal</option>
                </select>
                </div>
              </div><!-- col-4 -->

              <div class="col-md-3">
                <div class="form-group">
                <label class="form-control-label">Data: <span class="tx-danger">*</span></label>
                <input class="form-control" type="date" name="data" value="{{ $request->data ?? '' }}" placeholder="">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i><br/> Pesquisar</button>
              </div>

            </div>
          </form>

        </div>

        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $feriados->count() }} feriados</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Nome do Feriado</th>
                <th>Tipo</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($feriados as $feriado)
              <tr>
                <th scope="row">{{ $feriado->id }}</th>
                <td>{{ $feriado->data }}</td>
                <td>{{ $feriado->descricao }}</td>
                <td>{{ $feriado->tipo }}</td>
                <td>
                  <a href="{{ url('sistema/feriado/'.$feriado->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirFeriado" data-id="{{ $feriado->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $feriados->links() }}

        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/feriados/index.js') }}"></script>


@endsection