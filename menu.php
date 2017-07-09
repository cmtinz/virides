<?php 
    /*Consulta Menú*/
    $consulta = "select * from categorias where 1";
    $consultaCategorias = $conexion -> query($consulta);
    $categoria_id = isset($_GET['categoria_id'])? $_GET['categoria_id']: "";
?>
<ul>
    <li>
        <a href="index.php">Inicio</a>
        <ul>
            <li><a href="index.php">Zonas de despacho</a></li>
            <li><a href="index.php">Horarios</a></li>
            <li><a href="index.php">Ubicación</a></li>
            <li><a href="index.php">Contacto</a></li>
        </ul>
    </li>
    <?php while ($fila = $consultaCategorias -> fetch_assoc()) {?>
        <li class="categoriaProducto <?= $fila['id'] == $categoria_id? " activo": "" ?>">
            <a href="productos.php?categoria_id=<?= $fila['id']?>" data-toggle="tooltip" title="<?= $fila['descripcion']?>" data-placement="right">
                <?= $fila['nombre']?>
            </a>
        </li>
    <?php ;}?>
    <li><a href="ingreso.php">Ingreso</a></li>
</ul>