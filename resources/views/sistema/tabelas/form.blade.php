<div class="row no-gutters">

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Nome: <span class="tx-danger">*</span></label>
        <input class="form-control" type="text" name="nome" value="{{ $tabela->nome ?? '' }}" placeholder="Nome da Tabela" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Validade: <span class="tx-danger">*</span></label>
        <input class="form-control data" type="text" name="validade" value="{{ Helper::data_br($tabela->validade ?? '') }}" placeholder="Validade" required>
        </div>
    </div><!-- col-4 -->

    <div class="col-md-4">
        <div class="form-group">
        <label class="form-control-label">Valor: <span class="tx-danger">*</span></label>
        <input class="form-control moeda" type="text" name="valor" value="{{ Helper::converte_valor_real(Helper::GetUltimaAtualizacaoValorTabela($tabela)) }}" placeholder="Valor da Tabela" @if($tabela) readonly @endif  required>   
        </div>
    </div><!-- col-4 -->

    <div class="col-md-12">
        <div class="form-group">
        <label class="form-control-label">Descrição da tabela: <span class="tx-danger">*</span></label>
        <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="10" placeholder="Descrição da Tabela (Informações Adicionais)">{{ $tabela->descricao ?? '' }}</textarea>
        </div>
    </div><!-- col-4 -->

</div><!-- row -->