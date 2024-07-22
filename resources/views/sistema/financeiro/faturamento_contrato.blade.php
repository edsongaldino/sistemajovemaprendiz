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

      <div class="br-section-wrapper mg-t-10">

        <form method="POST" name="BuscaFaturamento" id="BuscaFaturamento">
          @csrf
          <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                <label class="form-control-label">Código da Empresa: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="codigoEmpresa" id="codigoEmpresa" value="@if(isset($faturamento)) {{ $faturamento->convenio->empresa->id ?? '' }} @endif" placeholder="Código" required readonly>
                </div>
            </div><!-- col-4 -->

            <div class="col-md-2 mg-t--1 mg-md-t-0">
              <div class="form-group mg-md-l--1">
              <label class="form-control-label">CNPJ: <span class="tx-danger">*</span></label>
              <input class="form-control cnpj" type="text" name="cnpjEmpresa" id="cnpjEmpresa" value="@if(isset($faturamento)) {{ $faturamento->convenio->empresa->cnpj ?? '' }} @endif" readonly>
              </div>
            </div><!-- col-4 -->

            <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Razão Social (Empresa): <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="razao" id="razao_social" value="@if(isset($faturamento)) {{ $faturamento->convenio->empresa->razao_social ?? '' }} @endif" readonly>
                </div>
            </div><!-- col-4 -->

            <div class="col-md-4 mg-t--1 mg-md-t-0">
              <div class="form-group mg-md-l--1">
              <label class="form-control-label">Cidade/UF: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="cidade" id="cidade" value="@if(isset($faturamento)) {{ $faturamento->convenio->empresa->endereco->cidade->nome_cidade ?? '' }}/{{ $faturamento->convenio->empresa->endereco->cidade->estado->uf_estado ?? '' }} @endif" readonly>
              </div>
            </div><!-- col-4 -->

            <div class="col-md-2 mg-t--1 mg-md-t-0">
              <div class="form-group mg-md-l--1">
              <label class="form-control-label">Qtde de Contratos: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="total_contratos" id="total_contratos" value="@if(isset($faturamento)) {{ $faturamento->convenio->contratos->count() ?? '' }} @endif" readonly>
              </div>
            </div><!-- col-4 -->

            <div class="col-md-2 mg-t--1 mg-md-t-0">
              <div class="form-group mg-md-l--1">
              <label class="form-control-label">Período (De):<span class="tx-danger">*</span></label>
              <input class="form-control" type="date" name="data_inicial" value="{{ $data_inicial ?? '' }}" placeholder="" required readonly>
              </div>
            </div><!-- col-4 -->

            <div class="col-md-2 mg-t--1 mg-md-t-0">
              <div class="form-group mg-md-l--1">
              <label class="form-control-label">à:<span class="tx-danger">*</span></label>
              <input class="form-control" type="date" name="data_final" value="{{ $data_final ?? '' }}" placeholder="" required readonly>
              </div>
            </div><!-- col-4 -->

            <div class="col-md-3">
              <div class="form-group">
                <label class="form-control-label">Forma de Pagamento: <span class="tx-danger">*</span></label>
                <select class="form-control" id="forma_pagamento" name="forma_pagamento" data-placeholder="Selecione a forma de pagamento" disabled>
                    <option value="Boleto">Boleto</option>
                </select>
              </div>
            </div><!-- col-4 -->

            <div class="col-md-3 mg-t--1 mg-md-t-0">
              <a href="/sistema/financeiro" class="btn btn-busca"><i class="fa fa-arrow-circle-o-left"></i> Voltar</a>
            </div>

          </div>

        </form>

        <div class="contratos-faturar" id="contratos-faturar">

            @if(isset($contratos))
            <h4 class="tx-gray-800 mg-b-5 mg-t-20">Contratos para faturar</h4>
            <p class="mg-b-20">Foram listados {{ $contratos->count() }} contratos</p>


            <div class="bd bd-gray-300 rounded table-responsive">

              <table class="table table-hover mg-b-0">

                <thead>
                  <tr>
                    <th>ID</th>
                    <th class="text-center">Dia de Faturamento</th>
                    <th>Nome da Empresa</th>
                    <th>Aluno</th>
                    <th>Valor Total</th>
                    <th>Ações</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach ($contratos as $contrato)
                  <tr>
                    <th>{{ $contrato->id }}</th>
                    <td class="text-center">{{ $contrato->convenio->dia_faturamento ?? '' }}</td>
                    <td>ID: {{ $contrato->empresa->id }} - {{ $contrato->empresa->razao_social }}<br/>{{ $contrato->empresa->endereco->cidade->nome_cidade }} ({{ $contrato->empresa->endereco->cidade->estado->uf_estado }})</td>
                    <td>{{ $contrato->aluno->nome }}</td>
                    @php
                        $FaturamentoContrato = Helper::getFaturamentoContrato($faturamento->id, $contrato->id)
                    @endphp

                    @if($FaturamentoContrato)

                        @if($contrato->tipo_faturamento == 'Instituição')
                        <td class="total-faturado"><strong>R$ {{ Helper::converte_valor_real(($FaturamentoContrato->FaturamentoContratoInstituicaoDados->valor_total ?? 0) + ($FaturamentoContrato->FaturamentoContratoInstituicaoDados->valor_issqn ?? 0)) }}</strong></td>
                        @else
                        <td class="total-faturado"><strong>R$ {{ Helper::converte_valor_real(($FaturamentoContrato->FaturamentoContratoEmpresaDados->valor_total ?? 0) + ($FaturamentoContrato->FaturamentoContratoEmpresaDados->valor_issqn ?? 0)) }}</strong></td>
                        @endif

                        <td>
                        <a href="#" class="btn btn-success ContratoFaturado"><i class="fa fa-check" aria-hidden="true"></i> Faturado</a>
                        <a href="#" class="btn btn-danger excluirFaturamentoContrato" data-id="{{ $FaturamentoContrato->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-close" aria-hidden="true"></i></a>
                        </td>
                    @else
                    <td class="total-faturado"><strong>R$ </strong></td>
                    <td><a href="#" class="btn btn-info faturarContrato" data-faturamento="{{ $faturamento->id }}" data-id="{{ $contrato->id }}" data-inicial="{{ $data_inicial }}" data-final="{{ $data_final }}" data-token="{{ csrf_token() }}"><i class="fa fa-dollar" aria-hidden="true"></i> Faturar Contrato</a></td>
                    @endif

                  </tr>
                  @endforeach

                </tbody>

              </table>

              {{ $contratos->links() }}

            </div>

            @else

            <h4 class="tx-gray-800 mg-b-5 mg-t-20">Nenhum contrato encontrado</h4>
            <p class="mg-b-20">Não conseguimos encontrar nenhum contrato à faturar nestes parâmetros</p>

            @endif

        </div>

      </div>

    </div><!-- br-pagebody -->

    <script src="{{ asset('assets/sistema/js/financeiro/index.js') }}"></script>

    <div class="modal" id="ModalFaltas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Faturando Contrato</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body form-faturar">
              <form action="">

                <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                      <label class="form-control-label">Número do Contrato: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="codigoEmpresa" id="codigoEmpresa" value="" placeholder="Código" required>
                      </div>
                  </div><!-- col-4 -->
                  <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-control-label">Nome do Jovem: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="codigoEmpresa" id="codigoEmpresa" value="" placeholder="Código" required>
                    </div>
                  </div><!-- col-4 -->
                </div>

              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">FATURAR</button>
          </div>
        </div>
      </div>
    </div>

@endsection
