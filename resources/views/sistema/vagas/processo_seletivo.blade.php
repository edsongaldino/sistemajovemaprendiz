@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Processo Seletivo</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-bank"></i> Empresa: {{ $vaga->empresa->nome_fantasia }}</h6>
      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-briefcase"></i> Vaga: {{ $vaga->tipo_vaga }}</h6>
      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-calendar"></i> Data de Início: {{ Helper::data_br($vaga->data_inicial) }}</h6>

      <a href="{{ url('sistema/vaga/'.$vaga->id.'/selecionar-candidatos') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Adicionar Candidato</button></a>


    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Candidato (Jovem Aprendiz)</th>
                <th>Empresa</th>
                <th>Situação</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($processo_seletivo as $processo)
              <tr>
                <th scope="row">{{ $processo->id }}</th>
                <td>{{ $processo->aluno->nome }}</td>
                <td>{{ $processo->vaga->empresa->nome_fantasia }}</td>
                <td>{{ $processo->situacao }}</td>
                <td>
                  @if($processo->situacao == 'Aceito')
                  <a href="{{ url('sistema/vaga/processo-seletivo/'.$processo->id.'/gerar-contrato') }}" target="_blank"><div class="btn btn-success"><i class="icon ion-check"></i> Gerar Contrato</div></a>
                  @else
                  <a href="#" class="excluirCandidato" data-id="{{ $processo->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $processo_seletivo->links() }}

        </div>

        </div>
        <input type="hidden" class="linkProcessoSeletivo" name="linkProcessoSeletivo" id="linkProcessoSeletivo" value="https://sistema.larjovemaprendiz.ong.br/sistema/vaga/{{ $vaga->id }}/consulta-processo">
        <button class="btn btn-incluir btn-copiar-link" id="copiarLink"><i class="fa fa-link"></i> Copiar Link do Processo</button>
        <button class="btn btn-incluir btn-enviar-candidatos" data-toggle="modal" data-target="#ModalEnviar"><i class="fa fa-envelope"></i> Enviar Candidatos para Empresa</button>

    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">
        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Logs de envio</h6>
        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Data</th>
                <th>Tipo</th>
                <th>Destinatário</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($logs as $log)
              <tr>
                <th scope="row">{{ $log->id }}</th>
                <td>{{ $log->user->nome }}</td>
                <td>{{ $log->created_at }}</td>
                <td>{{ $log->tipo }}</td>
                <td>{{ $log->script }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ModalEnviar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <form action="{{ route('sistema.processo.enviar') }}" method="POST">
              @csrf
              <input type="hidden" name="vaga_id" id="vaga_id" value="{{ $vaga->id }}">
              <div class="modal-content modal-comentarios">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="pergunta">Tem certeza que deseja enviar?</div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i> Não, Cancelar</button>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Sim</button>
                  </div>
              </div>
          </form>
      </div>
    </div>

  <script src="{{ asset('assets/sistema/js/vagas/index.js') }}"></script>

@endsection
