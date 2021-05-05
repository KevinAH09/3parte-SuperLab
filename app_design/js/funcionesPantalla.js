window.addEventListener('load', miFuncionLoad, false);

function miFuncionLoad() {
    setInterval("reloj()", 1000);
    var unlock = document.getElementById('main_screen');

    unlock.style.background = "url(\"app_core/resources/icons/asus.jpg \") no-repeat center center";
    unlock.style.backgroundSize = " 100% 100%";

}

function reloj() {
    var semana = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
    var fecha = new Date;
    var dia = fecha.getDay();
    var horas = fecha.getHours();
    var minutos = fecha.getMinutes();
    var segundos = fecha.getSeconds();

    // document.getElementById('lbl_time').innerHTML = semana[dia] + " " + horas + ':' + minutos;
    document.getElementById('lbl_time_top').innerHTML = innerHTML = semana[dia] + " " + horas + ':' + minutos + ':' + segundos;
}