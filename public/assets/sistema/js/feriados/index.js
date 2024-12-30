$('#tipo_feriado').change(function (){
    var tipo_feriado = ($(this).val());
    
    if(tipo_feriado == "Municipal"){
        $("#estado").css("display", "block");
        $("#cidade").css("display", "block");
        $("#header").css("display", "block");
    }else if(tipo_feriado == "Estadual"){
        $("#estado").css("display", "block");
        $("#cidade").css("display", "none");
        $("#header").css("display", "block");
    }else if(tipo_feriado == "Nacional"){
        $("#estado").css("display", "none");
        $("#cidade").css("display", "none");
        $("#header").css("display", "none");
    }
});

function EnviarFormFeriado() {

    var descricao = FormFeriado.descricao.value;
    var data = FormFeriado.data.value;
    var tipo = FormFeriado.tipo.value;
    var cidade_endereco = $("#inputCidade").val();
    var estado_endereco = $("#estado_endereco").val();
  
    if (descricao == "") {
        swal({title: "Ops", text: "O campo nome deve ser preenchido!", type: "error"});
        FormFeriado.descricao.focus();
        return false;
    }
  
    if (data == "") {
        swal({title: "Ops", text: "O data é obrigatória!", type: "error"});
        FormFeriado.data.focus();
        return false;
    }
  
    if (tipo == "") {
        swal({title: "Ops", text: "O campo tipo não pode ser vazio!", type: "error"});
        FormFeriado.tipo.focus();
        return false;
    }
  
    if (tipo == 'Estadual') {

      if (estado_endereco == "") {
          swal({title: "Ops", text: "O estado é obrigátório para feriados estaduais!", type: "error"});
          FormFeriado.estado_endereco.focus();
          return false;
      }

    }

    if (tipo == 'Municipal') {

      if (cidade_endereco == "") {
          swal({title: "Ops", text: "Você não selecionou a cidade!", type: "error"});
          FormFeriado.cidade_enderecocidade_endereco.focus();
          return false;
      }

    }

   
    document.getElementById('FormFeriado').submit();
  }


  $(document).on('click', '.excluirFeriado', function (e) {
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
            url: '/sistema/feriado/excluir',
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