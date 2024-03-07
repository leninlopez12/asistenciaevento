<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtcargo"]) and !empty($_POST["txtid"]) and !empty($_POST["txtcorreo"]) and !empty($_POST["txtcelular"])) {
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $cargo = $_POST["txtcargo"];
        $id = $_POST["txtid"];
        $correo = $_POST["txtcorreo"];
        $celular = $_POST["txtcelular"];

        $sql1 = $conexion->query("UPDATE empleado SET nombre='$nombre', apellido='$apellido', cargo=$cargo, correo='$correo', celular='$celular' WHERE id_empleado='$id'");
        if ($sql1 == true) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "El empleado se ha modificado correctamente",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Error al modificar empleado",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php }
        
    } else { ?>
        <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Los campos están vacíos",
                        styling: "bootstrap3"
                    })
                })
            </script>
    <?php } ?>
    
<?php }

?>
