function gravaTipoDependente(id, tipoDependente, ativo,callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroTipoDependente.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "grava", id: id, tipoDependente: tipoDependente, ativo: ativo }, //valores enviados ao script
        success: function (data) {
            callback(data);
        }
    });
}

function recuperaTipoDependente(id, callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroTipoDependente.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'recupera', id: id }, //valores enviados ao script     
        success: function (data) {
            callback(data);
        }

    });

    return;
}

function excluirTipoDependente(id, callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroTipoDependente.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'excluir', id: id }, //valores enviados ao script     
        success: function (data) {
            callback(data);
        }
    });
}
function validarTipoDependenteExistente(tipoDependente, callback) {
    $.ajax({
        url: 'js/sqlscope_cadastroTipoDependente.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'validarTipoDependenteExistente', tipoDependente: tipoDependente }, //valores enviados ao script
        success: function (data) {
            callback(data);
        }
    });
}


