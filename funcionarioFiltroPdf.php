<?php

include "repositorio.php";

//initilize the page
require_once("inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

require('./fpdf/mc_table.php');


    $id = $_GET["sexo"];

if($id == ""){
$sql = "SELECT F.codigo
,F.ativo
,F.nome
,F.dataNascimento
,F.cpf
,F.rg
,F.sexo
,F.estadoCivil
,F.cep
,F.logradouro
,F.numero
,F.complemento
,F.uf
,F.bairro
,F.cidade
,S.sexo
FROM dbo.funcionario F
LEFT JOIN dbo.sexo S
on F.sexo = S.codigo
";

}else{
    $sql = "SELECT F.codigo
,F.ativo
,F.nome
,F.dataNascimento
,F.cpf
,F.rg
,F.sexo
,F.estadoCivil
,F.cep
,F.logradouro
,F.numero
,F.complemento
,F.uf
,F.bairro
,F.cidade
,S.sexo
FROM dbo.funcionario F
LEFT JOIN dbo.sexo S
on F.sexo = S.codigo
 WHERE (0=0) AND F.sexo =" . $id;

}

$reposit = new reposit();
$result = $reposit->RunQuery($sql);

$contadorFuncionario = 0;
$arrayFuncionario = array();
foreach ($result as $row) {

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


    $contadorFuncionario = $contadorFuncionario + 1;
    $arrayFuncionario[] = array(
        "sequencialFuncionario" => $contadorFuncionario,
        "nome" => $nome,
        "ativo" => $descricaoAtivo,
        "dataNascimento" => $dataNascimento,
        "cpf" => $cpf,
        "rg" => $rg,
        "sexo" => $sexo,
        "estadosCivil" => $estadosCivil,
        "cep" => $cep,
        "logradouro" => $logradouro,
        "numero" => $numero,
        "complemento" => $complemento,
        "uf" => $uf,
        "bairro" => $bairro,
        "cidade" => $cidade

    );

    $strArrayFuncionario = json_encode($arrayFuncionario);
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






$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(193, 8, iconv('UTF-8', 'windows-1252', "DADOS DO FUNCIONARIOS"), 0, 0, "C", 0);
$pdf->Ln(6);
$pdf->Line(50, 30, 210-50, 30);
$baseY = 0;
$baseadd = 33;
$pdf->SetFont('Arial', '', 8);

$contador = -1;
foreach ($arrayFuncionario as $key) {

    $contador++;
    if ((($contador % 7) == 0) && $contador != 0) {
        $contador = 0;
        $pdf->AddPage();
        $baseY = 0;
    }

    $pdf->Line(5, $linha + $baseY + 65, 205, $linha + $baseY + 65); #Linha na Horizontal
    $pdf->SetX(15);
    $pdf->SetY(34 + $baseY);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(21, 5, iconv('UTF-8', 'windows-1252', "Funcionário :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 5, iconv('UTF-8', 'windows-1252', $key["nome"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(9, 5, iconv('UTF-8', 'windows-1252', "CPF :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(28, 5, iconv('UTF-8', 'windows-1252', $key["cpf"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(8, 5, iconv('UTF-8', 'windows-1252', "RG :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(23, 5, iconv('UTF-8', 'windows-1252', $key["rg"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(10, 5, iconv('UTF-8', 'windows-1252', "ativo :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(10, 5, iconv('UTF-8', 'windows-1252', $key["ativo"]), 0, 0, "L", 0);

    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(33, 5, iconv('UTF-8', 'windows-1252', "Data De Nascimento :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', $key["dataNascimento"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "Gênero :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', $key["sexo"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "EstadoCivil :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', $key["estadosCivil"]), 0, 0, "L", 0);
    $pdf->Ln(2);

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(193, 12, iconv('UTF-8', 'windows-1252', "ENDEREÇO"), 0, 0, "L", 0);

    $pdf->Ln(9);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(9, 5, iconv('UTF-8', 'windows-1252', "CEP :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(19, 5, iconv('UTF-8', 'windows-1252', $key["cep"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(9, 5, iconv('UTF-8', 'windows-1252', "Rua :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(25, 5, iconv('UTF-8', 'windows-1252', $key["logradouro"]), 0, 0, "L", 0);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "Numero :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(10, 5, iconv('UTF-8', 'windows-1252', $key["numero"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "Estado :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(12, 5, iconv('UTF-8', 'windows-1252', $key["uf"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(13, 5, iconv('UTF-8', 'windows-1252', "Bairro :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(12, 5, iconv('UTF-8', 'windows-1252', $key["bairro"]), 0, 0, "L", 0);
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(13, 5, iconv('UTF-8', 'windows-1252', "Cidade :"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(12, 5, iconv('UTF-8', 'windows-1252', $key["cidade"]), 0, 0, "L", 0);
    $pdf->Ln(5);
    
    $baseY = $baseY + $baseadd;
}
$pdf->Ln();

$pdf->Output();
