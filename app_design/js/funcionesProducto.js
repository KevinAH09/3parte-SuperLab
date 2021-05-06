
window.addEventListener('load', MyChart, false);


function cargarProductos(dato) {

  axios.get('index.php', {
    params: {
      datobusqueda: dato
    }
  })
    .then(function (response) { //En caso de carga exitosa del recurso
      var temphtml = document.createElement('div');
      temphtml.innerHTML = response.data;
      document.getElementById('resultados').innerHTML = temphtml.querySelector("#" + "resultados").innerHTML;
    })
    .catch(function (error) { //En caso de carga fallida del recurso
      // alertify.error(error.response.data);
    });
}
function cargarDatos() {

  axios.post('index.php', dato)
    .then(function (response) { 
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
      .then(function (response) {
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
    .then(function (response) { 
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
    .then(function (response) {

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

function generarNumero(numero){
  return (Math.random()*numero).toFixed(0);
}

function colorRGB(){
  var coolor = "("+generarNumero(255)+"," + generarNumero(255) + "," + generarNumero(255) +")";
  return "rgb" + coolor;
}



function MyChart() {
  var myData = [];
  axios.get('index.php', {
    params: {
      chart: true
    }
  })
    .then(function (response) { 

      var temphtml = document.createElement('div');
      temphtml.innerHTML = response.data;
      var aux = temphtml.querySelector("#" + "chartProducto");

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
      var colores=[];
      var coloresBar=[];
      for(var i=0;i<ProvP.length;i++)
      {
        colores.push(colorRGB());
      }
      for(var i=0;i<nombre.length;i++)
      {
        coloresBar.push(colorRGB());
      }
      var procentajes = [];
      for (var h = 0; h <= ProvCant.length; h++) {
        procentajes.push(((ProvCant.shift() * 100) / aux));
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
            backgroundColor: colores,
            fill: false,
            borderColor: 'rgb(0, 0, 0)',
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
              color: 'rgb(39, 97, 2)',
                font: {
                  family: 'Times',
                  size: 15,
                  style: 'normal',
                  lineHeight: 1.2
                }
            }
          },
          radius: 160,
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
            label: 'Cantidad',
            data: cantidad,
            fill: false,
            borderColor: 'rgb(42, 17, 166)',
            borderWidth:3,
            tension: 0.1
          }]
        },
        options: {
          plugins: {
            legend: false,
            title: {
              display: true,
              text: 'Gráfico #1, Todos los productos con su cantidad por unidad',
              color: 'rgb(42, 17, 166)',
                font: {
                  family: 'Times',
                  size: 15,
                  style: 'normal',
                  lineHeight: 1.2
                }
            }
          },
          scales: {
            y: {
              ticks: {
                color: 'black',
              },
              display: true,
              title: {
                display: true,
                text: 'Cantidades',
                color: 'rgb(42, 17, 166)',
                font: {
                  family: 'Times',
                  size: 15,
                  style: 'normal',
                  lineHeight: 1.2
                }
              },
              beginAtZero: true
            },
            x:{
              ticks: {
                color: 'black',
              },
            }
          }
        },
      });

      new Chart(ctx, {
        type: 'bar',
        data: {

          labels: nombre,
          datasets: [{
            label: 'Precio',
            data: precio,
            backgroundColor: coloresBar,
            borderColor: 'black',
            borderWidth: 1
          }]
        },
        options: {
          legend: false,
          plugins: {
            legend: false,
            title: {
              display: true,
              text: 'Gráfico #2, Todos los productos con su precio en colones',
              color: '#911',
                font: {
                  family: 'Times',
                  size: 15,
                  style: 'normal',
                  lineHeight: 1.2
                }
            }
          },
          scales: {
            y: {
              ticks: {
                color: 'black',
              },
              display: true,
              title: {
                display: true,
                text: 'Precios',
                color: '#911',
                font: {
                  family: 'Times',
                  size: 15,
                  style: 'normal',
                  lineHeight: 1.2
                }
              },
              beginAtZero: true
            },
            x:{
              ticks: {
                color: 'black',
              },
            }
          }
        }
      });

    })
    .catch(function (error) { //En caso de carga fallida del recurso
      // alertify.error(error.response.data);
    });

}



