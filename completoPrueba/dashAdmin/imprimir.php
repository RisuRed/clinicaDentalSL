<?php
$IdCon = $_REQUEST['IdCon'];
$IdCit = $_REQUEST['IdCit'];
$CanT = $_REQUEST['CanT'];
$tc = $_REQUEST['tc'];
$SubTotal = $_REQUEST['SubTotal'];
$Total = $_REQUEST['Total'];



   require('fpdf/fpdf.php');
    $pdf = new FPDF('L', 'mm', array(120,150));
    $pdf->AddPage();
    $pdf->SetTitle('Consulta');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(55);
    $pdf->Cell(5,5,utf8_decode('SmileLife'));
    $pdf->Ln();
    $pdf->Cell(36);
    $pdf->Cell(5,5,utf8_decode('Dra. Lenia Hernandez Covarrubias'));
    $pdf->Image('img/corazon.png',10,5,15,15);
    $pdf->Image('img/linea.png',0,0,150,10);
    $pdf->Image('img/linea.png',0,16,150,10);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(3);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(5,5,utf8_decode('Consulta numero:'));
    $pdf->Cell(20);
    $pdf->Cell(5,5,utf8_decode("$IdCon"));

    $pdf->Cell(60);
    $pdf->Cell(5,5,utf8_decode('FECHA:'));
    $pdf->Cell(10);
    $pdf->Cell(5,5,utf8_decode("08/11/2022"));

    $pdf->Ln();
    $pdf->Cell(3);
    $pdf->Cell(5,5,utf8_decode('Cita numero:'));
    $pdf->Cell(13);
    $pdf->Cell(5,5,utf8_decode("$IdCit"));

    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(3);
    $pdf->Cell(5,5,utf8_decode('Tratamientos'));
    $pdf->Cell(95);
    $pdf->Cell(5,5,utf8_decode('Precios'));
    $pdf->Image('img/linea.png',0,40,150,10);
    $pdf->Ln();
    $pdf->Ln(); 
    $pdf->Cell(3);
    $pdf->MultiCell(70,5,utf8_decode("$tc"));
    
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(90);
    $pdf->Cell(5,5,utf8_decode('Sub-Total'));
    $pdf->Cell(10);
    $pdf->Cell(5,5,utf8_decode("$SubTotal"));
    $pdf->Ln();
    $pdf->Cell(90);
    $pdf->Cell(5,5,utf8_decode('Total'));
    $pdf->Cell(10);
    $pdf->Cell(5,5,utf8_decode("$Total"));

    $pdf->Image('img/diente.png',110,90,30,30);
    $pdf->Output(); 
//}

//print json_encode($data, JSON_UNESCAPED_UNICODE); 

?>