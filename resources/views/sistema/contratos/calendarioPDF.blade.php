<!DOCTYPE html>
<html>
<head>
<style>
* {box-sizing: border-box;}
ul {list-style-type: none;}
body {font-family: Verdana, sans-serif;}
.calendario{
    width: 1024px;
    margin: auto;
}

.calendario .item-calendario{
    width: 50%;
    height: auto;
    float: left;
    padding: 10px;
    min-height: 360px;
}

.month {
  padding: 20px 25px;
  width: 100%;
  background: #1abc9c;
  text-align: center;
}

.month ul {
  margin: 0;
  padding: 0;
}

.month ul li {
  color: white;
  font-size: 20px;
  text-transform: uppercase;
  letter-spacing: 3px;
}

.weekdays {
  margin: 0;
  padding: 10px 0;
  background-color: #ddd;
}

.weekdays li {
  display: inline-block;
  width: 13%;
  color: #666;
  text-align: center;
  font-size: 14px;
}

.days {
  padding: 10px 0;
  background: #eee;
  margin: 0;
  height: auto;
  min-height: 200px;
}

.days li {
  list-style-type: none;
  display: inline-block;
  width: 13%;
  text-align: center;
  margin-bottom: 5px;
  font-size:12px;
  color: #777;
}

.days li .active {
  padding: 5px;
  background: #1abc9c;
  color: white !important
}

.days li.inicial {
  padding: 5px;
  background-color: rgb(70, 8, 129);
  color: white !important;
}

.days li.basico {
  padding: 5px;
  background-color: rgb(4, 112, 145);
  color: white !important;
}

.days li.pratico {
  padding: 5px;
  background-color: rgb(207, 187, 2);
  color: white !important;
}

.days li.pratica {
  padding: 5px;
  background-color: rgb(207, 187, 2);
  color: white !important;
}

.days li.especifico {
  padding: 5px;
  background-color: rgb(4, 143, 4);
  color: white !important;
}

.days li.feriado {
  padding: 5px;
  background-color: rgb(83, 99, 83);
  color: white !important;
}

.days li.ferias {
  padding: 5px;
  background-color: rgb(3, 43, 3);
  color: white !important;
}


.calendario .capa{
    width: 100%;
    padding: 10px;
}

.calendario .capa .logo-lar{
    width: 200px;
    margin: 50px auto;
}

.calendario .capa .titulo-calendario{
    font-size: 30px;
    text-align: center;
    color: #777;
    margin-top: 50px;
}

.calendario .capa .legenda{
    width: 70%;
    height: 200px;
    margin: 200px auto;
}

.calendario .capa .legenda .titulo-legenda{
    font-size: 20px;
    text-align: center;
    color: #036299;
}

.calendario .capa .legenda .item-legenda{
    width: 100%;
    height: 50px;
    line-height: 50px;
    float: left;
    margin: 10px 0;
}

.calendario .capa .legenda .item-legenda .cor{
    width: 30%;
    height: 50px;
    line-height: 50px;
    float: left;
}

.calendario .capa .legenda .item-legenda .descricao-cor{
    width: 70%;
    height: 50px;
    line-height: 50px;
    float: left;
    background-color: #ddd;
    font-size: 14px;
    padding: 0 15px;
}

.calendario .capa .legenda .item-legenda .cor.inicial {
  background-color: rgb(70, 8, 129);
  color: white !important;
}

.calendario .capa .legenda .item-legenda .cor.basico {
  background-color: rgb(4, 112, 145);
  color: white !important;
}

.calendario .capa .legenda .item-legenda .cor.pratico {
  background-color: rgb(207, 187, 2);
  color: white !important;
}

.calendario .capa .legenda .item-legenda .cor.especifico {
  background-color: rgb(4, 143, 4);
  color: white !important;
}

.calendario .capa .legenda .item-legenda .cor.ferias {
  background-color: rgb(3, 43, 3);
  color: white !important;
}

.calendario .capa .legenda .item-legenda .cor.feriado {
  background-color: rgb(83, 99, 83);
  color: white !important;
}





.break { page-break-before: always; }

