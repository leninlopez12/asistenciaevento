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
                ?>
                    <script>
                        $(function notificacion(){
                            new PNotify({
                                title:"INCORRECTO",
                                type:"error",
                                text:"Ya registraste tu entrada",
                                styling:"bootstrap3"
                            })
                        })
                    </script>
                <?php
            } else {
                $sql=$conexion->query("INSERT INTO asistencia(id_empleado, id_evento, entrada) VALUES ($id_empleado, $id_evento, '$fecha')");
                if ($sql == true) { ?>
                    <script>
                        $(function notificacion(){
                            new PNotify({
                                title:"CORRECTO",
                                type:"success",
                                text:"Hola, BIENVENIDO",
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
                        text:"El DNI ingresado no existe",
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
                    text:"Ingrese el DNI",
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
                ?>
                     <script>
                        $(function notificacion(){
                            new PNotify({
                                title:"INCORRECTO",
                                type:"error",
                                text:"PRIMERO DEBES REGISTRAR ENTRADA",
                                styling:"bootstrap3"
                            })
                        })
                     </script>
                <?php
            } else {
                $consultaFecha=$conexion->query("SELECT salida FROM asistencia WHERE id_empleado=$id_empleado ORDER BY id_asistencia DESC LIMIT 1");
                $fechaBD=$consultaFecha->fetch_object()->salida;
    
                if (substr($fecha,0,10)==substr($fechaBD,0,10)) {
                    ?>
                        <script>
                            $(function notificacion(){
                                new PNotify({
                                    title:"INCORRECTO",
                                    type:"error",
                                    text:"YA REGISTRASTE TU SALIDA",
                                    styling:"bootstrap3"
                                })
                            })
                        </script>
                    <?php
                } else {
                    $sql=$conexion->query("UPDATE asistencia SET salida='$fecha' WHERE id_asistencia=$id_asistencia");
                    if ($sql == true) { ?>
                        <script>
                            $(function notificacion(){
                                new PNotify({
                                    title:"CORRECTO",
                                    type:"success",
                                    text:"ADIOS, VUELVE PRONTO",
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
                                    text:"Error al registrar SALIDA",
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
                        text:"El DNI ingresado no existe",
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
                    text:"Ingrese el DNI",
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
