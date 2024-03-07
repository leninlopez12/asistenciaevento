<?php

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtdni"]) and !empty($_POST["txtcargo"]) and !empty($_POST["txtevento"])) {
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $dni = $_POST["txtdni"];
        $cargo = $_POST["txtcargo"];
        $evento = $_POST["txtevento"];

        $sql = $conexion->query("SELECT count(*) as 'total' FROM empleado WHERE dni='$dni'");
        if ($sql->fetch_object()->total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El dni <?= $dni ?> ya existe",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php } else {
            $registro = $conexion->query("INSERT INTO empleado(nombre, apellido, dni, cargo, id_evento) VALUES ('$nombre','$apellido','$dni',$cargo,$evento)");

            if ($registro == true) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Empleado registrado Correctamente",
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
                            text: " Error al registar empleado",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php }
        }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: " Los campos están vacíos",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php } ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>
<?php }

?>
