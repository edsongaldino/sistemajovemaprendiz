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

        <form action="{{ route('sistema.faturamento.buscar') }}" method="POST" name="BuscaFaturamento" id="BuscaFaturamento">
          @csrf
          <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                <label class="form-control-label">Código da Empresa: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="codigoEmpresa" id="codigoEmpresa" value="@if(isset($contratos)) {{ $contratos->first()->empresa->id ?? '' }} @endif" placeholder="Código">
                </div>
            </div><!-- col-4 -->

            <div class="col-md-3 mg-t--1 mg-md-t-0">
              <div class="form-group mg-md-l--1">
              <label class="form-control-label">CNPJ: <span class="tx-danger">*</span></label>
              <input class="form-control cnpj" type="text" name="cnpjEmpresa" id="cnpjEmpresa" value="@if(isset($contratos)) {{ $contratos->first()->empresa->cnpj ?? '' }} @endif">
              </div>
            </div><!-- col-4 -->

            <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Nome Fantasia (Empresa): <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome_fantasia" id="nome_fantasia" value="@if(isset($contratos)) {{ $contratos->first()->empresa->nome_fantasia ?? '' }} @endif" readonly>
                </div>
            </div><!-- col-4 -->

            <div class="col-md-3 mg-t--1 mg-md-t-0">
              <div class="form-group mg-md-l--1">
              <label class="form-control-label">Cidade/UF: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="cidade" id="cidade" value="@if(isset($contratos)) {{ $contratos->first()->empresa->endereco->cidade->nome_cidade ?? '' }}/{{ $contratos->first()->empresa->endereco->cidade->estado->uf_estado ?? '' }} @endif" readonly>
              </div>
            </div><!-- col-4 -->

            <div class="col-md-2 mg-t--1 mg-md-t-0">
              <div class="form-group mg-md-l--1">
              <label class="form-control-label">Qtde de Contratos: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="total_contratos" id="total_contratos" value="@if(isset($contratos)) {{ $contratos->count() ?? '' }} @endif" readonly>
              </div>
            </div><!-- col-4 -->

            <div class="col-md-2 mg-t--1 mg-md-t-0">
              <div class="form-group mg-md-l--1">
              <label class="form-control-label">Período (De):<span class="tx-danger">*</span></label>
              <input class="form-control" type="date" name="data_inicial" value="{{ $request->data_inicial ?? $data_inicial }}" placeholder="" required>
              </div>
            </div><!-- col-4 -->

            <div class="col-md-2 mg-t--1 mg-md-t-0">
              <div class="form-group mg-md-l--1">
              <label class="form-control-label">à:<span class="tx-danger">*</span></label>
              <input class="form-control" type="date" name="data_final" value="{{ $request->data_final ?? $data_final }}" placeholder="" required>
              </div>
            </div><!-- col-4 -->

            <div class="col-md-2">
              <div class="form-group">
                <label class="form-control-label">Forma de Pagamento: <span class="tx-danger">*</span></label>
                <select class="form-control" id="forma_pagamento" name="forma_pagamento" data-placeholder="Selecione a forma de pagamento" required>
                    <option value="Boleto" @if(($request->forma_pagamento ?? '') == 'Boleto') selected @endif>Boleto</option>
                    <option value="Depósito" @if(($request->forma_pagamento ?? '') == 'Depósito') selected @endif>Depósito</option>
                </select>
              </div>
            </div><!-- col-4 -->

            <div class="col-md-2 mg-t--1 mg-md-t-0">
              <div class="form-group mg-md-l--1">
              <label class="form-control-label">Dia Faturamento: <span class="tx-danger">*</span></label>
              <input class="form-control" type="number" name="dia_faturamento" id="dia_faturamento" value="{{ $request->dia_faturamento ?? '' }}">
              </div>
            </div><!-- col-4 -->

            <div class="col-md-2 mg-t--1 mg-md-t-0">
              <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i> Pesquisar</button>
            </div>

          </div>

        </form>

        <div class="contratos-faturar" id="contratos-faturar">

            @if(isset($convenios))
            <h4 class="tx-gray-800 mg-b-5 mg-t-20">Convênios Ativos</h4>
            <p class="mg-b-20">Foram listados {{ $convenios->count() }} convênios ativos para faturamento</p>


            <div class="bd bd-gray-300 rounded table-responsive">

              <table class="table table-hover mg-b-0">

                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tipo de Faturamento</th>
                    <th class="text-center">Dia de Faturamento</th>
                    <th>Nome da Empresa</th>
                    <th>Total de Contratos</th>
                    <th>Ações</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach ($convenios as $convenio)
                  <tr>
                    <td>{{ $convenio->id }}</td>
                    <td>{{ $convenio->tipo_convenio }}</td>
                    <td class="text-center">{{ $convenio->dia_faturamento ?? '' }}</td>
                    <td>ID: {{ $convenio->empresa->id }} - {{ $convenio->empresa->nome_fantasia }}<br/>{{ $convenio->empresa->endereco->cidade->nome_cidade }} ({{ $convenio->empresa->endereco->cidade->estado->uf_estado }})</td>
                    <td class="ver-contratos"><span class="qtd">{{ $convenio->contratos->count() ?? '' }}</span></td>
                    <td>
                        @if(Helper::getFaturamentoConvenio($convenio->id, $request->data_inicial ?? $data_inicial, $request->data_final ?? $data_final)->count() > 0)
                            <a href="#" class="btn btn-success"><i class="fa fa-dollar" aria-hidden="true"></i> Período Faturado</a>
                        @else
                            <a href="#" class="btn btn-info faturarConvenio" data-id="{{ $convenio->id }}" data-token="{{ csrf_token() }}" data-inicial="{{ $request->data_inicial ?? $data_inicial }}" data-final="{{ $request->data_final ?? $data_final }}" data-formapagamento="{{ $request->forma_pagamento ?? 'Boleto' }}"><i class="fa fa-check" aria-hidden="true"></i> Faturar Período</a>
                        @endif
                    </td>
                  </tr>
                  @endforeach

                </tbody>

              </table>

              {{ $convenios->links() }}

            </div>

            @else

            <h4 class="tx-gray-800 mg-b-5 mg-t-20">Nenhum convênio encontrado</h4>
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
