<?php

//requerimos de la conexion a la BD
require_once(__CON_PATH . "conexionProducto.php");

class MDL_producto
{

	private $conexion;

	public function __construct()
	{
		$this->conexion = new ConexionProducto();
	}

	function datoss()
	{
		$this->conexion->consulta("SELECT * FROM tbl_productos");
		$datos = null;
		$array = array();

		while ($fila = $this->conexion->extraer_registro()) {

			$datos = array('cod' => $fila[1], 'nom' => $fila[2], 'prec' => $fila[3], 'cant' => $fila[4], 'venc' => $fila[5], 'prov' => $fila[6]);
			$array[]=$datos;
		}
		// echo "gogggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg" .$datos[1];
		//Formateamos a JSON el resultado del array de datos para que sea recibido en el JS (response)
		echo json_encode($array);
	}

	function obtenerProductos()
	{
		//Ejecutamos consulta SQL
		//Seleccionamos todos los datos de todos los productos de la BD
		$this->conexion->consulta("SELECT * FROM tbl_productos ORDER BY id DESC");
		$datos = "";

		//Por cada registro que obtenga la consulta se distribuye en la variable $fila
		while ($fila = $this->conexion->extraer_registro()) {
			//Se concatena los resultados en forma de filas html con cada dato en cada celda de la tabla
			$datos .= "<tr onclick='cargarDatosEnFormulario($fila[0])'><td>$fila[1]</td><td>$fila[2]</td><td>$fila[3]</td><td>$fila[4]</td><td>$fila[5]</td><td>$fila[6]</td></tr>";
		}

		//Se retorna la cadena completa
		return $datos;
	}

	function buscarProductos($dato)
	{
		$this->conexion->consulta("SELECT * FROM tbl_productos 
							  WHERE codigo LIKE '$dato%' 
							  OR nombre LIKE '$dato%' ");
		$resultado = "";

		while ($fila = $this->conexion->extraer_registro()) {
			$resultado .= "<tr onclick='cargarDatosEnFormulario($fila[0])'><td>$fila[1]</td>
				       	   <td>$fila[2]</td><td>$fila[3]</td><td>$fila[4]</td><td>$fila[5]</td><td>$fila[6]</td></tr>";
		}

		echo $resultado; //imprimimos los datos
	}

	function insertarProductos($codigo, $nombre, $precio, $cantidad, $vencimiento, $proveedor)
	{
		//INSERTAR - ACTUALIZAR - Comprobamos que el código existe buscándolo primero
		$this->conexion->consulta("SELECT codigo FROM tbl_productos WHERE codigo = '$codigo'");

		if ($this->conexion->extraer_registro()) { //SI EXISTE EL CODIGO LO ACTUALIZA

			$actualizar = "UPDATE tbl_productos SET nombre='$nombre', precio=$precio, cantidad=$cantidad, vencimiento='$vencimiento', proveedor='$proveedor' WHERE codigo = '$codigo'";

			$this->conexion->consulta($actualizar);
			return "[[Registro actualizado exitosamente.]]";
		} else { //SI NO EXISTE EL CODIGO LO INSERTA

			$insertar = "INSERT INTO tbl_productos (codigo,nombre,precio,cantidad,vencimiento,proveedor) 
						VALUES('$codigo','$nombre',$precio,$cantidad,'$vencimiento','$proveedor')";

			$this->conexion->consulta($insertar);
			return "[[Registro insertado exitosamente.]]";
		}
	}


	function eliminarProductos($codigo)
	{

		//Comprobamos que el código existe buscándolo primero
		$this->conexion->consulta("SELECT codigo FROM tbl_productos WHERE codigo = '$codigo' ");

		if ($this->conexion->extraer_registro()) { //SI EXISTE EL CODIGO LO ELIMINA

			$this->conexion->consulta("DELETE FROM tbl_productos WHERE codigo = '$codigo' ");

			return "[[Registro eliminado exitosamente.]]";
		} else {
			return "[[El registro que intenta eliminar no existe.]]";
		}
	}

	function obtenerProductoUnico($dato)
	{
		$this->conexion->consulta("SELECT * FROM tbl_productos WHERE id = '$dato'");
		$datos = null;


		while ($fila = $this->conexion->extraer_registro()) {

			$datos = array('cod' => $fila[1], 'nom' => $fila[2], 'prec' => $fila[3], 'cant' => $fila[4], 'venc' => $fila[5], 'prov' => $fila[6]);
		}
		// echo "gogggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg" .$datos[1];
		//Formateamos a JSON el resultado del array de datos para que sea recibido en el JS (response)
		echo json_encode($datos);
	}

	
}



	// //Si existen paramtros de busqueda GET
	// if (isset($_GET['datobusqueda'])) {
	// 	buscarProductos($conexion, $_GET['datobusqueda']);
	// }

	// //Si existen paramtros de busqueda GET
	// if (isset($_GET['id'])) {
	// 	obtenerProductoUnico($conexion, $_GET['id']);
