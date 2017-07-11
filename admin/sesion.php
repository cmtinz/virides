<?php
if(!isset($_SESSION))session_start();
if ($_SESSION[rol] !== "administrador") {header("Location: login.php");}
?>