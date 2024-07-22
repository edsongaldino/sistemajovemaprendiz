function EnviarFormVaga() {

    var qtde_vagas = FormVaga.qtde_vagas.value;
    var tipo_vaga = FormVaga.tipo_vaga.value;
    var polo_id = FormVaga.polo_id.value;
    var situacao = FormVaga.situacao.value;

    if (qtde_vagas == "") {
        swal({title: "Ops", text: "O campo qtde_vagas deve ser preenchido!", type: "error"});
        FormVaga.qtde_vagas.focus();
        return false;
    }

    if (tipo_vaga == "") {
        swal({title: "Ops", text: "O campo tipo_vaga não pode ser vazio!", type: "error"});
        FormVaga.tipo_vaga.focus();
        return false;
    }

    if (polo_id == "") {
        swal({title: "Ops", text: "O campo polo responsável é obrigátório para polos educacionais!", type: "error"});
        FormVaga.polo_id.focus();
        return false;
    }

    if (situacao == "") {
        swal({title: "Ops", text: "O campo situacao não pode ser vazio!", type: "error"});
        FormVaga.situacao.focus();
        return false;
    }

    document.getElementById('FormVaga').submit();
  }

  function setaDadosModal(valor) {
    const myArray = valor.split("/");
    document.getElementById('processo_seletivo').value = myArray[0];
    document.getElementById('NomeCandidato').value = myArray[1];
  }


  $(document).on('click', '.excluirVaga', function (e) {
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
            url: 'vaga/excluir',
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

  $(document).on('click', '.excluirCandidato', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');

        swal({
            title: "Confirma a exclusão desse candidato?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/vaga/processo-seletivo/excluir-candidato',
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

  $(document).on('click', '.ProcessoConcluido', function (e) {
    e.preventDefault();
    swal({title: "Ops", text: "Este processo seletivo está concluído e não permite alterações!", type: "info"});
  });

  $(document).on('click', '.CandidatoBloqueado', function (e) {
    e.preventDefault();
    swal({title: "Ops", text: "Este candidato não pode ser selecionado, pois já se encontra em um processo seletivo!", type: "info"});
  });


  $(document).on('click', '.IncluirCandidatoVaga', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var vaga = $(this).data('vaga');
    var token = $(this).data('token');

        swal({
            title: "Confirma a inclusão desse candidato ao processo seletivo?",
            type: "info",
            confirmButtonClass: "btn-info",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/vaga/processo-seletivo/incluir-candidato',
            method: 'POST',
            data: {
              id: id,
              vaga: vaga,
              "_token": token
            },

          success: function() {
            swal({title: "OK", text: "Candidado incluído!", type: "success"},
              function(){
                  location.reload();
              }
            );
          },

          error: function() {
            swal({title: "OPS", text: "Erro ao incluir registro!", type: "warning"},
              function(){
                  location.reload();
              }
            );
          }

          });
    });
  });

  $(document).on('click', '.DesfazerAceite', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');

        swal({
            title: "Confirma a alteraçao deste candidato?",
            text: "Ao concluir, este candidato voltará para o status inicial",
            type: "info",
            confirmButtonClass: "btn-info",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/vaga/processo-seletivo/desfazer-aceite',
            method: 'POST',
            data: {
              id: id,
              "_token": token
            },

          success: function() {
            swal({title: "OK", text: "Candidato atualizado!", type: "success"},
              function(){
                  location.reload();
              }
            );
          },

          error: function() {
            swal({title: "OPS", text: "Erro ao atualizar candidato!", type: "warning"},
              function(){
                  location.reload();
              }
            );
          }

          });
    });
  });


  $(document).on('click', '.FinalizarProcessoSeletivo', function (e) {
      e.preventDefault();
      var vaga = $(this).data('vaga');
      var token = $(this).data('token');

      swal({
          title: "Confirma a conclusão desse processo seletivo?",
          text: "Ao concluir, este processo será finalizado, não sendo permitido edições",
          type: "info",
          confirmButtonClass: "btn-info",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não",
          showCancelButton: true,
      },
      function() {
        $.ajax({
          url: '/sistema/vaga/processo-seletivo/concluir',
          method: 'POST',
          data: {
            vaga: vaga,
            "_token": token
          },

        success: function() {
          swal({title: "OK", text: "Processo seletivo concluído!", type: "success"},
            function(){
                location.reload();
            }
          );
        },

        error: function() {
          swal({title: "OPS", text: "Erro ao finalizar processo!", type: "warning"},
            function(){
                location.reload();
            }
          );
        }

        });
    });
  });

  $('#copiarLink').click(function(){

    // Get the text field
    var copyText = document.getElementById("linkProcessoSeletivo");

    // Select the text field
    copyText.select();
    //copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);

    // Alert the copied text
    swal({title: "OK", text: "Link copiado para área de transferência!", type: "success"});

  });
