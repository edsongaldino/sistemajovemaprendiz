function EnviarFormCurso() {

    var nome = FormCurso.nome.value;
    var numero = FormCurso.numero.value;
  
    if (nome == "") {
        swal({title: "Ops", text: "O campo nome deve ser preenchido!", type: "error"});
        FormCurso.nome.focus();
        return false;
    }
  
    if (numero == "") {
        swal({title: "Ops", text: "O campo numero não pode ser vazio!", type: "error"});
        FormCurso.numero.focus();
        return false;
    }
  
    
    document.getElementById('FormCurso').submit();
  }


  $(document).on('click', '.excluirCurso', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');
  
        swal({
            title: "Confirma a exclusão desse curso?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/curso/excluir',
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