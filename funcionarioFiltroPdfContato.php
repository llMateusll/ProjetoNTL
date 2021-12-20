<?php

use PhpOffice\PhpSpreadsheet\Worksheet\Row;

include "repositorio.php";

//initilize the page
require_once("inc/init.php");

include "repositorio.php";

//initilize the page
require_once("inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

require('./fpdf/mc_table.php');

if ((empty($_GET["id"])) || (!isset($_GET["id"])) || (is_null($_GET["id"]))) {
    $mensagem = "Nenhum parâmetro de pesquisa foi informado.";
    echo "failed#" . $mensagem . ' ';
    return;
} else {
    $id = +$_GET["id"];
}
$sql = "SELECT codigo
,ativo
,nome
FROM dbo.funcionario 
WHERE (0=0) AND codigo =" . $id;

$reposit = new reposit();
$result = $reposit->RunQuery($sql);

$arrayFuncionario = array();
foreach ($result as $row) {

    $id = +$row['codigo'];
    $ativo = +$row['ativo'];
    $nome = $row['nome'];
}
$reposit = new reposit();
$result =  $reposit->RunQuery($sql);
$row = $result[0];
$reposit ="";
$result = "";


$sql = "SELECT codigo
        ,telefone
        ,principal
        ,whatsapp
        ,funcionario

    FROM dbo.funcionarioTelefone WHERE (0 = 0)";

$sql = $sql . " AND funcionario = " . $id;

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
    $strArrayTelefone = json_encode($arrayTelefone);
}

$reposit ="";
$result = "";

$sql = "SELECT codigo
        ,email
        ,principal
        ,funcionario

    FROM dbo.funcionarioEmail WHERE (0 = 0)";

$sql = $sql . " AND funcionario = " . $id;

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





require_once('fpdf/fpdf.php');

class PDF extends FPDF
{

    function Header()
    {
        global $codigo;

        //        if ($nomeLogoRelatorio != "")
        //        $this->SetFont('Arial', '', 8); #Seta a Fonte
        //        $dataAux = new DateTime();
        //        $dataAux->setTimezone(new DateTimeZone("GMT-3"));
        //        $dataAtualizada = $dataAux->format('d/m/Y H:i:s');
        //        $this->Cell(288, 0, $dataAtualizada, 0, 0, 'R', 0); #Título do Relatório
        $this->Cell(116, 1, "", 0, 1, 'C', 0); #Título do Relatório
        $this->Image('img/logoNTLnova.png', 5, 10, 70, 20); #logo da empresa
        $this->SetXY(190, 5);
        $this->SetFont('Arial', 'B', 8); #Seta a Fonte
        $this->Cell(20, 5, 'Pagina ' . $this->pageno()); #Imprime o Número das Páginas

        $this->Ln(11); #Quebra de Linhas
        $this->Ln(8);
    }

    function Footer()
    {

        $this->SetY(202);
    }
}

$pdf = new PDF('P', 'mm', 'A4'); #Crio o PDF padrão RETRATO, Medida em Milímetro e papel A$
$pdf->SetMargins(5, 10, 5); #Seta a Margin Esquerda com 20 milímetro, superrior com 20 milímetro e esquerda com 20 milímetros
$pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrirá em tamanho PADRÃO e as páginas na exibição serão contínuas
$pdf->AddPage();
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Line(5, $linha + 117, 205, $linha + 117); #Linha na Horizontal
$pdf->Cell(193, 4, iconv('UTF-8', 'windows-1252', " CONTATOS"), 0, 0, "C", 0);
$linha = $pdf->Ultimalinha();
$pdf->Ln(6);
$pdf->Line(50, 33, 210-50, 33);
$pdf->SetFillColor(234, 234, 234);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Ln(1);

$pdf->SetX(68);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(22, 5, iconv('UTF-8', 'windows-1252', "Funcionário :"), 0, 0, "C", 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(43, 5, iconv('UTF-8', 'windows-1252', $nome), 0, 0, "C", 0);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetX(65);

$pdf->Cell(30, 5, iconv('UTF-8', 'windows-1252', "Telefone"), 1, 0, "C", true);
$pdf->Cell(22, 5, iconv('UTF-8', 'windows-1252', 'Whatsapp '), 1, 0, "C", true);
$pdf->Cell(22, 5, iconv('UTF-8', 'windows-1252', 'Principal'), 1, 0, "C", true);

$pdf->Ln();

$pdf->SetFont('Arial', '', 8);
$contador = 0;

foreach ($arrayTelefone as $key) {

    $contador = $contador + 1;

    $sequencialTelefone = $key["sequencialTelefone"];

    $telefone = $key["telefone"];
    $telefone = iconv('UTF-8', 'windows-1252', $telefone);

    $whatsapp = $key["descricaoTelefoneWhatsapp"];
    $whatsapp = iconv('UTF-8', 'windows-1252', $whatsapp);

    $principal = $key["descricaoTelefonePrincipal"];
    $principal = iconv('UTF-8', 'windows-1252', $principal);

    $pdf->SetX(65);
    $pdf->SetWidths(array(30, 22, 22, 30, 50, 33, 10, 20, 20, 20, 20, 20, 30));
    $pdf->Row(array($telefone, $whatsapp, $principal));
}

$pdf->Ln(15); 
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetX(61);
$pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252', "Email"), 1, 0, "C", true);
$pdf->Cell(22, 5, iconv('UTF-8', 'windows-1252', 'Principal'), 1, 0, "C", true);



$pdf->Ln();

$pdf->SetFont('Arial', '', 8);
$contador = 0;
foreach ($arrayEmail as $key) {

    $contador = $contador + 1;

    $sequencialEmail = $key["sequencialEmail"];

    $email = $key["email"];
    $email = iconv('UTF-8', 'windows-1252', $email);

    $principal = $key["descricaoEmailPrincipal"];
    $principal = iconv('UTF-8', 'windows-1252', $principal);

   
    $pdf->SetWidths(array(60, 22, 40, 30, 50, 33, 10, 20, 20, 20, 20, 20, 30));
    $pdf->SetX(61);
    $pdf->Row(array($email, $principal));
    
}
$pdf->SetFillColor(234, 234, 234);
$pdf->SetFont('Arial', 'B', 8);
$pdf->SetX(35);

$pdf->Ln(5);

$pdf->SetFont('Arial', '', 8);
$contador = 0;


$pdf->Ln(8);

$pdf->Output();
