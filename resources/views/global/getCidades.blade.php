<label class="form-control-label">Cidade: <span class="tx-danger">*</span></label>
<select class="form-control" name="cidade_endereco" id="cidadeBusca" data-placeholder="Selecione a cidade" required>
    @foreach ($cidades as $cidade)
    <option value="{{ $cidade['id'] }}">{{ $cidade['nome_cidade'] }}</option>
    @endforeach
</select>
