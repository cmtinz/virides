<?php
    /*Conexión a base de datos*/
    require_once("conexion.php");

    /* Consulta Productos */
    $max=5;
    $pag=0;
    if(isset($_GET[pag]) && $_GET[pag] <> ""){
        $pag=$_GET[pag];
    }
    $inicio= $pag * $max;
    $busqueda = $_GET[busqueda];
    $consulta= " SELECT * FROM productos WHERE nombre LIKE '%$busqueda%' AND categoria_id = '$_GET[categoria_id]' ORDER BY fecha DESC";
    $consulta_limite = $consulta . " LIMIT $inicio, $max";
    $recurso = $conexion->query($consulta_limite); 
    if (isset($_GET[total])) {
        $total = $_GET[total];
    } else {
        $recurso_totales = $conexion -> query($consulta);
        $total = $recurso_totales -> num_rows;
    }
    $total_pag = ceil($total/$max) - 1;

    /* Consulta Categorías */
    $consulta = "select nombre from categorias where id = '$_GET[categoria_id]'";
    $recurso_categoria = $conexion -> query($consulta);
    $nombre_categoria = $recurso_categoria -> fetch_assoc();

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
                    <h2><?= $nombre_categoria[nombre]?></h2>
                    <!-- Pager -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="<?php if ($pag == 0) {echo 'disabled';}?>">
                                <a href="productos.php?pag=<?= $pag -1?>&total=<?php echo $total?>&categoria_id=<?= $_GET[categoria_id]?>">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 0; $i <= $total_pag; $i++) { ?>
                                <li class="<?php if ($pag == $i) {echo 'active';}?>">
                                    <a href="productos.php?pag=<?= $i?>&total=<?php echo $total?>&categoria_id=<?= $_GET[categoria_id]?>">
                                        <span aria-hidden="true"><?= $i + 1?></span>
                                    </a>
                                </li>
                            <?php }?>
                            <li class="<?php if ($pag == $total_pag) {echo 'disabled';}?>">
                                <a href="productos.php?pag=<?php echo $pag +1?>&total=<?php echo $total?>&categoria_id=<?= $_GET[categoria_id]?>">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav><!-- ./Pager -->
                    <!-- Grid Productos -->
                    <div id="tablaProductos row">
                    <? if ($total){
                    while ($fila = $recurso->fetch_assoc()) {?>
                    <div class="prodCont">
                        <div class="imgProd">
                            <img src="img/productos/<?= $fila[codigo]?>.jpg" alt="imagen de producto">
                        </div>
                        <div class="descProd">
                            <h3><a href="producto.php?id=<?php echo $fila[id]; ?>"><?php echo $fila[nombre];?></a></h3>
                            <p><?php echo $fila[frase_promocional];?></p>
                        </div>
                        <div class="precioProd">
                            <?php echo "$" . number_format($fila[precio], 0, ".", ",");?>
                        </div>
                    </div> <?php } } else { ?> <p>No hay resultados</p> <?php } ?>
                    </div><!-- ./Grid Productos -->
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