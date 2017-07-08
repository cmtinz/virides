<?php
    require_once("conexion.php");
    require_once("sesion.php");

    /*Comprar*/
    /*if($_POST[comprar] == "comprar") {
        $queryCompra = "INSERT INTO `compras` (`id`, `cliente`, `codigo`, `nombre`, `precio`, `cantidad`, `fecha`) VALUES (NULL, '$_POST[cliente]', '$_POST[codigo]', '$_POST[nombre]', '$_POST[precio]', '$_POST[cantidad]', CURRENT_TIMESTAMP)";
        $recurso = $conexion-> query($queryCompra);
        header("Location: boleta.php");
    };*/

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


    // Recopila resultados y codifica la respuesta en JSON
    $respuesta[consulta_verificar] = $consulta_verificar;
    $respuesta[consulta_modificar] = $consulta_modificar;
    $respuesta[consulta_agregar] = $consulta_agregar;
    $respuesta[consulta_totalItems] = $consulta_totalItems;
    $respuesta[total_items] = $fila_totalItems[totalItems];
    echo json_encode($respuesta);
?>