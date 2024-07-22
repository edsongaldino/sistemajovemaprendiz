@extends('sistema.layout')
@section('conteudo')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Contratos</a>
        <span class="breadcrumb-item active">Consultar</span>
    </nav>
</div><!-- br-pageheader -->

<div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
      <h4 class="tx-gray-800 mg-b-5"><i class="fa fa-calendar"></i> Calendário</h4>
      <p class="mg-b-0">Calendário do aluno</p>

     <a href="/sistema/contrato/{{ $contrato->id }}/calendario-pdf" target="_blank"><button class="btn btn-imprimir"><i class="fa fa-print"></i> Imprimir em PDF</button></a>
</div>

<div class="br-pagebody">

    <link href='/assets/sistema/calendar/css/main.css' rel='stylesheet' />
	<script src='/assets/sistema/calendar/js/main.js' type="text/javascript"></script>
    <script>

		document.addEventListener('DOMContentLoaded', function() {
		  var calendarEl = document.getElementById('calendar');

		  var calendar = new FullCalendar.Calendar(calendarEl, {
			headerToolbar: {
			  left: 'prev,next today',
			  center: 'title',
			  right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
			},
			initialDate: '@php echo $contrato->data_inicial @endphp',
			navLinks: true, // can click day/week names to navigate views
			businessHours: true, // display business hours
			editable: false,
			selectable: true,
			events: [
				@php $i=0; foreach($calendario_jovem as $calendario){ $i=$i+1;@endphp{
                    title: '@php echo $calendario->tipo @endphp',
                    start: '@php echo $calendario->data @endphp',
                    className: '@php echo $calendario->class_color @endphp'
                }@php if($i<>$total_dias_calendario){echo ",";}@endphp
                @php } @endphp
			]
		  });
		  calendar.setOption('locale', 'pt-br');
		  calendar.render();
		});

	  </script>
	  <style>

		#calendar {
		  max-width: 110100%0px;
		  margin: 0 auto;
		}

	  </style>

	<div id='calendar'></div>

</div>
@endsection
