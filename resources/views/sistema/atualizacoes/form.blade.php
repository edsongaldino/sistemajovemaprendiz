<div class="row no-gutters">

    <input type="hidden" name="data_atual" value="{{ $data_atual }}">

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Selecione o tipo da atualização: <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo_atualizacao" name="tipo_atualizacao" data-placeholder="Selecione a tipo">
            <option label="Selecione o tipo"></option>
            <option value="Acréscimo" @if(($atualizacao->tipo_atualizacao ?? '') == "Acréscimo") selected @endif>Acréscimo (+)</option>
            <option value="Decréscimo" @if(($atualizacao->tipo_atualizacao ?? '') == "Decréscimo") selected @endif>Decréscimo (-)</option> 
        </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Defina o módulo onde será aplicada a atualização: <span class="tx-danger">*</span></label>
        <select class="form-control" id="modulo_atualizacao" name="modulo_atualizacao" data-placeholder="Selecione o módulo">
            <option label="Selecione o tipo"></option>
            <option value="Tabela" @if(($atualizacao->modulo_atualizacao ?? '') == "Tabela") selected @endif>Tabelas</option>
            <option value="Salário" @if(($atualizacao->modulo_atualizacao ?? '') == "Salário") selected @endif>Salários</option> 
        </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Valor (Percentual): <span class="tx-danger">*</span></label>
        <input class="form-control percentual" type="text" name="percentual_atualizacao" value="{{ Helper::converte_valor_real($atualizacao->percentual_atualizacao ?? '') }}" placeholder="Percentual aplicado" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Situação da atualização: <span class="tx-danger">*</span></label>
        <select class="form-control" id="situacao_atualizacao" name="situacao_atualizacao" data-placeholder="Selecione o módulo">
            <option label="Selecione o tipo"></option>
            <option value="Efetivada" @if(($atualizacao->situacao_atualizacao ?? '') == "Efetivada") selected @endif>Efetivada</option>
            <option value="Agendada" @if(($atualizacao->situacao_atualizacao ?? '') == "Agendada") selected @endif>Agendada</option> 
        </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Data de Aplicação (À partir de): <span class="tx-danger">*</span></label>
        <input class="form-control moeda" type="date" name="data_atualizacao" value="{{ Helper::converte_valor_real($atualizacao->data_atualizacao ?? '') }}" placeholder="Percentual aplicado" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-12">
        <div class="form-group">
        <label class="form-control-label">Motivo da Atualização: <span class="tx-danger">*</span></label>
        <textarea class="form-control" name="motivo_atualizacao" id="motivo_atualizacao" cols="30" rows="10" placeholder="Motivo da Atualização (Informações Adicionais)">{{ $atualizacao->motivo_atualizacao ?? '' }}</textarea>
        </div>
    </div><!-- col-4 -->    

</div><!-- row -->