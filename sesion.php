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
        $_SESSION['user_id'] = $conexion -> insert_id;
    }

    // Determina si el usuario está registrado
    $consulta_determinarRegistro="select email, contrasena, rol from clientes where id='". $_SESSION['user_id']."'";
    $recurso_determinarRegistro = $conexion -> query($consulta_determinarRegistro);
    $determinarRegistro = $recurso_determinarRegistro -> fetch_assoc();
    $usuarioRegistrado = novacia($determinarRegistro['email']) || novacia($determinarRegistro['contrasena'])? true:false;
    $_SESSION['rol'] = $determinarRegistro['rol'];

    // Determina si existe una variable y en caso afirmativo la devuelve
    function existe($elemento) {
        return isset($elemento)? $elemento: "";
    }

    // Dertermina si una variable está establecida y tiene contenido, en caso afirmativo devuelve true
    function novacia($variable) {
        return isset($variable) && !empty($variable)? true: false;
    }

?>