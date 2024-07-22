@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Candidatos</a>
        <span class="breadcrumb-item active">Consultar</span>
      </nav>
    </div><!-- br-pageheader -->

    @if($processo == 'Consulta')

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-user"></i> Candidatos</h4>
      <p class="mg-b-0">Lista de candidatos cadastrados no sistema</p>
    </div>
    @elseif($processo == 'Seleção')
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-bank"></i> Empresa: {{ $vaga->empresa->nome_fantasia }}</h6>
      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-briefcase"></i> Vaga: {{ $vaga->tipo_vaga }}</h6>
      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-calendar"></i> Data de Início: {{ Helper::data_br($vaga->data_inicial) }}</h6>

      <a href="{{ url('sistema/vaga/'.$vaga->id.'/processo-seletivo') }}"><button class="btn btn-incluir"><i class="fa fa-plus"></i> Visualizar candidados selecionados</button></a>
    </div>
    @endif

    <div class="br-pagebody">
      <div class="br-section-wrapper">

        <div class="form-busca">

          <form action="{{ route('sistema.candidatos.buscar') }}" method="POST" name="BuscaCandidato" id="BuscaCandidato">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome" value="" placeholder="Nome do aluno">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-2">
                  <div class="form-group">
                  <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
                  <select class="form-control" name="sexo" data-placeholder="Selecione o sexo">
                      <option label="Selecione o sexo"></option>
                      <option value="">Ambos</option>
                      <option value="Feminino">Feminino</option>
                      <option value="Masculino">Masculino</option>
                  </select>
                  </div>
              </div><!-- col-4 -->
              <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CPF: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="cpf" id="cpf" value="">
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

              <div class="col-md-2">
                  <div class="form-group">
                  <label class="form-control-label">Turno (Estudo): <span class="tx-danger">*</span></label>
                  <select class="form-control" name="turno" data-placeholder="Selecione o turno que estuda">
                      <option label="Selecione o turno"></option>
                      <option value="">Ambos</option>
                      <option value="Matutino">Matutino</option>
                      <option value="Verpertino">Verpertino</option>
                      <option value="Noturno">Noturno</option>
                  </select>
                  </div>
              </div><!-- col-4 -->

              <div class="col-md-1">
                <div class="form-group">
                <label class="form-control-label">Idade: <span class="tx-danger">*</span></label>
                <input class="form-control" type="number" name="idade" value="" placeholder="Idade">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-2">
                <div class="form-group">
                <label class="form-control-label">Estado (UF): <span class="tx-danger">*</span></label>
                <select class="form-control" id="estado_endereco" name="estado_endereco" data-placeholder="Selecione o estado">
                    <option label="Selecione o estado"></option>
                    @foreach ($estados as $estado)
                    <option value="{{ $estado->id }}">{{ $estado->nome_estado }}</option>
                    @endforeach
                </select>
                </div>
              </div><!-- col-4 -->

              <div class="col-md-3">
                <div class="form-group" id="cidade_endereco">
                <label class="form-control-label">Cidade: <span class="tx-danger">*</span></label>
                </div>
              </div><!-- col-4 -->

              <div class="col-md-3">
                  <div class="form-group" id="bairro_busca">
                  <label class="form-control-label">Bairro: <span class="tx-danger">*</span></label>
                  </div>
              </div><!-- col-4 -->

              <input type="hidden" name="processo" id="processo" value="{{ $processo ?? '' }}">
              <input type="hidden" name="vaga" id="vaga" value="{{ $vaga->id ?? '' }}">

              <div class="col-md-3 mg-t--1 mg-md-t-0">
                <button type="submit" class="btn btn-busca"><i class="fa fa-search"></i><br/> Pesquisar</button>
              </div>

            </div>
          </form>

        </div>

        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $alunos->count() }} candidatos</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome do Candidato</th>
                <th>Sexo</th>
                <th>Idade</th>
                <th>Turno (Estudo)</th>
                <th>Cidade</th>
                <th>Pólo</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($alunos as $aluno)
              <tr>
                <th scope="row">{{ $aluno->id }}</th>
                <td>{{ $aluno->nome ?? '' }}<br/><span class="data-cadastro">Data de Cadastro: <strong>{{ Helper::datetime_br($aluno->created_at) }}</strong></span></td>
                <td>{{ $aluno->sexo ?? '' }}</td>
                <td>{{ Helper::calcularIdade($aluno->data_nascimento) ?? '' }}</td>
                <td>{{ $aluno->turno ?? '' }}</td>
                <td>{{ $aluno->endereco->cidade->nome_cidade ?? '' }} - {{ $aluno->endereco->cidade->estado->uf_estado ?? '' }}</td>
                <td>{{ $aluno->polo->nome ?? '' }} - {{ $aluno->ProcessoSeletivo('Ativo')->count() }}</td>
                <td>

                  @if($processo == 'Consulta')

                    <a href="{{ url('sistema/candidato/'.$aluno->id.'/curriculo') }}" target="_blank"><div class="btn btn-info"><i class="icon ion-eye"></i> Visualizar Currículo</div></a>
                    <a href="{{ url('sistema/candidato/'.$aluno->id.'/processo-seletivo') }}"><div class="btn btn-warning"><i class="icon ion-briefcase"></i> Processos Seletivos</div></a>
                    <a href="{{ url('sistema/candidato/'.$aluno->id.'/editar') }}"><div class="btn btn-success"><i class="icon ion-edit"></i></div></a>

                  @elseif($processo == 'Seleção')
                    @if($aluno->ProcessoSeletivo('Ativo')->count() > 0)
                    <a href="#" class="CandidatoBloqueado" title="Este candidato ja está em um processo seletivo"><div class="btn btn-success"><i class="fa fa-clock-o"></i> Em 1+ Processo</div> </a>
                    @else
                    <a href="#" class="IncluirCandidatoVaga" title="Adicionar candidato ao processo seletivo" data-vaga="{{ $vaga->id }}" data-id="{{ $aluno->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-info"><i class="fa fa-plus"></i> Adicionar à vaga</div></a>
                    @endif
                  @endif

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $alunos->appends($search ?? '')->links() }}
        </div>
        </div>
    </div>
    <script src="{{ asset('assets/sistema/js/vagas/index.js') }}"></script>

@endsection
