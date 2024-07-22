$("#cep_endereco").focusout(function(){
    //Início do Comando AJAX
    cep = $(this).val().replace(/[^\d]+/g,'');
    //alert(cep);
    $.ajax({
        //O campo URL diz o caminho de onde virá os dados
        //É importante concatenar o valor digitado no CEP
        url: 'https://viacep.com.br/ws/'+cep+'/json/',
        //Aqui você deve preencher o tipo de dados que será lido,
        //no caso, estamos lendo JSON.
        dataType: 'json',
        //SUCESS é referente a função que será executada caso
        //ele consiga ler a fonte de dados com sucesso.
        //O parâmetro dentro da função se refere ao nome da variável
        //que você vai dar para ler esse objeto.
        success: function(resposta){
            //Agora basta definir os valores que você deseja preencher
            //automaticamente nos campos acima.
            $("#logradouro_endereco").val(resposta.logradouro);
            $("#complemento_endereco").val(resposta.complemento);
            $("#bairro_endereco").val(resposta.bairro);
            $("#cidade_endereco").val(resposta.localidade).attr('readonly', 'readonly');
            $("#uf_endereco").val(resposta.uf).attr('readonly', 'readonly');

            //Vamos incluir para que o Número seja focado automaticamente
            //melhorando a experiência do usuário
            $("#numero_endereco").focus();
        }
    });
});