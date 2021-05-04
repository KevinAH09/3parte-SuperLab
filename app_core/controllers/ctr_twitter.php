<?php
  
   require_once(__MDL_PATH . "mdl_twitter.php");  //requerimos del modelo 
   require_once(__LIB_PATH . "message.php"); 
     
   class CTR_twitter {
   	
   	private $postdata;
   	var $mssg;
      
       public function __construct() //CONSTRUCTOR
	   {
         $this->postdata=new MDL_twitter();
         $this->mssg = new Message();
	   }
	   
	   public function obtener_tweets()
	   {
			return $this->postdata->get_tweets();
	   } 

     function obtener_tweets_filtro()
     {
      $postinfo=array();
      $postinfo[0]=strip_tags(trim(str_replace("'", "\"", $_POST['txt_post']))); 

      return $this->postdata->buscar_tweets($postinfo);
     }    
	    
     	//Si se presiona el botón Publicar 
	   function btn_save_click() 
	   {    
          $postinfo=array();
          //Removemos espacios y etiquetas html, además sustituimos comillas simples 
          //por dobles para prevenir SQL INJECTION
          $postinfo[0]=strip_tags(trim(str_replace("'", "\"", $_POST['txt_post']))) . str_replace("'", "\"", $this->uploadFile()); 

          $this->postdata->insertar_post($postinfo);
          $this->mssg->show_message("","success","success_insert");

    }

    //Si se presiona el botón Publicar 
    function btn_delete_click() 
    {    
          $this->postdata->eliminar_post($_POST['id_post']);
          $this->mssg->show_message("","success","success_delete");
    }

    //Si se presiona el botón Publicar 
     function btn_edit_click() 
     {  
        $postinfo=array();
        $postinfo[0]=$_POST['id_post']; 
        $postinfo[1]=strip_tags(trim(str_replace("'", "\"", $_POST['txt_post']))) . str_replace("'", "\"", $this->uploadFile()); 
        $this->postdata->editar_post($postinfo);
        $this->mssg->show_message("","success","success_uodate");

    }

    function cargar_view() 
    {    
        //Incluimos literalmente la vista correspondiente
          require_once(__VWS_PATH . "twitter.php");
    }

    function uploadFile() 
    {    
        $img =""; 

        if(isset($_FILES['txt_file'])){
          $target_dir = __RSC_FILES_PATH;
          $target_file = $target_dir . basename($_FILES["txt_file"]["name"]);
          move_uploaded_file($_FILES["txt_file"]["tmp_name"], $target_file);

          $img = "<br> <img src='$target_file' alt='' title='' width='300'/>";
        }

        return $img;
    }

  }
?>

