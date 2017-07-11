<?php
    /*Conexión a base de datos*/
    require_once("conexion.php");

    /* Sesión */
    require_once("sesion.php");

    /* Determinar si el usuario está registrado */
    if ($usuarioRegistrado == true) {
        header("Location: editar-usuario.php");
    }

    /* Crear usuario */
    if(isset($_POST['boton']) && $_POST['boton'] == "Crear Usuario") {
        $consulta_crearUsuario = "update clientes set nombre = '". $_POST['nombre'] ."', email= '". $_POST['mail'] ."', telefono = '". $_POST['telefono'] ."', comuna = '". $_POST['comuna'] ."', direccion = '". $_POST['direccion'] ."', contrasena='". $_POST['contrasena'] ."' where id = '". $_SESSION['user_id'] . "'";
        $recurso_crearUsuario = $conexion -> query($consulta_crearUsuario);
        // Devuelve a la página de origen
        if (isset($_SESSION['pagina_origen']) && $_SESSION['pagina_origen'] <> "") {
                header("Location: " . $_SESSION['pagina_origen']);
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
                    <h2>Regístrate</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="mail">Mail</label>
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="Email: será tu nombre de usuario.">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                        </div>
                        <div class="form-group">
                            <label for="comuna">Comuna</label>
                            <select class="form-control" name="comuna" id="comuna">
                                <option value="Providencia">Providencia</option>
                                <option value="Ñuñoa">Ñuñoa</option>
                                <option value="Lo Barnechea">Lo Barnechea</option>
                                <option value="La Reina">La Reina</option>
                                <option value="Las Condes">Las Condes</option>
                                <option value="Santiago Centro">Santiago Centro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Constraseña">
                        </div>
                        <div class="row boton-registro">
                            <input type="submit" class="btn btn-default" value="Crear Usuario" name="boton">
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