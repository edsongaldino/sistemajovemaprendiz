@include('sistema.includes.header')

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
    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-bank"></i> Situação do Processo: {{ $vaga->situacao }}</h6>
</div>

<div class="br-pagebody">
    <div class="br-section-wrapper">

    <div class="bd bd-gray-300 rounded table-responsive">
        <table class="table table-hover mg-b-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Candidato (Jovem Aprendiz)</th>
                <th>Data da Entrevista</th>
                <th>Situação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($processo_seletivo as $processo)
            <tr>
            <th scope="row">{{ $processo->id }}</th>
            <td>{{ $processo->aluno->nome }}</td>
            <td>{{ Helper::data_br($processo->data_entrevista ?? '') }}</td>
            <td>{{ $processo->situacao }}</td>
            <td>
                <a href="{{ url('sistema/candidato/'.$processo->aluno->id.'/curriculo') }}" target="_blank"><div class="btn btn-warning"><i class="icon ion-eye"></i> Currículo</div></a>
                @if($processo->situacao == 'Aceito')
                    @if($vaga->situacao == 'Processo Seletivo - Concluído')
                    <a href="#" class="ProcessoConcluido"><div class="btn btn-success"><i class="icon ion-close"></i> Desfazer Contratação</div></a>
                    @else
                    <a href="#" class="DesfazerAceite" data-id="{{ $processo->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-success"><i class="icon ion-close"></i> Desfazer Contratação</div></a>
                    @endif
                @else
                    @if($vaga->situacao == 'Processo Seletivo - Concluído')
                    <a class="ProcessoConcluido"><div class="btn btn-info"><i class="icon ion-edit"></i> Atualizar Situação</div></a>
                    @else
                    <a href="#" data-toggle="modal" data-target="#ModalAtualizarSituacao" onclick="setaDadosModal('{{ $processo->id }}/{{ $processo->aluno->nome }}')"><div class="btn btn-info"><i class="icon ion-edit"></i> Atualizar Situação</div></a>
                    @endif
                @endif
            </td>
            </tr>
            @endforeach
        </tbody>
        </table>
        
    </div>
    
    </div>
    @if($vaga->situacao == 'Processo Seletivo - Concluído')
    <button class="btn btn-incluir btn-enviar-candidatos ProcessoConcluido"><i class="fa fa-check"></i> Finalizar Processo Seletivo</button>
    @else
    <button class="btn btn-incluir btn-enviar-candidatos FinalizarProcessoSeletivo" data-vaga="{{ $vaga->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-check"></i> Finalizar Processo Seletivo</button>
    @endif

</div>

<div class="modal" id="ModalAtualizarSituacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Atualizar Processo Seletivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <form action="{{ route('sistema.processo-seletivo.gravar-atualizacao') }}" method="POST" name="AtualizacaoProcesso" id="AtualizacaoProcesso">
        @csrf
        <input type="hidden" name="id" id="processo_seletivo" value="">
        <div class="modal-body form-faturar">
            <div class="row">

            <div class="col-md-9">
                <div class="form-group">
                <label class="form-control-label">Candidato: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="candidato" id="NomeCandidato" value="" disabled>
                </div>
            </div><!-- col-4 -->

            <div class="col-md-5">
                <div class="form-group">
                <label class="form-control-label">Compareceu na entrevista? <span class="tx-danger">*</span></label>
                <select class="form-control" id="entrevista" name="entrevista" data-placeholder="Selecione" required>
                    <option label="Selecione"></option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>
                </div>
            </div><!-- col-4 -->

            <div class="col-md-4">
                <div class="form-group">
                <label class="form-control-label">Data: <span class="tx-danger">*</span></label>
                <input class="form-control" type="date" name="data" id="data" value="" placeholder="" required>
                </div>
            </div><!-- col-4 -->

            <div class="col-md-4">
                <div class="form-group">
                <label class="form-control-label">Resultado: <span class="tx-danger">*</span></label>
                <select class="form-control" id="resultado" name="resultado" data-placeholder="Selecione" required>
                    <option label="Selecione"></option>
                    <option value="Aceito">Aceito</option>
                    <option value="Dispensado">Dispensado</option>
                </select>
                </div>
            </div><!-- col-4 -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Gravar</button>
        </div>
        </form>
    </div>
    </div>
</div>

<script src="{{ asset('assets/sistema/js/vagas/index.js') }}"></script>

@include('sistema.includes.footer')