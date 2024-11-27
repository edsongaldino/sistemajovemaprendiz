function EnviarFormCadastro() {

    var nome = FormCadastro.nome.value;
    var telefone = FormCadastro.telefone.value;
    var cep_endereco = FormCadastro.cep_endereco.value;
    var email = FormCadastro.email.value;

    if (nome == "") {
        swal({title: "Ops", text: "O campo nome deve ser preenchido!", type: "error"});
        FormCadastro.nome.focus();
        return false;
    }

    if (telefone == "") {
        swal({title: "Ops", text: "O campo telefone não pode ser vazio!", type: "error"});
        FormCadastro.telefone.focus();
        return false;
    }

    if (cep_endereco == "") {
        swal({title: "Ops", text: "O campo CEP não pode ser vazio!", type: "error"});
        FormCadastro.cep_endereco.focus();
        return false;
    }

    if (email == "") {
        swal({title: "Ops", text: "O campo e-mail é obrigatório!", type: "error"});
        FormCadastro.email.focus();
        return false;
    }

    document.getElementById('FormCadastro').submit();
}