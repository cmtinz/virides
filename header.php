<?php
    $consulta_totalItems = "select sum(cantidad) as totalItems from compras where `cliente_id` ='$_SESSION[user_id]' ";
    $recurso_totalItems = $conexion -> query($consulta_totalItems);
    $fila_totalItems = $recurso_totalItems -> fetch_assoc();
    $totalItems = $fila_totalItems['totalItems'] =! ""? $fila_totalItems['totalItems'] : "0";
?>

<!-- Header-->
<header>
        <div class="container">
            <img src="img/logo-frutas.svg" alt="Logo verdurería">
            <h1>Verdulería Bilbao 640</h1>
        </div>
</header><!-- ./Header-->

<!--nav-superior-->
<nav class="encabezado">
    <div class="container">
        <div class="izquierda">
            <button type="button" class="btn btn-default hidden-lg hidden-md" data-toggle="collapse" data-target="#menu"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
        </div>
        <div class="derecha">
            <form action="productos.php" method="get">
                <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Búsqueda" <?= novacia($_GET['busqueda'])? "value='$busqueda'": ""?> >
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>
            <a type="button" class="btn btn-default" id="boton-carro" data-togle="tooltip" href="carro.php">
                <span class="badge" id="carro"><?= $fila_totalItems['totalItems'] ?></span>
                <span class="glyphicon glyphicon-shopping-cart"></span>
            </a>
        </div>
    </div><!-- /.container -->
</nav><!--./nav-superior-->