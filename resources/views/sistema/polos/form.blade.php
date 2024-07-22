<div class="row no-gutters">
    <div class="col-md-6">
        <div class="form-group">
        <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="nome" value="{{ $polo->nome ?? '' }}" placeholder="Nome do polo" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">CNPJ:</label>
        <input class="form-control" type="text" id="cnpj" name="cnpj" value="{{ $polo->cnpj ?? '' }}" placeholder="CNPJ do Pólo">
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3">
        <div class="form-group">
            <label class="form-control-label">Inscrição Estadual:</label>
            <input class="form-control" type="text" name="inscricao_estadual" value="{{ $polo->inscricao_estadual ?? '' }}" placeholder="Inscrição Estadual">
        </div>
    </div><!-- col-4 -->

    <div class="col-md-12">
        <div class="form-group">
        <label class="form-control-label">Razão Social: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="razao_social" value="{{ $polo->razao_social ?? '' }}" placeholder="Razão Social do polo" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">E-mail: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="email" value="{{ $polo->email ?? '' }}" placeholder="E-mail do polo" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Telefone: <span class="tx-danger">*</span></label>
        <input class="form-control" id="phoneMask" type="text" name="telefone" value="{{ $polo->telefone ?? '' }}" placeholder="Telefone" required>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-6">
        <div class="form-group">
        <label class="form-control-label">Região: <span class="tx-danger">*</span></label>
        <select class="form-control" id="regiao_id" name="regiao_id" data-placeholder="Selecione a região" required>
            <option label="Selecione a região"></option>
            @foreach ($regioes as $regiao)
            <option value="{{ $regiao->id }}" @if(($regiao->id ?? '') == ($polo->regiao_id ?? '')) selected @endif>{{ $regiao->nome }}</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-6">
        <div class="form-group">
        <label class="form-control-label">Tipo Polo: <span class="tx-danger">*</span></label>
        <select class="form-control" name="tipo_polo" id="tipo_polo" data-placeholder="Selecione o tipo" required>
            <option label="Selecione o tipo do polo"></option>
            <option value="Administrativo" @if(($polo->tipo_polo ?? '') == 'Administrativo') selected @endif>Administrativo</option>
            <option value="Educacional" @if(($polo->tipo_polo ?? '') == 'Educacional') selected @endif>Educacional</option>
            <option value="Administrativo e Educacional" @if(($polo->tipo_polo ?? '') == 'Administrativo e Educacional') selected @endif>Administrativo e Educacional</option>
        </select>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-12" id="polo_responsavel" @if(($polo->tipo_polo ?? '') == 'Educacional') style="display: block;" @else style="display: none;" @endif>
        <div class="form-group">
        <label class="form-control-label">Selecione o pólo responsável pela administração desta unidade: <span class="tx-danger">*</span></label>
        <select class="form-control" id="polo_id" name="polo_id" data-placeholder="Selecione a região">
            <option label="Selecione o pólo responsável"></option>
            @foreach ($polos as $polo_responsavel)
            <option value="{{ $polo_responsavel->id }}" @if(($polo_responsavel->id ?? '') == ($polo->polo_id ?? '')) selected @endif>{{ $polo_responsavel->nome }}</option> 
            @endforeach
        </select>
        </div>
    </div><!-- col-4 -->

    
    <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20"><i class="icon ion-location"></i> Endereço do Pólo</h6>

    <input type="hidden" name="endereco_id" value="{{ $polo->endereco_id ?? '' }}">

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
            <option value="{{ $estado->id }}" @if(($estado->id ?? '') == ($polo->endereco->cidade->estado_id ?? '')) selected @endif>{{ $estado->nome_estado }}</option> 
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
            <option value="{{ $cidade['id'] }}" @if(($cidade->id ?? '') == ($polo->endereco->cidade_id ?? '')) selected @endif>{{ $cidade['nome_cidade'] }}</option>
            @endforeach
        </select>
        @endif
        </div>
    </div><!-- col-4 -->
    

</div><!-- row -->