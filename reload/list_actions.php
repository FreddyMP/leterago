                <?php
                include ("../model/equipo_actividad.php");
                $equipo_actividad_instance = new Equipo_actividad();

                $id_equipo = $_POST["id_equipo"];

                echo $id_equipo;

                $equipo_actividad = $equipo_actividad_instance->list_actividades_assig($id_equipo);
                   
                ?>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Actividad</th>
                        <th scope="col">  OK</th>
                        <th scope="col">  N/A</th>
                        <th scope="col">  R</th>
                        <th scope="col">Observaciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $contador_checks = 0;
                        while ($equipos = mysqli_fetch_assoc($equipo_actividad)) {
                        
                      ?>
                      <tr>
                        <th scope="row"><?php echo $equipos["description"] ?></th>
                        <td><input  type="checkbox" name="ok<?php echo $contador_checks?>"  id=""></td>
                        <td><input  type="checkbox" name="no_aplica<?php echo $contador_checks?>"  id=""></td>
                        <td><input  type="checkbox" name="r<?php echo $contador_checks?>"  id=""></td>
                        <td>
                          <input class="form-control" type="text" name="observaciones<?php echo $contador_checks?>" id="">
                        </td>
                      </tr>
                      <?php
                        $contador_checks++;
                        }
                      ?>
                      <input type="hidden" value="<?php echo $contador_checks -1 ?>" name="cantidad_ckecks">
                    </tbody>
                  </table>
