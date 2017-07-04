document.addEventListener("DOMContentLoaded", hartasFunciones());
window.onresize = hartasFunciones;

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