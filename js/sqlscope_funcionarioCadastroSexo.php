<?php

include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'gravarSexo') {
    call_user_func($funcao);
}

if ($funcao == 'recupera') {
    call_user_func($funcao);
}

if ($funcao == 'excluir') {
    call_user_func($funcao);
}

if ($funcao == 'validaSexo') {
    call_user_func($funcao);
}
return;

function validaSexo()
{
    $sexo = "'" . $_POST["sexo"] . "'";
    $id = (int)$_POST["id"];
    if ($id != 0) {
        $sql = "SELECT sexo FROM dbo.sexo WHERE sexo = $sexo and ativo = 0 ";
    } else {
        $sql = "SELECT sexo FROM dbo.sexo WHERE sexo = $sexo";
    }
    
    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);
    $row = $result[0];


    if ($row == false) {
        echo 'sucess#';
        return;
    }
    echo 'failed#';
   
    return;
}

function gravarSexo()
{

    $reposit = new reposit(); //Abre a conexão.


    session_start();
    $id = (int)$_POST['id'];
    $ativo = $_POST['ativo'];
    $sexo = "'" . $_POST['sexo'] . "'";

    $sql = "dbo.sexo_Atualiza
            $id,
            $ativo,
            $sexo";

    $result = $reposit->Execprocedure($sql);

    $ret = 'sucess#';
    if ($result < 1) {
        $ret = 'failed#';
    }

    echo $ret;
    return;
}

function recupera()
{
    $codigo = $_POST["id"];


    $sql = "SELECT * FROM dbo.sexo WHERE (0 = 0)";


    $sql = $sql . " AND codigo = " . $codigo;


    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";

    if ($row = $result[0]) {

        $id = +$row['codigo'];
        $ativo = $row['ativo'];
        $sexo = $row['sexo'];


        $out = $id . "^" . $ativo . "^" . $sexo;

        if ($out == "") {
            echo "failed#";
        }
        if ($out != '') {
            echo "sucess#" . $out;
        }
        return;
    }
}

function excluir()
{

    $reposit = new reposit();

    $id = $_POST["id"];

    if ((empty($_POST['id']) || (!isset($_POST['id'])) || (is_null($_POST['id'])))) {
        $mensagem = "Selecione um lancamento";
        echo "failed#" . $mensagem . ' ';
        return;
    }

    $result = $reposit->update('dbo.sexo' . '|' . 'ativo = 0' . '|' . 'codigo = ' . $id);

    if ($result < 1) {
        echo ('failed#');
        return;
    }

    echo 'sucess#' . $result;
    return;
}
