<?php

require_once(__MDL_PATH . "mdl_producto.php");  //requerimos del modelo 
require_once(__LIB_PATH . "message.php");

class CTR_producto
{

      private $postdata;
      var $mssg;

      public function __construct() //CONSTRUCTOR
      {
            $this->postdata = new MDL_producto();
            $this->mssg = new Message();
      }

      public function obtener_productoss()
      {
            return $this->postdata->obtenerProductos();
      }

      public function datos()
      {
            return $this->postdata->datoss();
      }

      //    function obtener_tweets_filtro()
      //    {
      //     $postinfo=array();
      //     $postinfo[0]=strip_tags(trim(str_replace("'", "\"", $_POST['txt_post']))); 

      //     return $this->postdata->buscar_tweets($postinfo);
      //    }    

      //    	//Si se presiona el botón Publicar 
      function btn_save_click()
      {
            // $postinfo=array();
            // //Removemos espacios y etiquetas html, además sustituimos comillas simples 
            // //por dobles para prevenir SQL INJECTION
            // $postinfo[0]=strip_tags(trim(str_replace("'", "\"", $_POST['txt_post']))) . str_replace("'", "\"", $this->uploadFile()); 
            
            $this->postdata->insertarProductos($_POST['txt_cod'], $_POST['txt_nom'],$_POST['txt_prec'], $_POST['txt_cant'], $_POST['txt_venc'], $_POST['txt_prov']);
            
            $this->mssg->show_message("", "success", "success_insert");
      }

      function btn_delete_click($codigo)
      {
            $this->postdata->eliminarProductos($codigo);
            $this->mssg->show_message("", "success", "success_delete");
      }
      //Si se presiona el botón Publicar 
      function buscarProductoss($codigo)
      {
            $this->postdata->buscarProductos($codigo);
            $this->mssg->show_message("", "success", "success_delete");
      }
      function obtenerProductoUnicoo($codigo)
      {
            // $postinfo=array();
            // //Removemos espacios y etiquetas html, además sustituimos comillas simples 
            // //por dobles para prevenir SQL INJECTION
            // $postinfo[0]=strip_tags(trim(str_replace("'", "\"", $_POST['txt_post']))) . str_replace("'", "\"", $this->uploadFile()); 

            $this->postdata->obtenerProductoUnico($codigo);
            // $this->mssg->show_message("", "success", "success_insert");
      }
      //Si se presiona el botón Publicar 
      //  function btn_edit_click() 
      //  {  
      //     $postinfo=array();
      //     $postinfo[0]=$_POST['id_post']; 
      //     $postinfo[1]=strip_tags(trim(str_replace("'", "\"", $_POST['txt_post']))) . str_replace("'", "\"", $this->uploadFile()); 
      //     $this->postdata->editar_post($postinfo);
      //     $this->mssg->show_message("","success","success_uodate");

      // }

      //   function cargar_view() 
      //   {    
      //       //Incluimos literalmente la vista correspondiente
      //         require_once(__VWS_PATH . "twitter.php");
      //   }

      //   function uploadFile() 
      //   {    
      //       $img =""; 

      //       if(isset($_FILES['txt_file'])){
      //         $target_dir = __RSC_FILES_PATH;
      //         $target_file = $target_dir . basename($_FILES["txt_file"]["name"]);
      //         move_uploaded_file($_FILES["txt_file"]["tmp_name"], $target_file);

      //         $img = "<br> <img src='$target_file' alt='' title='' width='300'/>";
      //       }

      //       return $img;
      //   }

}
