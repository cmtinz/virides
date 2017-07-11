<?php
    /* Conexión */
    /* Conexión */
    require_once("../conexion.php");

    /* Iniciar Sesion */
    require_once("../sesion.php");

    /* Verificar Rol */
    require_once("verificar_rol.php");

    /* Consulta Países */
    $consulta = "describe clientes";
    $recurso = $conexion->query($consulta);
    while ($hola = $recurso -> fetch_assoc()) {
        if ($hola[Field] == "comuna") {
            $comunas = $hola[Type];
            $comunas = str_replace("enum(", "", $comunas);
            $comunas = str_replace(")", "", $comunas);
            $comunas = str_replace("'", "", $comunas);
            $comunas = explode(",", $comunas);
        }
    }

    /* Modificar Usuario */
    if($_POST[enviar] == "Actualizar") {
        $consultaModificar = "UPDATE `clientes` SET `nombre` = '$_POST[nombre]', `telefono` = '$_POST[telefono]', `comuna` = '$_POST[comuna]', `direccion` = '$_POST[direccion]', `usuario` = '$_POST[usuario]', `contrasena` = '$_POST[contrasena]' WHERE `clientes`.`id` = $_POST[id];";
        $modificar = $conexion -> query($consultaModificar);
        header("Location: usuarios.php");
    }

    /* Consulta Usuarios */
    $consultaUsuarios = "SELECT * FROM clientes WHERE 1 AND id = '$_GET[id]'";
    $recursoUsuarios = $conexion -> query($consultaUsuarios);
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
    <link rel="stylesheet" href="../css/registro.css">
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
    <h2>Modificar Usuario</h2>
    <form action="" method="post" id="formulario" class="admin">
        <div class="control">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" minlength="2" value="<?= $fila[nombre]?>" required>
        </div>
        <div class="control">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= $fila[email]?>" required>
        </div>
        <div class="control">
            <label for="tel">Teléfono</label>
            <input type="tel" id="tel" name="telefono" value="<?= $fila[telefono]?>" required>
        </div>
        <div class="control">
            <label for="comuna">Comuna</label>
            <select name="comuna" id="comuna">
                <?php foreach ($comunas as $comuna) {?>
                <option value="<?=$comuna?>" <?php if ($fila[comuna] == $comuna) {echo "selected";}?>><?=$comuna?></option>
                <?php }?>
            </select>
        </div>
        <div class="control direccion">
            <label for="dir">Dirección</label>
            <textarea name="direccion" cols="30" rows="10" id="dir" required minlength="6"><?= $fila[direccion]?></textarea>
        </div>
        <div class="control">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required minlength="6" value="<?= $fila[usuario]?>">
        </div>
        <div class="control contrasena">
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required minlength="6" value="<?= $fila[contrasena]?>">
        </div>
        <input type="hidden" value="<?= $_GET[id]?>" name="id">
        <input type="submit" name="enviar" value="Actualizar">
    </form>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>