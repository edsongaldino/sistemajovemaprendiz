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

  $("#codigoEmpresa").focusout(function(){

    //Início do Comando AJAX
    codigo = $(this).val().replace(/[^\d]+/g,'');

    //Início do Comando AJAX
    $.ajax({

        //O campo URL diz o caminho de onde virá os dados
        //É importante concatenar o valor digitado no CNPJ
        url: '/sistema/empresa/consulta-empresa/codigo/'+codigo,
        //Atualização: caso use java, use cnpj.jsp, usando o outro exemplo.
        //Aqui você deve preencher o tipo de dados que será lido,
        //no caso, estamos lendo JSON.
        dataType: 'json',
        //SUCESS é referente a função que será executada caso
        //ele consiga ler a fonte de dados com sucesso.
        //O parâmetro dentro da função se refere ao nome da variável
        //que você vai dar para ler esse objeto.
        success: function(resposta){

          if(resposta.razao_social){
            //Agora basta definir os valores que você deseja preencher
            //automaticamente nos campos acima.
            $("#razao_social").val(resposta.razao_social);
            $("#cidade").val(resposta.cidade);
            $("#cnpjEmpresa").val(resposta.cnpj);
            $("#data_inicial").focus().select();

          }else{
            swal("Ops!", "Não encontramos nenhuma empresa cadastrada com esse CÓDIGO!", "info");
          } 
        }
    });

});

$("#cnpjEmpresa").focusout(function(){

  //Início do Comando AJAX
  cnpj = $(this).val().replace(/[^\d]+/g,'');

  //Início do Comando AJAX
  $.ajax({

      //O campo URL diz o caminho de onde virá os dados
      //É importante concatenar o valor digitado no CNPJ
      url: '/sistema/empresa/consulta-empresa/cnpj/'+cnpj,
      //Atualização: caso use java, use cnpj.jsp, usando o outro exemplo.
      //Aqui você deve preencher o tipo de dados que será lido,
      //no caso, estamos lendo JSON.
      dataType: 'json',
      //SUCESS é referente a função que será executada caso
      //ele consiga ler a fonte de dados com sucesso.
      //O parâmetro dentro da função se refere ao nome da variável
      //que você vai dar para ler esse objeto.
      success: function(resposta){

            if(resposta.razao_social){
              //Agora basta definir os valores que você deseja preencher
              //automaticamente nos campos acima.
              $("#razao_social").val(resposta.razao_social);
              $("#cidade").val(resposta.cidade);
              $("#codigoEmpresa").val(resposta.id);
              $("#data_inicial").focus().select();

            }else{
              swal("Ops!", "Não encontramos nenhuma empresa cadastrada com esse CNPJ!", "info");
            }
      }
  });

});

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

  $(document).on('click', '.faturarConvenio', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var data_inicial = $(this).data('inicial');
    var data_final = $(this).data('final');
    var token = $(this).data('token');
    var forma_pagamento = $(this).data('formapagamento');

        swal({
            title: "Deseja iniciar o faturamento desse convênio?",
            type: "info",
            confirmButtonClass: "btn-info",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/convenio/faturar',
            method: 'POST',
            data: {
              id: id,
              data_inicial: data_inicial,
              data_final: data_final,
              forma_pagamento: forma_pagamento,
              "_token": token
            },

          success: function() {
            swal({title: "OK", text: "Convênio Faturado!", type: "success"},
              function(){
                  location.reload();
              }
            );
          },

          error: function() {
            swal({title: "OPS", text: "Erro ao faturar convênio!", type: "warning"},
              function(){
                  location.reload();
              }
            );
          }

          });
    });
  });


  $(document).on('click', '.faturarContrato', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var faturamento_id = $(this).data('faturamento');
    var data_inicial = $(this).data('inicial');
    var data_final = $(this).data('final');
    var token = $(this).data('token');

        swal({
            title: "Confirma o faturamento deste contrato?",
            type: "info",
            confirmButtonClass: "btn-info",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/contrato/faturar',
            method: 'POST',
            data: {
              id: id,
              faturamento_id: faturamento_id,
              data_inicial: data_inicial,
              data_final: data_final,
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
              swal({title: "OPS", text: "Erro ao faturar contrato!", type: "warning"},
                function(){
                    location.reload();
                }
              );
            }

          });
    });
});


