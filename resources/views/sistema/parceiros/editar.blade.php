@extends('sistema.layout')
@section('conteudo')


    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.html">Sistema</a>
        <a class="breadcrumb-item" href="#">Configurações</a>
        <a class="breadcrumb-item" href="#">Parceiros</a>
        <span class="breadcrumb-item active">Adicionar</span>
      </nav>
    </div><!-- br-pageheader -->

 
    <div class="br-pagebody">
        <div class="br-section-wrapper">

            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"><i class="fa fa-user"></i> Editar Parceiro</h6>
            <p class="mg-b-30 tx-gray-600">Preencha os dados abaixo para adicionar parceiros</p>

            <div class="form-layout form-layout-2">
            <form name="FormParceiro" id="FormParceiro" action="{{ route('sistema.parceiro.update') }}" method="POST">
                @csrf
                @php $acao = "editar"; @endphp
                @include('sistema.parceiros.form')
                <input type="hidden" name="id" value="{{ $parceiro->id ?? '' }}">
                <button type="button" onclick="EnviarFormParceiro();" class="btn btn-info btn-gravar"> <i class="fa fa-save"></i> Atualizar parceiro</button>
            </form>
            </div><!-- form-layout -->

        </div><!-- br-section-wrapper -->
    </div><!-- br-pagebody -->

@endsection