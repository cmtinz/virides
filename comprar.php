<?php
    require_once("conexion.php");
    require_once("sesion.php");

    /* Determina si hay una compra para el producto */
    $consulta_verificar = "select id from compras where producto_id = '$_POST[producto_id]' and `cliente_id`='$_SESSION[user_id]' ";
    $recurso_verificar = $conexion -> query($consulta_verificar);
    if ($recurso_verificar -> num_rows >= 1) {
        // Modifica compra 
        $consulta_modificar = "update compras set `cantidad` = $_POST[cantidad] where `producto_id` = '$_POST[producto_id]' and `cliente_id`='$_SESSION[user_id]' ";
        $recurso_modificar = $conexion -> query($consulta_modificar);
    } else {
        // Agrega ítem al carro
        $consulta_agregar = "insert into compras (`cliente_id`, `producto_id`, `cantidad`) values ('$_SESSION[user_id]', '$_POST[producto_id]', '$_POST[cantidad]')";
        $recurso_agregar = $conexion -> query($consulta_agregar);
    }

    /* Determinar total de elementos del carro */
    $consulta_totalItems = "select sum(cantidad) as totalItems from compras where `cliente_id` ='$_SESSION[user_id]' ";
    $recurso_totalItems = $conexion -> query($consulta_totalItems);
    $fila_totalItems = $recurso_totalItems -> fetch_assoc();

    /* Determina cantidad comprada del producto */
    $consulta_cantidadProducto = "select cantidad from compras where cliente_id = '$_SESSION[user_id]' and producto_id = '$_POST[producto_id]'";
    $recurso_cantidadProducto = $conexion -> query($consulta_cantidadProducto);
    $fila_cantidadProducto = $recurso_cantidadProducto -> fetch_assoc();

    /* Determina precio producto modificado */
    $consulta_precioProducto = "select precio from productos where id='". $_POST['producto_id']."'";
    $recurso_precioProducto = $conexion -> query($consulta_precioProducto);
    $fila_precioProducto = $recurso_precioProducto -> fetch_assoc();
    $fila_precioProducto = $fila_precioProducto['precio'] * $fila_cantidadProducto['cantidad'];

    /* Determina sub total */
    $consulta_subtotal = "select cantidad, precio from compras left join productos on producto_id = productos.id where cliente_id = '". $_SESSION['user_id']."'";
    $recurso_subtotal = $conexion -> query($consulta_subtotal);
    $subtotal = 0;
    while ($item = $recurso_subtotal -> fetch_assoc()) {
        $subtotal += $item['cantidad'] * $item['precio'];
    }

    // Recopila resultados y codifica la respuesta en JSON
    /*$respuesta['consulta_verificar'] = isset($consulta_verificar)? $consulta_verificar: $consulta_verificar;
    $respuesta['consulta_modificar'] = $consulta_modificar;
    $respuesta['consulta_agregar'] = $consulta_agregar;
    $respuesta['consulta_cantidadProducto'] = $consulta_cantidadProducto;
    $respuesta['consulta_totalItems'] = $consulta_totalItems;*/
    $respuesta['cantidadProducto'] = existe($fila_cantidadProducto['cantidad']);
    $respuesta['total_items'] = existe($fila_totalItems['totalItems']);
    $respuesta['precioProducto'] = $fila_precioProducto;
    $respuesta['subtotal'] = $subtotal;

    echo json_encode($respuesta);
?>