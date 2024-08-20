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
      <p class="mg-b-0">Lista de faturamentos</p>
    </div>

    <div class="br-pagebody">

      <div class="botoes-faturamento mg-t-20">
        <!--<a href="{{ url('sistema/financeiro/gerar-remessa') }}" target="_blank"><button class="btn btn-incluir remessa"><i class="fa fa-save"></i> Gerar Remessa</button></a>
        <a href="#" data-toggle="modal" data-target="#ModalRetorno" data-whatever="@mdo"><button class="btn btn-incluir retorno"><i class="fa fa-upload"></i> Importar Retorno</button></a>-->
        <a href="{{ url('sistema/arquivo/arquivos-importacao') }}" target="_blank"><button class="btn btn-incluir integracao-contabil"><i class="fa fa-save"></i> Integração Contábil</button></a>
        <a href="{{ url('sistema/faturamento/adicionar') }}"><button class="btn btn-incluir faturamento"><i class="fa fa-plus"></i> Adicionar Faturamento</button></a>
        <!--
        <a href="{{ url('sistema/faturamento/pendentes') }}"><button class="btn btn-incluir pendentes"><i class="fa fa-clock-o"></i> Pendentes</button></a>
        <a href="{{ url('sistema/faturamento/realizados') }}"><button class="btn btn-incluir faturados"><i class="fa fa-check"></i> Faturados</button></a>
        -->
      </div>

      <div class="row row-sm">

        @php
            $totalContratos  = 0;
            $valorTotal = 0;
            foreach ($FaturamentosTotal as $total) {
                $totalContratos += $total->faturamentoContratos->count();
                $valorTotal += $total->faturamentoContratos->sum('valor');
            }

        @endphp

        <div class="col-sm-6 col-xl-4">
          <div class="bg-teal rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-person-stalker tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Convênios Faturados / Periodo</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{ $FaturamentosTotal->count() }}</p>
                <span class="tx-11 tx-roboto tx-white-6">Número total de faturamentos por período</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-4 mg-t-20 mg-sm-t-0">
          <div class="bg-danger rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-power tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Contratos Faturados </p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{ $totalContratos }}</p>
                <span class="tx-11 tx-roboto tx-white-6">Número total de contratos faturados no período</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
          <div class="bg-primary rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="icon ion-pie-graph tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">R$ Valor Total Faturado</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">R$ {{ Helper::converte_valor_real($valorTotal) }}</p>
                <span class="tx-11 tx-roboto tx-white-6">Valor total dos contratos faturados no período</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->

      </div><!-- row -->

      <div class="br-section-wrapper mg-t-10">

        <form action="{{ route('sistema.financeiro.buscar') }}" method="POST" name="BuscaFaturamento" id="BuscaFaturamento">
            @csrf
            <div class="row">

              <div class="col-md-1">
                  <div class="form-group">
                  <label class="form-control-label">Cód. Empresa:</label>
                  <input class="form-control" type="text" name="codigoEmpresa" id="codigoEmpresa" value="@if(isset($contratos)) {{ $contratos->first()->empresa->id ?? '' }} @endif" placeholder="Código">
                  </div>
              </div><!-- col-4 -->

              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CNPJ: </label>
                <input class="form-control cnpj" type="text" name="cnpj" id="cnpjEmpresaBusca" value="@if(isset($contratos)) {{ $contratos->first()->empresa->cnpj ?? '' }} @endif">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CPF: </label>
                <input class="form-control cpf" type="text" name="cpf" id="cpfEmpresaBusca" value="@if(isset($contratos)) {{ $contratos->first()->empresa->cpf ?? '' }} @endif">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4 mg-t--1 mg-md-t-0">
                  <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Nome Fantasia (Empresa): </label>
                  <input class="form-control" type="text" name="nome_fantasia" id="nome_fantasia" value="@if(isset($contratos)) {{ $contratos->first()->empresa->nome_fantasia ?? '' }} @endif">
                  </div>
              </div><!-- col-4 -->

              <div class="col-md-2">
                <div class="form-group">
                <label class="form-control-label">Pólo: </label>
                <select class="form-control" name="polo" data-placeholder="Selecione o Pólo">
                    <option label="Selecione o pólo"></option>
                    @foreach ($polos as $polo)
                    <option value="{{ $polo->id }}">{{ $polo->nome }}</option>
                    @endforeach
                </select>
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2">
                <div class="form-group">
                <label class="form-control-label">Estado (UF): </label>
                <select class="form-control" id="estado_endereco" name="estado_endereco" data-placeholder="Selecione o estado">
                    <option label="Selecione o estado"></option>
                    @foreach ($estados as $estado)
                    <option value="{{ $estado->id }}">{{ $estado->nome_estado }}</option>
                    @endforeach
                </select>
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4">
                <div class="form-group" id="cidade_endereco">
                <label class="form-control-label">Cidade: </label>
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Período (De):</label>
                <input class="form-control" type="date" name="data_inicial" value="{{ $request->data_inicial ?? '' }}" placeholder="">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">à:</label>
                <input class="form-control" type="date" name="data_final" value="{{ $request->data_final ?? '' }}" placeholder="">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i> Pesquisar</button>
              </div>

            </div>

          </form>

      <div class="contratos-faturar" id="contratos-faturar">

        @if(isset($faturamentos))
        <h4 class="tx-gray-800 mg-b-5 mg-t-20">Faturamentos / Convênios</h4>
        <p class="mg-b-20">Foram listados {{ $faturamentos->count() }} convênios já faturados</p>

        <div class="bd bd-gray-300 rounded table-responsive">

        <table class="table table-hover mg-b-0">

            <thead>
            <tr>
                <th>ID</th>
                <th class="text-center">Data do Faturamento</th>
                <th>Nome da Empresa</th>
                <th style="text-align: center;">Qtde de Contratos (Faturados)</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
            </thead>

            <tbody>

            @foreach ($faturamentos as $faturamento)
            <tr>
                <th>{{ $faturamento->id }}</th>
                <td class="text-center">{{ Helper::datetime_br($faturamento->data) ?? '' }}<br/>{{ $faturamento->usuario->nome ?? '' }}<br/><b>{{ Helper::data_br($faturamento->data_inicial) }} à {{ Helper::data_br($faturamento->data_final) }}</b></td>
                <td>
                  @if($faturamento->convenio->empresa->tipo_cadastro == 'CNPJ')
                  CNPJ: <b>{{ Helper::mask($faturamento->convenio->empresa->cnpj, '##.###.###/####-##') ?? '' }}</b>
                  @else
                  CPF: <b>{{ Helper::mask($faturamento->convenio->empresa->cpf, '###.###.###-##') ?? '' }}</b>
                  @endif
                  
                  <br/>{{ $faturamento->convenio->empresa->razao_social ?? $faturamento->convenio->empresa->nome_fantasia }}<br/>{{ $faturamento->convenio->empresa->endereco->cidade->nome_cidade ?? '' }} ({{ $faturamento->convenio->empresa->endereco->cidade->estado->uf_estado ?? '' }})</td>
                @if(isset($faturamento->convenio->contratos))
                <td class="ver-contratos">
                  <span class="qtd">{{ $faturamento->faturamentoContratos->count() ?? '' }}</span><br/>
                  <a href="/sistema/faturamento/convenio/{{ $faturamento->id }}/contratos" class="btn btn-info btn-ver-contratos"><i class="fa fa-eye" aria-hidden="true"></i> Ver Contratos</a><br/>
                  @if(isset($faturamento->numero_pedido))
                  <span class="numero-pedido">Nº Pedido: <b>{{ $faturamento->numero_pedido }}</b></span>
                  @endif
                </td>
                @else
                <td class="ver-contratos"> - </td>
                @endif
                <td>
                  @if($faturamento->forma_pagamento == 'Depósito')
                    @if(isset($faturamento->informePagamento->id))
                    Valor Pago<br/>
                    <strong class="valor-pago">R$ {{ Helper::converte_valor_real($faturamento->informePagamento->valor_pago) }}</strong><br/>
                    {{ Helper::data_br($faturamento->informePagamento->data_pagamento) }}
                    @else
                    <strong>R$ {{ Helper::converte_valor_real(Helper::GetValorTotalFaturado($faturamento->id)) }}</strong><br/>{{ $faturamento->forma_pagamento }}
                    @endif
                  @elseif(isset($faturamento->boleto->codigo_boleto))
                        @if($faturamento->boleto->status == 'LIQUIDACAO')
                          Valor Pago<br/>
                          <strong class="valor-pago">R$ {{ Helper::converte_valor_real($faturamento->boleto->valor_pago) }}</strong>
                          @if($faturamento->boleto->valor_juros > 0)
                          <strong class="valor-juros" title="Juros e Multa">+ {{ Helper::converte_valor_real($faturamento->boleto->valor_juros) }} (JM)</strong>
                          @endif
                        @else
                          <strong>R$ {{ Helper::converte_valor_real(Helper::GetValorTotalFaturado($faturamento->id)) }}</strong><br/>{{ $faturamento->forma_pagamento }}
                        @endif
                  @else
                    <strong>R$ {{ Helper::converte_valor_real(Helper::GetValorTotalFaturado($faturamento->id)) }}</strong><br/>{{ $faturamento->forma_pagamento }}
                  @endif

                  @if(isset($faturamento->credito->id))
                    <br/><span class="credito" title="{{ $faturamento->credito->descricao_credito }}">[C] R$ {{ Helper::converte_valor_real($faturamento->credito->valor_credito) }}</span> 
                  @endif
                </td>
                <td>
                    @if(isset($faturamento->notaFiscal->codigo_nf))
                        @if($faturamento->notaFiscal->status == 'Aguardando Emissão')
                        <a href="#" class="btn btn-warning NFAguardando" data-codigo_nf="{{ $faturamento->notaFiscal->codigo_nf }}" data-token="{{ csrf_token() }}" title="{{ $faturamento->notaFiscal->status }}"><i class="fa fa-eye" aria-hidden="true"></i> Nota Fiscal</a>
                        @elseif($faturamento->notaFiscal->status == 'Cancelada' || $faturamento->notaFiscal->status == 'Cancelamento Solicitado')
                        <a href="#" class="btn btn-warning NFCancelada"><i class="fa fa-eye" aria-hidden="true"></i> Nota Fiscal</a>
                        @else
                        <a href="{{ $faturamento->notaFiscal->link_pdf }}" target="_blank" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i> Nota Fiscal</a>
                        <a href="#" class="btn btn-danger CancelarNF" data-id="{{ $faturamento->notaFiscal->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-close" aria-hidden="true"></i> Cancelar NF</a>
                        @endif
                    @else
                        <a href="#" class="btn btn-info EmitirNotaFiscal" data-id="{{ $faturamento->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Emitir NF</a>
                    @endif
                   
                    @if($faturamento->forma_pagamento == 'Depósito')
                      @if(isset($faturamento->informePagamento->id))
                      <a href="#" class="btn btn-success boletoLiquidado" title="Pagamento Informado"><i class="fa fa-money" aria-hidden="true"></i> Pagamento Informado</a>
                      @else

                      @endif
                    @elseif(isset($faturamento->boleto->codigo_boleto))
                      @if($faturamento->boleto->status == 'LIQUIDACAO')
                          <a href="#" class="btn btn-success boletoLiquidado" title="Boleto Liquidado"><i class="fa fa-check" aria-hidden="true"></i> Liquidado</a>
                      @else
                          <a href="faturamento/boleto/{{ $faturamento->boleto->id }}/visualizar" target="_blank" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i> Boleto</a>
                          <a href="#" class="btn btn-danger excluirBoleto" data-id="{{ $faturamento->boleto->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-close" aria-hidden="true"></i> Cancelar Cobrança</a>
                          <a href="#" class="btn btn-danger boletoAtivo"><i class="fa fa-close" aria-hidden="true"></i></a>
                      @endif
                    @else
                        <a href="#" class="btn btn-info gerarCobranca" data-id="{{ $faturamento->id }}" data-token="{{ csrf_token() }}" class="btn btn-info"><i class="fa fa-file-text-o" aria-hidden="true"></i> Gerar Cobrança</a>
                        <a href="#" class="btn btn-danger excluirFaturamento" data-id="{{ $faturamento->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-close" aria-hidden="true"></i></a>
                    @endif

                    <!-- Example single danger button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                        </button>
                        <div class="dropdown-menu">
                        <a href="#" class="dropdown-item EnviarEmailFaturamento" data-id="{{ $faturamento->id }}" data-token="{{ csrf_token() }}" data-tipo="boleto-nf">Enviar E-mail (Boleto + NF)</a>
                        <a class="dropdown-item" target="_blank" href="/sistema/faturamento/{{ $faturamento->id }}/visualizar-relatorio">Visualizar Relatório</a>
                        <a href="#" class="dropdown-item EnviarEmailFaturamento" data-id="{{ $faturamento->id }}" data-token="{{ csrf_token() }}" data-tipo="relatorio">Enviar Relatório</a>
                        
                        @if(isset($faturamento->numero_pedido))
                        <a href="#" class="dropdown-item AlterarNumeroPedido" data-id="{{ $faturamento->id }}" data-numero-pedido="{{ $faturamento->numero_pedido }}" data-dados-bancarios="{{ $faturamento->dados_bancarios }}">Alterar Número do Pedido</a>
                        @else
                        <a href="#" class="dropdown-item InformarNumeroPedido" data-id="{{ $faturamento->id }}" data-token="{{ csrf_token() }}">Informar Número do Pedido</a>
                        @endif
                        @if(isset($faturamento->boleto->codigo_boleto))
                          @if($faturamento->boleto->status != 'LIQUIDACAO')
                          <a href="#" class="dropdown-item AlterarVencimentoBoleto" data-id="{{ $faturamento->boleto->id }}">Alterar Vencimento do Boleto</a>
                          @endif
                        @endif

                        @if($faturamento->forma_pagamento == 'Depósito')
                          <a href="#" class="dropdown-item InformarPagamento" data-id="{{ $faturamento->id }}">Informar Pagamento</a>
                        @elseif($faturamento->forma_pagamento == 'Depósito')
                          @if(isset($faturamento->boleto->codigo_boleto))
                            @if($faturamento->boleto->status != 'LIQUIDACAO')
                            <a href="#" class="dropdown-item InformarPagamento" data-id="{{ $faturamento->id }}">Informar Pagamento</a>
                            @endif
                          @endif
                        @endif

                        @if(isset($faturamento->credito->id))
                        <a href="#" class="dropdown-item AlterarCredito" data-id="{{ $faturamento->id }}" data-credito-id="{{ $faturamento->credito->id }}" data-valor-credito="{{ $faturamento->credito->valor_credito }}" data-descricao-credito="{{ $faturamento->credito->descricao_credito }}">Alterar Crédito</a>
                        @else
                        <a href="#" class="dropdown-item InformarCredito" data-id="{{ $faturamento->id }}" data-token="{{ csrf_token() }}">Informar Crédito</a>
                        @endif
                        
                        </div>
                    </div>

                </td>
            </tr>
            @endforeach

            </tbody>

        </table>

        {{ $faturamentos->links() }}

        </div>

        @else

        <h4 class="tx-gray-800 mg-b-5 mg-t-20">Nenhum faturamento encontrado</h4>
        <p class="mg-b-20">Não conseguimos encontrar nenhum faturamento nestes parâmetros</p>

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

    <div class="modal fade" id="ModalInformarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <form action="{{ route('sistema.faturamento.informar-numero-pedido') }}" method="POST">
              @csrf
              <input type="hidden" name="Modalfaturamento_id" id="Modalfaturamento_id" value="">
              <div class="modal-content modal-comentarios">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i> Informar número do pedido</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">

                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Nº do Pedido:</label>
                        <input type="text" name="numero_pedido" id="numero_pedido" class="form-control" value="">
                      </div>
                    
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Dados Bancários:</label>
                        <textarea type="text" name="dados_bancarios" id="dados_bancarios" class="form-control"></textarea>
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

  <div class="modal fade" id="ModalAlterarVencimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('sistema.faturamento.alterar-vencimento-boleto') }}" method="POST">
            @csrf
            <input type="hidden" name="ModalBoleto_id" id="ModalBoleto_id" value="">
            <div class="modal-content modal-comentarios">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i> Alterar data de vencimento do boleto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Nova data de venmcimento:</label>
                      <input type="date" name="nova_data" id="nova_data" class="form-control nova-data" value="">
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

  <div class="modal fade" id="ModalInformarPagamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('sistema.faturamento.informar-pagamento') }}" method="POST">
            @csrf
            <input type="hidden" name="Modalfaturamento_id_IP" id="Modalfaturamento_id_IP" value="">
            <div class="modal-content modal-comentarios">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i> Informar Pagamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="message-text" class="col-form-label">Data do Pagamento:</label>
                        <input type="date" name="data_pagamento" id="data_pagamento" class="form-control" value="">
                      </div>
                    
                      <div class="form-group col-md-6">
                        <label for="message-text" class="col-form-label">Valor Pago:</label>
                        <input type="text" name="valor_pago" id="valor_pago" class="form-control moeda">
                      </div>
                    </div>

                    <label for="conta_bancaria" class="col-form-label">Conta Bancária:</label>
                    <select class="form-control" id="conta_bancaria" name="conta_bancaria" data-placeholder="Informar a conta que recebeu">
                      <option label="Selecione a conta"></option>
                      @foreach ($contas as $conta)
                      <option value="{{ $conta->id }}">{{ $conta->banco }} - ({{ $conta->conta_corrente }})</option>
                      @endforeach
                    </select>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Gravar</button>
                </div>
            </div>
        </form>
    </div>
  </div>

  <div class="modal fade" id="ModalInformarCredito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('sistema.faturamento.informar-credito') }}" method="POST">
            @csrf
            <input type="hidden" name="ModalCreditoFaturamento_id" id="ModalCreditoFaturamento_id" value="">
            <input type="hidden" name="Credito_id" id="Credito_id" value="">
            <div class="modal-content modal-comentarios">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i> Informar crédito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Valor Crédito:</label>
                      <input type="text" name="valor_credito" id="valor_credito" class="form-control moeda" value="">
                    </div>
                  
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Descrição:</label>
                      <textarea type="text" name="descricao_credito" id="descricao_credito" class="form-control"></textarea>
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

@endsection
