@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Contratos</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> contratos</h4>
      <p class="mg-b-0">Lista de contratos cadastrados no sistema</p>

     <a href="{{ route('sistema.contrato.adicionar') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar contrato</button></a>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">


        <div class="form-busca">

          <form action="{{ route('sistema.contratos.buscar') }}" method="POST" name="BuscaContrato" id="BuscaContrato">

            @csrf
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                <label class="form-control-label">Nome Fantasia (Empresa): <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome_fantasia" value="" placeholder="Nome Fantasia (Empresa)">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CNPJ: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="cnpj" id="cnpj" value="">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                <label class="form-control-label">Nome do Jovem: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome_aluno" value="" placeholder="Nome do Jovem">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CPF (Jovem): <span class="tx-danger">*</span></label>
                <input class="form-control cpf" type="text" name="cpf" id="cpf" value="">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-6">
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

              <div class="col-md-3">
                <div class="form-group">
                <label class="form-control-label">Situação: <span class="tx-danger">*</span></label>
                <select class="form-control" name="situacao" data-placeholder="Selecione a situação">
                    <option label="Selecione a situação"></option>
                    <option value="Ativo">Ativo</option>
                    <option value="Encerrado">Encerrado</option>
                </select>
                </div>
            </div><!-- col-4 -->

              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i> Pesquisar</button>
              </div>

            </div>
          </form>

        </div>

        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $contratos->count() }} contratos</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Situação</th>
                <th>Nome da Empresa</th>
                <th>Aluno</th>
                <th>Pólo</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($contratos as $contrato)
              <tr>
                <th scope="row">{{ $contrato->id }}</th>
                <td><b>{{ $contrato->situacao }}</b></td>
                <td>{{ $contrato->empresa->nome_fantasia ?? '' }}</td>
                <td>{{ $contrato->aluno->nome ?? '' }}</td>
                <td>{{ $contrato->polo->nome ?? '' }}</td>
                <td>
                  <a href="{{ url('sistema/contrato/'.$contrato->id.'/atualizacoes') }}" target="_blank"><div class="btn btn-info" title="Atualizações de Contrato"><i class="fa fa-check" aria-hidden="true"></i> Atualizações</div></a>
                  <a href="{{ url('sistema/contrato/'.$contrato->id.'/imprimir') }}" target="_blank"><div class="btn btn-warning" title="Imprimir Contrato"><i class="fa fa-print" aria-hidden="true"></i></div></a>
                  <a href="{{ url('sistema/calendario/aluno/'.$contrato->aluno_id.'/contrato/'.$contrato->id.'') }}" target="_blank"><div class="btn btn-success" title="Visualizar Calendário"><i class="fa fa-calendar" aria-hidden="true"></i></div></a>
                  <a href="{{ url('sistema/contrato/'.$contrato->id.'/editar') }}"><div class="btn btn-info"><i class="icon ion-edit"></i></div></a>
                  <a href="#" class="excluirContrato" data-id="{{ $contrato->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>

          {{ $contratos->links() }}

        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/contratos/index.js?v=1') }}"></script>


@endsection
