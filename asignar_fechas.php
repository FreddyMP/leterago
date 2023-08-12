<?php
    include_once("plantilla/menu_top.php");
    include_once("model/calendario.php");

    $calendario_instance = new Calendario();

    $cantidad = $_GET["cantidad"];

    $equipo = $_GET["id"];

    $existe = $calendario_instance->verificar_existencia($equipo);
    $rango_fecha = $calendario_instance->rango_fecha();
    $fecha_ini = $rango_fecha["fecha_ini"];
    $fecha_fin = $rango_fecha["fecha_fin"];

    if($existe == 0){
        
        ?>

<link rel="stylesheet" href="css/form.css">
<div class="Container">
    <br>
    <h3>Asignacion de fechas</h3>
    <div class="formularios">
        <h3>Mantenimiento numero: <small id="numero_mantenimiento">1</small> <small>de <?php echo $cantidad ?><small></h3>
        <div>
            <input class="form-control" type="date" name="" min="<?php echo $fecha_ini ?>" max="<?php echo $fecha_fin ?>" id="fechas">
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <Button class="btn btn-dark col-md-12" id="anterior">Anterior</Button>
            </div>
            <div class="col-md-6">
                <Button class="btn btn-info col-md-12" id="siguiente">Siguiente</Button>
                <Button class="btn btn-success col-md-12" id="terminar">Terminar</Button>
            </div>
            
        </div>
    </div>
</div>
<?php
    }else{
        $lista_fechas = $calendario_instance->list($equipo);
        ?>
            <link rel="stylesheet" href="css/form.css">
            <div class="Container">
                <br>
                <h3>Asignacion de fechas</h3>
                <div class="formularios">
                    <h3>Fechas asignadas</h3>
                    <form action="controllers/modificar_fecha_ejecucion.php" method="post">
                        <input  value="<?php echo $equipo?>" type="hidden" name="equipo">
                            <?php
                                $contador_inputs = 0;
                                while($fechas_list = mysqli_fetch_assoc($lista_fechas)){
                            ?>
                            <div>
                                <input class="form-control mb-3" value="<?php echo $fechas_list["fecha"]?>" min="<?php echo $fecha_ini ?>" max="<?php echo $fecha_fin ?>" type="date" name="input_val_new<?php echo $contador_inputs ?>" required>
                                <input  value="<?php echo $fechas_list["fecha"]?>" type="hidden" name="input_val_old<?php echo $contador_inputs ?>">
                                


                                <?php
                                     $contador_inputs++;
                                ?>
                            </div>
                            <?php
                                }
                            ?>
                            <hr>
                            <input type="hidden" value="<?php echo $cantidad ?>" name="cantidad">
                            <div class="row">
                                <div class="col-md-6">
                                    <Button class="btn btn-success col-md-12">guardar</Button>
                                </div>                  
                            </div>
                    </form>
                </div>
            </div>
        <?php
    }
?>

<script>
    $("#terminar").hide();
    var cantidad = <?php echo $cantidad; ?>;
    var counter = [];
    var count = 1;
    var cantidad_back = 0;
    var equipo = <?php echo $equipo; ?>
    

    $("#siguiente").click(function(){    
        if($("#fechas").val()!= ''){
            if(count <= cantidad){
                if(cantidad_back != 0){
                    counter[count - 1] = $("#fechas").val();
                    cantidad_back--;
                }
                if(count == cantidad){
                    $("#terminar").show();
                    $("#siguiente").hide();
                    $("#fechas").prop("disabled", true);
                }
                fecha = $("#fechas").val();
                if(counter[count - 1] == 'undefined' ){
                    counter.push(fecha);
                }else{
                    counter[count - 1] = $("#fechas").val();
                }
                
                $("#fechas").val('');
                console.log(counter[count - 1]);
                console.log(count);
                count++;
                $("#numero_mantenimiento").text(count);
            } else{
          
            }
        }  
        
    });
    $("#anterior").click(function(){
        cantidad_back++;
        $("#fechas").val(counter[count - 2]);
        if(count > 1){
            $("#terminar").hide();
            $("#siguiente").show();
            count--;
            console.log(count);
        }
        $("#fechas").prop("disabled", false);
         $("#numero_mantenimiento").text(count);
    });

    $("#terminar").click(function(){
        counter.push(equipo);
        $.ajax({
        url: "reload/insertar_fechas.php",
        method: "post",
        data: "fechas="+ counter,
        success: function(data) {
            window.location.href = "list_calendario.php";
        },
        error: function(xhr, status, error) {
          // Manejamos el error en caso de que la solicitud falle
          console.error("Error en la solicitud: " + status + ", " + error);
        }
      });
    });

</script>
