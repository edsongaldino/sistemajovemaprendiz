<div class="row no-gutters">

    <input type="hidden" name="empresa_id" id="empresa_id" value="{{ $vaga->empresa->id ?? '' }}">

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">CNPJ (Empresa): <span class="tx-danger">*</span></label>
        <input class="form-control cnpj" type="text" name="cnpj" id="cnpjBusca" value="{{ $vaga->empresa->cnpj ?? '' }}" placeholder="CNPJ da Empresa" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">Razão Social: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="razao_social" id="razao_social" value="{{ $vaga->empresa->razao_social ?? '' }}" placeholder="Razão Social da Empresa" readonly>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8" id="polo_vaga">
        <div class="form-group">
        <label class="form-control-label">Selecione o pólo responsável pela vaga: <span class="tx-danger">*</span></label>
        <select class="form-control" id="polo_id" name="polo_id" data-placeholder="Selecione o pólo">
            <option label="Selecione o pólo responsável pela vaga"></option>
            @foreach ($polos as $polo_vaga)
            <option value="{{ $polo_vaga->id }}" @if(($polo_vaga->id ?? '') == ($vaga->polo_id ?? '')) selected @endif>{{ $polo_vaga->nome }}</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Tipo da Vaga: <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo_vaga" name="tipo_vaga" data-placeholder="Selecione o tipo da vaga">
            <option label="Selecione o tipo da vaga"></option>
            <option value="Administrativo" @if(($vaga->tipo_vaga ?? '') == 'Administrativo') selected @endif>Administrativo</option> 
            <option value="Frentista" @if(($vaga->tipo_vaga ?? '') == 'Frentista') selected @endif>Frentista</option> 
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Quantidade: <span class="tx-danger">*</span></label>
        <input class="form-control" type="number" name="qtde_vagas" id="qtde_vagas" value="{{ $vaga->qtde_vagas ?? '' }}" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Data prevista para Início: <span class="tx-danger">*</span></label>
        <input class="form-control data" type="text" name="data_inicial" value="{{ Helper::data_br($vaga->data_inicial ?? '') }}" placeholder="Data Inicial" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Situação: <span class="tx-danger">*</span></label>
        <select class="form-control" id="situacao" name="situacao" data-placeholder="Selecione a situacao da vaga">
            <option label="Selecione a situacao da vaga"></option>
            <option value="Aberta" @if(($vaga->situacao ?? '') == 'Aberta') selected @endif>Aberta</option> 
            <option value="Processo Seletivo - Aberto" @if(($vaga->situacao ?? '') == 'Processo Seletivo - Aberto') selected @endif>Processo Seletivo - Aberto</option>
            <option value="Processo Seletivo - Concluído" @if(($vaga->situacao ?? '') == 'Processo Seletivo - Concluído') selected @endif>Processo Seletivo - Concluído</option> 
            <option value="Preenchida" @if(($vaga->situacao ?? '') == 'Preenchida') selected @endif>Preenchida</option> 
        </select>
        </div>
    </div><!-- col-4 -->
    

</div><!-- row -->