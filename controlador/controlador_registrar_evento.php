<?php
// Función para convertir una fecha a formato YYYY-MM-DD
function convertirFecha($fecha)
{
    $fecha = str_replace("/", "-", $fecha);
    $fecha = date("Y-m-d", strtotime($fecha));
    return $fecha;
}

// Si se ha enviado el formulario
if (!empty($_POST["btnregistrar"])) {

    // Validar que los campos no estén vacíos
    if (!empty($_POST["txtnombre"]) && !empty($_POST["txtfecha"]) && !empty($_POST["txttipo_evento"])) {

        // Obtener los datos del formulario
        $nombre = $_POST["txtnombre"];
        $fecha = convertirFecha($_POST["txtfecha"]);
        $tipo_evento = $_POST["txttipo_evento"];

        // Registrar el evento en la base de datos
        $sql = $conexion->prepare("INSERT INTO evento(nombre, fecha, tipo_evento) VALUES(?, ?, ?)");
        $sql->bind_param("sss", $nombre, $fecha, $tipo_evento);
        if ($sql->execute()) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "El evento se ha registrado correctamente",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Error al registrar el evento",
                        styling: "bootstrap3"
                    });
                });
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
                });
            });
        </script>
    <?php }

    // Evitar que se vuelva a enviar el formulario al actualizar la página
    ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>
<?php } ?>
