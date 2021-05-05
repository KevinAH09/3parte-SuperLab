<?php

require_once("global.php"); //ARCHIVO BÁSICO GLOBAL DE CONFIGURACIÓN
require_once(__LIB_PATH . "html.php");

$html = new HTML(); //Invocamos al html helper

//  if (isset($_POST['page'])) {
// 	$page = $_POST['page'];
// 	echo $page;
// }
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
		<script data-require="jquery@*" data-semver="2.2.0" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script data-require="bootstrap@*" data-semver="3.3.6" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link data-require="bootstrap-css@3.3.6" data-semver="3.3.6" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" />
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" />
		<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.js"></script>

		<?php
		echo $html->html_js_header(__JS_PATH . "funcionesTwiter.js");
		echo $html->html_css_header(__CSS_PATH . "style.css", "screen");
		echo $html->html_js_header(__JS_PATH . "funcionesPantalla.js");
		echo $html->html_js_header(__JS_PATH . "funcionesProducto.js");
		echo $html->html_css_header(__CSS_PATH . "stylepixel.css", "screen");
		echo $html->html_css_header(__CSS_PATH . "styleTwitter.css", "screen");
		echo $html->html_css_header(__CSS_PATH . "styleProducto.css", "screen");
		echo $html->html_js_header(__JS_PATH . "funcionespixel.js");
		?>

		<title>My Twitter</title>

	</head>

<body>
	<?php require_once(__VWS_PATH . "pantalla.php"); ?>
	<?php require_once(__VWS_PATH . "twitter.php"); ?>
	<?php require_once(__VWS_PATH . "pixelArt.php"); ?>
	<?php require_once(__VWS_PATH . "productos.php"); ?>
	
</body>

</html>