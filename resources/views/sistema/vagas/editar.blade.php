@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Vagas</a>
        <span class="breadcrumb-item active">Editar</span>
      </nav>
    </div><!-- br-pageheader -->

 
    <div class="br-pagebody">
        <div class="br-section-wrapper">

            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-bank"></i> Editar Vaga</h6>
            <p class="mg-b-30 tx-gray-600">Preencha os dados abaixo para editar</p>

            <div class="form-layout form-layout-2">
            <form name="FormVaga" id="FormVaga" action="{{ route('sistema.vaga.update') }}" method="POST">
                @csrf
                @php $acao = "editar"; @endphp
                @include('sistema.vagas.form')
                <input type="hidden" name="id" value="{{ $vaga->id ?? '' }}">
                <button type="button" onclick="EnviarFormVaga();" class="btn btn-info btn-gravar"> <i class="fa fa-save"></i> Atualizar vaga</button>
            </form>
            </div><!-- form-layout -->

        </div><!-- br-section-wrapper -->
    </div><!-- br-pagebody -->
    <script src="{{ asset('assets/sistema/js/vagas/index.js') }}"></script>

@endsection