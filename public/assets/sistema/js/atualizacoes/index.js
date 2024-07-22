function EnviarFormAtualizacao() {

    var tipo_atualizacao = FormAtualizacao.tipo_atualizacao.value;
    var modulo_atualizacao = FormAtualizacao.modulo_atualizacao.value;
    var percentual_atualizacao = FormAtualizacao.percentual_atualizacao.value;
    var data_atualizacao = FormAtualizacao.data_atualizacao.value;
    var motivo_atualizacao = FormAtualizacao.motivo_atualizacao.value;

    var data_atual = FormAtualizacao.data_atual.value;

    if (tipo_atualizacao == "") {
        swal({title: "Ops", text: "O campo tipo atualizacao deve ser preenchido!", type: "error"});
        FormTabela.tipo_atualizacao.focus();
        return false;
    }
  
    if (modulo_atualizacao == "") {
        swal({title: "Ops", text: "O campo modulo atualizacao não pode ser vazio!", type: "error"});
        FormTabela.modulo_atualizacao.focus();
        return false;
    }
  
    if (percentual_atualizacao == "") {
        swal({title: "Ops", text: "O campo percentual atualizacao não pode ser vazio!", type: "error"});
        FormTabela.percentual_atualizacao.focus();
        return false;
    }

    if (data_atualizacao == "") {
        swal({title: "Ops", text: "O campo data atualizacao não pode ser vazio!", type: "error"});
        FormTabela.data_atualizacao.focus();
        return false;
    }

    if (motivo_atualizacao == "") {
        swal({title: "Ops", text: "O campo motivo atualizacao não pode ser vazio!", type: "error"});
        FormTabela.motivo_atualizacao.focus();
        return false;
    }

    if (data_atualizacao <= data_atual) {

      swal({
        title: "Você informou uma data igual ou menor que a atual, ou seja, sua atualização será aplicada imediatamente!",
        type: "error",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sim!",
        cancelButtonText: "Cancelar",
        showCancelButton: true,
      },
      function() {

        document.getElementById('FormAtualizacao').submit();
        
      });

    }else{
       document.getElementById('FormAtualizacao').submit();
    }
    
  }


  $(document).on('click', '.excluirAtualizacao', function (e) {
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

            url: '/sistema/atualizacao/excluir',
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