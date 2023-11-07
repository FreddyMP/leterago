<?php
    require('./fpdf.php');
    include('../model/mantenimiento.php');

    $mantenimientos_instance = new Mantenimiento();

    $nombre = $_GET["nombre"];
    $id = $_GET["id"];
    $desde = $_GET["desde"];
    $hasta = $_GET["hasta"]; 

    $fecha = date("Y/m/d");

    $mantenimientos = $mantenimientos_instance->filter_find_by_equipo($id, $nombre, $desde, $hasta);

    $_Equipo = $mantenimientos_instance->find_with_equipo($id);

    $nombre_e = $_Equipo["cod"];
   
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(100,10,'REPORTE DE MANTENIMIENTOS');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,7,"Nombre del equipo: ".$_Equipo["cod"]." ".$_Equipo["nombre"]);
$pdf->Ln(); 
$pdf->Cell(100,5,"Filtros aplicados: Realizados por: '".$nombre."', Fecha desde '".$desde."', Fecha hasta '".$hasta."' " );
$pdf->Ln();
$pdf->Cell(100,7,'Fecha: '.$fecha);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,10,'Realizado por');
$pdf->Cell(60,10,'Fecha planificacion');
$pdf->Cell(30,10,'Fecha realizado');
$pdf->Ln();
$pdf->SetFont('Arial','',8);

while($row = mysqli_fetch_assoc($mantenimientos)){

    $pdf->Cell(60,10,$row["nombre"]." ".$row["apellido"]);
    $pdf->Cell(60,10,$row["fecha_planificacion"]);
    $pdf->Cell(30,10,$row["fecha"]);
}



$pdf->Output();
?>