<?php
    /*Conexión a base de datos*/
    require_once("conexion.php");

    /* Sesión */
    require_once("sesion.php");

    /* Consulta eliminar productos con cantidad 0 */
    $consulta_eliminarVacios = "delete from compras where cliente_id = '". $_SESSION['user_id'] ."' and cantidad = '0'";
    $recurso_eliminarVacios = $conexion -> query($consulta_eliminarVacios);

    /* Eliminar producto */
    if(isset($_GET['eliminar']) && $_GET['eliminar']<> ""){
        $consulta_eliminarProducto = "delete from compras where cliente_id = '". $_SESSION['user_id']."' and producto_id = '".$_GET['eliminar']."'";
        $recurso_eliminarProducto = $conexion -> query($consulta_eliminarProducto);
    }

    /* Consulta Productos Comprados */
    $consulta_productosComprados = "select compras.*, productos.nombre as producto_nombre, productos.`precio` as producto_precio, productos.precio as producto_precio from compras left join productos on producto_id = productos.`id` where cliente_id = '" . $_SESSION['user_id'] . "'";
    $recurso_productosComprados = $conexion -> query($consulta_productosComprados);

    /* Inicializa variables */
    $total_Compra = 0;

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
                <!-- Menú -->
                <div class="col-lg-3 col-md-3" id="menu">
                    <?php require_once("menu.php");?>
                </div><!-- ./Menú -->
                <div class="col-lg-8 col-md-9 col-lg-offset-1 contenido">
                    <h2>Carro de Compras</h2>
                    <?php if ($recurso_productosComprados -> num_rows > 0 ) {?>
                        <?php while ($compra = $recurso_productosComprados -> fetch_assoc()) {?>
                            <!-- Compra -->
                            <div class="compra-contenedor" id="compra-contenedor">
                                <div class="compra-nombreProducto">
                                    <?= $compra['producto_nombre']?>
                                </div>
                                <div class="compra-modificar">
                                    <button class="producto-disminuir">-</button>
                                    <input type="text" name="cantidad" class="producto-caja" data-producto="<?= $compra['producto_id']?>" value="<?= $compra['cantidad']?>" >
                                    <button class="producto-aumentar">+</button>
                                    <button class="producto-eliminar" data-productoID="<?= $compra['producto_id']?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                </div>
                                <div class="compra-total">
                                    <?php
                                        $precio_Producto = $compra['cantidad'] * $compra['producto_precio'];
                                        echo number_format($precio_Producto, 0, ".", ",");
                                        $total_Compra += $precio_Producto;
                                    ?>
                                </div>
                            </div><!-- ./Compra -->
                        <?php ;}?>
                        <!-- Totales -->
                        <div class="totales">
                            <div class="totales-subtotal">
                                <span class="totales-etiqueta">Subtotal</span>
                                <span class="totales-cifra" id="compra-subtotal">
                                    <?= number_format($total_Compra, 0, ".", ",")?>
                                </span>
                            </div>
                            <div class="totales-subtotal">
                                <span class="totales-etiqueta">Envío</span>
                                <span class="totales-cifra" id="compra-envio">
                                    <?= number_format($total_Envio = $total_Compra >= 15000? 0: 15000 - $total_Compra, 0, ".", ",")?>
                                </span>
                            </div>
                            <div class="totales-subtotal totales-total">
                                <span class="totales-etiqueta">Total</span>
                                <span class="totales-cifra" id="compra-total">
                                    <?= number_format($total_General = $total_Envio +  $total_Compra, 0, ".", ",") ?>
                                </span>
                            </div>
                        </div><!-- ./Totales -->
                        <div class="registrate">
                            <h3>Regístrate para continuar</h3>
                            <div class="row">
                                <a class="btn btn-default" href="registro.php" role="button">Nuevo Usuario</a>
                                <a class="btn btn-default" href="ingreso.php" role="button">Iniciar sesión</a>
                            </div>
                        </div>
                    <?php ;} else { ?>
                        No existen compras registradas.
                    <?php ;} ?>
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