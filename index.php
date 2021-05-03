<?php

require_once("global.php"); //ARCHIVO BÁSICO GLOBAL DE CONFIGURACIÓN
require_once(__LIB_PATH . "html.php");
require_once(__CTR_PATH . "ctr_twitter.php");

$html = new HTML(); //Invocamos al html helper
$twitter = new CTR_twitter(); //Invocamos al controlador
if (isset($_GET['cargarDatos'])) {
	$twitter->btn_save_click($_GET['cargarDatos']);
}
if (isset($_GET['eliminarPost'])) {
	$twitter->eliminar_tweets_AXIOS($_GET['eliminarPost']);
}
?>
<!DOCTYPE html>

<head>
	<title>LAB2</title>

	<head>

		<meta name="title" content="ESCRITORIO " />
		<meta name="description" content="ESCRITORIO example" />
		<meta name="robots" content="index, follow" />
		<meta name="keywords" content="HTML5, PHP, MySQL, jquery" />
		<meta name="language" content="es" />
		<!-- <link rel="shortcut icon" href="favicon.ico" /> -->
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>


		<?php
		echo $html->html_js_header(__JS_PATH . "funciones.js");
		echo $html->html_css_header(__CSS_PATH . "style.css", "screen");
		?>

		<title>My Twitter</title>

	</head>

<body >
	<?php require_once(__VWS_PATH . "pantalla.php"); ?>
</body>

</html>