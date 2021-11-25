<?php

include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'gravarDescrição') {
    call_user_func($funcao);
}

if ($funcao == 'recupera') {
    call_user_func($funcao);
}

if ($funcao == 'excluir') {
    call_user_func($funcao);
}

if ($funcao == 'validarDescrição') {
    call_user_func($funcao);
}
return;

function validarDescrição(){
    $descricao = "'" . $_POST["descricao"] . "'";

    $sql = "SELECT descricao FROM dbo.dependente WHERE descricao = $descricao";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);


    if ($result[0]["descricao"] === $_POST["descricao"]) {
        echo 'failed#';
        return;
    }

    echo 'sucess#';
    return;
}

function gravarDescrição(){

    $reposit = new reposit(); //Abre a conexão.


    session_start();
    $id = (int)$_POST['id'];
    $ativo = $_POST['ativo'];
    $descricao = "'" . $_POST['descricao'] . "'";

    $sql = "dbo.dependente_Atualiza
            $id,
            $ativo,
            $descricao";

    $result = $reposit->Execprocedure($sql);

    $ret = 'sucess#';
    if ($result < 1) {
        $ret = 'failed#';
    }

    echo $ret;
    return;
}

function recupera(){
    $codigo = $_POST["id"];


    $sql = "SELECT * FROM dbo.dependente WHERE (0 = 0)";


    $sql = $sql . " AND codigo = " . $codigo;


    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";

    if ($row = $result[0]) {

        $id = +$row['codigo'];
        $ativo = $row['ativo'];
        $descricao = $row['descricao'];


        $out = $id . "^" . $ativo . "^" . $descricao;

        if ($out == "") {
            echo "failed#";
        }
        if ($out != '') {
            echo "sucess#" . $out;
        }
        return;
    }
}

function excluir(){

    $reposit = new reposit();

    $id = $_POST["id"];

    if ((empty($_POST['id']) || (!isset($_POST['id'])) || (is_null($_POST['id'])))) {
        $mensagem = "Selecione um lancamento";
        echo "failed#" . $mensagem . ' ';
        return;
    }

    $result = $reposit->update('dbo.dependente' . '|' . 'ativo = 0' . '|' . 'codigo = ' . $id);

    if ($result < 1) {
        echo ('failed#');
        return;
    }

    echo 'sucess#' . $result;
    return;
}