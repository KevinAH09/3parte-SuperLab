<?php

require_once(__MDL_PATH . "mdl_producto.php");
require_once(__LIB_PATH . "message.php");

class CTR_producto
{

      private $postdata;
      var $mssg;

      public function __construct()
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
      function btn_save_click()
      {
          
            $this->postdata->insertarProductos($_POST['txt_cod'], $_POST['txt_nom'],$_POST['txt_prec'], $_POST['txt_cant'], $_POST['txt_venc'], $_POST['txt_prov']);
            
            $this->mssg->show_message("", "success", "success_insert");
      }

      function btn_delete_click($codigo)
      {
            $this->postdata->eliminarProductos($codigo);
            $this->mssg->show_message("", "success", "success_delete");
      }
      function buscarProductoss($codigo)
      {
            $this->postdata->buscarProductos($codigo);
            $this->mssg->show_message("", "success", "success_delete");
      }
      function obtenerProductoUnicoo($codigo)
      {
            
            $this->postdata->obtenerProductoUnico($codigo);
      }
      
}
