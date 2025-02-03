<?php

namespace App\Helpers;

use App\Aluno;
use App\AtualizacoesContrato;
use App\AtualizacoesTabela;
use App\CalendarioAluno;
use App\Contrato;
use App\Convenio;
use App\Faturamento;
use App\FaturamentoContrato;
use App\FaturamentoCredito;
use App\Feriado;
use App\Http\Controllers\AtualizacoesContratoController;
use App\Tabela;
use DateTime;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Carbon;

class Helper{

	public static function converte_reais_to_mysql($valor) {
		$valor = str_replace('.', '', $valor);
		$valor = str_replace(',', '.', $valor);

		return $valor;
	}


	public static function converte_valor_real($valor) {
		if (is_numeric($valor)) {
			try {
				$valor = number_format($valor,2,",",".");
			} catch (\Exception $e) {
				return $valor;
			}

			if($valor > 0) {
				return $valor;
			} else {
				return 0;
			}
		}
	}

	/*
	public static function response($content = '', $status = 200, array $headers = []){
		$factory = app(ResponseFactory::class);

		if (func_num_args() === 0) {
			return $factory;
		}

		return $factory->make($content, $status, $headers);
	}*/

	public static function limpa_campo($valor){
		$valor = preg_replace("/\D+/", "", $valor); // remove qualquer caracter não numérico
		return $valor;
	}

	/*
	public static function isMobile(){
		$agent = new Agent();
		return $agent->isMobile();
	}
	*/

	public static function data_br($data,$retorno = "00/00/0000") {
		if($data) {
			if($data != "0000-00-00") {
				$data = explode("-",$data);
				return $data[2]."/".$data[1]."/".$data[0];
			} else {
				return $retorno;
			}
		} else {
			return $retorno;
		}
	}

	public static function calcularIdade($data){
		$idade = 0;
		$data_nascimento = date('Y-m-d', strtotime($data));
		   $data = explode("-",$data_nascimento);
		   $anoNasc    = $data[0];
		   $mesNasc    = $data[1];
		   $diaNasc    = $data[2];

		   $anoAtual   = date("Y");
		   $mesAtual   = date("m");
		   $diaAtual   = date("d");

		   $idade      = ((int)$anoAtual) - ((int)$anoNasc);
		   if ($mesAtual < $mesNasc){
			   $idade -= 1;
		   } elseif ( ($mesAtual == $mesNasc) && ($diaAtual <= $diaNasc) ){
			   $idade -= 1;
		   }

		   return $idade;
	}

	public static function data_mysql($data,$retorno = "0000-00-00") {
		if($data) {
			$data = explode("/",$data);
			return $data[2]."-".$data[1]."-".$data[0];
		} else {
			return $retorno;
		}
	}

	public static function datetime_br($data){

		$data = Carbon::parse($data)->format('Y-m-d');
		return Helper::data_br($data);

	}

	public static function datetime_mysql($data){

		$data = Carbon::parse($data)->format('Y-m-d');
		return $data;

	}

	public static function calcula_idade($data_nascimento){
		return Carbon::parse($data_nascimento)->age;
	}

	public static function GetTotal($tipo){
		switch ($tipo){
            case $tipo == "Convenios":
                $total = Convenio::count();
                break;

            case $tipo == "Contratos":
                $total = Contrato::count();
                break;

			case $tipo == "Alunos":
                $total = Aluno::count();
                break;
        }

        return $total;
	}

	public static function GetTotalContratosAtivos($convenio_id){
		$total = Contrato::where('convenio_id', $convenio_id)->where('situacao', 'Ativo')->count();
        return $total;
	}

