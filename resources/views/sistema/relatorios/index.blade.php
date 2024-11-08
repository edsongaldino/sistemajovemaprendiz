@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Financeiro</a>
        <span class="breadcrumb-item active">Relatórios</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> Relatórios</h4>
      <p class="mg-b-0">Relatórios Financeiros</p>
    </div>

    <div class="br-pagebody">


      <div class="botoes-faturamento mg-t-20">
        <form class="form-horizontal" target="_blank" method="post" action={{route('sistema.relatorio.imprimir')}}>
          @csrf

          <input type="hidden" name="tipo_relatorio" value="{{ $request->tipo_relatorio }}">
          <input type="hidden" name="banco" value="{{ $request->banco }}">
          <input type="hidden" name="polo" value="{{ $request->polo }}">
          <input type="hidden" name="data_inicial" value="{{ $request->data_inicial }}">
          <input type="hidden" name="data_final" value="{{ $request->data_final }}">

          <button type="submit" class="btn btn-incluir faturamento"><i class="fa fa-print"></i> Imprimir Relatório</button>
        </form>
      </div>

      <div class="row row-sm">

        <div class="col-sm-6 col-xl-4">
          <div class="bg-teal rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-person-stalker tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Recebidos</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">R$ {{ Helper::converte_valor_real(Helper::ValorTotalRecebido($faturamentos)) }}</p>
                <span class="tx-11 tx-roboto tx-white-6">Valor total recebido</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-4 mg-t-20 mg-sm-t-0">
          <div class="bg-primary rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-power tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">À Receber</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">R$ {{ Helper::converte_valor_real(Helper::ValorTotalReceber($faturamentos)) }}</p>
                <span class="tx-11 tx-roboto tx-white-6">Valor total à receber no período</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
          <div class="bg-danger rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="icon ion-pie-graph tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Vencidos</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">R$ {{ Helper::converte_valor_real(Helper::ValorTotalVencido($faturamentos)) }}</p>
                <span class="tx-11 tx-roboto tx-white-6">Valor total dos contratos vencidos</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->

      </div><!-- row -->

      <div class="br-section-wrapper">

        <div class="form-busca">

          <form action="{{ route('sistema.relatorios.buscar') }}" method="POST" name="BuscaConvenio" id="BuscaConvenio">

            @csrf
            <div class="row">

              <div class="col-md-2">
                <div class="form-group">
                <label class="form-control-label">Tipo Relatório: <span class="tx-danger">*</span></label>
                <select class="form-control" name="tipo_relatorio" data-placeholder="Selecione o tipo do relatório" required>
                    <option label="Selecione o tipo do relatório"></option>
                    <option value="1" @if($request->tipo_relatorio == "1") selected="selected" @endif>À Receber (Geral)</option>
                    <option value="4" @if($request->tipo_relatorio == "4") selected="selected" @endif>À Receber (Venc. Período)</option>
                    <option value="2" @if($request->tipo_relatorio == "2") selected="selected" @endif>Recebidos</option>
                    <option value="3" @if($request->tipo_relatorio == "3") selected="selected" @endif>Vencidos</option>
                    <option value="5" @if($request->tipo_relatorio == "5") selected="selected" @endif>Faturados (Período)</option>
                    <option value="6" @if($request->tipo_relatorio == "6") selected="selected" @endif>À Faturar (Período)</option>
                </select>
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2">
                <div class="form-group">
                <label class="form-control-label">Banco: <span class="tx-danger">*</span></label>
                <select class="form-control" name="banco" data-placeholder="Selecione o Banco">
                    <option label="Selecione o banco"></option>
                    <option value="">Todos</option>
                    @foreach ($contas as $conta)
                    <option value="{{ $conta->id }}"  @if($request->banco == $conta->id) selected="selected" @endif>{{ $conta->banco }} - ({{ $conta->conta_corrente }})</option>
                    @endforeach
                </select>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-3">
                  <div class="form-group">
                  <label class="form-control-label">Pólo: <span class="tx-danger">*</span></label>
                  <select class="form-control" name="polo" data-placeholder="Selecione o Pólo">
                      <option label="Todos os pólos"></option>
                      @foreach ($polos as $polo)
                      <option value="{{ $polo->id }}" @if($request->polo == $polo->id) selected="selected" @endif>{{ $polo->nome }}</option>
                      @endforeach
                  </select>
                  </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Data Inicial: <span class="tx-danger">*</span></label>
                <input class="form-control" type="date" name="data_inicial" id="data_inicial" value="{{ $request->data_inicial ?? '' }}" required>
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Data Final: <span class="tx-danger">*</span></label>
                <input class="form-control" type="date" name="data_final" id="data_final" value="{{ $request->data_final ?? '' }}" required>
                </div>
              </div><!-- col-4 -->

              <div class="col-md-1 mg-t--1 mg-md-t-0">
                <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i><br/></button>
              </div>

            </div>
          </form>

        </div>

        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $faturamentos->count() }} registros</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">


            <thead>
              <tr>
                <th>Data Emissão</th>
                <th>Nº NF</th>
                <th>CNPJ</th>
                <th>Razão Social</th>
                <th>Vencimento</th>
                <th>Situação</th>
                @if($request->tipo_relatorio == "2")
                <th>Data Pagamento</th>
                @endif
                <th>Tipo</th>
                <th>Valor NF</th>
                <th>Juros/Multa</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($faturamentos as $faturamento)
              <tr class="item-faturamento">
                <td>
                  @if($request->tipo_relatorio != "6")
                  {{ Helper::datetime_br($faturamento->notaFiscal->created_at ?? '') }}
                  @else
                  -
                  @endif                
                </td>
                <td>{{ $faturamento->notaFiscal->numero_nf ?? '' }}</td>
                <td>{{ $faturamento->convenio->empresa->cnpj ?? '' }}</td>
                <td>{{ $faturamento->convenio->empresa->razao_social ?? '' }}</td>
                @if(isset($faturamento->boleto->codigo_boleto))
                  <td>{{ Helper::data_br($faturamento->boleto->data_vencimento) ?? '' }}</td>
                  <td class="situacaoP">
                    {{ Helper::getSituacaoByString($faturamento->boleto->status ?? '' )}}<br/>
                    @if($faturamento->boleto->status == "LIQUIDACAO" && $request->tipo_relatorio != "2")
                    <span class="dataPbase"><i class="fa fa-check-square" aria-hidden="true"></i> {{ Helper::data_br($faturamento->boleto->data_pagamento) ?? '' }}</span>
                    @endif
                  </td>
                  @if($request->tipo_relatorio == "2")
                  <td class="dataP"><i class="fa fa-check-square" aria-hidden="true"></i> {{ Helper::data_br($faturamento->boleto->data_pagamento) ?? '' }}</td>
                  @endif
                  <td>{{ $faturamento->forma_pagamento ?? '' }}</td>
                  <td>R$ {{ Helper::converte_valor_real(Helper::GetValorTotalFaturado($faturamento->id)) }}</td>
                  <td>{{ Helper::converte_valor_real($faturamento->boleto->valor_juros) }}</td>
                @else
                  <td>-</td>
                  <td class="situacaoP">{{ Helper::getSituacaoByString($faturamento->situacao_pagamento ?? '') }}</td>
                  @if($request->tipo_relatorio == "2")
                  <td class="dataP"><i class="fa fa-check-square" aria-hidden="true"></i> {{ Helper::data_br($faturamento->data_pagamento) ?? '' }}<br><span class="contaP">{{ $faturamento->informePagamento->conta->banco ?? '' }} ({{ $faturamento->informePagamento->conta->conta_corrente ?? '' }})</span></td>
                  @endif
                  <td>{{ $faturamento->forma_pagamento ?? '' }}</td>
                  <td>R$ {{ Helper::converte_valor_real(Helper::GetValorTotalFaturado($faturamento->id)) }}</td>
                  <td></td>
                @endif
              </tr>
              @endforeach

            </tbody>
          </table>



        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/convenios/index.js') }}"></script>


@endsection
