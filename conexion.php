<?php
$hostname = "carl.martinezp.laboratoriodiseno.cl";
$username = "carlmart_bilbao";
$password = "+C&7,Ha44~_s";
$database = "carlmart_bilbao";
$conexion = new mysqli($hostname, $username, $password, $database);
$conexion->set_charset('utf8'); 
if ($conexion ->connect_error) {
die('Error de Conexión (' . $conexion->connect_errno . ') '
. $conexion->connect_error);
};
function fechaChilena($fecha) {
    list($fecha, $hora) = explode(" ", $fecha);
    list($ano, $mes, $dia) = explode("-", $fecha);
    list($hora, $minuto, $segundo) = explode(":", $hora);
    $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "septiembre", "octubre", "noviembre", "diciembre");
    $fecha = $ano . "/" . $meses[$mes - 1] . "/" . $dia . ", " . $hora . ":" . $minuto;
    return $fecha;
};
?>