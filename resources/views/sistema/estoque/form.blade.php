<div class="row no-gutters">

    <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
            <label class="form-control-label">Selecione o tipo produto: <span class="tx-danger">*</span></label>
            <select class="form-control" id="tipo" name="tipo" data-placeholder="Selecione o tipo">
                <option label="Selecione"></option>
                <option value="Uniforme" @if(($produto->tipo ?? '') == 'Uniforme') selected @endif>Uniforme</option> 
                <option value="Materiais de Escritório" @if(($produto->tipo ?? '') == 'Materiais de Escritório') selected @endif>Materiais de Escritório</option> 
                <option value="Materiais de Limpeza" @if(($produto->tipo ?? '') == 'Materiais de Limpeza') selected @endif>Materiais de Limpeza</option> 
                <option value="Suprimentos" @if(($produto->tipo ?? '') == 'Suprimentos') selected @endif>Suprimentos</option> 
            </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
            <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="nome" value="{{ $produto->nome ?? '' }}" placeholder="Nome do produto" required>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label">Descrição: <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="descricao" value="{{ $produto->descricao ?? '' }}" placeholder="Descrição" required>
        </div>
    </div><!-- col-4 -->
       
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label">Categoria: <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="categoria" value="{{ $produto->categoria ?? '' }}" placeholder="Categoria (Ex: Papel)" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4" id="box-uniforme" style="display: none;">
        <div class="form-group">
            <label class="form-control-label">Uniforme (Tamanho): <span class="tx-danger">*</span></label>
            <select class="form-control" id="tamanho_uniforme" name="tamanho_uniforme" data-placeholder="Selecione o tamanho">
                <option label="Selecione"></option>
                <option value="PP" @if(($produto->tamanho_uniforme ?? '') == 'PP') selected @endif>PP</option> 
                <option value="P" @if(($produto->tamanho_uniforme ?? '') == 'P') selected @endif>P</option> 
                <option value="M" @if(($produto->tamanho_uniforme ?? '') == 'M') selected @endif>M</option> 
                <option value="G" @if(($produto->tamanho_uniforme ?? '') == 'G') selected @endif>G</option> 
                <option value="GG" @if(($produto->tamanho_uniforme ?? '') == 'GG') selected @endif>GG</option> 
                <option value="XGG" @if(($produto->tamanho_uniforme ?? '') == 'XGG') selected @endif>XGG</option> 
                <option value="XXGG" @if(($produto->tamanho_uniforme ?? '') == 'XXGG') selected @endif>XXGG</option> 
            </select>
        </div>
    </div><!-- col-4 -->

</div><!-- row -->