$(document).on('click', '.gerarCobranca', function (e) {

  e.preventDefault();
  var id = $(this).data('id');
  var token = $(this).data('token');

      swal({
          title: "Deseja gerar cobrança deste faturamento?",
          type: "info",
          confirmButtonClass: "btn-info",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não",
          showCancelButton: true,
      },
      function() {
        $.ajax({
          url: '/sistema/contrato/gerar-cobranca',
          method: 'POST',
          data: {
            id: id,
            "_token": token
          },

        success: function() {
          swal({title: "OK", text: "Cobrança gerada!", type: "success"},
            function(){
                location.reload();
            }
          );
        },

        error: function() {
          swal({title: "OPS", text: "Erro ao gerar cobrança!", type: "warning"},
            function(){
                location.reload();
            }
          );
        }

        });
  });
});


$(document).on('click', '.EmitirNotaFiscal', function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  var token = $(this).data('token');

      swal({
          title: "Deseja gerar Nota Fiscal deste faturamento?",
          type: "info",
          confirmButtonClass: "btn-info",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não",
          showCancelButton: true,
      },
      function() {
        $.ajax({
          url: '/sistema/faturamento/emitir-nf',
          method: 'POST',
          dataType: 'json',
          data: {
            id: id,
            "_token": token
          },

        success: function(data) {
          if(data.status == 'success'){
            swal({title: "OK", text: data.message, type: data.status},
              function(){
                  location.reload();
              }
            );
          }else{
            swal({title: "Ops", text: data.message, type: data.status},
              function(){
                  location.reload();
              }
            );
          };
        },
    });
  });
});

$(document).on('click', '.CancelarNF', function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  var token = $(this).data('token');

      swal({
          title: "Confirma o cancelamento dessa NF?",
          type: "error",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não",
          showCancelButton: true,
      },
      function() {
        $.ajax({
          url: '/sistema/faturamento/cancelar-nf',
          method: 'POST',
          data: {
            id: id,
            "_token": token
          },

        success: function(data) {
          swal({title: "OK", text: "Solçicitação de Cancelamento Enviada à Prefeitura!", type: "success"},
            function(){
                location.reload();
            }
          );
        },

        error: function(data) {
          swal({title: "OPS", text: "Erro ao solicitar Cancelamento!", type: "warning"},
            function(){
                location.reload();
            }
          );
        }

        });
  });
});


$(document).on('click', '.excluirBoleto', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');

        swal({
            title: "Confirma o cancelamento desse boleto?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/faturamento/boleto/baixar',
            method: 'POST',
            data: {
              id: id,
              "_token": token
            },

          success: function() {
            swal({title: "OK", text: "Registro baixado com sucesso!", type: "success"},
              function(){
                  location.reload();
              }
            );
          },

          error: function() {
            swal({title: "OPS", text: "Erro ao baixar registro!", type: "warning"},
              function(){
                  location.reload();
              }
            );
          }

          });
    });
});


