<?php

if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtfecha"]) and !empty($_POST["txttipo_evento"])) {
        $nombre=$_POST["txtnombre"];
        $fecha=$_POST["txtfecha"];
        $tipo_evento=$_POST["txttipo_evento"];
        $id=$_POST["txtid"];

        $verificarNombre=$conexion->query(" select count(*) as 'total' from evento where nombre='$nombre' and id_evento!=$id ");
        if ($verificarNombre->fetch_object()->total > 0) { ?>
            <script>
                $(function notificacion(){
                    new PNotify({
                        title:"INCORRECTO",
                        type:"error",
                        text:"El nombre <?= $nombre ?> ya existe",
                        styling:"bootstrap3"
                    })
                })
            </script>
        <?php } else {
            $sql=$conexion->query(" update evento set nombre='$nombre', fecha='$fecha', tipo_evento='$tipo_evento' where id_evento=$id ");
            if ($sql==true) { ?>
                 <script>
                    $(function notificacion(){
                        new PNotify({
                            title:"CORRECTO",
                            type:"success",
                            text:"El evento ha sido modificado correctamente",
                            styling:"bootstrap3"
                        })
                    })
                </script>
            <?php } else { ?>
                <script>
                    $(function notificacion(){
                        new PNotify({
                            title:"INCORRECTO",
                            type:"error",
                            text:"Error al modificar los datos",
                            styling:"bootstrap3"
                        })
                    })
                </script>
           <?php }
            
        }
        
    } else { ?>
        <script>
                $(function notificacion(){
                    new PNotify({
                        title:"INCORRECTO",
                        type:"error",
                        text:"Los campos estan vacios",
                        styling:"bootstrap3"
                    })
                })
            </script>
    <?php } ?>
        <script>
            setTimeout(() => {
                window.history.replaceState(null,null,window.location.pathname);
            }, 0);
        </script>      
<?php }

?>