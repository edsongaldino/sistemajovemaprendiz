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
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-user"></i> Alunos</h4>
      <p class="mg-b-0">Lista de alunos cadastrados no sistema</p>

     <a href="{{ route('sistema.aluno.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar aluno</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">

        <div class="form-busca">

          <form action="{{ route('sistema.alunos.buscar') }}" method="POST" name="BuscaAluno" id="BuscaAluno">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome" value="" placeholder="Nome do aluno">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CPF: <span class="tx-danger">*</span></label>
                <input class="form-control cpf" type="text" name="cpf" id="cpf" value="">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-3">
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
                <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i><br/> Pesquisar</button>
              </div>

            </div>
          </form>

        </div>

        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $alunos->count() }} alunos</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome do Aluno</th>
                <th>Cidade</th>
                <th>Pólo</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($alunos as $aluno)
              <tr>
                <th scope="row">{{ $aluno->id }}</th>
                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->endereco->cidade->nome_cidade ?? '' }} - {{ $aluno->endereco->cidade->estado->uf_estado ?? '' }}</td>
                <td>{{ $aluno->polo->nome }}</td>
                <td>
                  <a href="{{ url('sistema/aluno/'.$aluno->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirAluno" data-id="{{ $aluno->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $alunos->appends(Request::except('page'))->links() }}
        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/alunos/index.js') }}"></script>


@endsection
