<?php

require('./fpdf.php');
include_once("../model/equipos.php");

    $equipos_instance = New Equipos();
    $codigo = $_GET["codigo"];
    $nombre = $_GET["nombre"];
    $marca  = $_GET["marca"];
    $modelo = $_GET["modelo"];
    $exc_equipos = $equipos_instance->filter($codigo, $nombre, $marca, $modelo);

    $fecha = date("Y/m/d");
   
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(100,10,'REPORTE DE EQUIPOS REGISTRADOS');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,5,"Filtros aplicados: Codigos con '".$codigo."', Nombres con '".$nombre."', Marcas con '".$marca."', Modelos con '".$modelo."'" );
$pdf->Ln();
$pdf->Cell(100,7,'Fecha: '.$fecha);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'Codigo');
$pdf->Cell(60,10,'Descripcion');
$pdf->Cell(30,10,'Marca');
$pdf->Cell(50,10,'Modelo');
$pdf->Ln();
$pdf->SetFont('Arial','',8);

$string = "Texto con codificación diferente";
    $from_encoding = "ISO-8859-1"; // La codificación actual de la cadena
    $to_encoding = "UTF-8"; 

    $string_utf8 = iconv($from_encoding, $to_encoding, $string);

while($equipos = mysqli_fetch_assoc($exc_equipos)){
   
    $pdf->Cell(30,10,$equipos["codigo"]);
    $pdf->Cell(60,10,utf8_decode($equipos["description"]));
    $pdf->Cell(30,10,$equipos["marca"]);
    $pdf->Cell(50,10,$equipos["modelo"]);
    $pdf->Ln();
}

$pdf->Output();
?>