<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\CalendarioAluno;
use App\Contrato;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CalendarioAlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($aluno_id, $contrato_id)
    {

        $calendario_jovem = CalendarioAluno::where('aluno_id', $aluno_id)->where('contrato_id', $contrato_id)->count();
        $aluno = Aluno::find($aluno_id);
        $contrato = Contrato::find($contrato_id);

        if($calendario_jovem == 0){

            $qtd_aulas_adaptacao = 10;
            $qtd_aulas_basicas = 50;
            $qtd_dias_contrato = 330;
            $qtd_aulas_especifico = 50;
            $qtd_aulas_praticas = 220;

            /*Verificar no Convênio essas Informações*/
            $dia_aula_basica = 3;
            $dia_aula_especifica = 5;

            $total_dias = 1;

            $tot_adaptacao = 1;
            $tot_basico = 1;
            $tot_pratica = 1;
            $tot_especifico = 1;
            $tot_g = 1;

            while($total_dias <= $qtd_dias_contrato) {

                $data = Carbon::createFromFormat("Y-m-d", $contrato->data_inicial)->addDays($tot_g);
                $dia_semana = date('w', strtotime($data));

                if($dia_semana > 0 && $dia_semana < 6){

                    $calendario = new CalendarioAluno();
                    $calendario->aluno_id = $aluno->id;
                    $calendario->contrato_id = $contrato->id;
                    $calendario->data = $data;

                    if($tot_adaptacao <= $qtd_aulas_adaptacao){

                        $calendario->tipo = 'Adaptação';
                        $calendario->class_color = 'inicial';
                        $tot_adaptacao++;

                    }else{

                        if($tot_basico <= 21){

                            $calendario->tipo = 'Básico';
                            $calendario->class_color = 'basico';
                            $tot_basico++;

                        }else{

                            if($dia_semana == $dia_aula_basica){

                                if($tot_basico <= $qtd_aulas_basicas){

                                    $calendario->tipo = 'Básico';
                                    $calendario->class_color = 'basico';
                                    $tot_basico++;

                                }else{

                                    if($tot_pratica <= $qtd_aulas_praticas){

                                        $calendario->tipo = 'Prática';
                                        $calendario->class_color = 'pratica';
                                        $tot_pratica++;

                                    }else{

                                        $calendario->tipo = 'Específico';
                                        $calendario->class_color = 'especifico';
                                        $tot_especifico++;

                                    }

                                }

                            }else{

                                if($dia_semana == $dia_aula_especifica){

                                    if($tot_basico <= $qtd_aulas_basicas){

                                        $calendario->tipo = 'Prática';
                                        $calendario->class_color = 'pratica';
                                        $tot_pratica++;

                                    }else{

                                        if($tot_especifico <= $qtd_aulas_especifico){

                                            $calendario->tipo = 'Específico';
                                            $calendario->class_color = 'especifico';
                                            $tot_especifico++;

                                        }else{

                                            if($tot_pratica <= $qtd_aulas_praticas){

                                                $calendario->tipo = 'Prática';
                                                $calendario->class_color = 'pratica';
                                                $tot_pratica++;

                                            }else{

                                                $calendario->tipo = 'Específico';
                                                $calendario->class_color = 'especifico';
                                                $tot_especifico++;

                                            }

                                        }

                                    }

                                }else{

                                    if($tot_pratica <= $qtd_aulas_praticas){

                                        $calendario->tipo = 'Prática';
                                        $calendario->class_color = 'pratica';
                                        $tot_pratica++;

                                    }else{

                                        $calendario->tipo = 'Específico';
                                        $calendario->class_color = 'especifico';
                                        $tot_especifico++;

                                    }

                                }

                            }
                        }
                    }

                    $calendario->chamada = null;
                    $calendario->save();

                    $total_dias++;
                }

                $tot_g++;

            }

        }

        $calendario_jovem = CalendarioAluno::where('aluno_id', $aluno_id)->where('contrato_id', $contrato_id)->get();
        $total_dias_calendario = $calendario_jovem->count();
        return view('sistema.contratos.calendario', compact('calendario_jovem', 'total_dias_calendario', 'contrato'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CalendarioAluno  $calendarioAluno
     * @return \Illuminate\Http\Response
     */
    public function show(CalendarioAluno $calendarioAluno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CalendarioAluno  $calendarioAluno
     * @return \Illuminate\Http\Response
     */
    public function edit(CalendarioAluno $calendarioAluno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CalendarioAluno  $calendarioAluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalendarioAluno $calendarioAluno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CalendarioAluno  $calendarioAluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendarioAluno $calendarioAluno)
    {
        //
    }

}
