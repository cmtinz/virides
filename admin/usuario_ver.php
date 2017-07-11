<?php
    /* Conexión */
    require_once("conexion.php");

    /* Verificar permisos */
    require_once("sesion.php");

    /* Consulta Usuarios */
    $consultaUsuarios = "SELECT * FROM clientes WHERE 1 AND id = '$_GET[id]'";
    $recursoUsuarios = $conn -> query($consultaUsuarios);
    $fila = $recursoUsuarios -> fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Usuario</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/registro.css">
    <script>
        $(document).ready(function () {
            $("#formulario").validate();
        })
    </script>
</head>
<body>
    
        <?php include("header.php"); ?>
        <?php include("menu.php"); ?>
    
    <section>
    <h2>Ver Usuario</h2>
    <div action="" method="post" id="formulario" class="admin">
        <div class="control">
            <div for="nombre">Nombre</div>
            <div><?= $fila[nombre]?></div>
        </div>
        <div class="control">
            <div>Email</div>
            <div><?= $fila[email]?></div>
        </div>
        <div class="control">
            <div>Teléfono</div>
            <div><?= $fila[telefono]?></div>
        </div>
        <div class="control">
            <div>Comuna</div>
            <div><?= $fila[comuna]?></div>
        </div>
        <div class="control direccion">
            <div>Dirección</div>
            <div><?= $fila[direccion]?></div>
        </div>
        <div class="control">
            <div>Usuario</div>
            <div><?= $fila[usuario]?></div>
        </div>
    </div>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>