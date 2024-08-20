@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Financeiro</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5">Financeiro</h4>
      <p class="mg-b-0">Lista de alunos cadastrados no sistema</p>
    </div>

    <div class="br-pagebody">

      <div class="row row-sm">

        <div class="col-sm-6 col-xl-4">
          <div class="bg-teal rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-person-stalker tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Contratos Faturados / Mês</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">45</p>
                <span class="tx-11 tx-roboto tx-white-6">Número de contratos já faturados no mês</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-4 mg-t-20 mg-sm-t-0">
          <div class="bg-danger rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-power tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Contratos Aguardando Faturamento </p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">300</p>
                <span class="tx-11 tx-roboto tx-white-6">Número total de contratos aguardando faturamento no mês</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
          <div class="bg-primary rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="icon ion-pie-graph tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">R$ Relatório Parcial</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">R$ 500.000,00</p>
                <span class="tx-11 tx-roboto tx-white-6">Previsão de faturamento no mês atual</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->

      </div><!-- row -->

      <div class="botoes-faturamento mg-t-20">
        <a href="{{ url('sistema/financeiro/gerar-remessa') }}" target="_blank"><button class="btn btn-incluir remessa"><i class="fa fa-save"></i> Gerar Remessa</button></a>
        <a href="#" data-toggle="modal" data-target="#ModalRetorno" data-whatever="@mdo"><button class="btn btn-incluir retorno"><i class="fa fa-upload"></i> Importar Retorno</button></a>
        <a href="{{ url('sistema/faturamento/adicionar') }}"><button class="btn btn-incluir faturamento"><i class="fa fa-plus"></i> Adicionar Faturamento</button></a>
        <a href="{{ url('sistema/faturamento/pendentes') }}"><button class="btn btn-incluir pendentes"><i class="fa fa-clock-o"></i> Pendentes</button></a>
        <a href="{{ url('sistema/faturamento/realizados') }}"><button class="btn btn-incluir faturados"><i class="fa fa-check"></i> Faturados</button></a>

      </div>

      <div class="br-section-wrapper mg-t-10">

      <div class="contratos-faturar" id="contratos-faturar">

        @if(isset($faturamentos))
        <h4 class="tx-gray-800 mg-b-5 mg-t-20">Contratos faturados</h4>
        <p class="mg-b-20">Foram listados {{ $faturamentos->count() }} contratos já faturados</p>

        <div class="bd bd-gray-300 rounded table-responsive">

        <table class="table table-hover mg-b-0">

            <thead>
            <tr>
                <th>ID</th>
                <th class="text-center">Data do Faturamento</th>
                <th>Nome da Empresa</th>
                <th>Aluno</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
            </thead>

            <tbody>
                @foreach ($faturamentos as $faturamento)
                    <tr>
                        <th>{{ $faturamento->id }}</th>
                        <td class="text-center">{{ $faturamento->data ?? '' }}<br/>{{ $faturamento->usuario->nome ?? '' }}</td>
                        <td>{{ $faturamento->contrato->empresa->nome_fantasia ?? '' }}<br/>{{ $faturamento->contrato->empresa->endereco->cidade->nome_cidade ?? '' }} ({{ $faturamento->contrato->empresa->endereco->cidade->estado->uf_estado ?? '' }})</td>
                        <td>{{ $faturamento->contrato->aluno->nome ?? '' }}</td>
                        <td><strong>R$ {{ Helper::converte_valor_real($faturamento->valor) }}</strong><br/> <span class="descontos"> Desconto Uniforme: R$ {{ Helper::converte_valor_real(Helper::getAtualizacaoContrato($faturamento->data_inicial,$faturamento->data_final, $faturamento->contrato->id, 'Entrega de Uniforme')) }}<br/>Desconto Faltas: R$ {{ Helper::converte_valor_real(Helper::getAtualizacaoContrato($faturamento->data_inicial,$faturamento->data_final, $faturamento->contrato->id, 'Falta Trabalho')) }}</span></td>
                        <td>
                            @if(isset($faturamento->notaFiscal->codigo_nf))

                                @if($faturamento->notaFiscal->status == 'Aguardando Emissão')
                                <a href="#" class="btn btn-warning NFAguardando" title="{{ $faturamento->notaFiscal->status }}"><i class="fa fa-eye" aria-hidden="true"></i> Nota Fiscal</a>
                                @elseif($faturamento->notaFiscal->status == 'Cancelada' || $faturamento->notaFiscal->status == 'Cancelamento Solicitado')
                                <a href="#" class="btn btn-warning NFCancelada"><i class="fa fa-eye" aria-hidden="true"></i> Nota Fiscal</a>
                                @else
                                <a href="faturamento/nota-fiscal/{{ $faturamento->notaFiscal->codigo_nf }}/visualizar" target="_blank" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i> Nota Fiscal</a>
                                <a href="#" class="btn btn-danger CancelarNF" data-id="{{ $faturamento->notaFiscal->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-close" aria-hidden="true"></i> Cancelar NF</a>
                                @endif
                            @else
                                <a href="#" class="btn btn-info EmitirNotaFiscal" data-id="{{ $faturamento->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Emitir NF</a>
                            @endif

                            @if(isset($faturamento->boleto->codigo_boleto))
                                <a href="faturamento/boleto/{{ $faturamento->boleto->id }}/visualizar" target="_blank" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i> Boleto</a>
                                <a href="#" class="btn btn-danger excluirBoleto" data-id="{{ $faturamento->boleto->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-close" aria-hidden="true"></i> Cancelar Cobrança</a>
                                <a href="#" class="btn btn-danger boletoAtivo"><i class="fa fa-close" aria-hidden="true"></i></a>
                            @else
                                <a href="#" class="btn btn-info gerarCobranca" data-id="{{ $faturamento->id }}" data-token="{{ csrf_token() }}" class="btn btn-info"><i class="fa fa-file-text-o" aria-hidden="true"></i> Gerar Cobrança</a>
                                <a href="#" class="btn btn-danger excluirFaturamento"><i class="fa fa-close" aria-hidden="true"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $faturamentos->links() }}

        </div>

        @else

        <h4 class="tx-gray-800 mg-b-5 mg-t-20">Nenhum contrato encontrado</h4>
        <p class="mg-b-20">Não conseguimos encontrar nenhum contrato à faturar nestes parâmetros</p>

        @endif

        </div>

      </div>

    </div><!-- br-pagebody -->

    <script src="{{ asset('assets/sistema/js/financeiro/index.js?v=1') }}"></script>

    <div class="modal fade" id="ModalRetorno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ url('sistema/faturamento/importar-retorno') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content modal-comentarios">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i> Importar Arquivo de Retorno</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    <div class="form-group">
                          <label for="message-text" class="col-form-label">Arquivo (.CRT):</label>
                          <input type="file" name="arquivo_retorno" class="form-control" required="required">
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Upload Arquivo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
