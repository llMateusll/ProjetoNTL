<?php

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
        ,telefone
        ,principal
        ,whatsapp
        ,funcionario

    FROM dbo.funcionarioTelefone WHERE (0 = 0)";

        $sql = $sql . " AND codigo = " . $id;

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

//$pdf->SetFont('Arial','',10);
//$pdf->SetLeftMargin(10);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(193, 5, iconv('UTF-8', 'windows-1252', "CONCESSÃO DE PEDIDO DE VALE TRANSPORTE"), 0, 0, "C", 0);
$pdf->Ln(10);
$pdf->Line(5, 30, 205, 30); #Linha na Horizontal
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(193, 3, iconv('UTF-8', 'windows-1252', "Solicita a utilização do VALE TRANSPORTE: 
"), 0, 0, "L", 0);
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "$sim"), 0, 0, "L", 0);
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "$nao Porque: _________________________________________
"), 0, 0, "L", 0);
$pdf->SetX(28);
$pdf->Cell(93, 5, iconv('UTF-8', 'windows-1252', $justificativaVt), 100, 0, "L", 0);

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "Possui Cartão:" . $possuiVt . "  Número do Cartão:________________
"), 0, 0, "L", 0);
$pdf->SetX(75);
$pdf->Cell(90, 5, iconv('UTF-8', 'windows-1252', $telefone), 100, 0, "L", 0);
$pdf->SetX(100);
$pdf->Cell(90, 5, iconv('UTF-8', 'windows-1252', "Tipo do Cartão: "), 100, 0, "L", 0);
$pdf->Ln(5);
$pdf->Line(5, 53, 205, 53); #Linha na Horizontal
$pdf->SetFont('Arial', 'B', 8);
$pdf->Ln(3);
$pdf->Multicell(0, 3, iconv('UTF-8', 'windows-1252', "Interessado em receber o VALE TRANSPORTE, ciente de minha participação referente ao desconto percentual que me cabe em meu contra-cheque, nos Termos da Lei. No. 7418 de dezembro de 1985, forneço abaixo as informações necessárias para tanto:"), 0, 'J');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(193, 12, iconv('UTF-8', 'windows-1252', "DADOS DO CANDIDATO"), 0, 0, "C", 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "Candidato :"), 0, 0, "L", 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(90, 5, iconv('UTF-8', 'windows-1252', $nomeCompleto), 0, 0, "L", 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(16, 5, iconv('UTF-8', 'windows-1252', "Endereço:"), 0, 0, "L", 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(90, 5, iconv('UTF-8', 'windows-1252', $endereco . ", " . $numero . "."), 0, 0, "L", 0);
$pdf->SetFont('Arial', 'B', 8);

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(12, 5, iconv('UTF-8', 'windows-1252', "Bairro :"), 0, 0, "L", 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(70, 5, iconv('UTF-8', 'windows-1252', $bairro), 0, 0, "L", 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(12, 5, iconv('UTF-8', 'windows-1252', "Cidade:"), 0, 0, "L", 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252', $cidade), 0, 0, "L", 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(12, 5, iconv('UTF-8', 'windows-1252', "Estado:"), 0, 0, "L", 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(2, 5, iconv('UTF-8', 'windows-1252', $estado), 0, 0, "L", 0);
$pdf->Ln(5);
$pdf->Line(5, $linha + 63, 205, $linha + 63); #Linha na Horizontal

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Line(5, $linha + 87, 205, $linha + 87); #Linha na Horizontal
$pdf->Cell(193, 5, iconv('UTF-8', 'windows-1252', "TRANSPORTE UTILIZADO"), 0, 0, "C", 0);
$linha = $pdf->Ultimalinha();
$pdf->Ln(6);
$pdf->Line(5, $linha + 2, 205, $linha + 2); #Linha na Horizontal
$pdf->SetFillColor(234, 234, 234);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Ln(5);

$pdf->SetX(35);

$pdf->Cell(30, 10, iconv('UTF-8', 'windows-1252', "telefone"), 1, 0, "C", true);
$pdf->Cell(35, 10, iconv('UTF-8', 'windows-1252', 'whatsapp'), 1, 0, "C", true);


$pdf->Ln();

$pdf->SetFont('Arial', '', 8);
$contador = 0;
foreach ($arrayTelefone as $key) {

    $contador = $contador + 1;
    $telefone = $key["telefone"];
    $whatsapp = $key["whatsapp"];

    

    $pdf->SetX(35);
    $pdf->SetWidths(array(30, 35, 40, 30, 50, 33, 10, 20, 20, 20, 20, 20, 30));
    $pdf->Row(array($telefone, $whatsapp));
}
$pdf->Ln(8);


$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(193, 5, iconv('UTF-8', 'windows-1252', "DECLARAÇÃO"), 0, 0, "C", 0);

$linha = $pdf->Ultimalinha();
$pdf->Ln(6);


$pdf->Line(5, $linha + 2, 205, $linha + 2); #Linha na Horizontal
$pdf->SetFont('Arial', 'B', 7);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Multicell(0, 3, iconv('UTF-8', 'windows-1252', "Comprometo-me a utilizar o VALE TRANSPORTE unicamente para o deslocamento Residência / Trabalho / Residência,
bem como a manter atualizadas as informações acima prestadas."), 0, 'J');
$pdf->Ln(3);
$pdf->Multicell(0, 3, iconv('UTF-8', 'windows-1252', "Declaro ainda, que as informações supra, são a expressão da verdade, ciente de que o erro nas mesmas ou o uso indevido do Vale Transporte,
constituirá falta grave, ensejando punição, nos Termos da Legislação específica."), 0, 'J');
$pdf->Ln(8);
$pdf->Line(5, $linha + 25, 205, $linha + 25); #Linha na Horizontal
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(100, 5, iconv('UTF-8', 'windows-1252', "Local:_________________________________________________"), 0, 0, "L", 0);
// $pdf->SetFont('Arial', '', 8);
// $pdf->Cell(70, 5, iconv('UTF-8', 'windows-1252', $bairro), 0, 0, "L", 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(12, 5, iconv('UTF-8', 'windows-1252', "Data :_______________________________"), 0, 0, "L", 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(16, 5, iconv('UTF-8', 'windows-1252', "Nome Completo / Assinatura:___________________________________________________________________________"), 0, 0, "L", 0);
$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(30, 5, iconv('UTF-8', 'windows-1252', "Carteira de Trabalho:________________"), 0, 0, "L", 0);
$pdf->Cell(2, 5, iconv('UTF-8', 'windows-1252', $pis), 0, 0, "L", 0);
$pdf->Ln(8);


$pdf->SetFillColor(234, 234, 234);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Ln();


$pdf->Ln();

$pdf->SetFont('Arial', '', 8);
$contador = 0;


$pdf->Ln(8);

$pdf->Output();
