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

if ($funcao == 'validaEmail') {
    call_user_func($funcao);
}

if ($funcao == 'validaCpf') {
    call_user_func($funcao);
}

if ($funcao == 'validaRg') {
    call_user_func($funcao);
}

return;

function grava(){



    session_start();
    $id = (int)$_POST['id'];
    $ativo = (int)$_POST['ativo'];
    $nome = "'" . $_POST['nome'] . "'";
    $dataNascimento = $_POST['dataNascimento'];
    $dataNascimento = explode("/", $dataNascimento);
    $dataNascimento = "'" . $dataNascimento[2] . "-" . $dataNascimento[1] . "-" . $dataNascimento[0] . "'";
    $cpf = "'" . $_POST['cpf'] . "'";
    $rg = "'" . $_POST['rg'] . "'";
    $sexo = (int)$_POST['sexo'];
    $cep = "'" . $_POST['cep'] . "'";
    $estadoCivil = "'" . $_POST['estadoCivil'] . "'";
    $logradouro = "'" . $_POST['logradouro'] . "'";
    $numero = "'" . $_POST['numero'] . "'";
    $complemento = "'" . $_POST['complemento'] . "'";
    $uf = "'" . $_POST['uf'] . "'";
    $bairro = "'" . $_POST['bairro'] . "'";
    $cidade = "'" . $_POST['cidade'] . "'";

    $strArrayTelefone = $_POST['jsonTelefoneArray'];
    $arrayTelefone = json_decode($strArrayTelefone, true);

    $xmlTelefone = "";
    $nomeXml = "ArrayOfFuncionarioTelefone";
    $nomeTabela = "funcionarioTelefone";
    if (sizeof($arrayTelefone) > 0) {
        $xmlTelefone = '<?xml version="1.0"?>';
        $xmlTelefone = $xmlTelefone . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';

        foreach ($arrayTelefone as $chave) {
            $xmlTelefone = $xmlTelefone . "<" . $nomeTabela . ">";
            foreach ($chave as $campo => $valor) {
                if (($campo === "sequencialTelefone")) {
                    continue;
                }
                $xmlTelefone = $xmlTelefone . "<" . $campo . ">" . $valor . "</" . $campo . ">";
            }
            $xmlTelefone = $xmlTelefone . "</" . $nomeTabela . ">";
        }
        $xmlTelefone = $xmlTelefone . "</" . $nomeXml . ">";
    } else {
        $xmlTelefone = '<?xml version="1.0"?>';
        $xmlTelefone = $xmlTelefone . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        $xmlTelefone = $xmlTelefone . "</" . $nomeXml . ">";
    }
    $xml = simplexml_load_string($xmlTelefone);
    if ($xml === false) {
        $mensagem = "Erro na criação do XML de telefone";
        echo "failed#" . $mensagem . ' ';
        return;
    }
    $xmlTelefone = "'" . $xmlTelefone . "'";

    //------------------------- Funcionário Email---------------------

    $strArrayEmail = $_POST['jsonEmailArray'];
    $arrayEmail = json_decode($strArrayEmail, true);

    $xmlEmail = "";
    $nomeXml = "ArrayOfFuncionarioEmail";
    $nomeTabela = "funcionarioEmail";
    if (sizeof($arrayEmail) > 0) {
        $xmlEmail = '<?xml version="1.0"?>';
        $xmlEmail = $xmlEmail . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';

        foreach ($arrayEmail as $chave) {
            $xmlEmail = $xmlEmail . "<" . $nomeTabela . ">";
            foreach ($chave as $campo => $valor) {
                if (($campo === "sequencialEmail")) {
                    continue;
                }
                $xmlEmail = $xmlEmail . "<" . $campo . ">" . $valor . "</" . $campo . ">";
            }
            $xmlEmail = $xmlEmail . "</" . $nomeTabela . ">";
        }
        $xmlEmail = $xmlEmail . "</" . $nomeXml . ">";
    } else {
        $xmlEmail = '<?xml version="1.0"?>';
        $xmlEmail = $xmlEmail . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        $xmlEmail = $xmlEmail . "</" . $nomeXml . ">";
    }
    $xml = simplexml_load_string($xmlEmail);
    if ($xml === false) {
        $mensagem = "Erro na criação do XML de telefone";
        echo "failed#" . $mensagem . ' ';
        return;
    }
    $xmlEmail = "'" . $xmlEmail . "'";

    $sql = "dbo.funcionario_Atualiza
            $id,
            $ativo,
            $nome,
            $dataNascimento,
            $cpf,
            $rg,
            $sexo,
            $estadoCivil,
            $cep,
            $logradouro,
            $numero,
            $complemento,
            $uf,
            $bairro,
            $cidade,
            $xmlTelefone,
            $xmlEmail";

    $reposit = new reposit(); //Abre a conexão.
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


    $sql = "SELECT codigo
    ,ativo
    ,nome
    ,dataNascimento
    ,cpf
    ,rg
    ,sexo
    ,estadoCivil
    ,cep
    ,logradouro
    ,numero
    ,complemento
    ,uf
    ,bairro
    ,cidade
    
    

    FROM dbo.funcionario WHERE (0 = 0)";


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
        $rg = $row['rg'];
        $sexo = $row['sexo'];
        $estadoCivil = $row['estadoCivil'];
        $cep = $row['cep'];
        $logradouro = $row['logradouro'];
        $numero = $row['numero'];
        $complemento = $row['complemento'];
        $uf = $row['uf'];
        $bairro = $row['bairro'];
        $cidade = $row['cidade'];


        $sql = "SELECT codigo
        ,email
        ,principal
        ,funcionario

    FROM dbo.funcionarioEmail WHERE (0 = 0)";

        $sql = $sql . " AND funcionario = " . $codigo;

        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        $contadorEmail = 0;
        $arrayEmail = array();
        foreach ($result as $row) {
            $emailId = $row['codigo'];
            $email = $row['email'];
            $principal = +$row['principal'];

            if ($principal === 1) {
                $descricaoEmailPrincipal = "Sim";
            } else {
                $descricaoEmailPrincipal = "Não";
            }

            $contadorEmail = $contadorEmail + 1;
            $arrayEmail[] = array(
                "sequencialEmail" => $contadorEmail,
                "emailId" => $emailId,
                "email" => $email,
                "principal" => $principal,
                "descricaoEmailPrincipal" => $descricaoEmailPrincipal
            );
        }

        $strArrayEmail = json_encode($arrayEmail);

        $sql = "SELECT codigo
        ,telefone
        ,principal
        ,whatsapp
        ,funcionario

    FROM dbo.funcionarioTelefone WHERE (0 = 0)";

        $sql = $sql . " AND funcionario = " . $codigo;

        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        $contadorTelefone = 0;
        $arrayTelefone = array();
        foreach ($result as $row) {
            $telefoneId = $row['codigo'];
            $telefone = $row['telefone'];
            $principal = +$row['principal'];
            $whatsapp = +$row['whatsapp'];

            if ($principal === 1) {
                $descricaoPrincipal = "Sim";
            } else {
                $descricaoPrincipal = "Não";
            }
            if ($whatsapp === 1) {
                $descricaoWhatsapp = "Sim";
            } else {
                $descricaoWhatsapp = "Não";
            }


            $contadorTelefone = $contadorTelefone + 1;
            $arrayTelefone[] = array(
                "sequencialTelefone" => $contadorTelefone,
                "telefoneId" => $telefoneId,
                "telefone" => $telefone,
                "whatsapp" => $whatsapp,
                "descricaoTelefoneWhatsapp" => $descricaoWhatsapp,
                "principal" => $principal,
                "descricaoTelefonePrincipal" => $descricaoPrincipal
            );
        }

        $strArrayTelefone = json_encode($arrayTelefone);


        $out = $id . "^" . $ativo . "^" . $nome . "^" . $dataNascimento . "^" . $cpf . "^" . $rg . "^" . $sexo . "^" . $estadoCivil . "^" . $cep. "^" . 
         $logradouro . "^" . $numero . "^" . $complemento . "^" . $uf . "^" . $bairro . "^" . $cidade . "^" . $strArrayEmail . "^" . $strArrayTelefone;

        if ($out == "") {
            echo "failed#";
        }
        if ($out != '') {
            echo "sucess#" . $out . "#" . $strArrayEmail . "#" . $strArrayTelefone;
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
    return;
}

function validaEmail(){
    $email = "'" . $_POST["email"] . "'";

    $sql = "SELECT email 
    FROM dbo.funcionarioEmail 
    WHERE email = $email";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);


    if ($result[0]["email"] === $_POST["email"]) {
        echo 'failed#';
        return;
    }

    echo 'sucess#';
    return;
}

function validaRg(){
    $rg = "'" . $_POST["rg"] . "'";

    $sql = "SELECT rg FROM dbo.funcionario WHERE rg = $rg";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);


    if ($result[0]["rg"] === $_POST["rg"]) {
        echo 'failed#';
        return;
    }

    echo 'sucess#';
    return;
}
