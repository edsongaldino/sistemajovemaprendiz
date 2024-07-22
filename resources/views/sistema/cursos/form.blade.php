<div class="row no-gutters">
    <div class="col-md-6">
        <div class="form-group">
        <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="nome" value="{{ $curso->nome ?? '' }}" placeholder="Nome do curso" required>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Número: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="numero" value="{{ $curso->numero ?? '' }}" placeholder="Número" required>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">CBO: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="cbo" value="{{ $curso->cbo ?? '' }}" placeholder="CBO" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label">Função: <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="funcao" value="{{ $curso->funcao ?? '' }}" placeholder="Função" required>
        </div>
    </div><!-- col-4 -->
   

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">Selecione o pólo responsável por esse curso: <span class="tx-danger">*</span></label>
        <select class="form-control" id="polo_id" name="polo_id" data-placeholder="Selecione o pólo responsável">
            <option label="Selecione o pólo responsável"></option>
            @foreach ($polos as $polo)
            <option value="{{ $polo->id }}" @if(($polo->id ?? '') == ($curso->polo_id ?? '')) selected @endif>{{ $polo->nome }}</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->  
    
    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">CH Total: <span class="tx-danger">*</span></label>
            <input class="form-control" type="number" name="ch_total" value="{{ $curso->ch_total ?? '' }}" placeholder="CH Total" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">CH Prática: <span class="tx-danger">*</span></label>
            <input class="form-control" type="number" name="ch_pratica" value="{{ $curso->ch_pratica ?? '' }}" placeholder="CH Prática" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
            <label class="form-control-label">CH Teórica: <span class="tx-danger">*</span></label>
            <input class="form-control" type="number" name="ch_teorica" value="{{ $curso->ch_teorica ?? '' }}" placeholder="CH Teórica" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
            <label class="form-control-label">CH Semanal: <span class="tx-danger">*</span></label>
            <input class="form-control" type="number" name="ch_semanal" value="{{ $curso->ch_semanal ?? '' }}" placeholder="CH Semanal" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
            <label class="form-control-label">CH Diária: <span class="tx-danger">*</span></label>
            <input class="form-control" type="number" name="ch_diaria" value="{{ $curso->ch_diaria ?? '' }}" placeholder="CH Diária" required>
        </div>
    </div><!-- col-4 -->

</div><!-- row -->