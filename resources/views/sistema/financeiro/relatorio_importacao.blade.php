@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Financeiro</a>
        <span class="breadcrumb-item active">Relatório Contábil </span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5">Arquivos de Importação Contábil</h4>
      <p class="mg-b-0">Lista de arquivos de importação gerados pelo sistema</p>
    </div>

    <div class="br-pagebody">

      <div class="br-section-wrapper mg-t-10">

        <div class="botoes-faturamento mg-t-20">

            <a href="#" data-toggle="modal" data-target="#ModalGerarTXT"><button class="btn btn-incluir faturamento"><i class="fa fa-share"></i> Gerar Novo Arquivo</button></a>

        </div>

        <div class="contratos-faturar" id="contratos-faturar">

            @if(isset($arquivos))
            <p class="mg-b-20">Foram listados {{ $arquivos->count() }} arquivos</p>


            <div class="bd bd-gray-300 rounded table-responsive">

              <table class="table table-hover mg-b-0">

                <thead>
                  <tr>
                    <th>ID</th>
                    <th class="text-center">Data de Criação</th>
                    <th>Usuário</th>
                    <th>Link do Arquivo</th>
                    <th>Ações</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach ($arquivos as $arquivo)
                  <tr>
                    <th>{{ $arquivo->id }}</th>
                    <td class="text-center">{{ \Carbon\Carbon::parse($arquivo->created_at)->format('d/m/Y H:i')}}</td>
                    <td>{{ $arquivo->usuario->nome }}</td>
                    <td>{{ $arquivo->url_arquivo }}</td>
                    <td>
                        <a href="{{ $arquivo->url_arquivo }}" target="_blank"><div class="btn btn-info"><i class="icon ion-arrow-down-a"></i> Download Arquivo</div></a>
                        <a href="#" class="excluirArquivo" data-id="{{ $arquivo->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                    </td>
                  </tr>
                  @endforeach

                </tbody>

              </table>

              {{ $arquivos->links() }}

            </div>

            @else

            <h4 class="tx-gray-800 mg-b-5 mg-t-20">Nenhum arquivo encontrado</h4>
            <p class="mg-b-20">Não conseguimos encontrar nenhum arquivo gerado</p>

            @endif

        </div>

      </div>

    </div><!-- br-pagebody -->

    <div class="modal" id="ModalGerarTXT" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Gerar Arquivo de Importação (TXT)</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{ route('sistema.arquivo.gerar-arquivo') }}" method="POST" name="GerarArquivoImportacaoTXT" id="GerarArquivoImportacaoTXT">
              @csrf
              <div class="modal-body form-faturar">
                <div class="row">

                  <div class="col-md-5">
                      <div class="form-group">
                      <label class="form-control-label">Tipo: <span class="tx-danger">*</span></label>
                      <select class="form-control" id="tipo" name="tipo" data-placeholder="Selecione" required>
                          <option label="Selecione"></option>
                          <option value="FATURAMENTO">FATURAMENTO</option>
                          <option value="RECEBIMENTO">RECEBIMENTO</option>
                      </select>
                      </div>
                  </div><!-- col-4 -->

                  <div class="col-md-4">
                      <div class="form-group">
                      <label class="form-control-label">Data Inicial: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="date" name="data_inicial" id="data_inicial" value="" placeholder="" required>
                      </div>
                  </div><!-- col-4 -->

                  <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-control-label">Data Final: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="date" name="data_final" id="data_final" value="" placeholder="" required>
                      </div>
                  </div><!-- col-4 -->

                  <div class="col-md-5" id="boxRecebimento" style="display: none;">
                    <div class="form-group">
                        <label class="form-control-label">Recebimento: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="checkbox" name="recebimento" id="recebimento" value="recebimento" checked>
                    </div>
                    <div class="form-group">
                      <label class="form-control-label">Juros: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="checkbox" name="juros" id="juros" value="juros">
                    </div>
                </div><!-- col-4 -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Gerar Arquivo</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    <script src="{{ asset('assets/sistema/js/financeiro/index.js?v=1') }}"></script>

@endsection
