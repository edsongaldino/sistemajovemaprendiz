$('#tipo').change(function (){
  var tipo= ($(this).val());

  if(tipo == "Novo"){
      $("#jovem_reposto").attr('disabled','disabled');
      $(".alunoReposicao").css("display", "none");
  }else {
    if(tipo == "Reposição"){
      $("#jovem_reposto").removeAttr('disabled');
      $(".alunoReposicao").css("display", "block");
    }
  }
});

$('#atuacao_comercial').change(function (){
  var atuacao_comercial = ($(this).val());

  if(atuacao_comercial == "Não"){
      $(".responsavel_captacao").css("display", "none");
  }else {
    if(atuacao_comercial == "Sim"){
      $(".responsavel_captacao").css("display", "block");
    }
  }
});

$('#tipo_cadastro').change(function (){
  var tipo_cadastro= ($(this).val());

  if(tipo_cadastro == "CNPJ"){
    $(".CnpjE").css("display", "block");
    $(".cpfE").css("display", "none");
  }else {
    if(tipo_cadastro == "CPF"){
      $(".CnpjE").css("display", "none");
      $(".cpfE").css("display", "block");
    }
  }
});

$('#tipo_beneficio').change(function (){
  var tipo_beneficio= ($(this).val());

  if(tipo_beneficio == "Férias"){
    $(".Ferias").css("display", "block");
    $(".OutrosBeneficios").css("display", "none");

  }else {
    $(".OutrosBeneficios").css("display", "block");
    $(".Ferias").css("display", "none");
  }
});


