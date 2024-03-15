<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header('location:login/login.php');
}
?>

<style>
  ul li:nth-child(1) .activo {
    background: rgb(23 117 39) !important;
  }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">ASISTENCIA DE USUARIOS</h4>

    <?php
      include "../modelo/conexion.php";
      include "../controlador/controlador_eliminar_asistencia.php";

      $sql=$conexion->query(" SELECT asistencia.id_asistencia, 
      asistencia.id_empleado, 
      asistencia.entrada,
      asistencia.salida,
      empleado.id_empleado,
      empleado.nombre as 'nom_empleado',
      empleado.apellido,
      empleado.dni,
      empleado.cargo,
      cargo.id_cargo,
      cargo.nombre as 'nom_cargo',
      asistencia.id_evento
      FROM
      asistencia
      INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado
      INNER JOIN cargo ON empleado.cargo = cargo.id_cargo");
    ?>
    

    <div class="text-right mb-2">
      <a href="fpdf/reporteasistenciaH.php" target="_blank" class="btn btn-success"><i class="fas fa-file-pdf"></i> Generar Reportes</a>
    </div>
    <div class="text-right mb-2">
      <a href="reporte_asistencia.php" class="btn btn-primary"><i class="fas fa-plus"></i> Mas Reportes</a>
    </div>

    <table class="table table-bordered table-hover col-sm-12" id="example">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <!--<th scope="col">ID_Evento</th>-->
          <th scope="col">ASISTENTES</th>
          <th scope="col">CÓDIGO/NÚMERO DE IDENTIDAD</th>
          <th scope="col">GRADO</th>
          <th scope="col">ENTRADA</th>
          <th scope="col">SALIDA</th>
          <th scope="col">HORAS</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($datos=$sql->fetch_object()) { ?>
          <tr>
            <td><?= $datos->id_asistencia ?></td>
            <td><?= $datos->nom_empleado ." ". $datos->apellido?></td>
            <td><?= $datos->dni?></td> 
            <td><?= $datos->nom_cargo ?></td>
            <td><?= $datos->entrada ?></th>
            <td><?= $datos->salida ?></td>
            <?php
                  // Suponiendo que $datos->entrada y $datos->salida son marcas de tiempo en formato HH:MM:SS

                  // Convertir las marcas de tiempo en objetos DateTime
                  $hora_entrada = new DateTime($datos->entrada);
                  $hora_salida = new DateTime($datos->salida);

                  // Calcular la diferencia entre las dos marcas de tiempo
                  $diferencia = $hora_entrada->diff($hora_salida);

                  // Formatear la diferencia en horas, minutos y segundos
                  $tiempo_transcurrido = $diferencia->format('%H:%I:%S');

                  // Mostrar el resultado
                  
                  ?>

            <td><?=$tiempo_transcurrido?></td>   
            <td>
            <a href="inicio.php?id=<?= $datos->id_asistencia ?>" onclick="advertencia(event)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
            </td>         
          </tr>
        <?php  }
        ?> 
      </tbody>
    </table>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>
