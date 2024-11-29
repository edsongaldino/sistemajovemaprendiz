function EnviarFormCadastro() {

    var nome = FormCadastro.nome.value;
    var whatsapp = FormCadastro.whatsapp.value;
    var cep_endereco = FormCadastro.cep.value;
    var email = FormCadastro.email.value;

    if (nome == "") {
        swal({title: "Ops", text: "O campo nome deve ser preenchido!", type: "error"});
        FormCadastro.nome.focus();
        return false;
    }

    if (whatsapp == "") {
        swal({title: "Ops", text: "O campo telefone não pode ser vazio!", type: "error"});
        FormCadastro.whatsapp.focus();
        return false;
    }

    if (cep_endereco == "") {
        swal({title: "Ops", text: "O campo CEP não pode ser vazio!", type: "error"});
        FormCadastro.cep_endereco.focus();
        return false;
    }

    if (email == "") {
        swal({title: "Ops", text: "O campo e-mail é obrigatório!", type: "error"});
        FormCadastro.email.focus();
        return false;
    }

    document.getElementById('FormCadastro').submit();
}

$(document).on('click', '.EnviarEmailCadastro', function (e) {

    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');

    swal({
        title: "Confirma o envio do link para preenchimento do currículo?",
        type: "info",
        confirmButtonClass: "btn-info",
        confirmButtonText: "Sim!",
        cancelButtonText: "Não",
        showCancelButton: true,
    },
    function() {
        $.ajax({
        url: '/sistema/cadastro/enviar-link-curriculo',
        method: 'POST',
        data: {
            id: id,
            "_token": token
        },

        success: function(response) {
          if(response.status == "error"){
            swal({title: "Ops", text: response.msg, type: "error"},
              function(){
                  location.reload();
              }
            );
          }else{
            swal({title: "OK", text: response.msg, type: "success"},
              function(){
                  location.reload();
              }
          );
          }
        },

        error: function() {
          swal({title: "OPS", text: "Erro ao enviar e-mail!", type: "warning"},
              function(){
                  location.reload();
              }
          );
        }

        });
    });
  });

  $(document).on('click', '.CadastroNaoAprovado', function (e) {

    swal({title: "Ops", text: "Este cadastro ainda não está aprovado!", type: "warning"},
        function(){
            location.reload();
        }
    );

  });
  