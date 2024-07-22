<label class="form-control-label">Responsável pelo jovem na empresa: <span class="tx-danger">*</span></label>
<select class="form-control" name="empresa_contato_id" data-placeholder="Selecione o responsável">
    <option label="Selecione o responsável pelo jovem"></option>
    @foreach ($responsaveis as $responsavel)
    <option value="{{ $responsavel['id'] }}">{{ $responsavel['nome'] ?? '' }} ({{ $responsavel['departamento'] ?? '' }})</option>
    @endforeach
</select>
