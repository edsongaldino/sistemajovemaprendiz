<div class="row no-gutters">

    <div class="col-md-6">
        <div class="form-group">
        <label class="form-control-label">Descrição: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="descricao" value="{{ $feriado->descricao ?? '' }}" placeholder="Descrição do feriado" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Data: <span class="tx-danger">*</span></label>
        <input class="form-control DataNascimentoAluno" type="text" name="data" id="dateMask" value="{{ Helper::data_br($feriado->data ?? '') }}" placeholder="00/00/0000" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
            <label class="form-control-label">Abrangência do feriado: <span class="tx-danger">*</span></label>
            <select class="form-control" id="tipo_feriado" name="tipo" data-placeholder="Selecione o tipo">
                <option label="Selecione"></option>
                <option value="Nacional" @if(($feriado->tipo ?? '') == 'Nacional') selected @endif>Nacional</option> 
                <option value="Estadual" @if(($feriado->tipo ?? '') == 'Estadual') selected @endif>Estadual</option> 
                <option value="Municipal" @if(($feriado->tipo ?? '') == 'Municipal') selected @endif>Municipal</option> 
            </select>
        </div>
    </div><!-- col-4 -->

    <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20" id="header" @if(($feriado->tipo ?? '') == 'Municipal' || ($feriado->tipo ?? '') == 'Estadual') style="display: block;" @else style="display: none;" @endif><i class="icon ion-location"></i> Abrangência do Feriado</h6>

    <div class="col-md-6" id="estado" @if(($feriado->tipo ?? '') == 'Municipal' || ($feriado->tipo ?? '') == 'Estadual') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">Estado (UF): <span class="tx-danger">*</span></label>
        <select class="form-control" id="estado_endereco" name="estado_endereco" data-placeholder="Selecione o estado" required>
            <option label="Selecione o estado"></option>
            @foreach ($estados as $estado)
            <option value="{{ $estado->id }}" @if(($estado->id ?? '') == ($feriado->estado_id ?? '')) selected @endif>{{ $estado->nome_estado }}</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-6" id="cidade" @if(($feriado->tipo ?? '') == 'Municipal') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group" id="cidade_endereco">
        <label class="form-control-label">Cidade: <span class="tx-danger">*</span></label>
        @if(($acao ?? '') == "editar")
        <select class="form-control" id="inputCidade" name="cidade_endereco" data-placeholder="Selecione a cidade" required>
            <option label="Selecione a cidade"></option>
            @foreach ($cidades as $cidade)
            <option value="{{ $cidade['id'] }}" @if(($cidade->id ?? '') == ($feriado->cidade_id ?? '')) selected @endif>{{ $cidade['nome_cidade'] }}</option>
            @endforeach
        </select>
        @endif
        </div>
    </div><!-- col-4 -->
    

</div><!-- row -->