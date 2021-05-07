<?php

//requerimos de la conexion a la BD
require_once(__CON_PATH . "conexion.php");

class MDL_twitter
{

	private $conexion;

	public function __construct()
	{
		$this->conexion = new Conexion();
	}

	//Función para obtener registros
	public function get_tweets()
	{

		$this->conexion->consulta("SELECT tbl_posts.id, tbl_posts.post,tbl_posts.date,tbl_posts.tbl_posts_id 
									   FROM tbl_posts
									   ORDER BY tbl_posts.id DESC");

		return $this->extraerDatos();
	}
	public function get_tweets_respuestas($id)
	{
		$this->conexion->consulta("SELECT tbl_posts.id, tbl_posts.post,tbl_posts.date,tbl_posts.tbl_posts_id 
									   FROM tbl_posts WHERE tbl_posts.tbl_posts_id = $id
									   ORDER BY tbl_posts.id DESC");

		$posts = array(); //matriz
		$num_fila = 0;

		//obtenemos cada registro y cada campo
		while ($fila = $this->conexion->extraer_registro()) {
			$posts[$num_fila][0] = $fila[0]; //id
			$posts[$num_fila][1] = $fila[1]; //detalle del post
			$posts[$num_fila][2] = $fila[2];
			$posts[$num_fila][3] = $fila[3]; //fecha
			$num_fila++;
		}

		return $posts;
	}

	public function buscar_tweets($datospost = array())
	{

		$this->conexion->consulta("SELECT tbl_posts.id, tbl_posts.post,tbl_posts.date,tbl_posts.tbl_posts_id 
									   FROM tbl_posts WHERE tbl_posts.post LIKE '" . $datospost[0] . "%' ORDER BY tbl_posts.id DESC");
		
		$posts = array(); //matriz
		$num_fila = 0;

		//obtenemos cada registro y cada campo
		while ($fila = $this->conexion->extraer_registro()) {
			$posts[$num_fila][0] = $fila[0]; //id
			$posts[$num_fila][1] = $fila[1]; //detalle del post
			$posts[$num_fila][2] = $fila[2];
			$posts[$num_fila][3] = $fila[3]; //fecha
			$num_fila++;
		}

		return $posts;
	}
	public function extraerDatos()
	{
		$postpadres = array();
		$posts = array();


		$num_fila = 0;

		//obtenemos cada registro y cada campo
		while ($fila = $this->conexion->extraer_registro()) {
			$objeto = new stdClass();
			$objeto->post =  $fila;
			$objeto->respuestas = [];

			$posts[$num_fila] = $objeto;
			$num_fila++;
		}
		foreach ($posts as $valor) {
			if ($valor->post[3] != null) {
				foreach ($posts as $respuesta) {
					if ($respuesta->post[0] == $valor->post[3]) {
						array_push($respuesta->respuestas, $valor);
					}
				}
			}
		}

		foreach ($posts as $valor) {
			if ($valor->post[3] == null) {
				array_push($postpadres, $valor);
			}
		}
		return $postpadres;
	}

	//Función para insertar registros

	public function insertar_post($datospost = array(), $id_res)
	{
		if( $id_res !=''){
			$this->conexion->consulta("INSERT INTO tbl_posts (post, date,tbl_posts_id) 
									   VALUES ('" . $datospost[0] . "','" . date('Y-m-d H:i:s') . "',$id_res)");
		}else{
			$this->conexion->consulta("INSERT INTO tbl_posts (post, date) 
									   VALUES ('" . $datospost[0] . "','" . date('Y-m-d H:i:s') . "')");  
		}
		
	}

	public function eliminar_post($idpost)
	{
		$this->conexion->consulta("DELETE FROM tbl_posts
									   WHERE tbl_posts.id = " . $idpost);
	}

	public function editar_post($datospost = array())
	{
		$this->conexion->consulta("UPDATE tbl_posts SET post = '$datospost[1]', date = '" . date('Y-m-d H:i:s') . "' WHERE id = $datospost[0]");
	}
}
