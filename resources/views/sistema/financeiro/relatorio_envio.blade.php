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
      <p class="mg-b-0">Lista de notificações enviadas ao cliente</p>
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
              <a onclick="history.go(-1);" class="btn btn-busca"><i class="fa fa-arrow-circle-o-left"></i> Voltar</a>
            </div>

          </div>

        </form>

        <div class="contratos-faturar" id="contratos-faturar">

            
            <h4 class="tx-gray-800 mg-b-5 mg-t-20">Notificações enviadas ao cliente</h4>
            <p class="mg-b-20">Foram enviadas {{ $faturamento->envios->count() }} notificações ao cliente</p>


            <div class="bd bd-gray-300 rounded table-responsive">

              <table class="table table-hover mg-b-0">

                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tipo do Envio</th>
                    <th>Data e Hora do Envio</th>
                    <th>E-mail</th>
                    <th>Visualização</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach ($faturamento->envios as $envio)
                  <tr>
                    <td>{{ $envio->id }}</td>
                    <td>{{ $envio->tipo_notificacao ?? '' }}</td>
                    <td>{{ Helper::datahora_br($envio->created_at ?? '') }}</td>
                    <td>{{ $envio->email ?? '' }}</td>
                    <td>{{ $envio->data_visualizacao }}</td>
                  </tr>
                  @endforeach

                </tbody>

              </table>
            </div>
        </div>

      </div>

    </div><!-- br-pagebody -->

    <script src="{{ asset('assets/sistema/js/financeiro/index.js?v=1') }}"></script>

@endsection
