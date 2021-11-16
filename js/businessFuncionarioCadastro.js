function gravaFuncionario(id, ativo, nome, cpf, dataNascimento, rg,sexo,estadoCivil,jsonTelefone,jsonEmail,callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastro.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: "grava", id: id, ativo: ativo, nome: nome , cpf: cpf , dataNascimento: dataNascimento,rg: rg,sexo : sexo,estadoCivil : estadoCivil,jsonTelefone : jsonTelefone,jsonEmail : jsonEmail},   
        success: function (data) {
        callback(data);
        } 
    }); 
}

function recuperaFuncionario(id, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastro.php', //caminho do arquivo a ser executado
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
        url: 'js/sqlscope_funcionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'excluir', id: id}, //valores enviados ao script      
        success: function (data) {
            callback(data); 
        }
    });
}

function validaCpfExistente(cpf, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'validaCpf', cpf: cpf}, //valores enviados ao script      
        success: function (data) {
            
            callback(data); 
        }
    });
}

function validaRgExistente(rg, callback) {
    $.ajax({
        url: 'js/sqlscope_funcionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {funcao: 'validaRg', rg: rg}, //valores enviados ao script      
        success: function (data) {
            
            callback(data); 
        }
    });
}