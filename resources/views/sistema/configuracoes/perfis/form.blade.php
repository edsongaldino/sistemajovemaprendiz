<div class="row no-gutters">
    <div class="col-md-8">
        <div class="form-group">
        <label class="form-control-label">Nome do Perfil: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="nome" value="{{ $perfil->nome ?? '' }}" placeholder="Nome do perfil" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Selecione o tipo do perfil: <span class="tx-danger">*</span></label>
        <select class="form-control" id="tipo_perfil" name="tipo_perfil" data-placeholder="Selecione a tipo">
            <option label="Selecione o tipo"></option>
            <option value="Gestão" @if(($perfil->tipo_perfil ?? '') == "Gestão") selected @endif>Gestão (Interno)</option>
            <option value="Empresa" @if(($perfil->tipo_perfil ?? '') == "Empresa") selected @endif>Empresa (Externo)</option> 
            <option value="Parceiro" @if(($perfil->tipo_perfil ?? '') == "Parceiro") selected @endif>Parceiro (Externo)</option> 
        </select>
        </div>
    </div>


    <div id="gestao" class="col-md-12">

    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20"><i class="fa fa-cog"></i> Permissões</h6>

    <div class="row">
    @foreach ($sessoes as $sessao)

    <div class="col-md-12 mg-t--1 mg-md-t-20">
        <div class="form-group mg-md-l--1">
        <label class="form-control-label titulo-sessao">{{ $sessao->nome }}: <span class="tx-danger">*</span></label>
        <input type="hidden" name="{{ $sessao->chave }}[]" value="{{ $sessao->id }}">
        <div class="row">
    
            <div class="col-lg-3">
              <label class="ckbox">
                <input type="checkbox" name="{{ $sessao->chave_permissao }}[]" value="Visualizar"><span>Visualizar</span>
              </label>
            </div><!-- col-3 -->
            <div class="col-lg-3">
                <label class="ckbox">
                    <input type="checkbox" name="{{ $sessao->chave_permissao }}[]" value="Adicionar"><span>Adicionar</span>
                </label>
            </div><!-- col-3 -->
            <div class="col-lg-3">
                <label class="ckbox">
                    <input type="checkbox" name="{{ $sessao->chave_permissao }}[]" value="Editar"><span>Editar</span>
                </label>
            </div><!-- col-3 -->
            <div class="col-lg-3">
                <label class="ckbox">
                    <input type="checkbox" name="{{ $sessao->chave_permissao }}[]" value="Excluir"><span>Excluir</span>
                </label>
            </div><!-- col-3 -->
            
          </div><!-- row -->

        </div>
    </div><!-- col-4 -->

    @endforeach
    </div>

</div>
    
</div><!-- row -->