<div class="row no-gutters">
    <div class="col-md-7">
        <div class="form-group">
        <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="nome" value="{{ $aluno->nome ?? '' }}" placeholder="Nome do aluno" required>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-2">
        <div class="form-group">
        <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
        <select class="form-control" id="sexo" name="sexo" data-placeholder="Selecione o sexo" required>
            <option label="Selecione o sexo"></option>
            <option value="Masculino" @if( ($aluno->sexo ?? '') == 'Masculino') selected @endif>Masculino</option>
            <option value="Feminino" @if( ($aluno->sexo ?? '') == 'Feminino' ) selected @endif>Feminino</option>
        </select>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">CPF: <span class="tx-danger">*</span></label>
        <input class="form-control cpf" type="text" name="cpf" id="cpf" value="{{ $aluno->cpf ?? '' }}" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-5 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">RG: <span class="tx-danger">*</span></label>
        <input class="form-control" id="rg" type="text" name="rg" value="{{ $aluno->rg ?? '' }}" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Órgão Exp: <span class="tx-danger">*</span></label>
        <input class="form-control" id="orgao_expedidor" type="text" name="orgao_expedidor" value="{{ $aluno->orgao_expedidor ?? '' }}" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Data de Nascimento: <span class="tx-danger">*</span></label>
        <input class="form-control DataNascimentoAluno" type="text" name="data_nascimento" id="dateMask" value="{{ Helper::data_br($aluno->data_nascimento ?? '') }}" placeholder="00/00/0000" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Telefone (Residencial): <span class="tx-danger">*</span></label>
        <input class="form-control telefone" id="phoneMask" type="text" name="telefone" value="{{ $aluno->telefone ?? '' }}" placeholder="Telefone" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Telefone (Whatsapp): <span class="tx-danger">*</span></label>
        <input class="form-control" id="phoneMask2" type="text" name="whatsapp" value="{{ $aluno->whatsapp ?? '' }}" placeholder="Whatsapp" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
            <label class="form-control-label">Estado Civil: <span class="tx-danger">*</span></label>
            <select class="form-control" id="estado_civil" name="estado_civil" data-placeholder="Selecione o estado civil" required>
                <option label="Selecione o estado civil"></option>
                <option value="Solteiro" @if( ($aluno->estado_civil ?? '') == 'Solteiro') selected @endif>Solteiro</option>
                <option value="Casado" @if( ($aluno->estado_civil ?? '') == 'Casado' ) selected @endif>Casado</option>
                <option value="Separado" @if( ($aluno->estado_civil ?? '') == 'Separado') selected @endif>Separado</option>
                <option value="Divorciado" @if( ($aluno->estado_civil ?? '') == 'Divorciado') selected @endif>Divorciado</option>
                <option value="Viúvo" @if( ($aluno->estado_civil ?? '') == 'Viúvo') selected @endif>Viúvo</option>
            </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
            <label class="form-control-label">PCD? <span class="tx-danger">*</span></label>
            <select class="form-control" id="pcd" name="pcd" data-placeholder="Selecione" required>
                <option label="Selecione o estado civil"></option>
                <option value="Não" @if( ($aluno->pcd ?? '') == 'Não') selected @endif>Não</option>
                <option value="Sim" @if( ($aluno->pcd ?? '') == 'Sim' ) selected @endif>Sim</option>
            </select>
            </div>
    </div>

    <div class="col-md-12" id="dados-conjuge" @php if(isset($aluno->conjuge->id)): echo 'style="display: block;"'; else: echo 'style="display: none;"'; endif; @endphp>
        <div class="row no-gutters">
            <input type="hidden" name="conjuge_id" value="{{ $aluno->conjuge->id ?? '' }}">
            <div class="col-md-4">
                <div class="form-group">
                <label class="form-control-label">Nome do Cônjuge: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome_conjuge" value="{{ $aluno->conjuge->nome ?? '' }}" placeholder="Nome do cônjuge" required>
                </div>
            </div><!-- col-4 -->
            <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CPF Cônjuge: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="cpf_conjuge" id="cpf2" value="{{ $aluno->conjuge->cpf ?? '' }}" required>
                </div>
            </div><!-- col-4 -->
        
            <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">RG Cônjuge: <span class="tx-danger">*</span></label>
                <input class="form-control" id="rg_conjuge" type="text" name="rg_conjuge" value="{{ $aluno->conjuge->rg ?? '' }}" required>
                </div>
            </div><!-- col-4 -->
        
            <div class="col-md-2 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">Órgão Exp Cônjuge: <span class="tx-danger">*</span></label>
                <input class="form-control" id="orgao_expedidor_conjuge" type="text" name="orgao_expedidor_conjuge" value="{{ $aluno->conjuge->orgao_expedidor ?? '' }}" required>
                </div>
            </div><!-- col-4 -->
        </div>
    </div>

    <div class="col-md-12" id="dados-responsavel">
        <div class="row no-gutters">

            <input type="hidden" name="responsavel_id" value="{{ $aluno->responsavel->id ?? '' }}">

            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-control-label">Menor de Idade? <span class="tx-danger">*</span></label>
                    <label class="ckbox">
                        <input type="checkbox" name="menor_idade" id="menor_idade" @if(isset($aluno->responsavel->nome)) checked @endif>
                        <span>Sim</span>
                    </label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                <label class="form-control-label">Nome do Responsável: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="nome_responsavel" id="nome_responsavel" value="{{ $aluno->responsavel->nome ?? '' }}" placeholder="Nome do responsavel" @if(isset($aluno->responsavel->nome)) enable @else disabled @endif required>
                </div>
            </div><!-- col-4 -->
            <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">CPF Responsável: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="cpf_responsavel" id="cpf_responsavel" value="{{ $aluno->responsavel->cpf ?? '' }}" @if(isset($aluno->responsavel->nome)) enable @else disabled @endif required>
                </div>
            </div><!-- col-4 -->
        
            <div class="col-md-3 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                <label class="form-control-label">RG Responsável: <span class="tx-danger">*</span></label>
                <input class="form-control" id="rg_responsavel" type="text" name="rg_responsavel" value="{{ $aluno->responsavel->rg ?? '' }}" @if(isset($aluno->responsavel->nome)) enable @else disabled @endif required>
                </div>
            </div><!-- col-4 -->

        </div>
    </div>

    <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20"><i class="fa fa-user"></i> Dados de Acesso</h6>

    <input type="hidden" name="perfil_id" value="3">
    <input type="hidden" name="user_id" value="{{ $aluno->user->id ?? '' }}">
    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">E-mail: <span class="tx-danger">*</span></label>
        <input class="form-control" type="email" name="email" value="{{ $aluno->user->email ?? '' }}" placeholder="Email" required>
        </div>
    </div><!-- col-8 -->
    @if(($acao ?? '') == "editar")
    <div class="col-md-2">
        <div class="form-group">
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
        <div class="form-group">
        <label class="form-control-label">Senha: <span class="tx-danger">*</span></label>
        <input class="form-control" type="password" name="password" id="senha" value="" placeholder="Senha" @if(($acao ?? '') == "editar") disabled @endif required>
        </div>
    </div><!-- col-8 -->
    @if(($acao ?? '') == "editar")
    <div class="col-md-3">
    @else
    <div class="col-md-4">
    @endif
        <div class="form-group">
        <label class="form-control-label">Confirmar senha: <span class="tx-danger">*</span></label>
        <input class="form-control" type="password" name="password2" id="confirmar_senha" value="" @if(($acao ?? '') == "editar") disabled @endif placeholder="Confirmar senha" required>
        </div>
    </div><!-- col-8 -->
    
    <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20"><i class="icon ion-location"></i> Endereço do Aluno</h6>

    <input type="hidden" name="endereco_id" value="{{ $aluno->endereco_id ?? '' }}">

    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">CEP: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="cep_endereco" name="cep_endereco" value="{{ $endereco->cep_endereco ?? '' }}" placeholder="CEP" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-7">
        <div class="form-group">
        <label class="form-control-label">Logradouro: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="logradouro_endereco" name="logradouro_endereco" value="{{ $endereco->logradouro_endereco ?? '' }}" placeholder="Rua, Avenida, Travessa, etc" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
        <label class="form-control-label">Número: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="numero_endereco" name="numero_endereco" value="{{ $endereco->numero_endereco ?? '' }}" placeholder="Número" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">Complemento: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="complemento_endereco" name="complemento_endereco" value="{{ $endereco->complemento_endereco ?? '' }}" placeholder="Complemento" required>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Bairro: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="bairro_endereco" name="bairro_endereco" value="{{ $endereco->bairro_endereco ?? '' }}" placeholder="Bairro" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-6">
        <div class="form-group">
        <label class="form-control-label">Estado (UF): <span class="tx-danger">*</span></label>
        <select class="form-control" id="estado_endereco" name="estado_endereco" data-placeholder="Selecione o estado" required>
            <option label="Selecione o estado"></option>
            @foreach ($estados as $estado)
            <option value="{{ $estado->id }}" @if(($estado->id ?? '') == ($aluno->endereco->cidade->estado_id ?? '')) selected @endif>{{ $estado->nome_estado }}</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->
    
    <div class="col-md-6">
        <div class="form-group" id="cidade_endereco">
        <label class="form-control-label">Cidade: <span class="tx-danger">*</span></label>
        @if(($acao ?? '') == "editar")
        <select class="form-control" name="cidade_endereco" data-placeholder="Selecione a cidade" required>
            <option label="Selecione a cidade"></option>
            @foreach ($cidades as $cidade)
            <option value="{{ $cidade['id'] }}" @if(($cidade->id ?? '') == ($aluno->endereco->cidade_id ?? '')) selected @endif>{{ $cidade['nome_cidade'] }}</option>
            @endforeach
        </select>
        @endif
        </div>
    </div><!-- col-4 -->

    <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20"><i class="fa fa-bank"></i> Dados Escolares</h6>

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Escolaridade: <span class="tx-danger">*</span></label>
        <select class="form-control" id="escolaridade" name="escolaridade" data-placeholder="Selecione a escolaridade" required>
            <option label="Selecione a escolaridade"></option>
            <option value="Ensino Fundamental (Cursando)" @if( ($aluno->escolaridade ?? '') == 'Ensino Fundamental (Cursando)') selected @endif>Ensino Fundamental (Cursando)</option>
            <option value="Ensino Fundamental (Completo)" @if( ($aluno->escolaridade ?? '') == 'Ensino Fundamental (Completo)') selected @endif>Ensino Fundamental (Completo)</option>
            <option value="Ensino Médio (Cursando)" @if( ($aluno->escolaridade ?? '') == 'Ensino Médio (Cursando)') selected @endif>Ensino Médio (Cursando)</option>
            <option value="Ensino Médio (Completo)" @if( ($aluno->escolaridade ?? '') == 'Ensino Médio (Completo)') selected @endif>Ensino Médio (Completo)</option>
            <option value="Superior (Cursando)" @if( ($aluno->escolaridade ?? '') == 'Superior (Cursando)') selected @endif>Superior (Cursando)</option>
            <option value="Superior (Completo)" @if( ($aluno->escolaridade ?? '') == 'Superior (Completo)') selected @endif>Superior (Completo)</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Turno: <span class="tx-danger">*</span></label>
        <select class="form-control" id="turno" name="turno" data-placeholder="Selecione o turno" required>
            <option label="Selecione o turno"></option>
            <option value="Matutino" @if( ($aluno->turno ?? '') == 'Matutino') selected @endif>Matutino</option>
            <option value="Vespertino" @if( ($aluno->turno ?? '') == 'Vespertino') selected @endif>Vespertino</option>
            <option value="Noturno" @if( ($aluno->turno ?? '') == 'Noturno') selected @endif>Noturno</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Faz contra turno? <span class="tx-danger">*</span></label>
        <select class="form-control" id="contra_turno" name="contra_turno" data-placeholder="Selecione se o aluno faz contra turno" required>
            <option label="Selecione se o aluno faz contra turno"></option>
            <option value="Sim" @if( ($aluno->contra_turno ?? '') == 'Sim') selected @endif>Sim</option>
            <option value="Não" @if( ($aluno->contra_turno ?? '') == 'Não') selected @endif>Não</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20"><i class="fa fa-bank"></i> Pólo Administrativo</h6>

    <div class="col-md-12">
        <div class="form-group">
        <label class="form-control-label">Selecione o Pólo ao qual o aluno está vinculado: <span class="tx-danger">*</span></label>
        <select class="form-control" id="polo_id" name="polo_id" data-placeholder="Selecione o Pólo" required>
            <option label="Selecione o Pólo"></option>
            @foreach ($polos as $polo)
            <option value="{{ $polo->id }}" @if(($polo->id ?? '') == ($aluno->polo_id ?? '')) selected @endif>{{ $polo->nome }}</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->   

</div><!-- row -->