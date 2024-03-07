<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header('location:login/login.php');
}
?>

<style>
    ul li:nth-child(5) .activo {
        background: rgba(160, 24, 12, 255) !important;
    }
</style>

<?php require('./layout/topbar.php'); ?>
<?php require('./layout/sidebar.php'); ?>

<div class="page-content">
    <h4 class="text-center text-secondary">CREAR EVENTO</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_evento.php";
    ?>

    <div class="row">
        <form action="" method="POST">
            <div class="fl-flex-label mb-4 px-2">
                <input type="text" placeholder="Nombre del Evento" class="input input__text" name="txtnombre">
            </div>
            <div class="fl-flex-label mb-4 px-2">
                <input type="date" placeholder="" class="input input__text" name="txtfecha">
            </div>
            <div class="fl-flex-label mb-4 px-2">
                <input type="text" placeholder="Tipo de Evento" class="input input__text" name="txttipo_evento">
            </div>
            <div class="text-right p-2">
                <a href="evento.php" class="btn btn-secondary btn-rounded">Atras</a>
                <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
            </div>
        </form>
    </div>
</div>

<?php require('./layout/footer.php'); ?>
