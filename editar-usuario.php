<?php
    /*Conexión a base de datos*/
    require_once("conexion.php");

    /* Sesión */
    require_once("sesion.php");

    /* Determinar si el usuario está registrado */
    if ($usuarioRegistrado == false) {
        header("Location: registro.php");
    }

    /* Editar usuario */
    if(isset($_POST['boton']) && $_POST['boton'] == "Editar") {
        $consulta_editarUsuario = "update clientes set nombre = '". $_POST['nombre'] ."', email= '". $_POST['mail'] ."', telefono = '". $_POST['telefono'] ."', comuna = '". $_POST['comuna'] ."', direccion = '". $_POST['direccion'] ."' where id = '". $_SESSION['user_id'] . "'";
        $recurso_editarUsuario = $conexion -> query($consulta_editarUsuario);
        if ($_POST['contrasena'] != "") {
            $consulta_contrasena = "update clientes set contrasena='".$_POST['contrasena']."' where id ='". $_SESSION['user_id'] ."'";
            $recurso_contrasena = $conexion -> query($consulta_contrasena);
        };
    }
    
    /* Consulta datos de usuario */
    $consulta_usuario = "select * from clientes where id = '". $_SESSION['user_id']."'";
    $consulta_usuario = $conexion -> query($consulta_usuario);
    $usuario = $consulta_usuario -> fetch_assoc();

    
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
                    <h2>Edita tus datos</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?= $usuario['nombre'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="mail">Correo electrónico</label>
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="Email" value="<?= $usuario['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?= $usuario['direccion'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" value="<?= $usuario['telefono'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="comuna">Comuna</label>
                            <select class="form-control" name="comuna" id="comuna">
                                <option <?= $usuario['comuna'] == "Providencia"? "selected": ""?> >Providencia</option>
                                <option <?= $usuario['comuna'] == "Ñuñoa"? "selected": ""?> >Ñuñoa</option>
                                <option <?= $usuario['comuna'] == "Lo Barnechea"? "selected": ""?> >Lo Barnechea</option>
                                <option <?= $usuario['comuna'] == "La Reina"? "selected": ""?> >La Reina</option>
                                <option <?= $usuario['comuna'] == "Las Condes"? "selected": ""?> >Las Condes</option>
                                <option <?= $usuario['comuna'] == "Santiago Centro"? "selected": ""?> >Santiago Centro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="(dejar en blanco para mantener la contraseña actual)">
                        </div>
                        <div class="row boton-registro">
                            <input type="submit" class="btn btn-default" value="Editar" name="boton"?>
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