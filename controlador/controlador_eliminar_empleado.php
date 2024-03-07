<?php

include "../modelo/conexion.php";

if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    // Eliminar también las asistencias asociadas al empleado
    $sql_delete_asistencia = $conexion->query("DELETE FROM asistencia WHERE id_empleado=$id");
    if ($sql_delete_asistencia) {
        $sql = $conexion->query("DELETE FROM empleado WHERE id_empleado=$id");
        if ($sql) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "Empleado y sus asistencias eliminados correctamente",
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
                        text: "Error al eliminar empleado",
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
                    text: "Error al eliminar las asistencias del empleado",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php }
    ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>
<?php }

?>
