<div class="form-group alunoReposicao" style="display:none;">
    <label class="form-control-label">Aluno (Reposição): <span class="tx-danger">*</span></label>
    <select class="form-control" id="aluno_reposto_id" name="aluno_reposto_id" data-placeholder="Selecione o aluno que será reposto">
        <option label="Selecione o aluno que será reposto"></option>
        @foreach ($alunos as $aluno)
        <option value="{{ $aluno['id'] }}">{{ $aluno['nome'] ?? '' }} (CPF: {{ $aluno['cpf'] ?? '' }})</option>
        @endforeach
    </select>
</div>
