window.addEventListener('load', miFuncionLoad, false);

function miFuncionLoad() {
    setInterval("reloj()", 1000);
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