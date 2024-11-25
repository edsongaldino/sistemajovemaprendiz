<div class="row no-gutters">
    <div class="col-md-6">
        <div class="form-group">
        <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="nome" value="{{ $cadastro->nome_completo ?? '' }}" placeholder="Nome do aluno" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
        <input class="form-control" id="sexo" type="text" name="sexo" value="{{ $cadastro->sexo ?? '' }}" placeholder="Sexo" required>
        </div>
    </div><!-- col-4 -->
   
    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Data de Nascimento: <span class="tx-danger">*</span></label>
        <input class="form-control DataNascimentoAluno" type="text" name="data_nascimento" id="dateMask" value="{{ Helper::data_br($cadastro->data_nascimento ?? '') }}" placeholder="00/00/0000" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">Telefone (Whatsapp): <span class="tx-danger">*</span></label>
        <input class="form-control" id="phoneMask2" type="text" name="whatsapp" value="{{ $cadastro->whatsapp ?? '' }}" placeholder="Whatsapp" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-5">
        <div class="form-group">
        <label class="form-control-label">E-mail: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="email" value="{{ $cadastro->email ?? '' }}" placeholder="E-mail do aluno" required>
        </div>
    </div><!-- col-4 -->
    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Período de Estudo: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="periodo_estudo" value="{{ $cadastro->periodo_estudo ?? '' }}" placeholder="E-mail do aluno" required>
        </div>
    </div><!-- col-4 -->
  
    <h6 class="col-md-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20 mg-t-20"><i class="icon ion-location"></i> Endereço do Aluno</h6>

    <div class="col-md-3 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label">CEP: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="cep" name="cep" value="{{ $cadastro->cep ?? '' }}" placeholder="CEP" required>
        </div>
    </div><!-- col-4 -->
    
    <div class="col-md-3">
        <div class="form-group">
        <label class="form-control-label">Bairro: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="bairro" name="bairro" value="{{ $cadastro->bairro ?? '' }}" placeholder="Bairro" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Cidade: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="cidade" name="cidade" value="{{ $cadastro->cidade ?? '' }}" placeholder="Cidade" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-2">
        <div class="form-group">
        <label class="form-control-label">UF: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" id="estado" name="estado" value="{{ $cadastro->estado ?? '' }}" placeholder="UF" required>
        </div>
    </div><!-- col-4 -->

</div><!-- row -->