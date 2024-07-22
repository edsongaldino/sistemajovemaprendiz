<label class="form-control-label">Bairro: <span class="tx-danger">*</span></label>
<select class="form-control" name="bairro_endereco" data-placeholder="Selecione o bairro">
    <option label="Selecione o bairro"></option>
    @foreach ($bairros as $bairro)
    <option value="{{ $bairro['bairro_endereco'] }}">{{ $bairro['bairro_endereco'] }}</option>
    @endforeach
</select>
