<div class="row no-gutters">

    @if(isset($empresa))
    <input type="hidden" name="empresa_id" id="empresa_id" value="{{ $empresa->id ?? '' }}">
    <input type="hidden" name="aluno_id" id="aluno_id" value="{{ $aluno->id ?? '' }}">
    <input type="hidden" name="convenio_id" id="convenio_id" value="{{ $empresa->convenios->first()->id ?? '' }}">
    @else
    <input type="hidden" name="empresa_id" id="empresa_id" value="{{ $contrato->empresa->id ?? '' }}">
    <input type="hidden" name="aluno_id" id="aluno_id" value="{{ $contrato->aluno->id ?? '' }}">
    <input type="hidden" name="convenio_id" id="convenio_id" value="{{ $contrato->convenio_id ?? '' }}">
    @endif

    <input type="hidden" name="alunoReposicao_id" id="alunoReposicao_id" value="{{ $contrato->reposicao->id ?? '' }}">

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Tipo do contrato (Faturamento): <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo_faturamento" name="tipo_faturamento" data-placeholder="Selecione o tipo" required>
            <option label="Selecione o tipo do contrato"></option>
            <option value="Empresa" @if(($contrato->tipo_faturamento ?? '') == 'Empresa') selected @endif>Empresa</option>
            <option value="Instituição" @if(($contrato->tipo_faturamento ?? '') == 'Instituição') selected @endif>Instituição</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">Selecione o pólo responsável por esse contrato: <span class="tx-danger">*</span></label>
        <select class="form-control" id="polo_id" name="polo_id" data-placeholder="Selecione o pólo responsável" required>
            <option label="Selecione o pólo responsável"></option>
            @foreach ($polos as $polo)
            <option value="{{ $polo->id }}" @if(($polo->id ?? '') == ($contrato->polo_id ?? '')) selected @endif>{{ $polo->nome }}</option>
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->

    @if(isset($empresa))

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Tipo do cadastro (Empresa): <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo_cadastro" name="tipo_cadastro" data-placeholder="Selecione o tipo" required>
            <option label="Selecione o tipo do contrato"></option>
            <option value="CNPJ" @if(($empresa->tipo_cadastro ?? '') == 'CNPJ') selected @endif>CNPJ</option>
            <option value="CEI" @if(($empresa->tipo_cadastro ?? '') == 'CEI') selected @endif>CEI</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3 CnpjE" @if(($contrato->empresa->tipo_cadastro ?? '') == 'CNPJ') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">CNPJ (Empresa): <span class="tx-danger">*</span></label>
        <input class="form-control cnpj" type="text" name="cnpj" id="cnpjBusca" value="{{ $empresa->cnpj ?? '' }}" placeholder="CNPJ da Empresa">
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2 CeiE" @if(($empresa->tipo_cadastro ?? '') == 'CEI') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">CEI (Empresa): <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="cei" id="ceiBusca" value="{{ $empresa->cei ?? '' }}" placeholder="CEI da Empresa">
        </div>
    </div><!-- col-4 -->

    <div class="col-md-5 CeiE" @if(($empresa->tipo_cadastro ?? '') == 'CEI') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">Nome Fantasia (Empresa CEI/CPF): <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="nome_fantasia_CEI" name="nome_fantasia_CEI" value="{{ $empresa->nome_fantasia ?? '' }}" placeholder="Nome Fantasia" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-5 CnpjE" @if(($empresa->tipo_cadastro ?? '') == 'CNPJ') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">Razão Social: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="razao_social" id="razao_social" value="{{ $empresa->razao_social ?? '' }}" placeholder="Razão Social da Empresa" readonly>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
        <label class="form-control-label">Número do convênio: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="convenio" id="numero_convenio" value="{{ $empresa->convenios->first()->numero ?? '' }}" placeholder="Convênio" required readonly>
        </div>
    </div><!-- col-4 -->

    @else

    <div class="col-md-2">
        <div class="form-group">
        <label class="form-control-label">Tipo do cadastro (Empresa): <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo_cadastro" name="tipo_cadastro" data-placeholder="Selecione o tipo" required>
            <option label="Selecione o tipo do cadastro"></option>
            <option value="CNPJ" @if(($contrato->empresa->tipo_cadastro ?? '') == 'CNPJ') selected @endif>CNPJ</option>
            <option value="CEI" @if(($contrato->empresa->tipo_cadastro ?? '') == 'CEI') selected @endif>CEI</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3 CnpjE">
        <div class="form-group">
        <label class="form-control-label">CNPJ (Empresa): <span class="tx-danger">*</span></label>
        <input class="form-control cnpj" type="text" name="cnpj" id="cnpjBusca" value="{{ $contrato->empresa->cnpj ?? '' }}" placeholder="CNPJ da Empresa" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3 CeiE" @if(($contrato->empresa->tipo_cadastro ?? '') == 'CEI') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">CEI (Empresa): <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="cei" id="ceiBusca" value="{{ $contrato->empresa->cei ?? '' }}" placeholder="CEI da Empresa">
        </div>
    </div><!-- col-4 -->

    <div class="col-md-5 CeiE" @if(($contrato->empresa->tipo_cadastro ?? '') == 'CEI') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">Nome Fantasia (Empresa CEI/CPF): <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="nome_fantasia_CEI" name="nome_fantasia_CEI" value="{{ $contrato->empresa->nome_fantasia ?? '' }}" placeholder="Nome Fantasia" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-5 CnpjE">
        <div class="form-group">
        <label class="form-control-label">Razão Social: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="razao_social" id="razao_social" value="{{ $contrato->empresa->razao_social ?? '' }}" placeholder="Razão Social da Empresa" readonly>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
        <label class="form-control-label">Número do convênio: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="convenio" id="numero_convenio" value="{{ $contrato->convenio->numero ?? '' }}" placeholder="Convênio" required readonly>
        </div>
    </div><!-- col-4 -->
    @endif

    <div class="col-md-12">
        <div class="form-group" id="responsaveis_jovem">
        <label class="form-control-label">Responsável pelo jovem na empresa <span class="tx-danger">*</span></label>
        <select class="form-control" id="empresa_contato_id" name="empresa_contato_id" data-placeholder="Selecione">
            @if(isset($contrato))
                @foreach ($contrato->empresa->contatos as $contato)
                <option value="{{ $contato->id }}" @if(($contato->id ?? '') == ($contrato->empresa_contato_id ?? '')) selected @endif>{{ $contato->nome }} - ({{ $contato->departamento ?? '' }})</option>
                @endforeach
            @elseif(isset($empresa))
                <option value="">Selecione o responsável</option>
                @foreach ($empresa->contatos as $contato)
                <option value="{{ $contato->id }}">{{ $contato->nome }} - ({{ $contato->departamento ?? '' }})</option>
                @endforeach
            @endif
        </select>
        </div>
    </div><!-- col-4 -->

    @if(isset($aluno))
    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">CPF (Aluno): <span class="tx-danger">*</span></label>
        <input class="form-control cpf" type="text" name="cpf" id="cpfBusca" value="{{ $aluno->cpf ?? '' }}" placeholder="CPF do Aluno" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">NOME DO ALUNO (Primeiro Digite o CPF): <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="nome_aluno" id="nome_aluno" value="{{ $aluno->nome ?? '' }}" placeholder="Nome do Aluno" readonly>
        </div>
    </div><!-- col-4 -->
    @else
    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">CPF (Aluno): <span class="tx-danger">*</span></label>
        <input class="form-control cpf" type="text" name="cpf" id="cpfBusca" value="{{ $contrato->aluno->cpf ?? '' }}" placeholder="CPF do Aluno" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">NOME DO ALUNO (Primeiro Digite o CPF): <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="nome_aluno" id="nome_aluno" value="{{ $contrato->aluno->nome ?? '' }}" placeholder="Nome do Aluno" readonly>
        </div>
    </div><!-- col-4 -->
    @endif

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Data Inicial: <span class="tx-danger">*</span></label>
        <input class="form-control data" type="text" name="data_inicial" value="{{ Helper::data_br($contrato->data_inicial ?? '') }}" placeholder="Data Inicial" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Data Final: <span class="tx-danger">*</span></label>
        <input class="form-control data" type="text" name="data_final" value="{{ Helper::data_br($contrato->data_final ?? '') }}" placeholder="Data Final" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Selecione o Status: <span class="tx-danger">*</span></label>
        <select class="form-control situacao-contrato" id="situacao" name="situacao" data-placeholder="Selecione a situação" disabled>
            <option value="Ativo" @if(($contrato->situacao ?? '') == 'Ativo') selected @endif>Ativo</option>
            <option value="Encerrado" @if(($contrato->situacao ?? '') == 'Encerrado') selected @endif>Encerrado</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Selecione a tabela utilizada neste contrato: <span class="tx-danger">*</span></label>
        <select class="form-control" id="tabela_id" name="tabela_id" data-placeholder="Selecione a tabela">
            <option label="Selecione a tabela"></option>
            @foreach ($tabelas as $tabela)
            <option value="{{ $tabela->id }}" @if(($tabela->id ?? '') == ($contrato->tabela_id ?? '')) selected @endif>{{ $tabela->nome }} (R$ {{ Helper::converte_valor_real(Helper::GetUltimaAtualizacaoValorTabela($tabela)) }})</option>
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Valor da Bolsa (Jovem): <span class="tx-danger">*</span></label>
        <input class="form-control moeda valor-bolsa" type="text" name="valor_bolsa" value="{{ Helper::converte_valor_real($contrato->valor_bolsa ?? '0.00') }}" placeholder="R$" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">Valor por Extenso (Bolsa Jovem Aprendiz): <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="valor_bolsa_extenso" value="{{ $contrato->valor_bolsa_extenso ?? '' }}" required>
        </div>
    </div><!-- col-4 -->


    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Selecione o tipo do contrato: <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo" name="tipo" data-placeholder="Selecione">
            <option label="Selecione o tipo"></option>
            <option value="Novo" @if(($contrato->tipo ?? '') == 'Novo') selected @endif>Novo</option>
            <option value="Reposição" @if(($contrato->tipo ?? '') == 'Reposição') selected @endif>Reposição</option>
        </select>
        </div>
    </div><!-- col-4 -->


    <div class="col-md-9" id="alunoReposicao">
        <div class="form-group alunoReposicao" @if(($contrato->tipo ?? '') == 'Reposição') style="display: block;" @else style="display: none;" @endif>
        <label class="form-control-label">Aluno (Reposição): <span class="tx-danger">*</span></label>
        @if(($contrato->tipo ?? '') == 'Reposição')
        <input class="form-control" type="hidden" id="aluno_reposto_id" name="aluno_reposto_id" value="{{ $contrato->reposicao->aluno->id ?? '' }}">
        <input class="form-control" type="text" id="aluno_reposto" name="aluno_reposto" value="{{ $contrato->reposicao->aluno->nome ?? '' }}" readonly>
        @endif
        </div>
    </div><!-- col-4 -->


    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Teve atuação comercial? <span class="tx-danger">*</span></label>
        <select class="form-control" id="atuacao_comercial" name="atuacao_comercial" data-placeholder="Selecione">
            <option label="Selecione"></option>
            <option value="Sim" @if(($contrato->atuacao_comercial ?? '') == 'Sim') selected @endif>Sim</option>
            <option value="Não" @if(($contrato->atuacao_comercial ?? '') == 'Não') selected @endif>Não</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-6">
        <div class="form-group responsavel_captacao" @if(($contrato->atuacao_comercial ?? '') == 'Sim') style="display: block;" @else style="display: none;" @endif>
        <label class="form-control-label">Selecione o reponsável pela captação: <span class="tx-danger">*</span></label>
        <select class="form-control" id="responsavel_captacao" name="responsavel_captacao" data-placeholder="Selecione">
            <option label="Selecione"></option>
            @foreach ($usuarios as $usuario)
            <option value="{{ $usuario->id }}" @if(($usuario->id ?? '') == ($contrato->comercial->user->id ?? '')) selected @endif>{{ $usuario->nome ?? '' }} - ({{ $usuario->perfil->nome ?? '' }})</option>
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group responsavel_captacao" @if(($contrato->atuacao_comercial ?? '') == 'Sim') style="display: block;" @else style="display: none;" @endif>
        <label class="form-control-label">Comissão:</label>
        <input class="form-control" type="text" name="comissao" id="comissao" value="{{ $contrato->comercial->comissao ?? '' }}" placeholder="Comissão por Captação (%)">
        </div>
    </div><!-- col-4 -->

    <div class="col-md-12">
        <div class="form-group">
        <label class="form-control-label">Programa de Aprendizagem <span class="tx-danger">*</span></label>
        <select class="form-control" id="curso_id" name="curso_id" data-placeholder="Selecione">
            <option label="Selecione"></option>
            @foreach ($cursos as $curso)
            <option value="{{ $curso->id }}" @if(($curso->id ?? '') == ($contrato->curso_id ?? '')) selected @endif>{{ $curso->nome }} - ({{ $curso->polo->nome }})</option>
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label">Dia da Semana - Teórico <span class="tx-danger">*</span></label>
            <select class="form-control" id="dia_semana_teorico" name="dia_semana_teorico" data-placeholder="Selecione">
                <option label="Selecione"></option>
                <option value="Segunda-feira" @if(($contrato->dia_semana_teorico ?? '') == 'Segunda-feira') selected @endif>Segunda-feira</option>
                <option value="Terça-feira" @if(($contrato->dia_semana_teorico ?? '') == 'Terça-feira') selected @endif>Terça-feira</option>
                <option value="Quarta-feira" @if(($contrato->dia_semana_teorico ?? '') == 'Quarta-feira') selected @endif>Quarta-feira</option>
                <option value="Quinta-feira" @if(($contrato->dia_semana_teorico ?? '') == 'Quinta-feira') selected @endif>Quinta-feira</option>
                <option value="Sexta-feira" @if(($contrato->dia_semana_teorico ?? '') == 'Sexta-feira') selected @endif>Sexta-feira</option>
            </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">Período (Turno) - Teórico <span class="tx-danger">*</span></label>
            <select class="form-control" id="periodo_teorico" name="periodo_teorico" data-placeholder="Selecione">
                <option label="Selecione"></option>
                <option value="Manhã" @if(($contrato->periodo_teorico ?? '') == 'Manhã') selected @endif>Manhã</option>
                <option value="Tarde" @if(($contrato->periodo_teorico ?? '') == 'Tarde') selected @endif>Tarde</option>
                <option value="Noite" @if(($contrato->periodo_teorico ?? '') == 'Noite') selected @endif>Noite</option>
            </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">Período (Horário) - Teórico <span class="tx-danger">*</span></label>
            De <input type="time" name="hora_inicial_teorico" class="form-control" value="{{ $contrato->hora_inicial_teorico ?? '' }}" placeholder="Set time"> à <input type="time" value="{{ $contrato->hora_final_teorico ?? '' }}" name="hora_final_teorico" class="form-control" placeholder="Set time">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">Período (Turno) - Prático <span class="tx-danger">*</span></label>
            <select class="form-control" id="periodo_pratico" name="periodo_pratico" data-placeholder="Selecione">
                <option label="Selecione"></option>
                <option value="Manhã" @if(($contrato->periodo_pratico ?? '') == 'Manhã') selected @endif>Manhã</option>
                <option value="Tarde" @if(($contrato->periodo_pratico ?? '') == 'Tarde') selected @endif>Tarde</option>
                <option value="Noite" @if(($contrato->periodo_pratico ?? '') == 'Noite') selected @endif>Noite</option>
            </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">Período (Horário) - Prático <span class="tx-danger">*</span></label>
            De <input type="time" name="hora_inicial_pratico" value="{{ $contrato->hora_inicial_pratico ?? '' }}" class="form-control" placeholder="Set time"> à <input type="time" name="hora_final_pratico" value="{{ $contrato->hora_final_pratico ?? '' }}" class="form-control" placeholder="Set time">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Data Alteração (Do Básico p/ Específico): <span class="tx-danger">*</span></label>
        <input class="form-control data data-alteracao" type="text" name="data_alteracao_curso" value="{{ Helper::data_br($contrato->data_alteracao_curso ?? '') }}" placeholder="Data" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
        <label class="form-control-label">Último dia faturado: </label>
        <input class="form-control data" type="text" name="data_ultimo_faturamento" value="{{ Helper::data_br($contrato->data_ultimo_faturamento ?? '') }}" placeholder="Data">
        </div>
    </div><!-- col-4 -->


</div><!-- row -->