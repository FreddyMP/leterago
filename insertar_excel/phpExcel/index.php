<body>
<div class="container">
    <h2>Ejemplo: Leer Archivos Excel con PHP</h2>   
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Resultados de archivo de Excel.</h3>
      </div>
      <div class="panel-body">
        <div class="col-lg-12">  
<?php
$server ="localhost";
$user = "root";
$password = "";
$db = "leterago";

$conexion = new mysqli($server,$user,$password,$db);


require_once 'PHPExcel/Classes/PHPExcel.php';
$archivo = "Equipos.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
?>
<table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Cargo</th>
          <th>Sede</th>
        </tr>
      </thead>
      <tbody>
<?php
$num=0;
for ($row = 2; $row <= $highestRow; $row++){ $num++;?>
       <tr>
          <th scope='row'><?php echo $num;?></th>
          <td><?php $codigo = $sheet->getCell("A".$row)->getValue();?></td>
          <td><?php $descripcion = $sheet->getCell("B".$row)->getValue();?></td>
          <td><?php $marca = $sheet->getCell("C".$row)->getValue();?></td>
          <td><?php $modelo =  $sheet->getCell("D".$row)->getValue();?></td>
          <td><?php $serie = $sheet->getCell("E".$row)->getValue();?></td>
          <td><?php $ubicacion =   $sheet->getCell("F".$row)->getValue();?></td>
          <td><?php $estatus = $sheet->getCell("G".$row)->getValue();?></td>
          <td><?php $observaciones = $sheet->getCell("H".$row)->getValue();?></td>
        </tr>
    <?php    
    $conexion->query("INSERT INTO equipos (codigo, description, orden, id_categoria, marca, modelo, serie, id_almacen, ubicacion, estado, observaciones, create_by) values
    ('$codigo','$descripcion', 0, 2, '$marca','$modelo', '$serie', 1,'$ubicacion','$estatus', '$observaciones', 'System')");
}


?>
         </tbody>
    </table>
  </div>  
 </div>   
</div>
</body>