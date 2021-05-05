

window.onload = function () {
  MyChart();
}

function hola() {
  console.log("gh");
}

function cargarProductos(dato) {

  axios.get('index.php', {
    params: {
      datobusqueda: dato
    }
  })
    .then(function (response) { //En caso de carga exitosa del recurso
      // console.log(response.data);
      var temphtml = document.createElement('div');
      temphtml.innerHTML = response.data;
      document.getElementById('resultados').innerHTML = temphtml.querySelector("#" + "resultados").innerHTML;
    })
    .catch(function (error) { //En caso de carga fallida del recurso
      // alertify.error(error.response.data);
      // console.log(error+'erooooooooooooooooorrrooroororororororororororoorororo');
    });
}
function cargarDatos() {

  axios.post('index.php', dato)
    .then(function (response) { //En caso de carga exitosa del recurso
      // document.getElementById("grid").innerHTML = response.data;
      alert(response.data);
    })
    .catch(function (error) { //En caso de carga fallida del recurso
      // alertify.error(error.response.data);
    });
}

function insertarAjax() {

  if (document.getElementById('txt_cod').value != "" &&
    document.getElementById('txt_nom').value != "" &&
    document.getElementById('txt_prec').value != "" &&
    document.getElementById('txt_cant').value != "" &&
    document.getElementById('txt_venc').value != "" &&
    document.getElementById('txt_prov').value != "") {

    var formdata = new FormData();
    formdata.append('btn_guardar', true);
    formdata.append('txt_cod', document.getElementById('txt_cod').value);
    formdata.append('txt_nom', document.getElementById('txt_nom').value);
    formdata.append('txt_prec', document.getElementById('txt_prec').value);
    formdata.append('txt_cant', document.getElementById('txt_cant').value);
    formdata.append('txt_venc', document.getElementById('txt_venc').value);
    formdata.append('txt_prov', document.getElementById('txt_prov').value);
    axios.post('index.php', formdata
    )
      .then(function (response) { //En caso de carga exitosa del recurso
        //alertify.set('notifier', 'position', 'top-right');
        //Tomamos el texto que viene entre corchetes dobles
        //alertify.success(response.data.match(/\[\[(.*?)\]\]/)[1]);
        cargarProductos('');
      })
      .catch(function (error) { //En caso de carga fallida del recurso
        // alertify.error(error.response.data);
      });

  } else {
    // alertify.warning("Todos los campos son requeridos");
  }

}

function eliminarAjax() {

  var formdata = new FormData();
  formdata.append('btn_eliminar', true);
  formdata.append('txt_cod', document.getElementById('txt_cod').value);

  axios.post('index.php', formdata
  )
    .then(function (response) { //En caso de carga exitosa del recurso
      // alertify.set('notifier', 'position', 'top-right');
      //Tomamos el texto que viene entre corchetes dobles
      // alertify.success(response.data.match(/\[\[(.*?)\]\]/)[1]);
      cargarProductos('');
    })
    .catch(function (error) { //En caso de carga fallida del recurso
      // alertify.error(error.response.data);
    });
}

function cargarDatosEnFormulario(codigo) {
  axios.get('index.php', {
    params: {
      id: codigo
    }
  })
    .then(function (response) { //En caso de carga exitosa del recurso
      //Descomponemos el objeto JSON para separarlo en datos individuales
      // console.log(response.data);

      var temphtml = document.createElement('div');
      temphtml.innerHTML = response.data;
      var aux = temphtml.querySelector("#" + "selectProducto");
      console.log(aux.textContent);

      myData = JSON.parse(aux.textContent);
      document.getElementById('txt_cod').value = myData.cod;
      document.getElementById('txt_nom').value = myData.nom;
      document.getElementById('txt_prec').value = myData.prec;
      document.getElementById('txt_cant').value = myData.cant;
      document.getElementById('txt_venc').value = myData.venc;
      document.getElementById('txt_prov').value = myData.prov;
      console.log(myData);

    })
    .catch(function (error) { //En caso de carga fallida del recurso
      // alertify.error(error.response.data);
    });
}

function validarNum(evt) {
  var theEvent = evt || window.event;

  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode(key);

  var regex = /[0-9]|\./;
  if (!regex.test(key)) {
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }
}

function MyChart() {
  var myData = [];
  axios.get('index.php', {
    params: {
      chart: true
    }
  })
    .then(function (response) { //En caso de carga exitosa del recurso
      //Descomponemos el objeto JSON para separarlo en datos individuales
      // console.log(response.data);

      var temphtml = document.createElement('div');
      temphtml.innerHTML = response.data;
      var aux = temphtml.querySelector("#" + "chartProducto");
      // console.log(aux.textContent);

      myData = JSON.parse(aux.textContent);
      var nombre = [];
      var precio = [];
      console.log(myData);
      for (var i = 0; i < myData.length; i++) {
        nombre.push(myData[i].nom);
        precio.push(myData[i].prec);

      }
      
      var ctx = document.getElementById('myChart');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {

          labels: nombre,
          datasets: [{
            label: '# of Votes',
            data: precio,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });

    })
    .catch(function (error) { //En caso de carga fallida del recurso
      // alertify.error(error.response.data);
    });

}



