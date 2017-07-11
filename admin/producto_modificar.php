<?php 
    /* Conexión */
    require_once("../conexion.php");

    /* Iniciar Sesion */
    require_once("../sesion.php");

    /* Verificar Rol */
    require_once("verificar_rol.php");
    
    /* Consulta Modificar */
    if($_POST[modificar] == "Modificar") {
        $listaColores =  implode(",", $_POST[color]);
        $consulta = "UPDATE `productos` SET `nombre` = '$_POST[nombre]', `codigo` = '$_POST[codigo]', `categoria` = '$_POST[categoria]', `precio` = '$_POST[precio]', `disponibilidad` = '$_POST[disponibilidad]', `unidad` = '$_POST[unidad]', `fecha` = '$_POST[fecha]' WHERE `productos`.`id` = $_POST[id]; ";
        $recurso = $conexion-> query($consulta);
        header('Location: index.php');
    };
    
    /* Redirigir a lista */
    if(!isset($_GET[id]) || $_GET[id] == ""){
      header('Location: index.php');
    }

    /* Consulta Producto */
    $consulta = "SELECT * FROM productos WHERE 1 AND id=$_GET[id]";            
    $recurso = $conexion -> query($consulta);
    $fila = $recurso -> fetch_assoc();
    
    /* Consulta lista de categorías */
    $consultaCateogorias = "SELECT categoria FROM `productos` GROUP BY categoria";
    $recursoCategorias = $conexion -> query($consultaCateogorias);
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="css/grid.css">
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
        <div class="input"><input type="text" id="nombre" name="nombre" value="<?php echo $fila[nombre];?>" required></div>

        <label for="codigo">Código</label>
        <div class="input"><input type="text" id="codigo" name="codigo" value="<?php echo $fila[codigo];?>" required></div>

        <label for="categoria">Cateogoría</label>
        <div class="input"><input type="text" id="categoria" name="categoria" value="<?php echo $fila[categoria];?>" required></div>

        <label for="precio">Precio</label>
        <div class="input"><input type="text" id="precio" name="precio" value="<?php echo $fila[precio];?>" required></div>

        <label for="unidad">Unidad</label>
        <div class="input"><input type="text" id="unidad" name="unidad" value="<?php echo $fila[unidad];?>" required></div>

        <label for="estado">Estado</label>
        <fieldset id="estado">
            <input type="checkbox" name="disponibilidad" value="1" <?php if ($fila[disponibilidad] == 1) {echo "checked";}?>>Disponible<br>
        </fieldset>
        <label for="precio">Fecha</label>
        <div class="input"><input type="text" id="fecha" name="fecha" value="<?php echo $fila[fecha];?>" required></div>
        <input type="hidden" name="id" value="<?php echo $fila[id]?>">
        <input type="submit" name="modificar" value="Modificar">
    </form>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>