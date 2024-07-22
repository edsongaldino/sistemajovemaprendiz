$('#tipo').change(function (){
  var tipo_produto = ($(this).val());
  
  if(tipo_produto == "Uniforme"){
    $("#box-uniforme").css("display", "block");
  }else {
    $("#box-uniforme").css("display", "none");
  }

});

$('#tipo_movimentacao').change(function (){
  var tipo_movimentacao = ($(this).val());
  
  if(tipo_movimentacao == "Transferência" || tipo_movimentacao == "Saída"){
    $("#box-destino").css("display", "block");
  }else {
    $("#box-destino").css("display", "none");
  }

});

function EnviarFormEstoque() {

  var tipo = FormEstoque.tipo.value;
  var nome = FormEstoque.nome.value;
  var categoria = FormEstoque.categoria.value;
  var descricao = FormEstoque.descricao.value;
  
  if (tipo == "") {
      swal({title: "Ops", text: "O campo tipo deve ser preenchido!", type: "error"});
      FormEstoque.tipo.focus();
      return false;
  }else{
    if (tipo == "Uniforme") {
      var tamanho_uniforme = FormEstoque.tamanho_uniforme.value;
      if (tamanho_uniforme == "") {
        swal({title: "Ops", text: "O tamanho do uniforme deve ser selecionado!", type: "error"});
        FormEstoque.tamanho_uniforme.focus();
        return false;
      }
    }
  }

  if (nome == "") {
    swal({title: "Ops", text: "O nome do produto deve ser preenchido!", type: "error"});
    FormEstoque.nome.focus();
    return false;
  }


  if (categoria == "") {
      swal({title: "Ops", text: "O campo categoria deve ser preenchido!", type: "error"});
      FormEstoque.categoria.focus();
      return false;
  }

  if (descricao == "") {
      swal({title: "Ops", text: "O campo descricao não pode ser vazio!", type: "error"});
      FormEstoque.descricao.focus();
      return false;
  }
  
  document.getElementById('FormEstoque').submit();
}


$(document).on('click', '.excluirEmpresa', function (e) {
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
          url: 'empresa/excluir',
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

$(document).on('click', '.excluirMembro', function (e) {
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
          url: '/sistema/empresa/equipe/excluir',
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