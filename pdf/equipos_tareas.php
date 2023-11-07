<?php

require('./fpdf.php');
include_once("../model/calendario.php");
  $calendario_instance = new Calendario();

    $codigo = $_GET["codigo"];
    $id = $_GET["id"];
    $nombre = $_GET["nombre"];
    $desde  = $_GET["desde"];
    $hasta = $_GET["hasta"];

    $calendarios = $calendario_instance->filter($id, $codigo, $nombre, $desde, $hasta);

    $fecha = date("Y/m/d");
   
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(100,10,'REPORTE DE EQUIPOS REGISTRADOS');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,5,"Filtros aplicados: Codigos con '".$codigo."', Nombres con '".$nombre."', Fecha desde  '".$desde."', Fecha hasta '".$hasta."'" );
$pdf->Ln();
$pdf->Cell(100,7,'Fecha: '.$fecha);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'Codigo');
$pdf->Cell(60,10,'Descripcion');
$pdf->Cell(30,10,'Fecha planificacion');

$pdf->Ln();
$pdf->SetFont('Arial','',8);

$string = "Texto con codificación diferente";
    $from_encoding = "ISO-8859-1"; // La codificación actual de la cadena
    $to_encoding = "UTF-8"; 

    $string_utf8 = iconv($from_encoding, $to_encoding, $string);

while($row= mysqli_fetch_assoc($calendarios) ){
   
    $pdf->Cell(30,10,$row["codigo"]);
    $pdf->Cell(60,10,utf8_decode($row["descripcion"]));
    $pdf->Cell(30,10,$row["fecha"]);
    #   $pdf->Cell(50,10,$row["modelo"]);
    $pdf->Ln();
}

$pdf->Output();
?>