/* Add media queries for smaller screens */
@media screen and (max-width:720px) {
  .weekdays li, .days li {width: 13.1%;}
}

@media screen and (max-width: 420px) {
  .weekdays li, .days li {width: 12.5%;}
  .days li .active {padding: 2px;}
}

@media screen and (max-width: 290px) {
  .weekdays li, .days li {width: 12.2%;}
}
</style>
</head>
<body>

<div class="calendario">

    <div class="capa">

        <div class="logo-lar"><img src="/assets/sistema/img/logo-lar-contrato.png" alt=""></div>

        <div class="titulo-calendario">CALENDÁRIO JOVEM APRENDIZ</div>

        <div class="legenda">
            <div class="titulo-legenda">LEGENDA</div>

            <div class="item-legenda">
                <div class="cor inicial"></div>
                <div class="descricao-cor">INICIAL</div>
            </div>

            <div class="item-legenda">
                <div class="cor basico"></div>
                <div class="descricao-cor">BÁSICO</div>
            </div>

            <div class="item-legenda">
                <div class="cor pratico"></div>
                <div class="descricao-cor">PRÁTICO</div>
            </div>

            <div class="item-legenda">
                <div class="cor especifico"></div>
                <div class="descricao-cor">ESPECÍFICO</div>
            </div>

            <div class="item-legenda">
              <div class="cor ferias"></div>
              <div class="descricao-cor">FÉRIAS</div>
            </div>

            <div class="item-legenda">
              <div class="cor feriado"></div>
              <div class="descricao-cor">FERIADOS</div>
            </div>

        </div>
    </div>


    <div class="break"></div>

    @foreach($mesesContrato as $mes)

    <div class="item-calendario">

        <div class="month">
            <ul>
                <li>
                {{ Helper::mesExtenso($mes->mes) }}<br>
                <span style="font-size:18px">{{ $mes->ano }}</span>
                </li>
            </ul>
        </div>

        <ul class="weekdays">
            <li>Dom</li>
            <li>Seg</li>
            <li>Ter</li>
            <li>Qua</li>
            <li>Qui</li>
            <li>Sex</li>
            <li>Sáb</li>
        </ul>


        <ul class="days">
            @php
            $datas_mes = array();
            if($mes->mes < 10){
                $mesData = '0'.$mes->mes;
            }else{
                $mesData = $mes->mes;
            }
            $data_inicial_mes = $mes->ano.'-'.$mesData.'-01';

            $ultimo_dia_mes = date("t", mktime(0,0,0,$mesData,'01',$mes->ano));

            $calendario_jovem = Helper::getCalendarioMes($contrato->id,$contrato->aluno_id,$data_inicial_mes,$mes->ano.'-'.$mesData.'-'.$ultimo_dia_mes);
            foreach($calendario_jovem as $calendario){
                $datas_mes[$calendario->data] = $calendario->class_color;
            }

            @endphp

            @for($i = 1; $i <= $ultimo_dia_mes;)

                @php

                    if($i < 10){
                        $dia = '0'.$i;
                    }else{
                        $dia = $i;
                    }

                    $data_atual = $mes->ano.'-'.$mesData.'-'.$dia;

                    if(in_array($data_atual, array_keys($datas_mes))) {
                        $classe = $datas_mes[$data_atual];
                    }else{
                        $classe = 'padrao';
                    }
                @endphp

                @if($i == 1)
                    @php
                    $dia_semana = Helper::ParteData($data_inicial_mes,'semana');
                    @endphp
                    @switch($dia_semana)

                        @case(1)
                            <li></li>
                            @break

                        @case(2)
                            <li></li>
                            <li></li>
                            @break

                        @case(3)
                            <li></li>
                            <li></li>
                            <li></li>
                            @break

                        @case(4)
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            @break

                        @case(5)
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            @break

                        @case(6)
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            @break

                    @endswitch
                    <li class="{{ $classe }}">{{ $i }}</li>
                @else
                <li class="{{ $classe }}">{{ $i }}</li>
                @endif

            @php $i++; @endphp
            @endfor
        </ul>
    </div>
    @endforeach

</div>

<script>
    window.print();
</script>

</body>
</html>
