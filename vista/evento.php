<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header('location:login/login.php');
}
?>

<style>
    ul li:nth-child(5) .activo {
        background: rgb(23, 117, 39) !important;
    }
</style>

<?php require('./layout/topbar.php'); ?>
<?php require('./layout/sidebar.php'); ?>

<div class="page-content">
    <h4 class="text-center text-secondary">Eventos</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_modificar_evento.php";
    include "../controlador/controlador_eliminar_evento.php";

    $sql = $conexion->query("SELECT * FROM evento");
    ?>
    <a href="registro_evento.php" class="btn btn-primary btn-rounded mb-2"><i class="fas fa-plus"></i> &nbsp;Crear Evento</a>
    <div class="text-right mb-2">
        <a href="fpdf/reportecargoV.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar Reportes</a>
    </div>
    <table class="table table-bordered table-hover col-sm-12" id="example">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE EVENTO</th>
                <th scope="col">FECHA</th>
                <th scope="col">TIPO DE EVENTO</th>
                <th>Editar/Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($datos = $sql->fetch_object()) { ?>
                <tr>
                    <td><?= $datos->id_evento ?></td>
                    <td><?= $datos->nombre ?></td>
                    <td><?= $datos->fecha ?></td>
                    <td><?= $datos->tipo_evento ?></td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_evento ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="evento.php?id=<?= $datos->id_evento ?>" onclick="advertencia(event)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>

                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?= $datos->id_evento ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title w-100" id="exampleModalLabel">Modificar Evento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div hidden class="fl-flex-label mb-4 px-2">
                                        <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->id_evento ?>">
                                    </div>
                                    <div class="fl-flex-label mb-4 px-2">
                                        <input type="text" placeholder="Nombre del Evento" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
                                    </div>
                                    <div class="fl-flex-label mb-4 px-2">
                                        <input type="date" placeholder="" class="input input__text" name="txtfecha" value="<?= $datos->fecha ?>">
                                    </div>
                                    <div class="fl-flex-label mb-4 px-2">
                                        <input type="text" placeholder="Tipo de Evento" class="input input__text" name="txttipo_evento" value="<?= $datos->tipo_evento ?>">
                                    </div>
                                    <div class="text-right p-2">
                                        <a href="evento.php" class="btn btn-secondary btn-rounded">Atrás</a>
                                        <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </tbody>
    </table>
</div>

<?php require('./layout/footer.php'); ?>