	public static function dataExtenso($data) {


		$data = explode("-",$data);
		$dia = $data[2];
		$mes = $data[1];
		$ano = $data[0];

		switch ($mes){

			case 1: $mes = "Janeiro"; break;
			case 2: $mes = "Fevereiro"; break;
			case 3: $mes = "Março"; break;
			case 4: $mes = "Abril"; break;
			case 5: $mes = "Maio"; break;
			case 6: $mes = "Junho"; break;
			case 7: $mes = "Julho"; break;
			case 8: $mes = "Agosto"; break;
			case 9: $mes = "Setembro"; break;
			case 10: $mes = "Outubro"; break;
			case 11: $mes = "Novembro"; break;
			case 12: $mes = "Dezembro"; break;

		}

		return $dia." de ".$mes." de ".$ano;

	}

    public static function ParteData($data, $tipo) {


		$dat = explode("-",$data);
		$dia = $dat[2];
		$mes = $dat[1];
		$ano = $dat[0];

		switch ($mes){

			case 1: $mes = "Janeiro"; break;
			case 2: $mes = "Fevereiro"; break;
			case 3: $mes = "Março"; break;
			case 4: $mes = "Abril"; break;
			case 5: $mes = "Maio"; break;
			case 6: $mes = "Junho"; break;
			case 7: $mes = "Julho"; break;
			case 8: $mes = "Agosto"; break;
			case 9: $mes = "Setembro"; break;
			case 10: $mes = "Outubro"; break;
			case 11: $mes = "Novembro"; break;
			case 12: $mes = "Dezembro"; break;

		}

        switch ($tipo){

			case 'dia': return $dia; break;
			case 'mes': return $mes; break;
            case 'ano': return $ano; break;
            case 'semana':
                return date('w', strtotime($data));
            break;
            case 'mesAno': return $ano.'-'.$dat[1]; break;

		}

	}


    public static function mesExtenso($mes) {

		switch ($mes){

			case 1: $mes = "Janeiro"; break;
			case 2: $mes = "Fevereiro"; break;
			case 3: $mes = "Março"; break;
			case 4: $mes = "Abril"; break;
			case 5: $mes = "Maio"; break;
			case 6: $mes = "Junho"; break;
			case 7: $mes = "Julho"; break;
			case 8: $mes = "Agosto"; break;
			case 9: $mes = "Setembro"; break;
			case 10: $mes = "Outubro"; break;
			case 11: $mes = "Novembro"; break;
			case 12: $mes = "Dezembro"; break;

		}

        return $mes;

	}

    public static function getCalendarioMes($contrato, $aluno, $data_inicial, $data_final){
        return CalendarioAluno::where('contrato_id', $contrato)->where('aluno_id', $aluno)->whereBetween('data', [$data_inicial, $data_final])->get();
    }

	public static function getQtdeFaltas($data_inicial, $data_final, $contrato_id){

        $contrato = Contrato::find($contrato_id);

		$tipoBusca = 'Falta Trabalho';

        $ultimoFaturamento = FaturamentoContrato::where('contrato_id',$contrato->id)->OrderBy('id','desc')->skip(1)->take(1)->first();
        //Se já houver um faturamento anterior para o contrato, pega á partir da data até hoje

        if(isset($ultimoFaturamento)){
            $data_inicial = Carbon::parse($ultimoFaturamento->data)->addDay(1)->format('Y-m-d');
            $data_final = Carbon::now()->format('Y-m-d');
        }

		$atualizacoes =	AtualizacoesContrato::where(function ($query) use ($contrato_id,$tipoBusca) {
												$query->where('contrato_id',$contrato_id)->where('tipo', $tipoBusca);
												})->where(function ($query) use ($data_inicial,$data_final){
													$query->whereBetween('data', [$data_inicial, $data_final])->orWhere('faturamento_contrato_id', null);
												})->get();

		return $atualizacoes->count();

    }



