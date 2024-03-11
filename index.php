<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia INUDIPeru</title>
    <link rel="stylesheet" href="./public/estilos/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- pNotify -->
    <link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
    <link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
    <link href="public/pnotify/css/custom.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- pNotify -->
    <script src="public/pnotify/js/pnotify.js"></script>
    <script src="public/pnotify/js/pnotify.buttons.js"></script>

    <style>

        .container-left {
            flex: 2;
            padding: 10px;
        }

        .container-right {
            flex: 2;
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php
    error_reporting(0);
    date_default_timezone_set("America/Lima");
    ?>
    <!--<div class="container-left">
        <div style="text-align:center"class="container-left">
        <h1 class="H1" style="text-align: center; font-size: 36px; margin-top: 10px; margin-bottom:20px; transition: color 0.3s;">Curso taller internacional de Inteligencia Artificial orientada a la docencia universitaria</h1>
        <a href="https://inudi.edu.pe/programas/ia/">
    IMAGEN DE PANTALLA PRINCIPAL
            <img src="vista/login/img/indexlogo.png" style="width: 60%; height: auto; border: none; display: block; margin: 0 auto; margin-bottom: 40px; transition: transform 0.3s; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 10, 10);" alt="II CONGRESO INTERNACIONAL DE REVISION ADICIONAL MENDELEY" class="movimiento">
        </a>



        <p style="text-align: center; font-size: 18px; margin-bottom: 10px ; color: white;">Durante este curso, los participantes adquirirán habilidades fundamentales en el ámbito de la inteligencia artificial aplicada a la docencia universitaria. Algunos de los temas clave que se abordarán son los siguientes:</p>
        
    </div>-->

    </div>

    <div class="container-right">
            <div class="institute-name">
                <span class="line-1">Instituto Universitario de Innovación</a></span>
                <span class="line-2">Ciencia y Tecnología Inudi Perú</a></span>

            </div>
        
        <div style="text-align: center;">
                <a href="https://inudi.edu.pe/">
                    <img src="vista/login/img/logoinudi.png" style="border: none;">
                </a>

        </div>
        <h1> REGISTRA TU ASISTENCIA</h1>
        <h2  id="fecha"><?=date("d/m/Y, h:i:s") ?></h2>
        <?php
        include "modelo/conexion.php";
        include "controlador/controlador_registrar_asistencia.php";
        ?>
        <div class="container">
            <!--<a class="acceso" href="./vista/login/login.php">Login</a>-->
            <p class="dni">Ingrese su CÓDIGO/NÚMERO DE IDENTIDAD</p>
            <form action="" method="POST">
                <input type="number" placeholder="DNI del Asistente" name="txtdni" id="txtdni">
                <div class="botones">
                    <button id="entrada" class="entrada" type="submit" name="btnentrada" value="ok">ENTRADA</button>
                    <button id="salida" class="salida" type="submit" name="btnsalida" value="ok">SALIDA</button>
                </div>
            </form>
        </div>

        <script>
            setInterval(() => {
                let fecha=new Date();
                let fechaHora=fecha.toLocaleString();
                document.getElementById("fecha").textContent=fechaHora;    
            }, 1000);
        </script>

        <script>
            let dni=document.getElementById("txtdni");
            dni.addEventListener("input", function () {
                if (this.value.length > 25) {
                    this.value=this.value.slice(0,25)
                }
            })

            // Eventos para la entrada y salida 
            document.addEventListener("keyup",function (event) {
                if (event.code=="ArrowLeft") {
                    document.getElementById("salida").click()
                } else {
                    if (event.code=="ArrowRight") {
                        document.getElementById("entrada").click()
                    }
                }
            })
        </script>
    </div>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Instituto Universitario de Innovación, Ciencia y Tecnología Inudi Perú</p>
    </footer>
    
</body>


</html>
