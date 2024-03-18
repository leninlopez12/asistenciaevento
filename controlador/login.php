<?php
    session_start();

    if (isset($_POST["btningresar"])) {
        if (!empty($_POST["usuario"]) && !empty($_POST["password"])) {
            // Conexión a la base de datos (debes incluir este archivo o inicializar $conexion)
            include "../../modelo/conexion.php";

            // Verificar que el campo de contraseña no esté vacío antes de aplicar md5()
            $password = !empty($_POST["password"]) ? md5($_POST["password"]) : '';

            // Preparar la consulta con parámetros
            $query = "SELECT * FROM usuario WHERE usuario = ? AND password = ?";
            $stmt = $conexion->prepare($query);

            // Enlazar parámetros
            $stmt->bind_param("ss", $_POST["usuario"], $password);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener resultados
            $result = $stmt->get_result();

            // Verificar si se encontró el usuario
            if ($result->num_rows > 0) {
                // Usuario autenticado correctamente
                $datos = $result->fetch_object();
                $_SESSION["nombre"] = $datos->nombre;
                $_SESSION["apellido"] = $datos->apellido;
                $_SESSION["id"] = $datos->id_usuario;
                header("location:../inicio.php");
                exit; // Importante: terminar el script después de redirigir
            } else {
                // Usuario no encontrado
                echo "<div class='alert alert-danger'>Contraseña o Usuario son incorrectas</div>";
            }

            // Cerrar la declaración y la conexión
            $stmt->close();
            $conexion->close();
        } else {
            // Campos vacíos
            echo "<div class='alert alert-danger'>Por favor, complete todos los campos</div>";
        }
    } ?>
    <script>
            setTimeout(() => {
                window.history.replaceState(null,null,window.location.pathname);
            }, 0);
        </script><?       

?>
