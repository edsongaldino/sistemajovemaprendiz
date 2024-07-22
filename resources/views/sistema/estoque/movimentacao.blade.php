@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Estoque</a>
        <a class="breadcrumb-item" href="#">Produto</a>
        <span class="breadcrumb-item active">Movimentações</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-cub"></i> Movimentações do Produto ({{ $produto->nome }})</h4>
      <p class="mg-b-0">Lista de movimentações</p>

      <a href="#" title="Adicionar Movimentação" data-toggle="modal" data-target="#ModalMovimentacao" data-whatever="@mdo"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar movimentação ao produto</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $movimentacoes->count() }} registros</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tipo Movimentação</th>
                <th>Quantidade</th>
                <th>Usuário</th>
                <th>Destino</th>
                <th>Data</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($movimentacoes as $movimentacao)
              <tr class="@if($movimentacao->tipo == 'Entrada') entrada @else saida @endif">
                <th scope="row">{{ $movimentacao->id ?? '' }}</th>
                <td>{{ $movimentacao->tipo ?? '' }}<br><span class="descricao-mov">{{ $movimentacao->descricao ?? '' }}</span></td> 
                <td class="quantidade">
                  @if($movimentacao->tipo == 'Entrada')
                  +
                  @else
                  -
                  @endif
                  {{ $movimentacao->quantidade ?? '' }}
                </td>  
                <td>{{ $movimentacao->usuario->nome ?? '' }}<br>{{ $movimentacao->usuario->email ?? '' }}</td>
                <td>{{ $movimentacao->destino->nome ?? 'Estoque Geral' }}</td>
                <td>{{ $movimentacao->data ?? '' }}</td>      
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        </div>
    </div>
    
    <div class="modal fade" id="ModalMovimentacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('sistema.estoque.produto.movimentacao') }}" method="POST">
                @csrf
                <input type="hidden" name="estoque_produto_id" id="estoque_produto_id" value="{{ $produto->id }}">
                <div class="modal-content modal-comentarios">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i> Adicionar movimentação</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Selecione o tipo da movimentação:</label>
                            <select class="form-control" name="tipo" id="tipo_movimentacao">
                              <option value="" selected>Selecione </option>
                              <option value="Entrada">Entrada</option>   
                              <option value="Saída">Saída</option>    
                              <option value="Transferência">Transferência</option>                         
                            </select>
                        </div>

                        <div class="form-group" id="box-destino" style="display: none;">
                          <label for="message-text" class="col-form-label">Selecione o pólo destino:</label>
                          <select class="form-control" name="polo_destino" id="polo_destino">
                            <option value="" selected>Selecione </option>
                            @foreach ($polos as $polo)
                              <option value="{{ $polo->id }}">{{ $polo->nome }}</option>     
                            @endforeach                     
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Descrição:</label>
                          <input type="text" name="descricao" class="form-control" maxlength="100">
                        </div>

                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Quantidade:</label>
                          <input type="text" name="quantidade" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Gravar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/sistema/js/estoques/index.js') }}"></script>


@endsection