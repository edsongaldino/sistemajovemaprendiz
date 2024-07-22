@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Configurações</a>
        <a class="breadcrumb-item" href="#">Polo</a>
        <span class="breadcrumb-item active">Equipe</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-user"></i> Equipe do Pólo ({{ $polo->nome }})</h4>
      <p class="mg-b-0">Lista de usuários do pólo</p>

      <a href="#" title="Adicionar membro á equipe do pólo" data-toggle="modal" data-target="#ModalEquipe" data-whatever="@mdo"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar à equipe (Pólo)</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
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
              @foreach ($equipe as $membro)
              <tr>
                <th scope="row">{{ $membro->id }}</th>
                <td>{{ $membro->nome }}</td>
                <td>{{ $membro->email }}</td>
                <td>{{ $membro->nome_perfil }}</td>
                <td>
                  <a href="#" class="excluirMembro" data-id="{{ $membro->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/polos/index.js') }}"></script>

    <div class="modal fade" id="ModalEquipe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('sistema.polo.equipe.adicionar') }}" method="POST">
                @csrf
                <input type="hidden" name="polo_id" id="polo_id" value="{{ $polo->id }}">
                <div class="modal-content modal-comentarios">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Adicionar membro à equipe do Pólo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Selecione o usuário que deseja adicionar:</label>
                            <select class="form-control" name="user_id" id="user_id">
                              <option value="" selected>Selecione </option>

                              @foreach ($usuarios as $usuario)
                              <option value="{{ $usuario->id }}">{{ $usuario->nome }}</option> 
                              @endforeach
                              
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Incluir membro</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection