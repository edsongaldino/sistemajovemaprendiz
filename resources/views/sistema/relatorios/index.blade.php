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
      <div class="br-section-wrapper">

        <div class="form-busca">

          <form action="{{ route('sistema.relatorios.buscar') }}" method="POST" name="BuscaConvenio" id="BuscaConvenio">

            @csrf
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                <label class="form-control-label">Nome Fantasia (Empresa): <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome_fantasia" value="" placeholder="Nome Fantasia (Empresa)">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CNPJ: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="cnpj" id="cnpj" value="">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-2">
                  <div class="form-group">
                  <label class="form-control-label">Pólo: <span class="tx-danger">*</span></label>
                  <select class="form-control" name="polo" data-placeholder="Selecione o Pólo">
                      <option label="Selecione o pólo"></option>
                      @foreach ($polos as $polo)
                      <option value="{{ $polo->id }}">{{ $polo->nome }}</option>
                      @endforeach
                  </select>
                  </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Dia Faturamento: <span class="tx-danger">*</span></label>
                <input class="form-control" type="number" name="dia_faturamento" id="dia_faturamento" value="">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i><br/> Pesquisar</button>
              </div>

            </div>
          </form>

        </div>

        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $faturamentos->count() }} registros</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th>Data Emissão NF</th>
                <th>Número NF</th>
                <th>Valor NF</th>
                <th>Método Pagamento</th>
                <th>Juros/Multa</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($faturamentos as $faturamento)
              <tr>
                <td>{{ $faturamento->convenio->empresa->razao_social ?? '' }}</td>
                <td>{{ $faturamento->convenio->empresa->cnpj ?? '' }}</td>
                <td>{{ $faturamento->notaFiscal->created_at ?? '' }}</td>
                <td>{{ $faturamento->notaFiscal->numero_nf ?? '' }}</td>
                <td>R$ {{ Helper::converte_valor_real(Helper::GetValorTotalFaturado($faturamento->id)) }}</td>
                <td>{{ $faturamento->forma_pagamento }}</td>
                <td></td>
                <td>
                  <a href="{{ url('sistema/convenio/'.$faturamento->id.'/imprimir') }}" target="_blank"><div class="btn btn-warning" title="Imprimir Contrato de Convênio"><i class="fa fa-print" aria-hidden="true"></i></div></a>
                  <a href="{{ url('sistema/convenio/'.$faturamento->id.'/contratos') }}" target="_blank"><div class="btn btn-success" title="Listas Contratos desse convênio"><i class="fa fa-user" aria-hidden="true"></i></div></a>
                  <a href="{{ url('sistema/convenio/'.$faturamento->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirConvenio" data-id="{{ $faturamento->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>

          {{ $faturamentos->links() }}

        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/convenios/index.js') }}"></script>


@endsection
