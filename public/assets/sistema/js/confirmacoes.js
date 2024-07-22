$(document).on('click', '.excluirUsuario', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');
  
        swal({
            title: "Confirma a exclusão desse registro?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: 'usuario/excluir',
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

  $(document).on('click', '.excluirParceiro', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');
  
        swal({
            title: "Confirma a exclusão desse registro?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: 'parceiro/excluir',
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


  $(document).on('click', '.excluirPolo', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');
  
        swal({
            title: "Confirma a exclusão desse registro?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: 'polo/excluir',
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


  $(document).on('click', '.excluirRegiao', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');
  
        swal({
            title: "Confirma a exclusão desse registro?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: 'regiao/excluir',
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



  
  $(document).on("click", "#alterar_senha", function () {

    if($("#alterar_senha").is(':checked')){
      $("#senha").removeAttr('disabled');
      $("#confirmar_senha").removeAttr('disabled');
    } else {
      $("#confirmar_senha").attr("disabled", "disabled");
      $("#senha").attr("disabled", "disabled");
    }

  });


  function EnviarFormUser() {

    var nome = FormUser.nome.value;
    var data_nascimento = FormUser.data_nascimento.value;
    var telefone = FormUser.telefone.value;
    var email = FormUser.email.value;
    var perfil_id = FormUser.perfil_id.value;
    var password = FormUser.password.value;
    var password2 = FormUser.password2.value; 

    if (nome == "") {
        //alert('Preencha o campo com seu nome');
        swal({title: "Ops", text: "O campo nome deve ser preenchido!", type: "error"});
        FormUser.nome.focus();
        return false;
    }

    if (data_nascimento == "") {
        //alert('Preencha o campo com seu nome');
        swal({title: "Ops", text: "A data de nascimento deve ser preenchido!", type: "error"});
        FormUser.data_nascimento.focus();
        return false;
    }

    if (telefone == "") {
        //alert('Preencha o campo com seu nome');
        swal({title: "Ops", text: "O campo telefone não pode ser vazio!", type: "error"});
        FormUser.telefone.focus();
        return false;
    }

    if (email == "") {
        //alert('Preencha o campo com seu nome');
        swal({title: "Ops", text: "O campo email do usuário deve ser preenchido!", type: "error"});
        FormUser.email.focus();
        return false;
    }

    if (perfil_id == "") {
      //alert('Preencha o campo com seu nome');
      swal({title: "Ops", text: "O campo perfil do usuário deve ser selecionado!", type: "error"});
      FormUser.perfil_id.focus();
      return false;
  }

    if($('input[name="alterar_senha"]').is(':checked')){

        if (password != "") {
            if (password != password2) {
                //alert('Preencha o campo com seu nome');
                swal({title: "Ops", text: "Os campos senha e confirmar senha devem ser idênticos e não podem ser vazios!", type: "error"});
                FormUser.password2.focus();
                return false;
            }
        }

    }
    
    document.getElementById('FormUser').submit();
}

function EnviarFormParceiro() {

  var nome = FormParceiro.nome.value;
  var cpf = FormParceiro.cpf.value;
  var data_nascimento = FormParceiro.data_nascimento.value;
  var telefone = FormParceiro.telefone.value;
  var email = FormParceiro.email.value;
  var password = FormParceiro.password.value;
  var password2 = FormParceiro.password2.value; 

  if (nome == "") {
      //alert('Preencha o campo com seu nome');
      swal({title: "Ops", text: "O campo nome deve ser preenchido!", type: "error"});
      FormParceiro.nome.focus();
      return false;
  }

  if (cpf == "") {
      //alert('Preencha o campo com seu nome');
      swal({title: "Ops", text: "O campo cpf deve ser preenchido!", type: "error"});
      FormParceiro.cpf.focus();
      return false;
  }

  if (data_nascimento == "") {
      //alert('Preencha o campo com seu nome');
      swal({title: "Ops", text: "A data de nascimento deve ser preenchido!", type: "error"});
      FormParceiro.data_nascimento.focus();
      return false;
  }

  if (telefone == "") {
      //alert('Preencha o campo com seu nome');
      swal({title: "Ops", text: "O campo telefone não pode ser vazio!", type: "error"});
      FormParceiro.telefone.focus();
      return false;
  }

  if (email == "") {
      //alert('Preencha o campo com seu nome');
      swal({title: "Ops", text: "O campo email do usuário deve ser preenchido!", type: "error"});
      FormParceiro.email.focus();
      return false;
  }


  if($('input[name="alterar_senha"]').is(':checked')){

      if (password != "") {
          if (password != password2) {
              //alert('Preencha o campo com seu nome');
              swal({title: "Ops", text: "Os campos senha e confirmar senha devem ser idênticos e não podem ser vazios!", type: "error"});
              FormParceiro.password2.focus();
              return false;
          }
      }

  }
  
  document.getElementById('FormParceiro').submit();
}