<?
    /* Conexión */
    require_once("conexion.php");

    /* Verificar permisos */
    require_once("sesion.php");

    /* Consulta Eliminar */
    if(isset($_GET[idEliminar]) && $_GET[idEliminar]<> ""){
        $eliminar = "DELETE FROM clientes WHERE 1 AND id=$_GET[idEliminar]";
        $consultaEliminar = $conn -> query($eliminar);
    }

    /* Consultas de Lista de Productos */
    $max=10;
    $pag=0;
    if(isset($_GET[pag]) && $_GET[pag] <> ""){
        $pag=$_GET[pag];
    }
    $inicio= $pag * $max;
    $busqueda = $_GET[busqueda];
    $consulta= "SELECT * FROM clientes WHERE nombre LIKE '%$busqueda%'";
    $consulta_limite = $consulta . " LIMIT $inicio, $max";
    $recurso = $conn->query($consulta_limite); 
    if (isset($_GET[total])) {
        $total = $_GET[total];
    } else {
        $recurso_totales = $conn -> query($consulta);
        $total = $recurso_totales -> num_rows;
    }
    $total_pag = ceil($total/$max) - 1;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../css/grid.css">
</head>
<body>
    <!-- Encabezado -->
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>

    <!-- Pager --> 
    
    <div id="encabezadoTabla" class="conAgregar">
        <ul id="pager">
        <?php if ($pag - 1 >= 0) { ?>
        <li>
            <a href="usuarios.php?pag=<?php echo $pag -1?>&total=<?php echo $total?>">Anterior</a>
        </li>
        <?php } ?>
        <li> <?php echo $inicio + 1 ?> a <?php echo min($inicio + $max, $total) ?>  de <?php echo $total ?></li>
        <?php if ($pag + 1 <= $total_pag) { ?> 
        <li>
            <a href="usuarios.php?pag=<?php echo $pag +1?>&total=<?php echo $total?>">Siguiente</a>
        </li>
        <?php } ?>
        </ul>
        <form action="usuarios.php" method="get">
            <input type="text" name="busqueda" value="<?php echo $busqueda; ?>">
            <button type="submit">Buscar</button>
        </form>
        <div><a href="usuario_nuevo.php">Nuevo</a></div>
    </div>

    <!-- Usuario -->
    <table id="tablaUsuarios">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>E-Mail</th>
            <th>Teléfono</th>
            <th>Comuna</th>
            <th>Dirección</th>
        </tr>
        <? if ($total){
        while ($fila = $recurso->fetch_assoc()) {?>
        <tr class="usuario">
            <td><a href="usuario_ver.php?id=<?= $fila[id]?>"><?= $fila[id]?></a></td>
            <td><?= $fila[usuario]?></td>
            <td><?= $fila[nombre]?></td>
            <td><?= $fila[email]?></td>
            <td><?= $fila[telefono]?></td>
            <td><?= $fila[comuna]?></td>
            <td><?= $fila[direccion]?></td>
            <td><a href="usuarios.php?idEliminar=<?= $fila[id]?>">Eliminar</a></td>
            <td><a href="usuario_modificar.php?id=<?= $fila[id]?>">Modificar</a></td>
        </tr> <?php } } else { ?> <p>No hay resultados</p> <?php } ?>
    </table>

    <div id="tablaUsuarios" style="display: none">
        <? if ($total){
        while ($fila = $recurso->fetch_assoc()) {?>
        <div class="prodCont">
            <div class="descProd">
                <h2><a href="producto_mostrar.php?id=<?php echo $fila[id]; ?>"><?php echo $fila[nombre];?></a></h2>
                <div class="codigo"><?= $fila[codigo]?></div>
            </div>
            <div class="acciones">
                <span><a href="usuarios.php?idEliminar=<?php echo $fila[id];?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/></svg></a>
                </span>
                <span>
                    <a href="producto_modificar.php?id=<?php echo $fila[id];?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg></a>
                </span>
            </div>
        </div> <?php } } else { ?> <p>No hay resultados</p> <?php } ?>
        </div>
    <?php include("footer.php"); ?>
</body>
</html>