function EnviarFormContrato() {

    var tipo = FormContrato.tipo.value;
    var polo_id = FormContrato.polo_id.value;
    var empresa_id = FormContrato.empresa_id.value;
    var curso_id = FormContrato.curso_id.value;
    var tabela_id = FormContrato.tabela_id.value;
    var aluno_id = FormContrato.aluno_id.value;
    var data_inicial = FormContrato.data_inicial.value;
    var data_final = FormContrato.data_final.value;
    var situacao = FormContrato.situacao.value;
    var empresa_contato_id = FormContrato.empresa_contato_id.value;

    if (polo_id == "") {
        swal({title: "Ops", text: "O campo polo deve ser preenchido!", type: "error"});
        FormContrato.polo_id.focus();
        return false;
    }

    if (empresa_id == "") {
        swal({title: "Ops", text: "O campo empresa não pode ser vazio!", type: "error"});
        FormContrato.empresa_id.focus();
        return false;
    }

    if (aluno_id == "") {
        swal({title: "Ops", text: "O aluno precisa ser selecionado!", type: "error"});
        FormContrato.aluno_id.focus();
        return false;
    }

    if (empresa_contato_id == "") {
      swal({title: "Ops", text: "O responsável pelo aluno deve ser selecionado!", type: "error"});
      FormContrato.empresa_contato_id.focus();
      return false;
    }

    if (data_inicial == "") {
        swal({title: "Ops", text: "A data inicial não pode ser vazio!", type: "error"});
        FormContrato.data_inicial.focus();
        return false;
    }

    if (data_final == "") {
        swal({title: "Ops", text: "A data final não pode ser vazio!", type: "error"});
        FormContrato.data_final.focus();
        return false;
    }

    if (situacao == "") {
        swal({title: "Ops", text: "O campo situacao deve ser preenchido!", type: "error"});
        FormContrato.situacao.focus();
        return false;
    }

    if (curso_id == "") {
      swal({title: "Ops", text: "O campo curso não pode ser vazio!", type: "error"});
      FormContrato.curso_id.focus();
      return false;
    }

    if (tabela_id == "") {
      swal({title: "Ops", text: "O campo tabela não pode ser vazio!", type: "error"});
      FormContrato.tabela_id.focus();
      return false;
    }

    if (tipo == "Reposição") {
        var aluno_reposto_id = $("#aluno_reposto_id").val();

        if (aluno_reposto_id == null) {
            swal({title: "Ops", text: "Como você selecionou o tipo Reposição, é obrigatório selecionar o jovem reposto!", type: "info"});
            FormContrato.aluno_reposto.focus();
            return false;
        }
    } 
    

    document.getElementById('FormContrato').submit();
  }


  $(document).on('click', '.excluirContrato', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');

        swal({
            title: "Confirma a exclusão desse contrato?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/contrato/excluir',
            method: 'POST',
            data: {
              id: id,
              "_token": token
            },

          success: function() {
            swal({title: "OK", text: "Registro removido!", type: "success"},
              function(){
                  location.reload();
              }
            );
          },

          error: function() {
            swal({title: "OPS", text: "Erro ao remover registro!", type: "warning"},
              function(){
                  location.reload();
              }
            );
          }
        });
    });
  });

  $(document).on('click', '.excluirAtualizacao', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');

        swal({
            title: "Confirma a exclusão desse item?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/contrato/excluirAtualizacao',
            method: 'POST',
            data: {
              id: id,
              "_token": token
            },

          success: function() {
            swal({title: "OK", text: "Registro removido!", type: "success"},
              function(){
                  location.reload();
              }
            );
          },

          error: function() {
            swal({title: "OPS", text: "Erro ao remover registro!", type: "warning"},
              function(){
                  location.reload();
              }
            );
          }

          });
    });
  });

  /*
  $('#AtualizarSituacao').change(function (){
    var situacao = ($(this).val());

    if(situacao == "Desligado"){
        $("#motivoDesligamento").css("display", "block");
    }else {
        $("#motivoDesligamento").css("display", "none");
    }
  });
  */

  $(document).on('click', '.atualizarCalendario', function (e) {
    e.preventDefault();
    var contrato_id = $(this).data('contrato');
    var aluno_id = $(this).data('aluno');
      swal({
          title: "Confirma a atualização desse calendário?",
          type: "info",
          confirmButtonClass: "btn-info",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não",
          showCancelButton: true,
      },
      function() {
        window.location.href = '/sistema/calendario/aluno/'+ aluno_id +'/contrato/' + contrato_id + '/atualiza';
      });
  });

  function EnviarFormBeneficios() {

    var tipo_beneficio = $("#tipo_beneficio").val();

    if (tipo_beneficio == "") {
      swal({title: "Ops", text: "É obrigatório informar o tipo do benefício!", type: "info"});
      return false;
    }
    

    if (tipo_beneficio == "Férias") {

        var quantidade = $("#qtdeFerias").val();
        var data_inicial = $("#data_inicial").val();
        var data_final = $("#data_final").val();

        if (quantidade == "") {
            swal({title: "Ops", text: "É obrigatório informar a quantidade de dias de férias!", type: "info"});
            FormBeneficios.quantidade.focus();
            return false;
        }

        if (data_inicial == "") {
          swal({title: "Ops", text: "Informe o dia de início das férias!", type: "info"});
          FormBeneficios.data_inicial.focus();
          return false;
        }

        if (data_final == "") {
          swal({title: "Ops", text: "Informe a data final!", type: "info"});
          FormBeneficios.data_final.focus();
          return false;
        }

    }else{
        var data = $("#dataBeneficio").val();
        var valor = $("#valorBeneficio").val();

        if (data == "") {
          swal({title: "Ops", text: "Informe o data corretamente!", type: "info"});
          FormBeneficios.data.focus();
          return false;
        }

        if (valor == "") {
          swal({title: "Ops", text: "O valor do benefício não pode ser nulo!", type: "info"});
          FormBeneficios.valor.focus();
          return false;
        }
    }

    document.getElementById('FormBeneficios').submit();
  }

  if($("#idContrato").val() == null){

    $("#dia_semana_teorico option[value='Terça-feira']").prop('selected', true);
    $("#periodo_teorico option[value='Tarde']").prop('selected', true);
    $("#hora_inicial_teorico").val('13:00:00');
    $("#hora_final_teorico").val('18:00:00');  

    $("#dia_semana_especifico option[value='Sexta-feira']").prop('selected', true);
    $("#periodo_especifico option[value='Tarde']").prop('selected', true);
    $("#hora_inicial_especifico").val('13:00');
    $("#hora_final_especifico").val('18:00');

    $("#periodo_pratico option[value='Tarde']").prop('selected', true);
    $("#hora_inicial_pratico").val('13:00');
    $("#hora_final_pratico").val('18:00');

  }
  