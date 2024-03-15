<?php
if (!empty($_POST["btnentrada"])) {
    if (!empty($_POST["txtdni"])) { 
        $dni=$_POST["txtdni"];
        
        // Obtener el ID del evento asociado al empleado
        $id_evento_query = $conexion->query("SELECT id_evento FROM empleado WHERE dni='$dni'");
        $id_evento_row = $id_evento_query->fetch_assoc();
        $id_evento = $id_evento_row['id_evento'];

        // Verificar si el empleado existe
        $consulta=$conexion->query("SELECT COUNT(*) AS 'total' FROM empleado WHERE dni='$dni'");
        $id=$conexion->query("SELECT id_empleado FROM empleado WHERE dni='$dni'");
        
        if ($consulta->fetch_object()->total > 0) {
            $fecha=date("Y-m-d h:i:s");
            $id_empleado=$id->fetch_object()->id_empleado;

            $consultaFecha=$conexion->query("SELECT entrada FROM asistencia WHERE id_empleado=$id_empleado ORDER BY id_asistencia DESC LIMIT 1");
            $fechaBD=$consultaFecha->fetch_object()->entrada;

            if (substr($fecha,0,10)==substr($fechaBD,0,10)) {
                        $result = $conexion->query("SELECT nombre FROM empleado WHERE id_empleado = $id_empleado");
                        $row = $result->fetch_assoc();
                        $nombre_asistente = $row['nombre'];
                ?>
                    <script>
                        $(function notificacion(){
                            new PNotify({
                                title:"INCORRECTO",
                                type:"error",
                                text:"<?php echo $nombre_asistente; ?>, Ya registro su entrada",
                                styling:"bootstrap3"
                            })
                        })
                    </script>
                <?php
            } else {
                $sql=$conexion->query("INSERT INTO asistencia(id_empleado, id_evento, entrada) VALUES ($id_empleado, $id_evento, '$fecha')");
                if ($sql == true) {
                        $result = $conexion->query("SELECT nombre FROM empleado WHERE id_empleado = $id_empleado");
                        $row = $result->fetch_assoc();
                        $nombre_asistente = $row['nombre'];
                    ?>
                    <script>
                        $(function notificacion(){
                            new PNotify({
                                title:"ASISTENCIA REGISTRADA",
                                type:"success",
                                text:"Hola,  <?php echo $nombre_asistente; ?>  BIENVENIDO, la asistencia de inicio se ha registrado correctamente",
                                styling:"bootstrap3"
                            })
                        })
                    </script>
                <?php } else { ?>
                    <script>
                        $(function notificacion(){
                            new PNotify({
                                title:"INCORRECTO",
                                type:"error",
                                text:"Error al registrar entrada",
                                styling:"bootstrap3"
                            })
                        })
                    </script>
                <?php }
            }
        } else { ?>
            <script>
                $(function notificacion(){
                    new PNotify({
                        title:"INCORRECTO",
                        type:"error",
                        text:"El ID/Código/DNI ingresado no existe",
                        styling:"bootstrap3"
                    })
                })
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion(){
                new PNotify({
                    title:"INCORRECTO",
                    type:"error",
                    text:"Ingrese el ID/Código/DNI",
                    styling:"bootstrap3"
                })
            })
        </script>
    <?php } ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
    </script>
<?php }

?>

<?php
if (!empty($_POST["btnsalida"])) {
    if (!empty($_POST["txtdni"])) { 
        $dni=$_POST["txtdni"];
        
        // Obtener el ID del evento asociado al empleado
        $id_evento_query = $conexion->query("SELECT id_evento FROM empleado WHERE dni='$dni'");
        $id_evento_row = $id_evento_query->fetch_assoc();
        $id_evento = $id_evento_row['id_evento'];

        // Verificar si el empleado existe
        $consulta=$conexion->query("SELECT COUNT(*) AS 'total' FROM empleado WHERE dni='$dni'");
        $id=$conexion->query("SELECT id_empleado FROM empleado WHERE dni='$dni'");
        
        if ($consulta->fetch_object()->total > 0) {
            $fecha=date("Y-m-d h:i:s");
            $id_empleado=$id->fetch_object()->id_empleado;
            
            $busqueda=$conexion->query("SELECT id_asistencia, entrada FROM asistencia WHERE id_empleado=$id_empleado ORDER BY id_asistencia DESC LIMIT 1");
            
            while ($datos=$busqueda->fetch_object()) {
                $id_asistencia=$datos->id_asistencia;
                $entradaBD=$datos->entrada;
            }

            if (substr($fecha,0,10)!=substr($entradaBD,0,10)) {
                        $result = $conexion->query("SELECT nombre FROM empleado WHERE id_empleado = $id_empleado");
                        $row = $result->fetch_assoc();
                        $nombre_asistente = $row['nombre'];
                ?>
                     <script>
                        $(function notificacion(){
                            new PNotify({
                                title:"INCORRECTO",
                                type:"error",
                                text:"<?php echo $nombre_asistente; ?>, PRIMERO DEBES REGISTRAR ENTRADA",
                                styling:"bootstrap3"
                            })
                        })
                     </script>
                <?php
            } else {
                $consultaFecha=$conexion->query("SELECT salida FROM asistencia WHERE id_empleado=$id_empleado ORDER BY id_asistencia DESC LIMIT 1");
                $fechaBD=$consultaFecha->fetch_object()->salida;
    
                if (substr($fecha,0,10)==substr($fechaBD,0,10)) {
                        $result = $conexion->query("SELECT nombre FROM empleado WHERE id_empleado = $id_empleado");
                        $row = $result->fetch_assoc();
                        $nombre_asistente = $row['nombre'];
                    ?>
                        <script>
                            $(function notificacion(){
                                new PNotify({
                                    title:"INCORRECTO",
                                    type:"error",
                                    text:"<?php echo $nombre_asistente; ?>, YA REGISTRASTE TU SALIDA",
                                    styling:"bootstrap3"
                                })
                            })
                        </script>
                    <?php
                } else {
                    $sql=$conexion->query("UPDATE asistencia SET salida='$fecha' WHERE id_asistencia=$id_asistencia");
                    if ($sql == true) { 
                        $result = $conexion->query("SELECT nombre FROM empleado WHERE id_empleado = $id_empleado");
                        $row = $result->fetch_assoc();
                        $nombre_asistente = $row['nombre'];
                        ?>
                        <script>
                            $(function notificacion(){
                                new PNotify({
                                    title:"SALIDA REGISTRADA",
                                    type:"success",
                                    text:" <?php echo $nombre_asistente; ?> ¡Hasta luego! Esperamos verte nuevamente en nuestra próxima clase.",
                                    styling:"bootstrap3"
                                })
                            })
                        </script>
                    <?php } else { ?>
                        <script>
                            $(function notificacion(){
                                new PNotify({
                                    title:"INCORRECTO",
                                    type:"error",
                                    text:"Error al registrar la SALIDA",
                                    styling:"bootstrap3"
                                })
                            })
                        </script>
                    <?php }
                }
            }
        } else { ?>
            <script>
                $(function notificacion(){
                    new PNotify({
                        title:"INCORRECTO",
                        type:"error",
                        text:"El ID/Código/DNI ingresado no existe",
                        styling:"bootstrap3"
                    })
                })
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion(){
                new PNotify({
                    title:"INCORRECTO",
                    type:"error",
                    text:"Ingrese el ID/Código/DNI",
                    styling:"bootstrap3"
                })
            })
        </script>
    <?php } ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
    </script>
<?php } ?>
