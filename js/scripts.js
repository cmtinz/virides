$(document).ready(function(){
    // Habilita los tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Ejecuta funciones de redimensionamiento
    hartasFunciones();
    window.onresize = hartasFunciones;

    // Eventos de aumentar, disminuir o eliminar productos
    $(".producto-disminuir").click(function (){
        var caja = this.parentNode.getElementsByTagName("input")[0];
        var valor;
        if (caja.value == "") {valor = 0} else {valor = parseInt(caja.value)}
        valor -= 1;
        caja.value = valor < 0 ? 0: valor;
        comprarProducto(caja);
    });
    $(".producto-aumentar").click(function (){
        var caja = this.parentNode.getElementsByTagName("input")[0];
        var valor;
        if (caja.value == "") {valor = 0} else {valor = parseInt(caja.value)}
        caja.value = valor + 1;
        comprarProducto(caja);
    });
    $(".producto-caja").change(function () {
        caja = this;
        comprarProducto(caja);
    })
    $(".producto-eliminar").click(function (esto) {
        var id = esto.target.getAttribute("data-productoId"); 
        window.location.href = "carro.php?eliminar=" + id;
    });
});

// Ejecuta consulta para comprar / actualizar la compra de un producto
function comprarProducto(producto) {
    $.post("comprar.php", {producto_id: producto.getAttribute("data-producto"), cantidad: producto.value}, function(respuesta, codigo) {
        if (codigo == "success") {
            respuesta = JSON.parse(respuesta)
            document.getElementById("carro").innerText = respuesta.total_items;
            producto.value = respuesta.cantidadProducto;
            // Actualiza totales del carro de compra si existe
            if (document.getElementById("compra-contenedor")) {
                document.getElementById("compra-subtotal").innerText = respuesta.subtotal.toLocaleString();
                var envio = respuesta.subtotal >= 15000?0: 15000 - respuesta.subtotal;
                document.getElementById("compra-envio").innerText = envio.toLocaleString();
                document.getElementById("compra-total").innerText = (envio + respuesta.subtotal).toLocaleString();
                producto.parentElement.parentElement.getElementsByClassName("compra-total")[0].innerText = respuesta.precioProducto.toLocaleString()
            }
        } else {
            console.log(`Error: ${codigo}`)
        }
    })
}

// Llama a las funciones de redimensionamiento
function hartasFunciones(){
    redimensionarBody();
    cuadradoPerfecto();
}
// Establece que el padding del body sea igual a la altura del footer para que este elemento esté debidamente posicionado bottom.
function redimensionarBody(){
    alto = document.getElementsByTagName("footer")[0].clientHeight + 20;
    document.body.style.paddingBottom = alto + "px";
}

function cuadradoPerfecto(){
    var hola = document.querySelectorAll(".cuadradoPerfecto")
    hola.forEach(function (esto) {esto.style.height = esto.clientWidth + "px"})
}

