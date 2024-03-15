<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header('location:login/login.php');
}

?>

<style>
    ul li:nth-child(3) .activo {
        background: rgb(23 117 39) !important;
    }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">LISTA DE ASISTENTES</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_modificar_empleado.php";
    include "../controlador/controlador_eliminar_empleado.php";

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
    } else {
        // Si no se recibió un evento, obtener todos los empleados
        $result = $conexion->query("SELECT empleado.id_empleado, empleado.nombre, empleado.apellido, empleado.dni, empleado.cargo, empleado.correo, empleado.celular, empleado.id_evento, cargo.nombre AS nom_cargo
                                    FROM empleado
                                    INNER JOIN cargo ON empleado.cargo = cargo.id_cargo");
    }

    if (!$result) {
        die("Error al ejecutar la consulta SQL: " . $conexion->error);
    }
    ?>

    <a href="registro_empleado.php" class="btn btn-primary btn-rounded mb-2"><i class="fas fa-plus"></i> &nbsp;Registrar</a>
    <div class="text-right mb-2">
        <a href="fpdf/reporteempleadoV.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar Reportes</a>
    </div>

    <form action="" method="POST">
        <div class="fl-flex-label mb-4 px-2 col-md-6">
            <select name="txtevento" class="input input__select">
                <option value="">Seleccionar evento...</option>
                <?php
                $sql_eventos = $conexion->query("SELECT * FROM evento");
                while ($evento = $sql_eventos->fetch_object()) {
                    echo "<option value='{$evento->id_evento}'>{$evento->nombre}</option>";
                }
                ?>
            </select>
        </div>
        <div class="fl-flex-label mb-4 px-2 col-md-6">
            <button type="submit" class="btn btn-primary btn-rounded">Filtrar</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover col-sm-12" id="example">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDO</th>
                    <th scope="col">CÓDIGO/NÚMERO DE IDENTIDAD</th>
                    <th scope="col">GRADO</th>
                    <th scope="col">CORREO ELECTRÓNICO</th>
                    <th scope="col">CELULAR</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($datos = $result->fetch_object()) { ?>
                    <tr>
                        <td><?= $datos->id_empleado ?></td>
                        <td><?= $datos->nombre ?></td>
                        <td><?= $datos->apellido ?></td>
                        <td><?= $datos->dni ?></td>
                        <td><?= $datos->nom_cargo ?></td>
                        <td><?= $datos->correo ?></td>
                        <td><?= $datos->celular ?></td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_empleado ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="empleado.php?id=<?= $datos->id_empleado ?>" onclick="advertencia(event)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $datos->id_empleado ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title w-100" id="exampleModalLabel">Modificar Asistente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">
                                        <div hidden class="fl-flex-label mb-4 px-2 col-12">
                                            <input type="text" placeholder="Nombre" class="input input__text" name="txtid" value="<?= $datos->id_empleado ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12">
                                            <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12">
                                            <input type="text" placeholder="Apellido" class="input input__text" name="txtapellido" value="<?= $datos->apellido ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12">
                                            <input type="text" placeholder="Dni" class="input input__text" name="txtdni" value="<?= $datos->dni ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12">
                                            <select name="txtcargo" class="input input__select">
                                                <?php
                                                $sql2 = $conexion->query(" select * from cargo ");
                                                while ($datos2 = $sql2->fetch_object()) { ?>
                                                    <option <?= $datos->cargo == $datos2->id_cargo ? 'selected' : '' ?> value="<?= $datos2->id_cargo ?>"><?= $datos2->nombre ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12">
                                            <input type="text" placeholder="correo" class="input input__text" name="txtcorreo" value="<?= $datos->correo ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-12">
                                            <input type="text" placeholder="celular" class="input input__text" name="txtcelular" value="<?= $datos->celular ?>">
                                        </div>
                                        <div class="fl-flex-label mb-4 px-2 col-md-6">
                                            <select name="txtevento" class="input input__select">
                                                <option value="">Seleccionar evento...</option>
                                                <?php
                                                $sql_eventos = $conexion->query("SELECT * FROM evento");
                                                while ($evento = $sql_eventos->fetch_object()) {
                                                    $selected = $datos->id_evento == $evento->id_evento ? 'selected' : '';
                                                    echo "<option value='{$evento->id_evento}' {$selected}>{$evento->nombre}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="text-right p-2">
                                            <a href="empleado.php" class="btn btn-secondary btn-rounded">Atrás</a>
                                            <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php  }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- fin del contenido principal -->
<script>
        setTimeout(() => {
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
    </script>
<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>
