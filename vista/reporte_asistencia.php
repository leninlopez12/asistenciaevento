<?php
  session_start();
    if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
          header('location:login/login.php');
    }

?>

<style>
  ul li:nth-child(1) .activo {
    background: rgba(160,24,12,255) !important;
  }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">ASISTENCIA DE ESTUDIANTES</h4>

    <?php
      include "../modelo/conexion.php";
      $sql = $conexion->query(" select * from empleado ");
    ?>

    <form action="fpdf/reporteasistenciafechaH.php" target="_blank">
      <input required type="date" name="txtfechainicio" class="input input__text mb-2">
      <input required type="date" name="txtfechafinal" class="input input__text mb-2">
      <select required name="txtempleado" class="input input__select mb-2">
        <option value="todos">Todos los asistentes</option>
        <?php
          while ($datos=$sql->fetch_object()) { ?>
            <option value="<?= $datos->id_empleado ?>"><?= $datos->nombre ." ". $datos->apellido ?></option>
          <?php }
        ?>
      </select>
      <button type="submit" neme="btngenerar" class="btn btn-primary w-100 p-3">Generar Reporte</button>
    </form>    

    

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