    public static function getAtualizacaoContrato($data_inicial, $data_final, $contrato_id, $tipo){

        $contrato = Contrato::find($contrato_id);

		$tipoBusca = $tipo;

		if($tipo == 'Qtde Falta Trabalho'){
			$tipoBusca = 'Falta Trabalho';
		}

        $ultimoFaturamento = FaturamentoContrato::where('contrato_id',$contrato->id)->OrderBy('id','desc')->skip(1)->take(1)->first();
        //Se já houver um faturamento anterior para o contrato, pega á partir da data até hoje

        if(isset($ultimoFaturamento)){
            $data_inicial = Carbon::parse($ultimoFaturamento->data)->addDay(1)->format('Y-m-d');
            $data_final = Carbon::now()->format('Y-m-d');
        }

		$atualizacoes =	AtualizacoesContrato::where(function ($query) use ($contrato_id,$tipoBusca) {
												$query->where('contrato_id',$contrato_id)->where('tipo', $tipoBusca);
												})->where(function ($query) use ($data_inicial,$data_final){
													$query->whereBetween('data', [$data_inicial, $data_final])->orWhere('faturamento_contrato_id', null);
												})->get();


		$FaturamentoAtual = FaturamentoContrato::where('contrato_id',$contrato->id)->OrderBy('id','desc')->first();
		(new AtualizacoesContratoController())->incluiAtualizacaoNoFaturamento($atualizacoes, $FaturamentoAtual->id);

        switch($tipo){

            case "Falta Trabalho":
				if($atualizacoes->count() > 0){
					return $atualizacoes->count()*($contrato->valor_bolsa/30);
				}else{
					return 0;
				}
            break;

            case "Entrega de Uniforme":
                return $atualizacoes->sum('valor');
            break;

            case "Exame Admissional" || "Exame Demissional" || "Exame Periodico":
                return $atualizacoes->sum('valor');
            break;

            case "Qtde Falta Trabalho":
                return $atualizacoes->count();
            break;

            case "Benefícios":
                return $atualizacoes->count();
            break;

        }

    }

	public static function getLancamentosFaturamento($faturamento_contrato_id, $tipo){


        switch($tipo){

            case "Qtde Falta Trabalho":
				$atualizacoes =	AtualizacoesContrato::where('faturamento_contrato_id', $faturamento_contrato_id)->where('tipo', 'Falta Trabalho')->get();
                return $atualizacoes->count();
            break;

            case "Benefícios":
				$atualizacoes =	AtualizacoesContrato::where('faturamento_contrato_id', $faturamento_contrato_id)->where('tipo', 'Benefícios')->get();
                return $atualizacoes->count();
            break;

        }

    }

    public static function getDiasEntreDatas($data_inicial, $data_final){

        $diferenca = strtotime($data_final) - strtotime($data_inicial);
        $dias = floor($diferenca / (60 * 60 * 24))+1;
        return $dias;

    }

	public static function getSituacaoByString($situacao){

        switch($situacao){

            case "LIQUIDACAO":
                return "LIQUIDADO";
            break;

			case "":
                return "EMITIDO";
            break;

			case "REGISTRO_CONFIRMADO":
                return "EMITIDO";
            break;

			default:
                return $situacao;
            break;

        }

    }

    public static function calcularDesconto(float $valor, float $p_desconto): float
    {
        $resultado = $valor - ($valor * $p_desconto / 100);
        return round($resultado, 2);
    }

    public static function calcularAcrescimo(float $valor, float $p_acrescimo): float
    {
        $resultado = $valor + ($valor * $p_acrescimo / 100);
        return round($resultado, 2);
    }

    public static function calcularPer100DeValor(float $valor, float $percentual): float
    {
        $resultado = ($valor * $percentual / 100);
        return round($resultado, 2);
    }

    public static function calculaDecimo($Faturamento){
        //calculo
        $tempo_contrato = Helper::getDiasEntreDatas($Faturamento->data_inicial, $Faturamento->data_final);
		$totalFaturamentos = FaturamentoContrato::where('contrato_id', $Faturamento->contrato_id)->count();

        switch ($tempo_contrato){
            case $tempo_contrato <= 14:
                $valor = 0;
                break;

            case $tempo_contrato > 14 && $tempo_contrato <= 44:
                $valor = $Faturamento->contrato->valor_bolsa/12;
                break;

			case $tempo_contrato > 44 && $totalFaturamentos == 1:
                $valor = ($Faturamento->contrato->valor_bolsa/12)*2;
                break;

			default:
				$valor = $Faturamento->contrato->valor_bolsa/12;
				break;
        }

        return $valor;

    }

