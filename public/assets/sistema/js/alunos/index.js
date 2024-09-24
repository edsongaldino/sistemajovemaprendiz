$('#estado_civil').change(function (){
    var estado_civil = ($(this).val());

    if(estado_civil == "Casado"){
        $("#dados-conjuge").css("display", "block");
    }else{
        $("#dados-conjuge").css("display", "none");
    }
});

$(document).on("click", "#menor_idade", function () {

  if($("#menor_idade").is(':checked')){
    $("#nome_responsavel").removeAttr('disabled');
    $("#cpf_responsavel").removeAttr('disabled');
    $("#rg_responsavel").removeAttr('disabled');
  } else {
    $("#nome_responsavel").attr("disabled", "disabled");
    $("#cpf_responsavel").attr("disabled", "disabled");
    $("#rg_responsavel").attr("disabled", "disabled");
  }

});

function EnviarFormAluno() {

    var nome = FormAluno.nome.value;
    var telefone = FormAluno.telefone.value;
    var cep_endereco = FormAluno.cep_endereco.value;
    var logradouro_endereco = FormAluno.logradouro_endereco.value;

    var email = FormAluno.email.value;
    var polo_id = FormAluno.polo_id.value;

    if (nome == "") {
        swal({title: "Ops", text: "O campo nome deve ser preenchido!", type: "error"});
        FormAluno.nome.focus();
        return false;
    }

    if (telefone == "") {
        swal({title: "Ops", text: "O campo telefone não pode ser vazio!", type: "error"});
        FormAluno.telefone.focus();
        return false;
    }

    if (cep_endereco == "") {
        swal({title: "Ops", text: "O campo CEP não pode ser vazio!", type: "error"});
        FormAluno.cep_endereco.focus();
        return false;
    }

    if (logradouro_endereco == "") {
        swal({title: "Ops", text: "O campo logradouro não pode ser vazio!", type: "error"});
        FormAluno.logradouro_endereco.focus();
        return false;
    }

    if (email == "") {
        swal({title: "Ops", text: "O campo e-mail é obrigatório!", type: "error"});
        FormAluno.email.focus();
        return false;
    }

    if (polo_id == "") {
        swal({title: "Ops", text: "Selecione um pólo!", type: "error"});
        FormAluno.polo_id.focus();
        return false;
    }

    document.getElementById('FormAluno').submit();
  }


  $(document).on('click', '.excluirAluno', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');

        swal({
            title: "Confirma a exclusão desse aluno?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/aluno/excluir',
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