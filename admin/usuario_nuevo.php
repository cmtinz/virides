<?php
    /* Conexión */
    require_once("conexion.php");

    /* Verificar permisos */
    require_once("sesion.php");

    /* Consulta agregar cliente */
    if($_POST[enviar] == "Enviar") {
        $insert = "INSERT INTO `clientes` (`id`, `nombre`, `email`, `telefono`, `comuna`, `direccion`, `usuario`, `contrasena`) VALUES (NULL, '$_POST[nombre]', '$_POST[email]', '$_POST[telefono]', '$_POST[comuna]', '$_POST[direccion]', '$_POST[usuario]', '$_POST[contrasena]')";
        $recurso = $conn-> query($insert);
        header("Location: usuarios.php");
    }

     /* Consulta Países */
    $consulta = "describe clientes";
    $recurso = $conn->query($consulta);
    while ($hola = $recurso -> fetch_assoc()) {
        if ($hola[Field] == "comuna") {
            $comunas = $hola[Type];
            $comunas = str_replace("enum(", "", $comunas);
            $comunas = str_replace(")", "", $comunas);
            $comunas = str_replace("'", "", $comunas);
            $comunas = explode(",", $comunas);
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="../css/grid.css">
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
    <h2>Registro de Usuario</h2>
    <form action="" method="post" id="formulario">
        <div class="control">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" minlength="2" required>
        </div>
        <div class="control">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="control">
            <label for="tel">Teléfono</label>
            <input type="tel" id="tel" name="telefono" required>
        </div>
        <div class="control">
            <label for="pais">Comuna</label>
            <select name="comuna" id="comuna">
                <?php foreach ($comunas as $comuna) {?>
                <option value="<?=$comuna?>" <?php if ($fila[comuna] == $comuna) {echo "selected";}?>><?=$comuna?></option>
                <?php }?>
            </select>
        </div>
        <div class="control direccion">
            <label for="dir">Dirección</label>
            <textarea name="direccion" cols="30" rows="10" id="dir" required minlength="6"></textarea>
        </div>
        <div class="control">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required minlength="6">
        </div>
        <div class="control contrasena">
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required minlength="6">
        </div>
        <input type="submit" name="enviar" value="Enviar">
    </form>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>