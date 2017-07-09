<?php
    $consulta_totalItems = "select sum(cantidad) as totalItems from compras where `cliente_id` ='$_SESSION[user_id]' ";
    $recurso_totalItems = $conexion -> query($consulta_totalItems);
    $fila_totalItems = $recurso_totalItems -> fetch_assoc();
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
            <form class="">
                <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Búsqueda">
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>
            <button type="button" class="btn btn-default" id="boton-carro" data-togle="tooltip">
                <span class="badge" id="carro"><?= $fila_totalItems['totalItems'] ?></span>
                <span class="glyphicon glyphicon-shopping-cart"></span>
            </button>
        </div>
    </div><!-- /.container -->
</nav><!--./nav-superior-->