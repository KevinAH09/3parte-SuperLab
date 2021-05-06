
window.addEventListener('load', MyChart, false);


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
      var cantidad = [];
      var proveedor = [];
      for (var i = 0; i < myData.length; i++) {
        nombre.push(myData[i].nom);
        precio.push(myData[i].prec);
        cantidad.push(myData[i].cant);
        proveedor.push(myData[i].prov);
      }

      var ProvCant = [];
      var ProvP = [];
      var dato1;
      var dato2 = 0;
      var aux = proveedor.length;
      for (var k = 0; k <= proveedor.length; k++) {
        dato2 = 0;
        dato1 = [];
        dato1 = proveedor.shift();
        for (var j = 0; j < proveedor.length; j++) {

          if (dato1 == proveedor[j]) {
            proveedor.splice(j, 1);
            j = j - 1;
            dato2++;
          }
        }
        k = 0;
        dato2++;
        ProvCant.push(dato2);
        ProvP.push(dato1);
      }
      var procentajes = [];
      for (var h = 0; h <= ProvCant.length; h++) {
        procentajes.push((ProvCant.shift() * 100) / aux);
        h = 0;
      }
      var ctx = document.getElementById('myChart');
      var ctxLineal = document.getElementById('myChartLineal');
      var ctxCircular = document.getElementById('myChartCircular');

      new Chart(ctxCircular, {
        type: 'pie',
        data: {
          labels: ProvP,
          datasets: [{

            data: procentajes,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
            ],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
        },
        options: {
          plugins: {
            datalabels:
            {
              color:'#fff'
            },
            title: {
              display: true,
              text: 'Gráfico #3, Todos los proveedores y el porcentaje de los productos que se aportan al inventario',
            }
          }
        }
        // formatter: (procentajes) => {
        //   console.log(procentajes);
        //   return procentajes.value + '%';
        // }
      });

      new Chart(ctxLineal, {
        type: 'line',
        data: {
          labels: nombre,
          datasets: [{
            label: 'Gráfico #1, Todos los productos con sus cantidades',
            data: cantidad,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
          }]
        },
        options: {
          plugins: {
            legend: false,
            title: {
              display: true,
              text: 'Gráfico #1, Todos los productos con sus cantidades',
            }
          },
          scales: {
            y: {
              display: true,
              title: {
                display: true,
                text: 'Cantidades',
                color: '#911',
                font: {
                  family: 'Times',
                  size: 20,
                  style: 'normal',
                  lineHeight: 1.2
                }
              },
              beginAtZero: true
            }
          }
        },
      });

      new Chart(ctx, {
        type: 'bar',
        data: {

          labels: nombre,
          datasets: [{
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
          legend: false,
          plugins: {
            legend: false,
            title: {
              display: true,
              text: 'Gráfico #2, Todos los productos con sus precios',
            }
          },
          scales: {
            y: {
              display: true,
              title: {
                display: true,
                text: 'Precios',
                color: '#911',
                font: {
                  family: 'Times',
                  size: 20,
                  style: 'normal',
                  lineHeight: 1.2
                }
              },
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



