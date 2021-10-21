function gravaSexo(id, descricao, ativo,callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroSexo.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "grava", id: id, descricao: descricao, ativo: ativo }, //valores enviados ao script     
        success: function (data) {
            callback(data);
        }
    });
}

function recuperaSexo(id, callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroSexo.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'recupera', id: id }, //valores enviados ao script     
        success: function (data) {
            callback(data);
        }

    });

    return;
}

function excluirSexo(id, callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroSexo.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'excluir', id: id }, //valores enviados ao script     
        success: function (data) {
            callback(data);
        }
    });
}
function validarDescricaoExistente(descricao, callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroSexo.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'validarDescricaoExistente', descricao: descricao }, //valores enviados ao script
        success: function (data) {
            callback(data);
        }
    });
}


