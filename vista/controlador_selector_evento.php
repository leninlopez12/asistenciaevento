<?php
include "../modelo/conexion.php";

// Verificar si se recibió un evento para filtrar los empleados
if (isset($_POST['txtevento'])) {
    $id_evento = $_POST['txtevento'];
    $sql = $conexion->prepare("SELECT empleado.id_empleado, empleado.nombre, empleado.apellido, empleado.dni, empleado.cargo, empleado.correo, empleado.celular, cargo.nombre AS nom_cargo
                                FROM empleado
                                INNER JOIN cargo ON empleado.cargo = cargo.id_cargo
                                WHERE empleado.id_evento = ?");
    $sql->bind_param("i", $id_evento);
    $sql->execute();
    $result = $sql->get_result();

    if (!$result) {
        die("Error al ejecutar la consulta SQL: " . $conexion->error);
    }

    // Aquí puedes mostrar los resultados o devolverlos en un formato adecuado, dependiendo de tu lógica de aplicación.
}
?>