$(document).on('click', '.excluirFaturamentoContrato', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');

        swal({
            title: "Confirma a exclusão deste faturamento?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/faturamento/contrato/excluir',
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

$(document).on('click', '.excluirFaturamento', function (e) {
  e.preventDefault();
  var id = $(this).data('id');
  var token = $(this).data('token');

      swal({
          title: "Confirma a exclusão deste faturamento?",
          type: "error",
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Sim!",
          cancelButtonText: "Não",
          showCancelButton: true,
      },
      function() {
        $.ajax({
          url: '/sistema/faturamento/excluir',
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

$(document).on('click', '.excluirArquivo', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var token = $(this).data('token');

        swal({
            title: "Confirma a exclusão deste arquivo?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/arquivo/excluir',
            method: 'POST',
            data: {
              id: id,
              "_token": token
            },

          success: function() {
            swal({title: "OK", text: "Arquivo removido!", type: "success"},
              function(){
                  location.reload();
              }
            );
          },

          error: function() {
            swal({title: "OPS", text: "Erro ao remover arquivo!", type: "warning"},
              function(){
                  location.reload();
              }
            );
          }

          });
    });
});


$(document).on('click', '.GerarArquivoContabil', function (e) {
    e.preventDefault();
    var token = $(this).data('token');

        swal({
            title: "Deseja gerar um novo arquivo?",
            type: "info",
            confirmButtonClass: "btn-info",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/arquivo/gerar-arquivo',
            method: 'POST',
            data: {
              "_token": token
            },

          success: function() {
            swal({title: "OK", text: "Arquivo Gerado!", type: "success"},
              function(){
                  location.reload();
              }
            );
          },

          error: function() {
            swal({title: "OPS", text: "Erro ao gerar arquivo!", type: "warning"},
              function(){
                  location.reload();
              }
            );
          }

          });
    });
});

$(document).on('click', '.boletoAtivo', function () {
    swal({
        title: "Não é possível excluir um faturamento com boleto emitido!",
        type: "info",
    }
  )}
);

$(document).on('click', '.boletoLiquidado', function () {
    swal({
        title: "Este boleto já foi liquidado!",
        type: "info",
    }
  )}
);

$(document).on('click', '.NFAguardando', function (e) {
    e.preventDefault();
    var codigo_nf = $(this).data('codigo_nf');
    var token = $(this).data('token');

        swal({
            title: "Confirma a atualização desta nota?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim!",
            cancelButtonText: "Não",
            showCancelButton: true,
        },
        function() {
          $.ajax({
            url: '/sistema/faturamento/atualizar-nf',
            method: 'POST',
            data: {
              codigo_nf: codigo_nf,
              "_token": token
            },

          success: function() {
            swal({title: "OK", text: "Nota Fiscal Atualizada!", type: "success"},
              function(){
                  location.reload();
              }
            );
          },

          error: function() {
            swal({title: "OPS", text: "Ainda não foi possível atualizar a nota!", type: "warning"},
              function(){
                  location.reload();
              }
            );
          }

          });
    });
});

$(document).on('click', '.NFCancelada', function () {
  swal({
      title: "Esta NF consta como CANCELADA na prefeitura. Verifique junto a contabilidade!",
      type: "info",
  }
)}
);


$(document).on('click', '.EnviarEmailFaturamento', function (e) {

    e.preventDefault();
    var id = $(this).data('id');
    var tipo = $(this).data('tipo');
    var token = $(this).data('token');

    if(tipo == 'boleto-nf'){
        var titulo = "Confirma o envio da cobrança deste faturamento?"
    }else{
        var titulo = "Confirma o envio deste relatório para o cliente?"
    }

    swal({
        title: titulo,
        type: "info",
        confirmButtonClass: "btn-info",
        confirmButtonText: "Sim!",
        cancelButtonText: "Não",
        showCancelButton: true,
    },
    function() {
        $.ajax({
        url: '/sistema/faturamento/enviar-email',
        method: 'POST',
        data: {
            id: id,
            tipo: tipo,
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

  $(document).on('click', '.InformarNumeroPedido', function (e) {

    e.preventDefault();
    var id = $(this).data('id');
    $("#Modalfaturamento_id").val(id);
    $('#ModalInformarPedido').modal('show');
    
  });

  $(document).on('click', '.AlterarNumeroPedido', function (e) {

    e.preventDefault();
    var id = $(this).data('id');
    var numeroPedido = $(this).data('numero-pedido');
    var dadosBancarios = $(this).data('dados-bancarios');
    $("#Modalfaturamento_id").val(id);
    $("#numero_pedido").val(numeroPedido);
    $("#dados_bancarios").val(dadosBancarios);
    $('#ModalInformarPedido').modal('show');
    
  });

  $('#tipo').change(function (){
    var tipo = ($(this).val());

    if(tipo == "RECEBIMENTO"){
      $("#boxRecebimento").css("display", "block");
    }else {
      $("#boxRecebimento").css("display", "none");
    }

  });

  $(document).on('click', '.AlterarVencimentoBoleto', function (e) {

    e.preventDefault();
    var id = $(this).data('id');
    $("#ModalBoleto_id").val(id);
    $('#ModalAlterarVencimento').modal('show');
    
  });

  $(document).on('click', '.InformarPagamento', function (e) {

    e.preventDefault();
    var id = $(this).data('id');
    $("#Modalfaturamento_id_IP").val(id);
    $('#ModalInformarPagamento').modal('show');
    
  });

  $(document).on('click', '.InformarCredito', function (e) {

    e.preventDefault();
    var id = $(this).data('id');
    $("#ModalCreditoFaturamento_id").val(id);
    $('#ModalInformarCredito').modal('show');
    
  });

  $(document).on('click', '.AlterarCredito', function (e) {

    e.preventDefault();
    var id = $(this).data('id');
    var idCredito = $(this).data('credito-id');
    var valorCredito = $(this).data('valor-credito');
    var descricaoCredito = $(this).data('descricao-credito');
    $("#ModalCreditoFaturamento_id").val(id);
    $("#Credito_id").val(idCredito);
    $("#valor_credito").val(valorCredito);
    $("#descricao_credito").val(descricaoCredito);
    $('#ModalInformarCredito').modal('show');
    
  });
