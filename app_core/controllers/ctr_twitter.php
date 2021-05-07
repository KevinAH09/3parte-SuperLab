<?php

require_once(__MDL_PATH . "mdl_twitter.php");  //requerimos del modelo 
require_once(__LIB_PATH . "message.php");

class CTR_twitter
{

  private $postdata;
  var $mssg;

  public function __construct() //CONSTRUCTOR
  {
    $this->postdata = new MDL_twitter();
    $this->mssg = new Message();
  }

  public function obtener_tweets()
  {
    return $this->postdata->get_tweets();
  }
  function obtener_tweets_respuestas($id)
  {
    return $this->postdata->get_tweets_respuestas($id);
  }
  function obtener_tweets_filtro()
  {
    $postinfo = array();
    $postinfo[0] = strip_tags(trim(str_replace("'", "\"", $_POST['txt_post'])));

    return $this->postdata->buscar_tweets($postinfo);
  }

  //Si se presiona el botón Publicar 
  function btn_save_click()
  {
    $postinfo = array();
    //Removemos espacios y etiquetas html, además sustituimos comillas simples 
    //por dobles para prevenir SQL INJECTION
    $postinfo[0] = strip_tags(trim(str_replace("'", "\"", $_POST['txt_post']))) . str_replace("'", "\"", $this->uploadFile());

    $this->postdata->insertar_post($postinfo, $_POST['id_res']);
    $this->mssg->show_message("", "success", "success_insert");
  }


  function btn_delete_click($id, $nombreimagen)
  {
    $postres = $this->postdata->get_tweets_respuestas($id);
    if ($postres != null) {
      foreach ($postres as $respuesta) {
        $this->btn_delete_click($respuesta[0], $respuesta[1]);
      }
    }
    if ($nombreimagen != "") {
      if ($this->rstrpos($nombreimagen) != "false") {
        unlink($this->rstrpos($nombreimagen));
      }
     

    }
    $this->postdata->eliminar_post($id);
  }
  function rstrpos($nombreimagen)
  {
    $pos = strripos($nombreimagen, 'img src="');
    if ($pos === false) {
      return "false";
    } else {
      return substr($nombreimagen, $pos + 9, -31);
    }
  }

  //Si se presiona el botón Publicar 
  function btn_edit_click()
  {
    $postinfo = array();
    $postinfo[0] = $_POST['id_post'];
    $postinfo[1] = strip_tags(trim(str_replace("'", "\"", $_POST['txt_post']))) . str_replace("'", "\"", $this->uploadFile());
    $this->postdata->editar_post($postinfo);
    $this->mssg->show_message("", "success", "success_uodate");
  }

  function cargar_view()
  {
    //Incluimos literalmente la vista correspondiente
    require_once(__VWS_PATH . "twitter.php");
  }

  function uploadFile()
  {
    $img = "";

    if (isset($_FILES['txt_file'])) {
      $target_dir = __RSC_FILES_PATH;
      $target_file = $target_dir . basename($_FILES["txt_file"]["name"]);
      move_uploaded_file($_FILES["txt_file"]["tmp_name"], $target_file);

      $img = "<br> <img src='$target_file' alt='' title='' width='40%'/>";
    }

    return $img;
  }
}
