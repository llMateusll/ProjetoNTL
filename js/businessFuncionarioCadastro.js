function gravaFuncionario(id, ativo, nome, cpf, dataNascimento, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastro.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: "grava", id: id, ativo: ativo, nome: nome , cpf: cpf , dataNascimento: dataNascimento},   
        success: function (data) {
        callback(data);
        } 
    }); 
}
  
function recuperaUsuarioGrupo(id, ativo, nome, cpf, dataNascimento, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'recupera', id: id, ativo: ativo, nome: nome, cpf: cpf, dataNascimento: dataNascimento}, //valores enviados ao script      
        success: function (data) {
            callback(data); 
        }
    });

    return;
}
  
function excluirUsuarioGrupo(id, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'excluir', id: id}, //valores enviados ao script      
        success: function (data) {
            callback(data); 
        }
    });
}
