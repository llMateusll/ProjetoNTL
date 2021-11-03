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