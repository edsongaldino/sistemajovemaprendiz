<div class="row no-gutters">
    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="nome" value="{{ $parceiro->nome ?? '' }}" placeholder="Nome completo" required>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">CPF: <span class="tx-danger">*</span></label>
        <input class="form-control cpf" type="text" name="cpf" value="{{ $parceiro->cpf ?? '' }}" placeholder="CPF" required>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-7">
        <div class="form-group mg-md-l--1 mg-t--1">
        <label class="form-control-label mg-b-0-force">Pólos: <span class="tx-danger">*</span></label>
        <select id="select2-a" class="form-control" name="polos" data-placeholder="Selecione os pólos representados pelo parceiro" multiple required>
            <option label="Selecione"></option>
            @foreach ($polos as $polo)
            <option value="{{ $polo->id }}">{{ $polo->nome }}</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Telefone: <span class="tx-danger">*</span></label>
        <input class="form-control" id="phoneMask" type="text" name="telefone" value="{{ $parceiro->user->telefone ?? '' }}" placeholder="Telefone" required>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-2 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Data de Nascimento: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="data_nascimento" id="dateMask" value="{{ Helper::data_br($parceiro->user->data_nascimento ?? '') }}" placeholder="00/00/0000" required>
        </div>
    </div><!-- col-4 -->
    
    <div class="col-md-4">
        <div class="form-group bd-t-0-force">
        <label class="form-control-label">E-mail: <span class="tx-danger">*</span></label>
        <input class="form-control" type="email" name="email" value="{{ $parceiro->user->email ?? '' }}" placeholder="Email" required>
        </div>
    </div><!-- col-8 -->
    @if(($acao ?? '') == "editar")
    <div class="col-md-2">
        <div class="form-group bd-t-0-force">
            <label class="form-control-label">Alterar senha? <span class="tx-danger">*</span></label>
            <label class="ckbox">
                <input type="checkbox" name="alterar_senha" id="alterar_senha">
                <span>Sim</span>
            </label>
        </div>
    </div>
    <div class="col-md-3">
    @else
    <div class="col-md-4">
    @endif
        <div class="form-group bd-t-0-force">
        <label class="form-control-label">Senha: <span class="tx-danger">*</span></label>
        <input class="form-control" type="password" name="password" id="senha" value="" placeholder="Senha" @if(($acao ?? '') == "editar") disabled @endif required>
        </div>
    </div><!-- col-8 -->
    @if(($acao ?? '') == "editar")
    <div class="col-md-3">
    @else
    <div class="col-md-4">
    @endif
        <div class="form-group bd-t-0-force">
        <label class="form-control-label">Confirmar senha: <span class="tx-danger">*</span></label>
        <input class="form-control" type="password" name="password2" id="confirmar_senha" value="" @if(($acao ?? '') == "editar") disabled @endif placeholder="Confirmar senha" required>
        </div>
    </div><!-- col-8 -->
    
</div><!-- row -->