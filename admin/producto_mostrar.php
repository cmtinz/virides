<?php
  /* Conexión */
    /* Conexión */
    require_once("../conexion.php");

    /* Iniciar Sesion */
    require_once("../sesion.php");

    /* Verificar Rol */
    require_once("verificar_rol.php");

  /* Consulta ver productos */
  $query = " SELECT * FROM productos WHERE 1 AND id=$_GET[id]";            
  $recurso = $conexion -> query($query); 
  $total = $recurso -> num_rows;
  $fila = $recurso -> fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Rayitas: <?php echo $fila[nombre]?></title>
  <link rel="stylesheet" href="css/grid.css">
  <link rel="stylesheet" href="css/productos.css">
  </head>
<body>

<!-- Encabezado -->
<?php include("header.php"); ?>
<?php include("menu.php"); ?>

<!-- Contenedor de Producto -->
<div id="prod">
  <div id="prodImg"> <img src="img/<?php echo $fila[codigo]?>.jpg" alt="imagen de producto"> </div>

    <h2 id="nombre"><?php echo $fila[nombre];?></h2>
    <p id="codigo"><?php echo $fila[codigo];?></p>
    <div id="prodDesc">
      <p id="frasePromocional"><?php echo $fila[frase_promocional];?></p>
      <ul id="ficha">
        <li>Categoría: <?php echo $fila[categoria];?></li>
        <li>Precio: <?php echo $fila[precio];?></li>
        <li>Unidad de venta: <?php echo $fila[unidad];?></li>
        <? if ($fila[disponibilidad] == "1") {
          $disponible = "disponible";
          } else {$disponible = "no disponible";}?>
        <li>Disponibilidad: <?php echo $disponible;?></li>
        <li><?php echo fechaChilena($fila[fecha]);?></li>
      </ul>
    </div>

  <div id="prodCompra">
    <a href="index.php?idEliminar=<?php echo $fila[id];?>">Eliminar</a>
    <a href="producto_modificar.php?id=<?php echo $fila[id];?>">Modificar</a>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>