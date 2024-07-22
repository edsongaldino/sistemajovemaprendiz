function EnviarFormPerfil() {

    var nome = FormPerfil.nome.value;
  
    if (nome == "") {
        swal({title: "Ops", text: "O campo nome deve ser preenchido!", type: "error"});
        FormPerfil.nome.focus();
        return false;
    }
    
    document.getElementById('FormPerfil').submit();
  }
  
  $('#tipo_perfil').change(function (){
    var tipo_perfil= ($(this).val());
    
    if(tipo_perfil == "Gestão"){
      $("#gestao").css("display", "block");
    }else {
      $("#gestao").css("display", "none");
    }
  });
  
  $(document).on('click', '.excluirPerfil', function (e) {
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
            url: 'perfil/excluir',
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