$('#tipo_polo').change(function (){
    var tipo_polo = ($(this).val());
    
    if(tipo_polo == "Educacional"){
        $("#polo_responsavel").css("display", "block");
    }else{
        $("#polo_responsavel").css("display", "none");
    }
});

function EnviarFormPolo() {

    var nome = FormPolo.nome.value;
    var telefone = FormPolo.telefone.value;
    var regiao_id = FormPolo.regiao_id.value;
    var tipo_polo = FormPolo.tipo_polo.value;
    var polo_id = FormPolo.polo_id.value;
    var cep_endereco = FormPolo.cep_endereco.value;
    var logradouro_endereco = FormPolo.logradouro_endereco.value;
  
    if (nome == "") {
        swal({title: "Ops", text: "O campo nome deve ser preenchido!", type: "error"});
        FormPolo.nome.focus();
        return false;
    }
  
    if (telefone == "") {
        swal({title: "Ops", text: "O campo telefone não pode ser vazio!", type: "error"});
        FormPolo.telefone.focus();
        return false;
    }
  
    if (regiao_id == "") {
        swal({title: "Ops", text: "O campo região não pode ser vazio!", type: "error"});
        FormPolo.regiao_id.focus();
        return false;
    }
  
    if (tipo_polo == "") {
        swal({title: "Ops", text: "O campo tipo não pode ser vazio!", type: "error"});
        FormPolo.tipo_polo.focus();
        return false;
    }else{

        if (tipo_polo == 'Educacional') {

            if (polo_id == "") {
                swal({title: "Ops", text: "O campo polo responsável é obrigátório para polos educacionais!", type: "error"});
                FormPolo.polo_id.focus();
                return false;
            }

        }

    }

    if (cep_endereco == "") {
        swal({title: "Ops", text: "O campo CEP não pode ser vazio!", type: "error"});
        FormPolo.cep_endereco.focus();
        return false;
    }

    if (logradouro_endereco == "") {
        swal({title: "Ops", text: "O campo logradouro não pode ser vazio!", type: "error"});
        FormPolo.logradouro_endereco.focus();
        return false;
    }
    
    document.getElementById('FormPolo').submit();
  }


  $(document).on('click', '.excluirMembro', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');
  
        swal({
            title: "Confirma a exclusão desse membro?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/polo/equipe/excluir',
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