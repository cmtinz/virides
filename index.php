<?php
    /*Conexión a base de datos*/
    require_once("conexion.php");

    /* Sesión */
    require_once("sesion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verdurería Bilbao 640</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <!--Encabezado-->
    <?php require_once("header.php");?>
    <!--./Encabezado-->
    <div class="principal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3" id="menu">
                    <?php require_once("menu.php");?>
                </div>
                <div class="col-lg-8 col-md-9 col-lg-offset-1 contenido">
                    <h2>Frutas, verduras y más</h2>
                    <ul>
                        <li>Compra en línea o directamente en nuestro local.</li>
                        <li>Despechamos gratis desde $15.000 pesos de compras (compras inferiores cancelan la diferencia).</li>
                        <li>Llegamos a siete comunas:
                            <ul>
                                <li>Santiago Centro</li>
                                <li>Providencia</li>
                                <li>La Reina</li>
                                <li>Ñuñoa</li>
                                <li>Las Condes</li>
                                <li>Vitacura</li>
                                <li>Lo Barnechea</li>
                            </ul>
                        </li>
                    </ul>
                    <h3>Visítanos</h3>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3329.3240449376726!2d-70.62604018480087!3d-33.4408631807766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662c5803cb9f0f1%3A0xc9c813b4838a830a!2sAv.+Francisco+Bilbao+640%2C+Providencia%2C+Regi%C3%B3n+Metropolitana%2C+Chile!5e0!3m2!1ses-419!2s!4v1499743663979" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <p class="">
                        Av. Bailbao 640 Providencia: Abierto de lunes a viernes de 9:30 a 18:00 y sábados de 10:00 a 13:00<br>
                    </p>
                    <h3>Contáctanos</h3>
                    <ul>
                        <li><a href="mailto:fruteriabilbao@gmail.com">fruteriabilbao@gmail.com</a></li>
                        <li><a href="tel:+56123123123">+56 123 123 123</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("footer.php");?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>