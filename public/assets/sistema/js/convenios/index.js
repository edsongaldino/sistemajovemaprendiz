function EnviarFormConvenio() {

    var empresa_id = FormConvenio.empresa_id.value;
    var data_inicial = FormConvenio.data_inicial.value;
    var dia_faturamento = FormConvenio.dia_faturamento.value;
    var situacao = FormConvenio.situacao.value;
    var qtde_jovens = FormConvenio.qtde_jovens.value;
    var tabela_id = FormConvenio.tabela_id.value;
    var polo_id = FormConvenio.polo_id.value;
    var tipo_convenio = FormConvenio.tipo_convenio.value;
  
    if (empresa_id == "") {
        swal({title: "Ops", text: "O campo empresa não pode ser vazio!", type: "error"});
        FormConvenio.empresa_id.focus();
        return false;
    }

    if (data_inicial == "") {
        swal({title: "Ops", text: "A data inicial não pode ser vazio!", type: "error"});
        FormConvenio.data_inicial.focus();
        return false;
    }

    if (dia_faturamento == "") {
        swal({title: "Ops", text: "O dia de faturamento não pode ser vazio!", type: "error"});
        FormConvenio.dia_faturamento.focus();
        return false;
    }

    if (qtde_jovens == "") {
      swal({title: "Ops", text: "A quantidade de jovens não pode ser vazio!", type: "error"});
      FormConvenio.qtde_jovens.focus();
      return false;
  }

    if (situacao == "") {
        swal({title: "Ops", text: "O campo situacao deve ser preenchido!", type: "error"});
        FormConvenio.situacao.focus();
        return false;
    }

    if (tabela_id == "") {
      swal({title: "Ops", text: "A tabela deve ser selecionada!", type: "error"});
      FormConvenio.tabela_id.focus();
      return false;
  }

    if (polo_id == "") {
      swal({title: "Ops", text: "O polo deve ser preenchido!", type: "error"});
      FormConvenio.polo_id.focus();
      return false;
  }

    if (tipo_convenio == "") {
      swal({title: "Ops", text: "O tipo do convênio deve ser selecionado!", type: "error"});
      FormConvenio.tipo_convenio.focus();
      return false;
    }
  
    
    document.getElementById('FormConvenio').submit();
  }


  $(document).on('click', '.excluirConvenio', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');
  
        swal({
            title: "Confirma a exclusão desse convênio?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/convenio/excluir',
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