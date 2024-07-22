@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Regiões</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> Regiões</h4>
      <p class="mg-b-0">Lista de regiões cadastrados no sistema</p>

     <a href="{{ route('sistema.regiao.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar região</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">

        <div class="form-busca">

          <form action="{{ route('sistema.regiao.buscar') }}" method="POST" name="BuscaRegiao" id="BuscaRegiao">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <label class="form-control-label">Nome da Região: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome" value="" placeholder="Nome da Região">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Nome do Responsável: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome_responsavel" id="nome_responsavel" value="">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i><br/> Pesquisar</button>
              </div>

            </div>
          </form>

        </div>
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listadas {{ $regioes->count() }} regiões</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome da Região</th>
                <th>Responsável</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($regioes as $regiao)
              <tr>
                <th scope="row">{{ $regiao->id }}</th>
                <td>{{ $regiao->nome }}</td>
                <td>
                @foreach ($regiao->responsaveis as $responsavel)
                  {{ $responsavel->nome ?? '' }} 
                @endforeach
                </td>
                <td>
                  <a href="#" onclick="setaDadosModal('{{ $regiao->id }}')" title="Adicionar responsável Pela Região" data-toggle="modal" data-target="#ModalResponsavel" data-whatever="@mdo"><div class="btn btn-warning"><i class="icon ion-person-add"></i></div></a>
                  <a href="{{ url('sistema/regiao/'.$regiao->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirRegiao" data-id="{{ $regiao->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $regioes->links() }}

        </div>
        </div>
    </div>

    <script src="{{ asset('assets/sistema/js/regioes/index.js') }}"></script>


    <div class="modal fade" id="ModalResponsavel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('sistema.regiao.responsavel.adicionar') }}" method="POST">
                @csrf
                <input type="hidden" name="regiao_id" id="regiao_id" value="">
                <div class="modal-content modal-comentarios">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Interação</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Selecione o Responsável:</label>
                            <select class="form-control" name="user_id" id="user_id">
                              <option value="" selected>Selecione </option>

                              @foreach ($colaboradores as $colaborador)
                              <option value="{{ $colaborador->id }}">{{ $colaborador->nome }} - {{ $colaborador->nome_perfil }}</option> 
                              @endforeach
                              
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Gravar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection