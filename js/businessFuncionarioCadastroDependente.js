function validaDescriçãoExistente(id,ativo,descricao, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastroDependente.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'validarDescrição', id: id,ativo: ativo,descricao: descricao }, //valores enviados ao script      
        success: function (data) {

            callback(data);
        }
    });
}

function gravarDescrição(id,ativo,descricao, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastroDependente.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: "gravarDescrição",id: id, ativo: ativo, descricao: descricao},   
        success: function (data) {

            callback(data);
        } 
    }); 
}
function recuperaFuncionario(id, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastroDependente.php', //caminho do arquivo a ser executado
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
        url: 'js/sqlscope_funcionarioCadastroDependente.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'excluir', id: id}, //valores enviados ao script      
        success: function (data) {
            callback(data); 
        }
    });
}
   