function buscarAjax() {
  var formdata = new FormData();
  formdata.append('btn_search', true);
  formdata.append('txt_post', document.getElementById('txt_post').value);

  axios.post('index.php', formdata)
    .then(function (response) { //En caso de carga exitosa del recurso
      console.log(response.data);
      recargarElemento("index.php", "main_panel", formdata);
    })
    .catch(function (error) { //En caso de carga fallida del recurso

    });
}



function recargarElemento(page, element, formdata) {
  axios.post(page, formdata)
    .then(function (response) { //En caso de carga exitosa del recurso   
      var temphtml = document.createElement('div');
      temphtml.innerHTML = response.data;
      document.getElementById(element).innerHTML = temphtml.querySelector("#" + element).innerHTML;
    })
    .catch(function (error) { //En caso de carga fallida del recurso

    });
}

function elim(id) {
  console.log(document.getElementById("content_post_"+id).children[0].innerHTML);
  var formdata = new FormData();
  formdata.append('btn_delete', true);
  formdata.append('id_post', id);
  formdata.append('img_post',document.getElementById("content_post_"+id).children[0].innerHTML+" ");
  axios.post('index.php', formdata)
    .then(function (response) { //En caso de carga exitosa del recurso
      console.log(response.data);
      recargarElemento("index.php", "main_panel", null);
    })
    .catch(function (error) { //En caso de carga fallida del recurso

    });
}

function publicarAjax(id = '') {

  if (document.getElementById('txt_post').value != "") {
    var formdata = new FormData();
    formdata.append('id_res', "");
    if(id!=''){
      formdata.append('id_res', id);
    }
    formdata.append('btn_save', true);
    formdata.append('txt_post', document.getElementById('txt_post').value);

    var imagefile = document.querySelector('#txt_file');

    if (imagefile.files[0]) {
      formdata.append("txt_file", imagefile.files[0]);
    }

    axios.post('index.php', formdata)
      .then(function (response) { //En caso de carga exitosa del recurso
        console.log(response.data);
        recargarElemento("index.php", "main_panel", null);
        document.getElementById('txt_file').value = "";
      })
      .catch(function (error) { //En caso de carga fallida del recurso

      });
  }
}


function editarAjax(id) {

  var formdata = new FormData();
  formdata.append('btn_edit', true);
  formdata.append('id_post', id);
  formdata.append('txt_post', document.getElementById('txt_post').value);

  var imagefile = document.querySelector('#txt_file');

  if (imagefile.files[0]) {
    formdata.append("txt_file", imagefile.files[0]);
  }

  axios.post('index.php', formdata)
    .then(function (response) { //En caso de carga exitosa del recurso
      recargarElemento("index.php", "main_panel", null);
      document.getElementById('txt_file').value = "";
    })
    .catch(function (error) { //En caso de carga fallida del recurso

    });
}