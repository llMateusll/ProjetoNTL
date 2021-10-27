<?php

include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'grava') {
    call_user_func($funcao);
}

if ($funcao == 'recupera') {
    call_user_func($funcao);
}

if ($funcao == 'excluir') {
    call_user_func($funcao);
}
if ($funcao == 'validaCpf') {
    call_user_func($funcao);
}

return;

function grava()
{

    $reposit = new reposit(); //Abre a conexão.


    session_start();
    $id = (int)$_POST['id'];
    $ativo = (int)$_POST['ativo'];
    $nome = "'" . $_POST['nome'] . "'";
    $dataNascimento = $_POST['dataNascimento'];
    $dataNascimento = explode("/", $dataNascimento);
    $dataNascimento = "'" . $dataNascimento[2] . "-" . $dataNascimento[1] . "-" . $dataNascimento[0] . "'";
    $cpf = "'" . $_POST['cpf'] . "'";

    $sql = "dbo.funcionario_Atualiza
            $id,
            $ativo,
            $nome,
            $dataNascimento,
            $cpf";

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


    $sql = "SELECT codigo, ativo, nome, dataNascimento,cpf FROM dbo.funcionario WHERE (0 = 0)";


    $sql = $sql . " AND codigo = " . $codigo;


    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";

    if ($row = $result[0]) {

        $id = +$row['codigo'];
        $ativo = +$row['ativo'];
        $nome = $row['nome'];
        $dataNascimento = $row['dataNascimento'];
        $dataNascimento = explode(" ", $dataNascimento);
        $dataNascimento = explode("-", $dataNascimento[0]);
        $dataNascimento = $dataNascimento[2] . "/" . $dataNascimento[1] . "/" . $dataNascimento[0];
        $cpf = $row['cpf'];


        $out = $id . "^" . $ativo . "^" . $nome . "^" . $dataNascimento . "^" . $cpf;

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

    $result = $reposit->update('dbo.funcionario' . '|' . 'ativo = 0' . '|' . 'codigo = ' . $id);

    if ($result < 1) {
        echo ('failed#');
        return;
    }

    echo 'sucess#' . $result;
    return;
}

function validaCpf(){
    $cpf = "'" . $_POST["cpf"] . "'";

    $sql = "SELECT cpf FROM dbo.funcionario WHERE cpf = $cpf";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);


    if ($result[0]["cpf"] === $_POST["cpf"]) {
        echo 'failed#';
        return;
    }
    
    echo 'sucess#';
    return ;
}