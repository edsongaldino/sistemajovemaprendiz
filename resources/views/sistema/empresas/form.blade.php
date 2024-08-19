<div class="row no-gutters">

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Tipo Empresa: <span class="tx-danger">*</span></label>
        <select class="form-control" name="tipo_empresa" id="tipo_empresa" data-placeholder="Selecione o tipo" required>
            <option label="Selecione o tipo da empresa"></option>
            <option value="Matriz" @if(($empresa->tipo_empresa ?? '') == 'Matriz') selected @endif>Matriz</option>
            <option value="Filial" @if(($empresa->tipo_empresa ?? '') == 'Filial') selected @endif>Filial</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Tipo Cadastro: <span class="tx-danger">*</span></label>
        <select class="form-control" name="tipo_cadastro" id="tipo_cadastro" data-placeholder="Selecione o tipo do cadastro" required>
            <option label="Selecione o tipo da empresa"></option>
            <option value="CNPJ" @if(($empresa->tipo_cadastro ?? '') == 'CNPJ') selected @endif>CNPJ</option>
            <option value="CPF" @if(($empresa->tipo_cadastro ?? '') == 'CPF') selected @endif>CPF</option>
        </select>
        </div>
    </div><!-- col-4 -->


    <div class="col-md-3 CnpjE" @if(($empresa->tipo_cadastro ?? '') == 'CPF') style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">CNPJ: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="cnpj" name="cnpj" value="{{ $empresa->cnpj ?? '' }}" placeholder="CNPJ da empresa">
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3 cpfE" id="CPF" @if(($empresa->tipo_cadastro ?? '') == 'CPF') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">CPF: <span class="tx-danger">*</span></label>
        <input class="form-control cpf" type="text" name="cpf" value="{{ $empresa->cpf ?? '' }}" maxlength="12" placeholder="Cadastro Pessoa Física">
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">CEI: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="cei" value="{{ $empresa->cei ?? '' }}" maxlength="12" placeholder="Cadastro Específico do INSS">
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">Inscrição Estadual: <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="inscricao_estadual" value="{{ $empresa->inscricao_estadual ?? '' }}" placeholder="Inscrição Estadual" required>
            <input type="checkbox" class="varias-inscricoes" name="varias_inscricoes" id="varias_inscricoes" value="true"> Possui mais de uma inscrição
        </div>
    </div><!-- col-4 -->


    <div class="col-md-9 cpfE" @if(($empresa->tipo_cadastro ?? '') == 'CPF') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">Nome Fantasia (Empresa CPF): <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="nome_fantasia_cpf" name="nome_fantasia_cpf" value="{{ $empresa->nome_fantasia ?? '' }}" placeholder="Nome Fantasia" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-5 CnpjE" @if(($empresa->tipo_cadastro ?? '') == 'CNPJ') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">Razão Social: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="razao_social" name="razao_social" value="{{ $empresa->razao_social ?? '' }}" placeholder="Razão Social" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4 CnpjE" @if(($empresa->tipo_cadastro ?? '') == 'CNPJ') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">Nome Fantasia: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="nome_fantasia" name="nome_fantasia" value="{{ $empresa->nome_fantasia ?? '' }}" placeholder="Nome Fantasia" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4 mg-t--1 mg-md-t-0 CnpjE" @if(($empresa->tipo_cadastro ?? '') == 'CNPJ') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Telefone: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="telefone" name="telefone" value="{{ $empresa->telefone ?? '' }}" placeholder="Telefone" required>
        </div>
    </div><!-- col-4 -->


    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">Atividade Principal: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="atividade_principal" name="atividade_principal" value="{{ $empresa->atividade_principal ?? '' }}" placeholder="Atividade Principal">
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Conta Contábil: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="conta_contabil" name="conta_contabil" value="{{ $empresa->conta_contabil ?? '' }}" placeholder="Conta Contábil" required>
        </div>
    </div><!-- col-4 -->


    <div class="col-md-5">
        <div class="form-group">
        <label class="form-control-label">Nome do Responsável Legal: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="nome_responsavel" value="{{ $empresa->nome_responsavel ?? '' }}" placeholder="Nome do Responsável" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">CPF do Responsável: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="cpf" name="cpf_responsavel" value="{{ $empresa->cpf_responsavel ?? '' }}" placeholder="CPF do Responsável" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">RG do Responsável Legal: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="rg_responsavel" value="{{ $empresa->rg_responsavel ?? '' }}" placeholder="RG do Responsável" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-1">
        <div class="form-group">
        <label class="form-control-label">Órgão Exp: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="emissor_rg_responsavel" value="{{ $empresa->emissor_rg_responsavel ?? '' }}" placeholder="SSP/MT" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">E-mail do Responsável <span class="tx-danger">*</span></label>
        <input class="form-control" type="email" id="email" name="email_responsavel" value="{{ $empresa->email_responsavel ?? '' }}" placeholder="E-mail do Responsável" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Telefone do Responsável: <span class="tx-danger">*</span></label>
        <input class="form-control" id="phoneMask" type="text" name="telefone_responsavel" value="{{ $empresa->telefone_responsavel ?? '' }}" placeholder="Telefone" required>
        </div>
    </div><!-- col-4 -->

    <div class="row col-md-12 no-gutters" id="EmpresaMatriz" @if (isset($empresa) && (($empresa->tipo_empresa ?? '') == 'Filial')) style="display: block;" @else style="display: none;" @endif>
        <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20"><i class="icon ion-location"></i> Empresa Matriz</h6>
        <div class="row col-md-12 no-gutters">
        <div class="col-md-4">
            <div class="form-group">
            <label class="form-control-label">CNPJ: <span class="tx-danger">*</span></label>
            <input class="form-control cnpj" type="text" id="cnpj_matriz" name="cnpj_matriz" value="{{ $empresa->cnpj_matriz ?? '' }}" placeholder="CNPJ da Matriz">
            </div>
        </div><!-- col-4 -->

        <div class="col-md-8">
            <div class="form-group">
            <label class="form-control-label">Razão Social:</label>
            <input class="form-control" type="text" id="razao_social_matriz" name="razao_social_matriz" value="{{ $empresa->razao_social_matriz ?? '' }}" placeholder="Razão Social (Preenchimento Automático)" readonly>
            </div>
        </div><!-- col-4 -->
        </div>

    </div>

    @if (isset($empresa) && ($empresa->inscricoes->count() > 0))
    <div class="row col-md-12 no-gutters" id="inscEstadual" style="display: block;">

        <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20"><i class="icon ion-location"></i> Inscrições Estaduais</h6>
        <div class="row col-md-12 no-gutters" id="EmpresaInscricoes">
            <div class="col-md-3">
                <div class="form-group">
                <label class="form-control-label">Quantas inscrições estaduais deseja acrescentar para este cliente? <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" id="qtdInscricoes" name="qtdInscricoes" value="{{ $empresa->inscricoes->count() }}" placeholder="" required>
                </div>
            </div><!-- col-4 -->
            @if($empresa->inscricoes->count() > 0)
            @foreach ($empresa->inscricoes as $inscricao)
            <div class="col-md-3" id="linhaInscricao">
                <div class="form-group">
                    <label class="form-control-label">Inscrição Estadual: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="inscEstadual[]" value="{{ $inscricao->inscricao_estadual ?? '' }}" maxlength="9" placeholder="Inscrição Estadual" required>
                </div>
            </div><!-- col-4 -->
            @endforeach
            @else
            <div class="col-md-3" id="linhaInscricao">
                <div class="form-group">
                    <label class="form-control-label">Inscrição Estadual: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="inscEstadual[]" value="" placeholder="Inscrição Estadual" maxlength="9" required>
                </div>
            </div><!-- col-4 -->
            @endif
        </div>
    </div>
    @else
    <div class="row col-md-12 no-gutters" id="inscEstadual" style="display: none;">

        <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20"><i class="icon ion-location"></i> Inscrições Estaduais</h6>
        <div class="row col-md-12 no-gutters" id="EmpresaInscricoes">
            <div class="col-md-3">
                <div class="form-group">
                <label class="form-control-label">Quantas inscrições estaduais deseja acrescentar para este cliente? <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" id="qtdInscricoes" name="qtdInscricoes" value="" placeholder="" required>
                </div>
            </div><!-- col-4 -->
            <div class="col-md-3" id="linhaInscricao">
                <div class="form-group">
                    <label class="form-control-label">Inscrição Estadual: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="inscEstadual[]" value="" placeholder="Inscrição Estadual" maxlength="9" required>
                </div>
            </div><!-- col-4 -->
        </div>

    </div>
    @endif


    <div class="row col-md-12 no-gutters" id="contatosEmpresa">

        <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20"><i class="icon ion-user"></i> Contatos da Empresa <div class="btn btn-info AddContato" id="AddContato"><i class="fa fa-plus"></i> Incluir contato</div></h6>

        @if (isset($empresa) && isset($empresa->contatos))
            @if($empresa->contatos->count() > 0)

            @foreach ($empresa->contatos as $contato)
                <div class="row col-md-12 no-gutters" id="itemContato">

                    <div class="col-md-3">
                        <div class="form-group">
                        <label class="form-control-label">Setor <span class="tx-danger">*</span></label>
                        <select class="form-control" name="contato_setor[]">
                            <option value="RH" @if($contato->setor == "RH") selected @endif>RH</option>
                            <option value="FINANCEIRO" @if($contato->setor == "FINANCEIRO") selected @endif>FINANCEIRO</option>
                            <option value="COMERCIAL" @if($contato->setor == "COMERCIAL") selected @endif>COMERCIAL</option>
                            <option value="RESPONSÁVEL jOVEM" @if($contato->setor == "RESPONSÁVEL jOVEM") selected @endif>RESPONSÁVEL PELO jOVEM</option>
                        </select>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="form-control-label">Nome <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="contato_nome[]" value="{{ $contato->nome }}" placeholder="" required>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-md-3">
                        <div class="form-group">
                        <label class="form-control-label">CPF <span class="tx-danger">*</span></label>
                        <input class="form-control cpf" type="text" name="contato_cpf[]" value="{{ $contato->cpf ?? '' }}" placeholder="" required>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-md-4">
                        <div class="form-group">
                        <label class="form-control-label">Departamento <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="contato_departamento[]" value="{{ $contato->departamento ?? '' }}" placeholder="" required>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-md-4">
                        <div class="form-group">
                        <label class="form-control-label">E-mail <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="contato_email[]" value="{{ $contato->email }}" placeholder="" required>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-md-2">
                        <div class="form-group">
                        <label class="form-control-label">Whatsapp <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" id="phoneMask" name="contato_whatsapp[]" value="{{ $contato->whatsapp }}" placeholder="" required>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-md-2">
                        <div class="form-group">
                        <label class="form-control-label">Data de Nasc. <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" id="dateMask" name="contato_data_nascimento[]" value="{{ Helper::data_br($contato->data_nascimento ?? '') }}" placeholder="" required>
                        </div>
                    </div><!-- col-4 -->

                    <div class="remover-contato excluirContato" data-id="{{ $contato->id }}" data-token="{{ csrf_token() }}"><i class="icon ion-close"></i></div>

                </div>
            @endforeach

            @else

            <div class="row col-md-12 no-gutters" id="itemContato">

                <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-control-label">Setor <span class="tx-danger">*</span></label>
                    <select class="form-control" name="contato_setor[]">
                        <option value="RH" selected>RH</option>
                        <option value="FINANCEIRO">FINANCEIRO</option>
                        <option value="COMERCIAL">COMERCIAL</option>
                        <option value="RESPONSÁVEL jOVEM">RESPONSÁVEL PELO jOVEM</option>
                    </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-6">
                    <div class="form-group">
                    <label class="form-control-label">Nome <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_nome[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-control-label">CPF <span class="tx-danger">*</span></label>
                    <input class="form-control cpf" type="text" name="contato_cpf[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-control-label">Departamento <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_departamento[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-control-label">E-mail <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_email[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-2">
                    <div class="form-group">
                    <label class="form-control-label">Whatsapp <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="phoneMask" name="contato_whatsapp[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-2">
                    <div class="form-group">
                    <label class="form-control-label">Data de Nasc. <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="dateMask" name="contato_data_nascimento[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

            </div>

            @endif

        @else
        <div class="row col-md-12 no-gutters">
                <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-control-label">Setor <span class="tx-danger">*</span></label>
                    <select class="form-control" name="contato_setor[]">
                        <option value="RH" selected>RH</option>
                        <option value="FINANCEIRO">FINANCEIRO</option>
                        <option value="COMERCIAL">COMERCIAL</option>
                        <option value="RESPONSÁVEL jOVEM">RESPONSÁVEL PELO jOVEM</option>
                    </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-6">
                    <div class="form-group">
                    <label class="form-control-label">Nome <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_nome[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-control-label">CPF <span class="tx-danger">*</span></label>
                    <input class="form-control cpf" type="text" name="contato_cpf[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-control-label">Departamento <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_departamento[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-control-label">E-mail <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_email[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-2">
                    <div class="form-group">
                    <label class="form-control-label">Whatsapp <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="phoneMask" name="contato_whatsapp[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-2">
                    <div class="form-group">
                    <label class="form-control-label">Data de Nasc. <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="dateMask" name="contato_data_nascimento[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

        </div>

        <div class="row col-md-12 no-gutters">
            <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-control-label">Setor <span class="tx-danger">*</span></label>
                    <select class="form-control" name="contato_setor[]">
                        <option value="RH" selected>RH</option>
                        <option value="FINANCEIRO">FINANCEIRO</option>
                        <option value="COMERCIAL">COMERCIAL</option>
                        <option value="RESPONSÁVEL jOVEM">RESPONSÁVEL PELO jOVEM</option>
                    </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-6">
                    <div class="form-group">
                    <label class="form-control-label">Nome <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_nome[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-control-label">CPF <span class="tx-danger">*</span></label>
                    <input class="form-control cpf" type="text" name="contato_cpf[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-control-label">Departamento <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_departamento[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-control-label">E-mail <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_email[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-2">
                    <div class="form-group">
                    <label class="form-control-label">Whatsapp <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="phoneMask" name="contato_whatsapp[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-2">
                    <div class="form-group">
                    <label class="form-control-label">Data de Nasc. <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="dateMask" name="contato_data_nascimento[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

        </div>

        <div class="row col-md-12 no-gutters" id="itemContato">

                <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-control-label">Setor <span class="tx-danger">*</span></label>
                    <select class="form-control" name="contato_setor[]">
                        <option value="RH" selected>RH</option>
                        <option value="FINANCEIRO">FINANCEIRO</option>
                        <option value="COMERCIAL">COMERCIAL</option>
                        <option value="RESPONSÁVEL jOVEM">RESPONSÁVEL PELO jOVEM</option>
                    </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-6">
                    <div class="form-group">
                    <label class="form-control-label">Nome <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_nome[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-control-label">CPF <span class="tx-danger">*</span></label>
                    <input class="form-control cpf" type="text" name="contato_cpf[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-control-label">Departamento <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_departamento[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-control-label">E-mail <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="contato_email[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-2">
                    <div class="form-group">
                    <label class="form-control-label">Whatsapp <span class="tx-danger">*</span></label>
                    <input class="form-control telefone" type="text" name="contato_whatsapp[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-2">
                    <div class="form-group">
                    <label class="form-control-label">Data de Nasc. <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" id="dateMask" name="contato_data_nascimento[]" value="" placeholder="" required>
                    </div>
                </div><!-- col-4 -->

        </div>
        @endif

    </div>

    <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20"><i class="icon ion-location"></i> Endereço da Empresa</h6>

    <input type="hidden" name="endereco_id" value="{{ $empresa->endereco_id ?? '' }}">

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
            <option value="{{ $estado->id }}" @if(($estado->id ?? '') == ($empresa->endereco->cidade->estado_id ?? '')) selected @endif>{{ $estado->nome_estado }}</option>
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
            <option value="{{ $cidade['id'] }}" @if(($cidade->id ?? '') == ($empresa->endereco->cidade_id ?? '')) selected @endif>{{ $cidade['nome_cidade'] }}</option>
            @endforeach
        </select>
        @else
        <select class="form-control" name="cidade_endereco" data-placeholder="Selecione a cidade" required>
            <option label="Selecione primeiro o estado"></option>
        </select>
        @endif
        </div>
    </div><!-- col-4 -->


</div><!-- row -->
