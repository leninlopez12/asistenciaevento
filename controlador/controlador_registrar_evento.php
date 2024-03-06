<?php
// Función para convertir una fecha a formato YYYY-MM-DD
function convertirFecha($fecha) {
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

    // Verificar si el nombre del evento ya existe
    $verificarNombre = $conexion->query("SELECT COUNT(*) AS 'total' FROM evento WHERE nombre='$nombre'");
    $total = $verificarNombre->fetch_object()->total;

    // Si el nombre del evento ya existe, mostrar un mensaje de error
    if ($total > 0) { ?>
      <script>
        $(function notificacion() {
          new PNotify({
            title: "ERROR",
            type: "error",
            text: "El evento <?= $nombre ?> ya existe",
            styling: "bootstrap3"
          });
        });
      </script>
    <?php } else {

      // Registrar el evento en la base de datos
      $sql = $conexion->query("INSERT INTO evento(nombre, fecha, tipo_evento) VALUES('$nombre', '$fecha', '$tipo_evento')");

      // Si el evento se ha registrado correctamente, mostrar un mensaje de éxito
      if ($sql == true) { ?>
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
    }
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

<?php }

?>
