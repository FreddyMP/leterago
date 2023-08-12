<?php
    include("plantilla/menu_top.php");

?>
<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <div class="row">
        <div class="col-md-3 ">
            <div class="informacion_dash">
                <center>
                Equipos <small>(100)</small>
                </center>
                 
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="informacion_dash">
                <center>
                Ubicaciones <small>(100)</small>
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
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
      datasets: [{
        label: 'A tiempo',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      },{
        label: 'Atrasados',
        data: [2, 9, 1, 2, 0, 1],
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
