<div class="row no-gutters">

    <div class="col-md-12">
        <div class="form-group">
        <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="nome" value="{{ $regiao->nome ?? '' }}" placeholder="Nome da Região" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-12">
        <div class="form-group">
        <label class="form-control-label">Descrição da região: <span class="tx-danger">*</span></label>
        <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="10">{{ $regiao->descricao ?? '' }}</textarea>
        </div>
    </div><!-- col-4 -->    

</div><!-- row -->