<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtcargo"]) and !empty($_POST["txtid"]) and !empty($_POST["txtcorreo"]) and !empty($_POST["txtcelular"]) and !empty($_POST["txtevento"])) {
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $cargo = $_POST["txtcargo"];
        $id = $_POST["txtid"];
        $correo = $_POST["txtcorreo"];
        $celular = $_POST["txtcelular"];
        $id_evento = $_POST["txtevento"];
        $sql1 = $conexion->prepare("UPDATE empleado SET nombre=?, apellido=?, cargo=?, correo=?, celular=?, id_evento=? WHERE id_empleado=?");
        $sql1->bind_param("ssissii", $nombre, $apellido, $cargo, $correo, $celular, $id_evento, $id);
        if ($sql1->execute()) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "El asistente se ha modificado correctamente",
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
                        text: "Error al modificar asistente",
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
