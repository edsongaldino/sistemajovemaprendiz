@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Configurações</a>
        <a class="breadcrumb-item" href="#">Usuários</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-user"></i> Usuários</h4>
      <p class="mg-b-0">Lista de usuários cadastrados no sistema</p>

     <a href="{{ route('sistema.usuarios.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar usuário</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">


        <div class="form-busca">

          <form action="{{ route('sistema.usuarios.buscar') }}" method="POST" name="BuscaAluno" id="BuscaAluno">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome" value="" placeholder="Nome do usuário">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-3">
                  <div class="form-group">
                  <label class="form-control-label">Perfil: <span class="tx-danger">*</span></label>
                  <select class="form-control" name="perfil" data-placeholder="Selecione o Perfil">
                      <option label="Selecione o perfil"></option>
                      @foreach ($perfis as $perfil)
                      <option value="{{ $perfil->id }}">{{ $perfil->nome }}</option>
                      @endforeach
                  </select>
                  </div>
              </div><!-- col-4 -->
              
              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CPF: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="cpf" id="cpf" value="">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i><br/> Pesquisar</button>
              </div>

            </div>
          </form>

        </div>

        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $usuarios->count() }} usuários</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($usuarios as $usuario)
              <tr>
                <th scope="row">{{ $usuario->id }}</th>
                <td>{{ $usuario->nome }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->perfil->nome ?? '' }}</td>
                <td>
                  <a href="{{ url('sistema/usuario/'.$usuario->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirUsuario" data-id="{{ $usuario->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $usuarios->links() }}
          
        </div>
        </div>
    </div>


@endsection