    public static function calculaFerias($Faturamento){
        //calculo
        $tempo_contrato = Helper::getDiasEntreDatas($Faturamento->data_inicial, $Faturamento->data_final);
		$totalFaturamentos = FaturamentoContrato::where('contrato_id', $Faturamento->contrato_id)->count();

        switch ($tempo_contrato){
            case $tempo_contrato <= 14:
                $valor = 0;
                break;

            case $tempo_contrato > 14 && $tempo_contrato <= 44:
                $valor = $Faturamento->contrato->valor_bolsa/12;
                break;

			case $tempo_contrato > 44 && $totalFaturamentos == 1:
                $valor = ($Faturamento->contrato->valor_bolsa/12)*2;
                break;

			default:
				$valor = $Faturamento->contrato->valor_bolsa/12;
				break;

        }

        return $valor;
    }

    public static function getFaturamentoContrato($faturamento, $contrato){
        return FaturamentoContrato::where('contrato_id', $contrato)->where('faturamento_id', $faturamento)->whereNull('deleted_at')->first();
    }

    public static function getFaturamentoConvenio($convenio, $data_inicial, $data_final){
        return Faturamento::where('convenio_id', $convenio)->whereDate('data_inicial', $data_inicial)->whereDate('data_final', $data_final)->whereNull('deleted_at')->get();
    }

	public static function Phone($number){
		$number="(".substr($number,0,2).") ".substr($number,2,-4)." - ".substr($number,-4);
		// primeiro substr pega apenas o DDD e coloca dentro do (), segundo subtr pega os números do 3º até faltar 4, insere o hifem, e o ultimo pega apenas o 4 ultimos digitos
		return $number;
	}

	public static function mask($valor, $mask)
	{
		$maskared = '';
		$val = Helper::limpa_campo($valor);
		$k = 0;
		for($i = 0; $i<=strlen($mask)-1; $i++)
		{
		if($mask[$i] == '#')
		{
			if(isset($val[$k]))
			$maskared .= $val[$k++];
		}
		else
		{
			if(isset($mask[$i]))
			$maskared .= $mask[$i];
			}
		}
		return $maskared;
		/*
		$cnpj = "11222333000199";
		$cpf = "00100200300";
		$cep = "08665110";
		$data = "10102010";

		echo mask($cnpj,'##.###.###/####-##');
		echo mask($cpf,'###.###.###-##');
		echo mask($cep,'#####-###');
		echo mask($data,'##/##/####');
		*/
	}

    public static function GetValorTotalFaturado($faturamento_id){

        $faturamentos = FaturamentoContrato::where('faturamento_id', $faturamento_id)->whereNull('deleted_at')->get();
		$credito = FaturamentoCredito::where('faturamento_id', $faturamento_id)->first();
        $totalGeral = 0;

        foreach($faturamentos as $faturamento){

            if($faturamento->contrato->tipo_faturamento ?? '' == 'Instituição'){
                $totalGeral += ($faturamento->FaturamentoContratoInstituicaoDados->valor_total ?? '0') + ($faturamento->FaturamentoContratoInstituicaoDados->valor_issqn ?? '0');
            }else{
                $totalGeral += ($faturamento->FaturamentoContratoEmpresaDados->valor_total ?? '0') + ($faturamento->FaturamentoContratoEmpresaDados->valor_issqn ?? '0');
            }

        }
		if(isset($credito)){
			$totalGeral = $totalGeral - $credito->valor_credito;
		}

        return $totalGeral;

    }

	public static function GetUltimaAtualizacaoValorTabela(Tabela $tabela){

		$UltimaAtualizacao = AtualizacoesTabela::where('tabela_id', $tabela->id)->orderBy('id','desc')->first();

		if(!$UltimaAtualizacao){
			return $tabela->valor;
		}

		if($UltimaAtualizacao->atualizacao->data_atualizacao <= date('Y-m-d')){
			return $UltimaAtualizacao->novo_valor;
		}else{
			return $UltimaAtualizacao->valor_atual;
		}
	}

