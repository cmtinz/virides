<?php
    /*Conexión a base de datos*/
    require_once("conexion.php");

    /* Sesión */
    require_once("sesion.php");

    /* Determinar si el usuario está registrado */
    if ($usuarioRegistrado == true) {
        header("Location: editar-usuario.php");
    }
    
    /* Ingresar */
    if((isset($_POST['email']) && $_POST['email']<>"") && (isset($_POST['contrasena']) && $_POST['contrasena']<>"") ){
        $consulta_ingreso="SELECT * FROM clientes WHERE email='".$_POST['email']. "' AND contrasena='".$_POST['contrasena']."'";
        $recurso_ingreso = $conexion -> query($consulta_ingreso);
        $ingreso = $recurso_ingreso -> fetch_assoc();
        if($recurso_ingreso->num_rows == 1){
            // Cambiar id de compras efectuadas
            $consulta_cambiarCompras = "update compras set cliente_id = '". $ingreso['id'] . "' where cliente_id = '". $_SESSION['user_id'] ."'";
            $recurso_cambiarCompras = $conexion -> query($consulta_cambiarCompras);
            $_SESSION['user_id'] = $ingreso['id'];
        } else {
            $error="Usuario/Clave no registrados";
        }
    }
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

    <!-- Contenido Principal -->
    <div class="principal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3" id="menu">
                    <?php require_once("menu.php");?>
                </div>
                <div class="col-lg-8 col-md-9 col-lg-offset-1 contenido">
                    <h2>Ingresa</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">
                        </div>
                        <div class="row boton-registro">
                            <input type="submit" class="btn btn-default" value="Ingresar" name="boton"?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- ./Contenido Principal -->
    <?php require_once("footer.php");?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>