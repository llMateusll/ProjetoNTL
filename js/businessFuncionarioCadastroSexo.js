function validaSexoExistente(sexo,ativo,id, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastroSexo.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'validaSexo', sexo: sexo,ativo: ativo,id:id }, //valores enviados ao script      
        success: function (data) {

            callback(data);
        }
    });
}

function gravarSexo(id,ativo,sexo, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastroSexo.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: "gravarSexo",id: id, ativo: ativo, sexo: sexo},   
        success: function (data) {
        callback(data);
        } 
    }); 
}
function recuperaFuncionario(id, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastroSexo.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'recupera', id: id}, //valores enviados ao script      
        success: function (data) {
            callback(data); 
        }
    });

    return;
}
function excluirGrupo(id, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastroSexo.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'excluir', id: id}, //valores enviados ao script      
        success: function (data) {
            callback(data); 
        }
    });
}
   