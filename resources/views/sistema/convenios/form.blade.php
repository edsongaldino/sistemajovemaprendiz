<div class="row no-gutters">
    <input type="hidden" name="empresa_id" id="empresa_id" value="{{ $convenio->empresa->id ?? '' }}">

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Tipo do cadastro (Empresa): <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo_cadastro" name="tipo_cadastro" data-placeholder="Selecione o tipo" required>
            <option label="Selecione o tipo do cadastro"></option>
            <option value="CNPJ" @if(($convenio->empresa->tipo_cadastro ?? '') == 'CNPJ') selected @endif>CNPJ</option>
            <option value="CPF" @if(($convenio->empresa->tipo_cadastro ?? '') == 'CPF') selected @endif>CPF</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4 CnpjE" @if(($convenio->empresa->tipo_cadastro ?? '') == 'CPF') style="display: none;" @else style="display: block;" @endif>
        <div class="form-group">
        <label class="form-control-label">CNPJ (Empresa): <span class="tx-danger">*</span></label>
        <input class="form-control cnpj" type="text" name="cnpj" id="cnpjBusca" value="{{ $convenio->empresa->cnpj ?? '' }}" placeholder="CNPJ da Empresa" required @if(($acao ?? '') == 'editar') readonly @endif>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4 cpfE" @if(($convenio->empresa->tipo_cadastro ?? '') == 'CPF') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">CPF (Empresa): <span class="tx-danger">*</span></label>
        <input class="form-control cpf" type="text" name="cpf" id="cpfEmpresaBusca" value="{{ $convenio->empresa->cpf ?? '' }}" placeholder="CPF da Empresa">
        </div>
    </div><!-- col-4 -->

    <div class="col-md-5 cpfE" @if(($convenio->empresa->tipo_cadastro ?? '') == 'CPF') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">Nome Fantasia (Empresa CPF): <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="nome_fantasia_cpf" name="nome_fantasia_cpf" value="{{ $convenio->empresa->nome_fantasia ?? '' }}" placeholder="Nome Fantasia" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-5 CnpjE" @if(($convenio->empresa->tipo_cadastro ?? '') == 'CPF') style="display: none;" @else style="display: block;" @endif>
        <div class="form-group">
        <label class="form-control-label">Razão Social: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="razao_social" id="razao_social" value="{{ $convenio->empresa->razao_social ?? '' }}" placeholder="Razão Social da Empresa" readonly>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
        <label class="form-control-label">Percentual ISSQN: <span class="tx-danger">*</span></label>
        <input class="form-control percentual" type="text" name="percentual_issqn" value="{{ $convenio->percentual_issqn ?? '' }}" placeholder="%" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
        <label class="form-control-label">Data Inicial: <span class="tx-danger">*</span></label>
        <input class="form-control data" type="text" name="data_inicial" value="{{ Helper::data_br($convenio->data_inicial ?? '') }}" placeholder="Data Inicial" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
        <label class="form-control-label">Dia de Faturamento: <span class="tx-danger">*</span></label>
        <input class="form-control" type="number" name="dia_faturamento" value="{{ $convenio->dia_faturamento ?? '' }}" placeholder="Dia de Faturamento" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Dia de Vencimento (Boleto): <span class="tx-danger">*</span></label>
        <select class="form-control" id="vencimento_boleto" name="vencimento_boleto" data-placeholder="Selecione o vencimento">
            <option label="Selecione o vencimento"></option>
            <option value="Todo dia 15" @if(($convenio->vencimento_boleto ?? '') == 'Todo dia 15') selected @endif>Todo dia 15</option>
            <option value="Todo dia 20" @if(($convenio->vencimento_boleto ?? '') == 'Todo dia 20') selected @endif>Todo dia 20</option>
            <option value="Todo dia 22" @if(($convenio->vencimento_boleto ?? '') == 'Todo dia 22') selected @endif>Todo dia 22</option>
            <option value="Todo dia 24" @if(($convenio->vencimento_boleto ?? '') == 'Todo dia 24') selected @endif>Todo dia 24</option>
            <option value="Todo dia 25" @if(($convenio->vencimento_boleto ?? '') == 'Todo dia 25') selected @endif>Todo dia 25</option>
            <option value="Todo dia 28" @if(($convenio->vencimento_boleto ?? '') == 'Todo dia 28') selected @endif>Todo dia 28</option>

            <option value="10 dias após a emissão" @if(($convenio->vencimento_boleto ?? '') == '10 dias após a emissão') selected @endif>10 dias após a emissão</option>
            <option value="21 dias após a emissão" @if(($convenio->vencimento_boleto ?? '') == '21 dias após a emissão') selected @endif>21 dias após a emissão</option>
            <option value="28 dias após a emissão" @if(($convenio->vencimento_boleto ?? '') == '28 dias após a emissão') selected @endif>28 dias após a emissão</option>
            <option value="30 dias após a emissão" @if(($convenio->vencimento_boleto ?? '') == '30 dias após a emissão') selected @endif>30 dias após a emissão</option>
            <option value="45 dias após a emissão" @if(($convenio->vencimento_boleto ?? '') == '45 dias após a emissão') selected @endif>45 dias após a emissão</option>
            <option value="60 dias após a emissão" @if(($convenio->vencimento_boleto ?? '') == '60 dias após a emissão') selected @endif>60 dias após a emissão</option>

            <option value="Faturamento + 30 Dias" @if(($convenio->vencimento_boleto ?? '') == 'Faturamento + 30 Dias') selected @endif>Faturamento + 30 Dias</option>
            <option value="Faturamento + 45 Dias" @if(($convenio->vencimento_boleto ?? '') == 'Faturamento + 45 Dias') selected @endif>Faturamento + 45 Dias</option>

            <option value="Dia 01 do próximo mês" @if(($convenio->vencimento_boleto ?? '') == 'Dia 01 do próximo mês') selected @endif>Dia 01 do próximo mês</option>
            <option value="Dia 05 do próximo mês" @if(($convenio->vencimento_boleto ?? '') == 'Dia 05 do próximo mês') selected @endif>Dia 05 do próximo mês</option>
            <option value="Dia 10 do próximo mês" @if(($convenio->vencimento_boleto ?? '') == 'Dia 10 do próximo mês') selected @endif>Dia 10 do próximo mês</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Forma de Pagamento: <span class="tx-danger">*</span></label>
        <select class="form-control" id="forma_pagamento" name="forma_pagamento" data-placeholder="Selecione" required>
            <option label="Selecione"></option>
            <option value="Boleto" @if(($convenio->forma_pagamento ?? '') == 'Boleto') selected @endif>Boleto</option>
            <option value="Depósito" @if(($convenio->forma_pagamento ?? '') == 'Depósito') selected @endif>Depósito</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Quantidade de Jovens: <span class="tx-danger">*</span></label>
        <input class="form-control" type="number" name="qtde_jovens" value="{{ $convenio->qtde_jovens ?? '' }}" placeholder="Quantidade de Jovens" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Tabela R$ (Capacitação): <span class="tx-danger">*</span></label>
        <select class="form-control" id="tabela_id" name="tabela_id" data-placeholder="Selecione">
            <option label="Selecione"></option>
            @foreach ($tabelas as $tabela)
            <option value="{{ $tabela->id }}" @if(($tabela->id ?? '') == ($convenio->tabela_id ?? '')) selected @endif>{{ $tabela->nome }} (R$ {{ Helper::converte_valor_real(Helper::GetUltimaAtualizacaoValorTabela($tabela)) }})</option>
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-5">
        <div class="form-group">
        <label class="form-control-label">Selecione o tipo: <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo_convenio" name="tipo_convenio" data-placeholder="Selecione o tipo">
            <option label="Selecione o tipo do convenio"></option>
            <option value="Administrativo" @if(($convenio->tipo_convenio ?? '') == 'Administrativo') selected @endif>Administrativo</option>
            <option value="Supermercado" @if(($convenio->tipo_convenio ?? '') == 'Supermercado') selected @endif>Supermercado</option>
            <option value="Frentista" @if(($convenio->tipo_convenio ?? '') == 'Frentista') selected @endif>Frentista</option>
            <option value="Produção" @if(($convenio->tipo_convenio ?? '') == 'Produção') selected @endif>Produção</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">Selecione o pólo das atividades teóricas: <span class="tx-danger">*</span></label>
        <select class="form-control" id="polo_id" name="polo_id" data-placeholder="Selecione">
            <option label="Selecione"></option>
            @foreach ($polos as $polo)
            <option value="{{ $polo->id }}" @if(($polo->id ?? '') == ($convenio->polo_id ?? '')) selected @endif>{{ $polo->nome }}</option>
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Selecione o Status: <span class="tx-danger">*</span></label>
        <select class="form-control" id="situacao" name="situacao" data-placeholder="Selecione a situação">
            <option label="Selecione a situação do convenio"></option>
            <option value="Ativo" @if(($convenio->situacao ?? '') == 'Ativo') selected @endif>Ativo</option>
            <option value="Bloqueado" @if(($convenio->situacao ?? '') == 'Bloqueado') selected @endif>Bloqueado</option>
            <option value="Cancelado" @if(($convenio->situacao ?? '') == 'Cancelado') selected @endif>Cancelado</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Emissão Nota Fiscal: <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo_emissao_nf" name="tipo_emissao_nf" data-placeholder="Selecione">
            <option label="Selecione o formato de emissão"></option>
            <option value="Simples (Individual)" @if(($convenio->tipo_emissao_nf ?? '') == 'Simples (Individual)') selected @endif>Simples (Individual)</option>
            <option value="Aglutinado (Matriz)" @if(($convenio->tipo_emissao_nf ?? '') == 'Aglutinado (Matriz)') selected @endif>Aglutinado (Matriz)</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Emissão Cobrança: <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo_emissao_cobranca" name="tipo_emissao_cobranca" data-placeholder="Selecione">
            <option label="Selecione o formato de emissão"></option>
            <option value="Simples (Individual)" @if(($convenio->tipo_emissao_cobranca ?? '') == 'Simples (Individual)') selected @endif>Simples (Individual)</option>
            <option value="Aglutinado (Matriz)" @if(($convenio->tipo_emissao_cobranca ?? '') == 'Aglutinado (Matriz)') selected @endif>Aglutinado (Matriz)</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Envios (Notas/Boletos/Relatórios): <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo_envio" name="tipo_envio" data-placeholder="Selecione">
            <option label="Selecione o formato de envio"></option>
            <option value="Simples (Individual)" @if(($convenio->tipo_envio ?? '') == 'Simples (Individual)') selected @endif>Simples (Individual)</option>
            <option value="Aglutinado (Matriz)" @if(($convenio->tipo_envio ?? '') == 'Aglutinado (Matriz)') selected @endif>Aglutinado (Matriz)</option>
        </select>
        </div>
    </div><!-- col-4 -->

</div><!-- row -->
