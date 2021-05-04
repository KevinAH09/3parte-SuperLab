window.onload = function () {
    // var canvas = document.getElementById("canvas");
    //======================================================================
    // VARIABLES
    //======================================================================
    let miCanvas = document.querySelector('#canvas');
    let lineas = [];
    let correccionX = 0;
    let correccionY = 0;
    let pintarLinea = false;
    // Marca el nuevo punto
    let nuevaPosicionX = 0;
    let nuevaPosicionY = 0;
    let color = '';

    let posicion = miCanvas.getBoundingClientRect()
    correccionX = posicion.x;
    correccionY = posicion.y;
    var img = new Image();
    let ctx = miCanvas.getContext('2d')
    // img.src = "imagen.jpg";

    //======================================================================
    // FUNCIONES
    //======================================================================

    /**
     * Funcion que empieza a dibujar la linea
     */
    function empezarDibujo() {
        pintarLinea = true;
        lineas.push([]);
    };

    /**
     * Funcion que guarda la posicion de la nueva línea
     */
    function guardarLinea() {
        lineas[lineas.length - 1].push({
            x: nuevaPosicionX,
            y: nuevaPosicionY,
            c: color
        });
    }

    /**
     * Funcion dibuja la linea
     */
    function dibujarLinea(event) {
        event.preventDefault();
        let posicion2 = miCanvas.getBoundingClientRect()
        if (pintarLinea) {
            let ctx = miCanvas.getContext('2d')
            // Estilos de linea
            ctx.lineJoin = ctx.lineCap = 'round';
            ctx.lineWidth = 5;
            // Color de la linea
            ctx.strokeStyle = '	#8B0000';
            // Marca el nuevo punto
            if (event.changedTouches == undefined) {
                scaleX = canvas.width / posicion2.width;
                scaleY = canvas.height / posicion2.height;
                nuevaPosicionX = (event.clientX - posicion2.left) * scaleX;
                nuevaPosicionY = (event.clientY - posicion2.top) * scaleY
                color = document.getElementById("muestrario").value;
            }
            // Guarda la linea
            guardarLinea();
            // Redibuja todas las lineas guardadas
            ctx.beginPath();
            lineas.forEach(function (segmento) {
                ctx.moveTo(segmento[0].x, segmento[0].y);
                segmento.forEach(function (punto, index) {
                    // ctx.lineTo(punto.x, punto.y);
                    ctx.fillStyle = segmento[0].c;
                    ctx.fillRect(punto.x, punto.y, 5, 5);
                });
            });
            ctx.stroke();
        }
    }

    /**
     * Funcion que deja de dibujar la linea
     */
    function pararDibujar() {
        pintarLinea = false;
        guardarLinea();
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
    var input = document.getElementById('image_uploads')
    input.addEventListener('change', updateImageDisplay);

    function updateImageDisplay() {

        var curFile = input.files;
        source = curFile[0].name;
        img.src = window.URL.createObjectURL(curFile[0]);

        img.onload = function () {
            ctx.drawImage(img, 0, 0, 500, 500);
            // image.style.display = 'none';
            image.style.width = '500px';
            image.style.height = '500px';
        }
    }
    var limpiar = document.getElementById("limpiar");
    limpiar.addEventListener("click", function () {
        canvas.width = canvas.width;
        lineas = [];
    }, false);

    var inputImagen='imagen';
    var imagen2=document.getElementById(inputImagen); 
    function GuardarTrazado() {
        imagen2.value = document.getElementById(idCanvas).toDataURL('image/png');
        // document.forms[idForm].submit();
    }
};