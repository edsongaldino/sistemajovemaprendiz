@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Contrato</a>
        <span class="breadcrumb-item active">Consultar Atualizações</span>
      </nav>
    </div><!-- br-pageheader -->

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-bank"></i> Atualizações do contrato</h4>
      <p class="mg-b-0">Lista de contratos cadastrados no sistema</p>

      <a href="#" data-toggle="modal" data-target="#ModalBeneficio"><button class="btn btn-incluir beneficios"><i class="fa fa-star" aria-hidden="true"></i> Lançar Benefícios</button></a>
      <a href="#" data-toggle="modal" data-target="#ModalExame"><button class="btn btn-incluir exames"><i class="fa fa-user-md" aria-hidden="true"></i> Lançar Exames</button></a>
      <a href="#" data-toggle="modal" data-target="#ModalFaltas"><button class="btn btn-incluir faturamento"><i class="fa fa-plus"></i> Lançar Falta</button></a>
      <a href="#" data-toggle="modal" data-target="#ModalUniforme"><button class="btn btn-incluir faturados"><i class="fa fa-check"></i> Lançar Uniforme</button></a>
      <a href="#" data-toggle="modal" data-target="#ModalSituacao"><button class="btn btn-incluir situacao"><i class="fa fa-edit"></i> Atualizar Situação</button></a>

    </div>

    <div class="br-pagebody">

      <div class="br-section-wrapper">


        <div class="form-busca">

            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                <label class="form-control-label">Convênio: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="numero_contrato" value="{{ $contrato->convenio->numero ?? '' }}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-5">
                <div class="form-group">
                <label class="form-control-label">Razão Social (Empresa): <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="razao_social" value="{{ $contrato->empresa->razao_social ?? '' }}" disabled>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-5 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Nome do Jovem: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome_jovem" id="nome_jovem" value="{{ $contrato->aluno->nome ?? '' }}" disabled>
                </div>
              </div><!-- col-4 -->

            </div>

        </div>

        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Foram listados {{ $atualizacoes->count() }} atualizações neste contrato</h6>

        <div class="bd bd-gray-300 rounded table-responsive">
          <table class="table table-hover mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tipo da Atualização</th>
                <th>Data</th>
                <th>Usuário Responsável</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($atualizacoes as $atualizacao)
              <tr>
                <th scope="row">{{ $atualizacao->id }}</th>
                <td>{{ $atualizacao->tipo }}</td>
                <td>{{ Helper::data_br($atualizacao->data) }}</td>
                <td>{{ $atualizacao->user->nome }}</td>
                @if($atualizacao->tipo == 'Entrega de Uniforme')
                <td class="text-center">Quantidade <br/><b>{{ $atualizacao->quantidade }}</b></td>
                <td class="text-center">Tamanho <br/><b>{{ $atualizacao->tamanho }}</b></td>
                <td class="text-center">Valor <br/>R$ <b>{{ Helper::converte_valor_real($atualizacao->valor) }}</b></td>
                @elseif($atualizacao->tipo == 'Exame Admissional' || $atualizacao->tipo == 'Exame Demissional' || $atualizacao->tipo == 'Exame Periodico')
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center">Valor <br/><b>{{ $atualizacao->valor }}</b></td>
                @elseif($atualizacao->tipo == 'Atualização Contratual')
                <td class="text-center">Tipo <br/><b>{{ $atualizacao->tipo }}</b></td>
                <td class="text-center" colspan="2">Motivo <br/><b>{{ $atualizacao->motivo_desligamento }}</b></td>
                @elseif($atualizacao->tipo == 'Benefícios')
                <td class="text-center">Tipo <br/><b>{{ $atualizacao->tipo_beneficio }}</b></td>
                <td class="text-center" colspan="2">Valor <br/>R$ <b>{{ Helper::converte_valor_real($atualizacao->valor) }}</b></td>
                @elseif($atualizacao->tipo == 'Férias')
                <td class="text-center">Quantidade de Dias <br/><b>{{ $atualizacao->quantidade }}</b></td>
                <td class="text-center" colspan="2">Período de Férias<br/> <b>{{ Helper::data_br($atualizacao->data_inicial) }} à {{ Helper::data_br($atualizacao->data_final) }}</b></td>
                @else
                <td class="text-center"></td>
                <td class="text-center">Falta Justificada? <br/><b>{{ $atualizacao->falta_justificada }}</b></td>
                <td class="text-center"></td>
                @endif

                <td>
                  <a href="#" class="excluirAtualizacao" data-id="{{ $atualizacao->id }}" data-token="{{ csrf_token() }}"><div class="btn btn-danger"><i class="icon ion-close"></i></div></a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>

          {{ $atualizacoes->links() }}

        </div>
        </div>
    </div>

    <div class="modal" id="ModalFaltas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Lançar Falta (Trabalho)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="{{ route('sistema.contrato.gravarAtualizacao') }}" method="POST" name="AtualizacaoContrato" id="AtualizacaoContrato">
            @csrf
            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
            <input type="hidden" name="tipo" value="Falta Trabalho">
            <div class="modal-body form-faturar">
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-control-label">Data: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="date" name="data" id="data" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->
                <div class="col-md-5">
                  <div class="form-group">
                  <label class="form-control-label">Falta Justificada? <span class="tx-danger">*</span></label>
                  <select class="form-control" id="falta_justificada" name="falta_justificada" data-placeholder="Selecione" required>
                    <option label="Selecione"></option>
                    <option value="Não">Não</option>
                    <option value="Sim">Sim</option>
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

    <div class="modal" id="ModalUniforme" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Lançar Retirada (Uniforme)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="{{ route('sistema.contrato.gravarAtualizacao') }}" method="POST" name="AtualizacaoContrato" id="AtualizacaoContrato">
            @csrf
            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
            <input type="hidden" name="tipo" value="Entrega de Uniforme">
            <div class="modal-body form-faturar">
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-control-label">Data: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="date" name="data" id="data" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="form-control-label">Quantidade: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="number" name="quantidade" id="quantidade" value="" placeholder="" required>
                  </div>
                </div><!-- col-4 -->
                <div class="col-md-5">
                  <div class="form-group">
                  <label class="form-control-label">Tamanho: <span class="tx-danger">*</span></label>
                  <select class="form-control" id="tamanho" name="tamanho" data-placeholder="Selecione" required>
                    <option label="Selecione"></option>
                    <option value="PP">PP</option>
                    <option value="P">P</option>
                    <option value="M">M</option>
                    <option value="G">G</option>
                    <option value="GG">GG</option>
                    <option value="XGG">XGG</option>
                    <option value="XXGG">XXGG</option>
                  </select>
                  </div>
              </div><!-- col-4 -->
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Valor (R$): <span class="tx-danger">*</span></label>
                  <input class="form-control moeda" type="text" name="valor" id="valor" value="" placeholder="R$" required>
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

    <div class="modal" id="ModalExame" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Lançar Exames</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="{{ route('sistema.contrato.gravarAtualizacao') }}" method="POST" name="AtualizacaoContrato" id="AtualizacaoContrato">
            @csrf
            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
            <input type="hidden" name="tipo" value="Entrega de Uniforme">
            <div class="modal-body form-faturar">
              <div class="row">

                <div class="col-md-5">
                    <div class="form-group">
                    <label class="form-control-label">Tipo: <span class="tx-danger">*</span></label>
                    <select class="form-control" id="tipo" name="tipo" data-placeholder="Selecione" required>
                        <option label="Selecione"></option>
                        <option value="Exame Admissional">Exame Admissional</option>
                        <option value="Exame Demissional">Exame Demissional</option>
                        <option value="Exame Periodico">Exame Periódico</option>
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
                    <label class="form-control-label">Valor (R$): <span class="tx-danger">*</span></label>
                    <input class="form-control moeda" type="text" name="valor" id="valor" value="" placeholder="R$" required>
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


    <div class="modal" id="ModalSituacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Atualizar Situação Contratual</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{ route('sistema.contrato.gravarAtualizacao') }}" method="POST" name="AtualizacaoContrato" id="AtualizacaoContrato">
              @csrf
              <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
              <input type="hidden" name="tipo" value="Atualização Contratual">
              <div class="modal-body form-faturar">
                <div class="row">

                  <div class="col-md-5">
                      <div class="form-group">
                      <label class="form-control-label">Situação (Contrato/Jovem): <span class="tx-danger">*</span></label>
                      <select class="form-control" id="AtualizarSituacao" name="situacao_contrato" data-placeholder="Selecione" required>
                          <option label="Selecione"></option>
                          <option value="Ativo">Ativo</option>
                          <option value="Desligado">Desligado</option>
                          <option value="Término de Contrato">Término de Contrato</option>
                      </select>
                      </div>
                  </div><!-- col-4 -->

                  <div class="col-md-4">
                      <div class="form-group">
                      <label class="form-control-label">Data: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="date" name="data" id="data" value="" placeholder="" required>
                      </div>
                  </div><!-- col-4 -->

                  <div class="col-md-9" id="motivoDesligamento">
                      <div class="form-group">
                      <label class="form-control-label">Motivo: <span class="tx-danger">*</span></label>
                      <textarea class="form-control" name="motivo_desligamento" id="motivo_desligamento" cols="30" rows="4"></textarea>
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

      <div class="modal" id="ModalBeneficio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Lançar Benefício</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="{{ route('sistema.contrato.gravarAtualizacao') }}" method="POST" name="FormBeneficios" id="FormBeneficios">
              @csrf
              <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">
              <input type="hidden" name="tipo" value="Benefícios">
              <div class="modal-body form-faturar">
                <div class="row">

                  <div class="col-md-5">
                    <div class="form-group">
                    <label class="form-control-label">Tipo Benefício: <span class="tx-danger">*</span></label>
                    <select class="form-control" id="tipo_beneficio" name="tipo_beneficio" data-placeholder="Selecione" required>
                      <option label="Selecione"></option>
                      <option value="Vale Alimentação">Vale Alimentação</option>
                      <option value="Vale Transporte">Vale Transporte</option>
                      <option value="Plano de Saúde">Plano de Saúde</option>
                      <option value="Férias">Férias</option>
                    </select>
                    </div>
                  </div><!-- col-4 -->

                  <div class="col-md-4 OutrosBeneficios">
                      <div class="form-group">
                      <label class="form-control-label">Data: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="date" name="data" id="dataBeneficio" value="" placeholder="">
                      </div>
                  </div><!-- col-4 -->
                  
                  <div class="col-md-4 OutrosBeneficios">
                    <div class="form-group">
                      <label class="form-control-label">Valor (R$): <span class="tx-danger">*</span></label>
                      <input class="form-control moeda" type="text" name="valor" id="valorBeneficio" value="" placeholder="R$">
                    </div>
                  </div><!-- col-4 -->

                  <div class="col-md-4 Ferias" style="display: none;">
                    <div class="form-group">
                      <label class="form-control-label">Qtde de Dias: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="quantidade" id="qtdeFerias" value="" placeholder="">
                    </div>
                  </div><!-- col-4 -->

                  <div class="col-md-5 Ferias" style="display: none;">
                    <div class="form-group">
                    <label class="form-control-label">Data Inicial: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="date" name="data_inicial" id="data_inicial" value="" placeholder="">
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-md-4 Ferias" style="display: none;">
                    <div class="form-group">
                    <label class="form-control-label">Data Final: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="date" name="data_final" id="data_final" value="" placeholder="">
                    </div>
                  </div><!-- col-4 -->

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="EnviarFormBeneficios();" class="btn btn-primary">Gravar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <script src="{{ asset('assets/sistema/js/contratos/index.js?v=1.2') }}"></script>


@endsection