	public static function dias_feriados($ano = null){
		if (empty($ano)) {
			$ano = intval(date('Y'));
		}

		$pascoa = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
		$dia_pascoa = date('j', $pascoa);
		$mes_pascoa = date('n', $pascoa);
		$ano_pascoa = date('Y', $pascoa);

		$feriados = [
			// Tatas Fixas dos feriados Nacionail Basileiras
			mktime(0, 0, 0, 1, 1, $ano), // Confraternização Universal - Lei nº 662, de 06/04/49
			mktime(0, 0, 0, 4, 21, $ano), // Tiradentes - Lei nº 662, de 06/04/49
			mktime(0, 0, 0, 5, 1, $ano), // Dia do Trabalhador - Lei nº 662, de 06/04/49
			mktime(0, 0, 0, 9, 7, $ano), // Dia da Independência - Lei nº 662, de 06/04/49
			mktime(0, 0, 0, 10, 12, $ano), // N. S. Aparecida - Lei nº 6802, de 30/06/80
			mktime(0, 0, 0, 11, 2, $ano), // Todos os santos - Lei nº 662, de 06/04/49
			mktime(0, 0, 0, 11, 15, $ano), // Proclamação da republica - Lei nº 662, de 06/04/49
			mktime(0, 0, 0, 11, 20, $ano), // Dia Nacional de Zumbi e da Consciência Negra - Lei nº 14.759, de 2023
			mktime(0, 0, 0, 12, 25, $ano), // Natal - Lei nº 662, de 06/04/49

			// Essas Datas depem diretamente da data de Pascoa
			// mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48, $ano_pascoa), // 2ºferia Carnaval
			mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47, $ano_pascoa), // 3ºferia Carnaval
			mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2, $ano_pascoa), // 6ºfeira Santa
			mktime(0, 0, 0, $mes_pascoa, $dia_pascoa, $ano_pascoa), // Páscoa
			mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60, $ano_pascoa), // Corpus Cirist

		];

		sort($feriados);

		return $feriados;
	}

	public static function verificarFeriado($data, $boolean = false) {

		$param = array();

		// Sua chave (exigida após 01/08/2016!), leia no final dessa postagem!
		$param['key'] = '3d2a446b-29b9-438c-8779-af3d941844a4';

		// Listas de países suportados!
		$paisesSuportados = array('BE', 'BG', 'BR', 'CA', 'CZ', 'DE', 'ES', 'FR', 'GB', 'GT', 'HR', 'HU', 'ID', 'IN', 'IT', 'NL', 'NO', 'PL', 'PR', 'SI', 'SK', 'US');

		// Define o pais para buscar feriados
		$param['country'] = $paisesSuportados[2];

		// Quebra a string em partes (em ano, mes e dia)
		list($param['year'], $param['month'], $param['day']) = explode('-', $data);

		// Converte a array em parâmetros de URL
		$param = http_build_query($param);

		// Conecta na API
		$curl = curl_init('https://holidayapi.com/v1/holidays?'.$param);

		// Permite retorno
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		// Obtem dados da API
		$dados = json_decode(curl_exec($curl), true);

		// Encerra curl
		curl_close($curl);

		// Retorna true/false se houver $boolean ou Nome_Do_Feriado/false se não houve $boolean
		return isset($dados['holidays']['0']) ? $boolean ? true : $dados['holidays']['0']['name'] : false;

	}

	public static function obterIdDiaSemana($dia) {
		$diasSemana = [
			'Domingo' => 0,
			'Segunda-feira' => 1,
			'Terça-feira' => 2,
			'Quarta-feira' => 3,
			'Quinta-feira' => 4,
			'Sexta-feira' => 5,
			'Sábado' => 6
		];
	
		//$dia = strtolower($dia); // Para garantir que a comparação seja insensível a maiúsculas/minúsculas
	
		if (array_key_exists($dia, $diasSemana)) {
			return $diasSemana[$dia];
		} else {
			return "Dia inválido"; // Retorna uma mensagem de erro caso o dia não exista
		}
	}


	public static function ValorTotalRecebido($faturamentos){
		$valorTotal = 0;
		foreach($faturamentos as $faturamento){
			if(isset($faturamento->boleto)){
				if($faturamento->boleto->status == "LIQUIDACAO"){
					$valorTotal += $faturamento->boleto->valor+$faturamento->boleto->valor_juros;
				}
			}
			elseif(isset($faturamento->informePagamento)){
				$valorTotal += $faturamento->informePagamento->valor_pago;
			}
		}
		return $valorTotal;
	}

	public static function ValorTotalReceber($faturamentos){
		$valorTotal = 0;
		foreach($faturamentos as $faturamento){
			if(($faturamento->situacao <> "Liquidado") && (!$faturamento->informePagamento)){
				$valorTotal += Helper::GetValorTotalFaturado($faturamento->id);
			}
		}
		return $valorTotal;
	}

	public static function ValorTotalVencido($faturamentos){
		$valorTotal = 0;
		foreach($faturamentos as $faturamento){
			if(isset($faturamento->boleto)){
				if($faturamento->boleto->status == "VENCIDO"){
					$valorTotal += $faturamento->boleto->valor+$faturamento->boleto->valor_juros;
				}
			}
		}
		return $valorTotal;
	}

	public static function GetTipoRelatorioByID($id){

		switch($id){
			case 1:
				$tipo = "À Receber (Geral)";
				break;
			case 2:
				$tipo = "Recebidos";
				break;
			case 3:
				$tipo = "Vencidos";
				break;
				case 4:
					$tipo = "À Receber (Venc. Período)";
					break;
					case 5:
						$tipo = "Faturados (Período)";
						break;
						case 6:
							$tipo = "À Faturar (Período)";
							break;
			default:
				$tipo = "Á Receber";
				break;
		}

        return $tipo;

    }

	public static function removeAcentos($string){
    	return strtr(utf8_decode(html_entity_decode($string)),utf8_decode('ÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ'),'AAAAEEIOOOUUCNaaaaeeiooouucn');
	}

	public static function IsFeriado($data, $cidade, $estado){

    	$BuscaFeriados = Feriado::where('data', Helper::datetime_mysql($data))->get();
		$feriado = false;
		foreach($BuscaFeriados as $feriado){
			if($feriado->cidade_id == $cidade || $feriado->estado_id == $estado){
				$feriado = true;
			}
		}
		return $feriado;

	}

	public static function IsFerias($data, $contrato_id){

		$atualizacoes = AtualizacoesContrato::where('contrato_id', $contrato_id)->where('tipo', 'Férias')->get();
		$feriado = false;

		foreach($atualizacoes as $atualizacao){

			$dataAtual   = new DateTime($data); // Today
			$dataInicial = new DateTime($atualizacao->data_inicial);
			$dataFinal   = new DateTime($atualizacao->data_final);

			if ($dataAtual >= $dataInicial && $dataAtual <= $dataFinal->modify('+1 day')) {
				$feriado = true;
			}

		}
		
		return $feriado;

	}

	public static function obterIdSemana($data) {
		// Converte a data para o formato de timestamp
		$timestamp = strtotime($data);
		
		// Retorna o número da semana para a data fornecida
		return date('W', $timestamp);
	}

	public static function valor_por_extenso($valor = 0, $maiusculas = false) {
		if(!$maiusculas){
			$singular = ["centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão"];
			$plural = ["centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões"];
			$u = ["", "um", "dois", "três", "quatro", "cinco", "seis",  "sete", "oito", "nove"];
		}else{
			$singular = ["CENTAVO", "REAL", "MIL", "MILHÃO", "BILHÃO", "TRILHÃO", "QUADRILHÃO"];
			$plural = ["CENTAVOS", "REAIS", "MIL", "MILHÕES", "BILHÕES", "TRILHÕES", "QUADRILHÕES"];
			$u = ["", "um", "dois", "TRÊS", "quatro", "cinco", "seis",  "sete", "oito", "nove"];
		}
	
		$c = ["", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"];
		$d = ["", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa"];
		$d10 = ["dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove"];
	
		$z = 0;
		$rt = "";
	
		$valor = number_format($valor, 2, ".", ".");
		$inteiro = explode(".", $valor);
		for($i=0;$i<count($inteiro);$i++)
		for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
		$inteiro[$i] = "0".$inteiro[$i];
	
		$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
		for ($i=0;$i<count($inteiro);$i++) {
			$valor = $inteiro[$i];
			$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
			$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
			$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
	
			$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
			$ru) ? " e " : "").$ru;
			$t = count($inteiro)-1-$i;
			$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
			if ($valor == "000")$z++; elseif ($z > 0) $z--;
			if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
			if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
		}
	
		if(!$maiusculas){
			$return = $rt ? $rt : "zero";
		} else {
			if ($rt) $rt = str_replace(" E "," e ",ucwords($rt));
				$return = ($rt) ? ($rt) : "Zero" ;
		}
	
		if(!$maiusculas){
			return str_replace(" E "," e ",ucwords($return));
		}else{
			return strtoupper($return);
		}
	}


	public static function GetDataVencimentoFaturamento($faturamento){

		if(isset($faturamento->notaFiscal->created_at)){
            $dataNF = $faturamento->notaFiscal->created_at;
        }else{
            $dataNF = $faturamento->created_at;
        }

		switch($faturamento->convenio->vencimento_boleto){

            case "Todo dia 15":
                $data_vencimento = date('Y-m', strtotime($dataNF)).'-15';
                break;

                case "Todo dia 20":
                    $data_vencimento = date('Y-m', strtotime($dataNF)).'-20';
                    break;

                    case "Todo dia 22":
                        $data_vencimento = date('Y-m', strtotime($dataNF)).'-22';
                        break;

                        case "Todo dia 24":
                            $data_vencimento = date('Y-m', strtotime($dataNF)).'-24';
                            break;

                            case "Todo dia 25":
                                $data_vencimento = date('Y-m', strtotime($dataNF)).'-25';
                                break;

                                case "Todo dia 28":
                                    $data_vencimento = date('Y-m', strtotime($dataNF)).'-28';
                                    break;

            case "10 dias após a emissão":
                $data_vencimento = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addDays(10);
                break;

                case "21 dias após a emissão":
                    $data_vencimento = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addDays(21);
                    break;

                    case "28 dias após a emissão":
                        $data_vencimento = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addDays(28);
                        break;

                        case "30 dias após a emissão":
                            $data_vencimento = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addDays(30);
                            break;

                            case "45 dias após a emissão":
                                $data_vencimento = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addDays(45);
                                break;

                                case "60 dias após a emissão":
                                    $data_vencimento = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addDays(60);
                                    break;

            case "Faturamento + 30 Dias":
                $data_vencimento = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addDays(30);
                break;

                case "Faturamento + 45 Dias":
                    $data_vencimento = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addDays(45);
                    break;

            case "Dia 01 do próximo mês":
                $data = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addMonths(1);
                $data_vencimento = date('Y-m', strtotime($data)).'-01';
                break;

                case "Dia 05 do próximo mês":
                    $data = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addMonths(1);
                    $data_vencimento = date('Y-m', strtotime($data)).'-05';
                    break;

                    case "Dia 10 do próximo mês":
                        $data = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addMonths(1);
                        $data_vencimento = date('Y-m', strtotime($data)).'-10';
                        break;

            default:
                $data_vencimento = Carbon::createFromFormat("Y-m-d", date('Y-m-d', strtotime($dataNF)))->addDays(30);
                break;
        }

		return $data_vencimento;
	}


}

?>
