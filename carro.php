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

    /* Consulta datos de usuario */
    $consulta_usuario = "select * from clientes where id = '". $_SESSION['user_id']."'";
    $consulta_usuario = $conexion -> query($consulta_usuario);
    $usuario = $consulta_usuario -> fetch_assoc();

    /* Compra */
    if(isset($_POST['boton']) && $_POST['boton'] == "Comprar") {
        $mensaje="El usuario ".$usuario['nombre']." ha realizado una compra en el sitio web:
        Correo electrónico: ".$usuario['email']."
        Teléfono: ".$_POST['telefono']."
        Dirección de entrega: ".$_POST['direccion']."
        Comuna: ".$_POST['comuna']."
        Sub Total: " . $_POST['totalSubtotal']."
        Envío: " . $_POST['totalEnvio']."
        Total: " . $_POST['totalCompra']."
        _______________________________________________
        ";
        $cabecera = "From: carl.martinezp@alumnos.duoc.cl\n";
        $cabecera .= "Reply-To: carl.martinezp@alumnos.duoc.cl\n";
        $destinatario= $usuario['nombre'] . " <". $usuario['email'] .">";
        $asunto="Venta en Verdurería Bilbao 640";
        mail("$destinatario", "$asunto", "$mensaje", "$cabecera");

        // Eliminar productos del carro de compra
        $consulta_eliminarProductos = "delete from compras where cliente_id = '".$_SESSION['user_id']."'";
        $recurso_eliminarProductos = $conexion -> query($consulta_eliminarProductos); 

        // Redirigir a compra exitosa
        header("Location: compra-exitosa.php");
    }

    /* Inicializa variables */
    $total_Compra = 0;
    $_SESSION['pagina_origen'] = basename($_SERVER['PHP_SELF']);

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
                        <!-- Determina si el ususario está registrado-->
                        <?php if ($usuarioRegistrado == false) {?>
                            <!-- Usuario no registrado -->
                            <div class="registrate">
                                <h3>Regístrate para continuar</h3>
                                <div class="row">
                                    <a class="btn btn-default" href="registro.php" role="button">Nuevo Usuario</a>
                                    <a class="btn btn-default" href="ingreso.php" role="button">Iniciar sesión</a>
                                </div>
                            </div>
                        <?php ;} else {?>
                            <!-- Usuario registrado -->
                            <form action="" method="post" class="revalidacion">
                                <h3>Revalida tus datos<small> para continuar con la compra</small></h3>

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
                                <input type="hidden" name="totalSubtotal" value="<?= number_format($total_Compra, 0, ".", ",") ?>">
                                <input type="hidden" name="totalEnvio" value="<?= number_format($total_Envio = $total_Compra >= 15000? 0: 15000 - $total_Compra, 0, ".", ",")?>">
                                <input type="hidden" name="totalCompra" value="<?= number_format($total_General = $total_Envio +  $total_Compra, 0, ".", ",")?>">
                                <div class="row boton-registro">
                                    <input type="submit" class="btn btn-default btn-lg" value="Comprar" name="boton"?>
                                </div>
                            </form>
                        <?php ;}?>
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