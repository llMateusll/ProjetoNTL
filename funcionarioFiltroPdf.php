<?php

include "repositorio.php";

//initilize the page
require_once("inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

require('./fpdf/mc_table.php');

if ((empty($_GET["sexo"])) || (!isset($_GET["sexo"])) || (is_null($_GET["sexo"]))) {
    $mensagem = "Nenhum parâmetro de pesquisa foi informado.";
    echo "failed#" . $mensagem . ' ';
    return;
} else {
    $id = +$_GET["sexo"];
}

$sql = "SELECT *
FROM dbo.funcionario WHERE (0=0) AND sexo =" . $id;

$reposit = new reposit();
$result = $reposit->RunQuery($sql);
$out = "";
$row = $result[0];
if ($row) {

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
    $estadoCivil = +$row['estadoCivil'];
    $cep = $row['cep'];
    $logradouro = $row['logradouro'];
    $numero = $row['numero'];
    $complemento = $row['complemento'];
    $uf = $row['uf'];
    $bairro = $row['bairro'];
    $cidade = $row['cidade'];
    $primeiroEmprego = $row['primeiroEmprego'];
    $pispasep = $row['pispasep'];

    $estadosCivil = "";
    if ($estadoCivil == 1) {
        $estadosCivil = "Viúvo(a)";
    }
    if ($estadoCivil == 2) {
        $estadosCivil = "Divorciado(a)";
    }
    if ($estadoCivil == 3) {
        $estadosCivil = "Separado(a)";
    }
    if ($estadoCivil == 4) {
        $estadosCivil = "Casado(a)";
    }
    if ($estadoCivil == 5) {
        $estadosCivil = "Solteiro(a)";
    }


    $descricaoAtivo = "";
    if ($ativo == 1) {
        $descricaoAtivo = "Sim";
    } else {
        $descricaoAtivo = "Não";
    }

    $dataNascimento = explode(" ", $dataNascimento);
    $dataNascimento = explode("-", $dataNascimento[0]);
    $dataNascimento = $dataNascimento[2] . "/" . $dataNascimento[1] . "/" .
    $dataNascimento[0];
}


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
        $this->Image('img/images.jpg', 10, 5, 30, 20); #logo da empresa
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



$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Line(5, $linha + 87, 205, $linha + 87); #Linha na Horizontal
$pdf->Cell(193, 5, iconv('UTF-8', 'windows-1252', "DADOS DO FUNCIONARIOS"), 0, 0, "C", 0);
$linha = $pdf->Ultimalinha();
$pdf->Ln(6);
$pdf->Line(5, $linha + 2, 205, $linha + 2); #Linha na Horizontal
$pdf->SetFillColor(234, 234, 234);
$pdf->SetFont('Arial', 'B', 7);




$pdf->Cell(31, 7, iconv('UTF-8', 'windows-1252', "Funcionario"), 1, 0, "C", true);
$pdf->Cell(15, 7, iconv('UTF-8', 'windows-1252', 'Ativo'), 1, 0, "C", true);
$pdf->Cell(29, 7, iconv('UTF-8', 'windows-1252', 'Data De Nascimento'), 1, 0, "C", true);
$pdf->Cell(29, 7, iconv('UTF-8', 'windows-1252', 'CPF'), 1, 0, "C", true);
$pdf->Cell(29, 7, iconv('UTF-8', 'windows-1252', 'RG'), 1, 0, "C", true);
$pdf->Cell(29, 7, iconv('UTF-8', 'windows-1252', 'Gêneros'), 1, 0, "C", true);
$pdf->Cell(25, 7, iconv('UTF-8', 'windows-1252', 'Estado Civil'), 1, 0, "C", true);

$pdf->Ln();

$pdf->SetFont('Arial', '', 8);
$contador = 0;
foreach ($arrayFuncionario as $key) {

    $contador = $contador + 1;
    $nome = $key["sequencialFuncionario"];
    $trajetoFuncionario = $key["trajetoFuncionario"];

    $nome = $key["nome"];
    $nome = iconv('UTF-8', 'windows-1252', $nome);

    $descricaoAtivo = $key["descricaoAtivo"];
    $descricaoAtivo = iconv('UTF-8', 'windows-1252', $descricaoAtivo);

    $dataNascimento = $key["dataNascimento"];
    $dataNascimento = iconv('UTF-8', 'windows-1252', $dataNascimento);

    $pdf->SetX(35);
    $pdf->SetWidths(array(30, 35, 40, 30, 50, 33, 10, 20, 20, 20, 20, 20, 30));
    $pdf->Row(array($trajetoFuncionario, $tipoFuncionario, $linhaFuncionario, $valorFuncionario));
}
$pdf->Ln(8);








$pdf->Ln();

$pdf->SetFillColor(234, 234, 234);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Ln();


$pdf->Ln();

$pdf->SetFont('Arial', '', 8);
$contador = 0;


$pdf->Ln(8);

$pdf->Output();
