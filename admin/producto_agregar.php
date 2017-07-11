<?php
    /* Conexión */
    require_once("conexion.php");

    /* Verificar permisos */
    require_once("sesion.php");

    /* Consulta Agregar Producto */
    if($_POST[agregar] == "Agregar") {
        if ($_POST[rojo] == 1) {$color[] = "rojo";};
        if ($_POST[azul] == 1) {$color[] = "azul";};
        if ($_POST[purpura] == 1) {$color[] = "purpura";};
        if ($_POST[verde] == 1) {$color[] = "verde";};
        $listaColores =  implode(",", $color);
        $consulta = "INSERT INTO `productos` (`id`, `nombre`, `codigo`, `categoria`, `precio`, `disponibilidad`, `unidad`, `fecha`) VALUES (NULL, '$_POST[nombre]', '$_POST[codigo]', '$_POST[categoria]', '$_POST[precio]', '$_POST[disponibilidad]', '$_POST[unidad]', CURRENT_TIMESTAMP);";
        $recurso = $conn-> query($consulta);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/producto_agregar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#formulario").validate();
        })
    </script>
</head>
<body>
    <!-- Encabezado -->
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>
    <section id="contenedorFormulario">
    <form action="" method="post" id="formulario">
        <label for="nombre">Nombre</label>
        <div class="input"><input type="text" id="nombre" name="nombre" required></div>

        <label for="codigo">Código</label>
        <div class="input"><input type="text" id="codigo" name="codigo" required></div>

        <label for="categoria">Cateogoría</label>
        <div class="input"><input type="text" id="categoria" name="categoria" required></div>

        <label for="precio">Precio</label>
        <div class="input"><input type="text" id="precio" name="precio" required></div>

        <label for="unidad">Unidad</label>
        <div class="input"><input type="text" id="unidad" name="unidad" required></div>

        <label for="estado">Estado</label>
        <fieldset id="estado">
        <input type="checkbox" name="disponibilidad" value="1" checked>Disponible<br>
        </fieldset>
        <input type="submit" name="agregar" value="Agregar">
    </form>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>