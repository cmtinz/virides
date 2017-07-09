<?php
    // Verifica conexión
    require_once("conexion.php");

    // Inicia sesion si es que no lo está
    if(!isset($_SESSION))session_start();

    // Determina si existe un usuario creado, caso contrario crea uno provisional
    if (!$_SESSION['user_id']) {
        // Determina el IP del visitante, por puro copuchar.
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $consulta = "insert into clientes (`ultimo_ip`) values ('$ip')";
        $consulta_agregar = $conexion -> query($consulta);
        $_SESSION[user_id] = $conexion -> insert_id;
    }
?>