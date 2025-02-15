<?php

namespace App;

use App\Helpers\Helper;
use App\Http\Controllers\FaturamentoController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FaturamentoContrato extends Model
{
    protected $table = 'faturamento_contrato';

    public function convenio()
    {
        return $this->belongsTo(Convenio::class, 'convenio_id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function FaturamentoContratoInstituicaoDados()
    {
        return $this->belongsTo(FaturamentoContratoInstituicaoDados::class, 'id', 'faturamento_contrato_id');
    }

    public function FaturamentoContratoEmpresaDados()
    {
        return $this->belongsTo(FaturamentoContratoEmpresaDados::class, 'id', 'faturamento_contrato_id');
    }

    public function FaturarContrato($contrato_id,$faturamento_id, $data_inicial, $data_final){

        if(isset(Auth::user()->id)){
            $user_id = Auth::user()->id;
        }else{
            $user_id = 1;
        }

        $Faturamento = new FaturamentoContrato();
        $Faturamento->user_id = $user_id;
        $Faturamento->contrato_id = $contrato_id;
        $Faturamento->faturamento_id = $faturamento_id;
        $Faturamento->data = Carbon::now();

        $contrato = Contrato::find($contrato_id);

        $faturamentoPadrao = true;

        //Pega a data do último faturamento, se existir ok, senão ele pega a data inicial do contrato
        if((New FaturamentoController())->GetFaturamentoMesAnterior($contrato_id, $data_inicial)){
            //Quando o período for maior que 30 - pegar somente 30 dias
            $Faturamento->data_inicial = $data_inicial;
        }else{
            //Verificar Data do Ultimo Faturamento (Sistema Anterior)
            if($contrato->data_ultimo_faturamento && $contrato->data_ultimo_faturamento <> '0000-00-00'){
                $Faturamento->data_inicial = Carbon::parse($contrato->data_ultimo_faturamento)->addDay(1);
            }else{
                $Faturamento->data_inicial = $contrato->data_inicial;
                $faturamentoPadrao = false;
            }
        }

        //Verifica se o contrato se encerra no mês atual
        if((New FaturamentoController())->GetEncerramentoContratoMesAtual($contrato_id, $data_inicial)){
            $Faturamento->data_final = $contrato->data_final;
            $faturamentoPadrao = false;
        }else{

            $dataDesligamento = (New FaturamentoController())->GetDataDesligamentoContrato($contrato_id, $data_inicial);          

            if($dataDesligamento){
                $Faturamento->data_final = $dataDesligamento;
            }else{
                $Faturamento->data_final = $data_final;
            }
        }

        //Caso seja um faturamento padrão e quantidade de dias do mês seja maior que 30 parametriza o padrão de 30 dias

        $qtdFaltas = Helper::getQtdeFaltas($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id);

        if($faturamentoPadrao){
            $qtdDias = 30;
        }else{
            $qtdDias = Helper::getDiasEntreDatas($Faturamento->data_inicial,$Faturamento->data_final);
        }

        $qtdDiasFaturamento = $qtdDias-$qtdFaltas;

        $valorTabela = Helper::GetUltimaAtualizacaoValorTabela($contrato->convenio->tabela);

        if($contrato->tipo_faturamento == 'Empresa'){
            $Faturamento->valor = ($valorTabela/30)*$qtdDiasFaturamento;
        }else{
            $Faturamento->valor = ($contrato->valor_bolsa/30)*$qtdDiasFaturamento;
        }

        $txAdm = ($valorTabela/30)*$qtdDias;

        $Faturamento->taxa_administrativa = $txAdm;
        $Faturamento->quantidade_dias = $qtdDias;
        //Inserir ISSQN no faturamento da empresa

        //return response()->json(array('status'=>'error', 'msg'=> $Faturamento->data_inicial), 200);

        if($Faturamento->save()):

            if($Faturamento->contrato->tipo_faturamento == 'Instituição'){
                $dados = new FaturamentoContratoInstituicaoDados();
                $dados->faturamento_contrato_id = $Faturamento->id;
                $dados->valor_salario_liquido = $Faturamento->valor - Helper::calcularPer100DeValor($Faturamento->valor, '7.5');
                $dados->valor_decimo_terceiro = Helper::calculaDecimo($Faturamento);
                $dados->valor_ferias = Helper::calculaFerias($Faturamento);
                $dados->valor_terco_ferias = $dados->valor_ferias/3;
                $dados->valor_inss = Helper::calcularPer100DeValor($Faturamento->valor, '25.5') + Helper::calcularPer100DeValor($Faturamento->valor, '7.5');
                $dados->valor_fgts = Helper::calcularPer100DeValor($Faturamento->valor, '2');
                $dados->valor_pis = Helper::calcularPer100DeValor(($Faturamento->valor+$dados->valor_decimo_terceiro+$dados->valor_ferias+$dados->valor_terco_ferias), '2');
                $dados->valor_inss_provisionamento = Helper::calcularPer100DeValor(($dados->valor_decimo_terceiro+$dados->valor_ferias+$dados->valor_terco_ferias), '25.5');
                $dados->valor_fgts_provisionamento = Helper::calcularPer100DeValor(($dados->valor_decimo_terceiro+$dados->valor_ferias+$dados->valor_terco_ferias), '2');
                $dados->valor_pis_provisionamento = Helper::calcularPer100DeValor(($Faturamento->valor+$dados->valor_decimo_terceiro+$dados->valor_ferias+$dados->valor_terco_ferias), '1');
                $dados->valor_beneficios = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Benefícios');
                $dados->valor_descontos = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Falta Trabalho');
                $dados->valor_exames = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Exame Admissional') + Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Exame Demissional') + Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Exame Periodico');
                $dados->valor_uniforme = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Entrega de Uniforme');

                $dados->valor_total = ($dados->valor_salario_liquido+$txAdm+$dados->valor_decimo_terceiro+
                                        $dados->valor_ferias+$dados->valor_terco_ferias+$dados->valor_inss+
                                        $dados->valor_fgts+$dados->valor_inss_provisionamento+$dados->valor_fgts_provisionamento+$dados->valor_pis_provisionamento+
                                        $dados->valor_beneficios+$dados->valor_exames+$dados->valor_uniforme)/*-($dados->valor_descontos)*/;
                // Calcular ISSQN
                $dados->valor_issqn = (New FaturamentoController())->CalculaISSQN($dados->valor_total, $contrato->convenio->percentual_issqn);
                $dados->save();
            }else{
                $dados = new FaturamentoContratoEmpresaDados();
                $dados->faturamento_contrato_id = $Faturamento->id;
                $dados->valor_beneficios = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Benefícios');
                $dados->valor_descontos = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Falta Trabalho');
                $dados->valor_exames = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Exame Admissional') + Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Exame Demissional') + Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Exame Periodico');
                $dados->valor_uniforme = Helper::getAtualizacaoContrato($Faturamento->data_inicial, $Faturamento->data_final, $contrato_id, 'Entrega de Uniforme');

                $dados->valor_total = ($txAdm+$dados->valor_beneficios+$dados->valor_exames+$dados->valor_uniforme)-($dados->valor_descontos);
                // Calcular ISSQN
                $dados->valor_issqn = (New FaturamentoController())->CalculaISSQN($dados->valor_total, $contrato->convenio->percentual_issqn);
                $dados->save();
            }
            return $Faturamento;
        else:
            return false;
        endif;
    }

}
