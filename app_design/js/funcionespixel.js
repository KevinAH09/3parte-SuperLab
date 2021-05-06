window.onload = function () {
    // var canvas = document.getElementById("canvas");

    //======================================================================
    // VARIABLES
    //======================================================================
    let miCanvas = document.querySelector('#canvas');
    let tam = document.getElementById('size');
    let lineas = [];
    let pintar = false;
    // Marca el nuevo punto
    let nuevaPosicionX = 0;
    let nuevaPosicionY = 0;
    let color = '';
    let tamano = 0;

    let posicion = miCanvas.getBoundingClientRect()
    correccionX = posicion.x;
    correccionY = posicion.y;
    var img = new Image();
    let ctx = miCanvas.getContext('2d')
    borrar();
    //======================================================================
    // FUNCIONES
    //======================================================================

    /**
     * Funcion que empieza a dibujar la linea
     */
    function empezarDibujo() {
        pintar = true;
        lineas.push([]);
    };

    /**
     * Funcion que guarda la posicion del trazado
     */
    function guardarTrazado() {
        lineas[lineas.length - 1].push({
            x: nuevaPosicionX,
            y: nuevaPosicionY,
            c: color,
            t:tamano
        });
    }

    /**
     * Funcion dibuja la linea
     */
    function dibujarLinea(event) {
        console.log(tam.value);
        // event.preventDefault();
        let posicion2 = miCanvas.getBoundingClientRect()
        if (pintar) {
            let ctx = miCanvas.getContext('2d')
            // Estilos de linea
            // ctx.lineJoin = ctx.lineCap = 'round';
            // ctx.lineWidth = 5;
            // // Color de la linea
            // ctx.strokeStyle = '	#8B0000';
            // Marca el nuevo punto
            if (event.changedTouches == undefined) {
                scaleX = canvas.width / posicion2.width;
                scaleY = canvas.height / posicion2.height;
                nuevaPosicionX = (event.clientX - posicion2.left) * scaleX;
                nuevaPosicionY = (event.clientY - posicion2.top) * scaleY
                color = document.getElementById("muestrario").value;
                tamano=tam.value;
            }
            // Guarda el trazado
            guardarTrazado();
            // Redibuja todas los trazados
            ctx.beginPath();
            lineas.forEach(function (segmento) {
                ctx.moveTo(segmento[0].x, segmento[0].y);
                segmento.forEach(function (punto, index) {
                    // ctx.lineTo(punto.x, punto.y);
                    ctx.fillStyle = segmento[0].c;
                    ctx.fillRect(punto.x, punto.y, segmento[0].t, segmento[0].t);
                });
            });
            ctx.stroke();
        }
    }

    /**
     * Funcion que deja de dibujar 
     */
    function pararDibujar() {
        pintar = false;
        guardarTrazado();
    }

    //======================================================================
    // EVENTOS
    //======================================================================

    // Eventos raton
    miCanvas.addEventListener('mousedown', empezarDibujo, false);
    miCanvas.addEventListener('mousemove', dibujarLinea, false);
    miCanvas.addEventListener('mouseup', pararDibujar, false);

    // Eventos pantallas táctiles
    miCanvas.addEventListener('touchstart', empezarDibujo, false);
    miCanvas.addEventListener('touchmove', dibujarLinea, false);

    //Evento para cambiar la imagen en el canvas
    var input = document.getElementById('file-1')
    input.addEventListener('change', updateImageDisplay);
    function updateImageDisplay() {
        borrar();
        var file = input.files;
        img.src = window.URL.createObjectURL(file[0]);
        img.onload = function () {
            ctx.drawImage(img, 0, 0, 300, 150);
        }
    }

    //Evento para limpiar lo desarrollado dentro del canvas
    var limpiar = document.getElementById("limpiar");
    limpiar.addEventListener("click", function () {
        borrar();
    }, false);
    function borrar() {
        canvas.width = canvas.width;
        lineas = [];
    }

};
//Guardar el trazado en una imagen
function GuardarTrazado() {
    // Crear un elemento <a>
    let miCanvas2 = document.querySelector('#canvas');
    let enlace = document.createElement('a');
    // El título
    enlace.download = "trazado canvas.jpeg";
    // Convertir la imagen a Base64 y ponerlo en el enlace
    enlace.href = miCanvas2.toDataURL();
    // Hacer click en él
    enlace.click();
}