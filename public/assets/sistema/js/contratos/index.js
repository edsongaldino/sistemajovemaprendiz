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
