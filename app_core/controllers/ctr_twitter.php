<?php
require_once(__MDL_PATH . "mdl_twitter.php");
require_once(__LIB_PATH . "message.php");

class CTR_twitter{
    private $postdata;
    var $mssg;

    public function __construct(){
        $this->postdata = new MDL_twitter() ;
        $this->mssg = new Message();

    }

    public function obtener_tweets(){
        return $this->postdata->get_tweets();
    }
    public function obtener_tweets_AXIOS(){
        echo $this->postdata->get_tweets();
    }
    public function eliminar_tweets_AXIOS($dato){
        echo $this->postdata->eliminarPostAJAX($dato);
    }
    function btn_save_click(){
        $postinfo = array();

        $postinfo[0] = strip_tags(trim(str_replace("'","\"",$_POST['txt_post'])));
        $this->postdata->insertar_post($postinfo);
        $this->mssg->show_message("","success","success_insert");
    }

    function cargar_view(){
        require_once(__VWS_PATH . "twitter.php");
    }

}
?>