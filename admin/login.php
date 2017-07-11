<?php
    require_once("conexion.php");
    if(!isset($_SESSION))session_start();
    if((isset($_POST[usuario]) && $_POST[usuario]<>"") && (isset($_POST[clave]) && $_POST[clave]<>"") ){
        $query="SELECT * FROM clientes WHERE usuario='$_POST[usuario]' AND contrasena='$_POST[clave]'";
        $resource=$conn->query($query);
        if($t=$resource->num_rows){
            $row=$resource->fetch_assoc();
            $_SESSION[user_id]=$row[id];
            $_SESSION[nombre]=$row[nombre];
            $_SESSION[email]=$row[email];
            $_SESSION[telefono]=$row[telefono];
            $_SESSION[pais]=$row[pais];
            $_SESSION[direccion]=$row[direccion];
            $_SESSION[rol]=$row[rol];
            $volver=($_SESSION[volver])?$_SESSION[volver]:"index.php";
            header("Location: ".$volver);
        } else {
            $error="Usuario/Clave no registrados";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/registro.css">
    <script>
        $(document).ready(function () {
            $("#formulario").validate();
        });
    </script>
</head>
<body>
    
        <?php include("header.php"); ?>
        <?php include("menu.php"); ?>
    
    <section>
    <h2>Login</h2>
    <form action="" method="post" id="formulario" class="login">
        <div class="control">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" />
        </div>
        <div class="control">
            <label for="clave">Contraseña</label>
            <input type="password" name="clave" id="clave" />
        </div>
        <input type="submit" name="ingresar" id="ingresar" value="Ingresar" class="boton" />
    </form>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>