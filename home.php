<?php
    include("plantilla/menu_top.php");
    include_once("model/dashboard.php");

    $instance_Dashboard = new Dashboard();

    $mes = date("m");

    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                  "Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    $a_tiempo =  array($instance_Dashboard->a_tiempo('01'),$instance_Dashboard->a_tiempo('02'),$instance_Dashboard->a_tiempo('03'),
    $instance_Dashboard->a_tiempo('04'),$instance_Dashboard->a_tiempo('05'),$instance_Dashboard->a_tiempo('06'),$instance_Dashboard->a_tiempo('07'),
    $instance_Dashboard->a_tiempo('08'),$instance_Dashboard->a_tiempo('09'), $instance_Dashboard->a_tiempo('10'),$instance_Dashboard->a_tiempo('11'),
    $instance_Dashboard->a_tiempo('12'));

    $tarde = array($instance_Dashboard->tarde('01'),$instance_Dashboard->tarde('02'),$instance_Dashboard->tarde('03'),
    $instance_Dashboard->tarde('04'),$instance_Dashboard->tarde('05'),$instance_Dashboard->tarde('06'),$instance_Dashboard->tarde('07'),
    $instance_Dashboard->tarde('08'),$instance_Dashboard->tarde('09'), $instance_Dashboard->tarde('10'),$instance_Dashboard->tarde('11'),
    $instance_Dashboard->tarde('12'));

    $no_realizados = array($instance_Dashboard->no_realizadas('01'),$instance_Dashboard->no_realizadas('02'),$instance_Dashboard->no_realizadas('03'),
    $instance_Dashboard->no_realizadas('04'),$instance_Dashboard->no_realizadas('05'),$instance_Dashboard->no_realizadas('06'),$instance_Dashboard->no_realizadas('07'),
    $instance_Dashboard->no_realizadas('08'),$instance_Dashboard->no_realizadas('09'), $instance_Dashboard->no_realizadas('10'),$instance_Dashboard->no_realizadas('11'),
    $instance_Dashboard->no_realizadas('12'));


?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <div class="row">
        <div class="col-md-3 ">
            <div class="informacion_dash">
                <center>
                Equipos <small>(<?php echo $instance_Dashboard->count_equipos() ?>)</small>
                </center>
                 
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="informacion_dash">
                <center>
                Ubicaciones <small>(<?php echo $instance_Dashboard->count_ubicaciones() ?>)</small>
                </center>
               
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="informacion_dash">
                <center>
                    Almacenes <small>(100)</small>
                </center>
               
            </div>
        </div>
        <div class="col-md-3">
            <div class="informacion_dash">
                <center>
                Metas cumplidas <small>(100)</small>
                </center>
                
            </div>
        </div>
    </div>
    <div class="formularios">
        <div id ="grafico">
            <canvas id="myChart"></canvas>
        </div>

    <script src="js/chart.js"></script>

    <script>
    const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [<?php foreach($meses as $mes){ echo "'".$mes."',";}  ?>],
      datasets: [{
        label: 'A tiempo',
        data: [<?php foreach($a_tiempo  as $cantidad) {echo $cantidad.","; }?>],
        borderWidth: 1
      },{
        label: 'Atrasados',
        data: [<?php foreach($tarde  as $cantidad) {echo $cantidad.","; }?>],
        borderWidth: 1
      },{
        label: 'No realizados',
        data: [<?php foreach($no_realizados  as $cantidad) {echo $cantidad.","; }?>],
        borderWidth: 1
      }
    
    ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
    </div>
</div>
