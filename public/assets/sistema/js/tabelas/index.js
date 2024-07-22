function EnviarFormTabela() {

    var nome = FormTabela.nome.value;
    var validade = FormTabela.validade.value;
    var valor = FormTabela.valor.value;
    var descricao = FormTabela.descricao.value;
  
    if (nome == "") {
        swal({title: "Ops", text: "O campo nome deve ser preenchido!", type: "error"});
        FormTabela.nome.focus();
        return false;
    }
  
    if (validade == "") {
        swal({title: "Ops", text: "O campo validade não pode ser vazio!", type: "error"});
        FormTabela.telefone.focus();
        return false;
    }
  
    if (valor == "") {
        swal({title: "Ops", text: "O campo valor não pode ser vazio!", type: "error"});
        FormTabela.valor.focus();
        return false;
    }

    if (descricao == "") {
        swal({title: "Ops", text: "O campo descricao não pode ser vazio!", type: "error"});
        FormTabela.descricao.focus();
        return false;
    }
    
    document.getElementById('FormTabela').submit();
  }


  $(document).on('click', '.excluirTabela', function (e) {
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
            url: '/sistema/tabela/excluir',
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