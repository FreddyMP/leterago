<?php

require('./fpdf.php');
include('../model/mantenimiento.php');

$mantenimientos_instance = new Mantenimiento();


$codigo = $_GET["codigo"];
$nombre = $_GET["nombre"];
$ubicacion  = $_GET["ubicacion"];
$desde = $_GET["desde"];
$hasta = $_GET["hasta"]; 
$mantenimientos = $mantenimientos_instance->filter_all($codigo, $nombre, $ubicacion, $desde, $hasta);
$fecha = date("Y/m/d");
   
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(100,10,'REPORTE DE MANTENIMIENTOS');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,5,"Filtros aplicados: Codigos con '".$codigo."', Nombres con '".$nombre."', Ubicacion con '".$ubicacion."', Fecha desde con '".$desde."', Fecha hasta '".$hasta."'" );
$pdf->Ln();
$pdf->Cell(100,7,'Fecha: '.$fecha);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'Codigo');
$pdf->Cell(60,10,'Descripcion');
$pdf->Cell(75,10,'Ubicacion');
$pdf->Cell(50,10,'Fecha');
$pdf->Ln();
$pdf->SetFont('Arial','',8);


while($equipos = mysqli_fetch_assoc($mantenimientos)){
   
    $pdf->Cell(30,10,$equipos["documento"]);
    $pdf->Cell(60,10,utf8_decode($equipos["description"]));
    $pdf->Cell(75,10,$equipos["ubicacion"]);
    $pdf->Cell(50,10,$equipos["fecha"]);
    $pdf->Ln();
}

$pdf->Output();
?>