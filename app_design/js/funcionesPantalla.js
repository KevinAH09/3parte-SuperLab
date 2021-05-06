window.addEventListener('load', miFuncionLoad, false);

function miFuncionLoad() {
    setInterval("reloj()", 1000);
    var unlock = document.getElementById('main_screen');

    unlock.style.background = "url(\"app_core/resources/icons/asus.jpg \") no-repeat center center";
    unlock.style.backgroundSize = " 100% 100%";

    var limpiar = document.getElementById("lbl_time_top");
    limpiar.addEventListener("click", mostrarUocultar, false);
    $("#date").datepicker({

    });
    var iconsa = document.getElementsByClassName('fond');
    for (var i = 0; i < iconsa.length; i++) {
        iconsa[i].addEventListener('click', cambiar, false);
    }
}
function mostrarUocultar() {
    var x = document.getElementById("date");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function reloj() {
    var semana = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
    var fecha = new Date;
    var dia = fecha.getDay();
    var horas = fecha.getHours();
    var minutos = fecha.getMinutes();
    var segundos = fecha.getSeconds();

    document.getElementById('lbl_time_top').innerHTML = innerHTML = semana[dia] + " " + horas + ':' + minutos + ':' + segundos;
}
function cambiar() {
    var unlock = document.getElementById('main_screen');

    unlock.style.background = "url(\"" + this.id + "\") no-repeat center center";
    unlock.style.backgroundSize = " 100% 100%"; 
}