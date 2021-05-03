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

<body>
	<div id='page'>
		<header>
		</header>

		<section id='main'>
			<section id='device'>
				<div id='screen'>
					
					<div id='main_screen'>
					<button id="btn_buscar" width="20" height="15" class="icon"><i class="fa fa-cog"></i></button>
						<div id='topbar'><span id='lbl_time_top'>HOLAA</span></div>
						<div id='panel'>
							<div id='panel_icons'>

								<div id='pixel_art_app' class='icons' >
									<div class='label_icon'>PixelArt</div>
								</div>

								<div id='bd_productos_app' class='icons' >
									<div class='label_icon'>Productos</div>
								</div>

								<div id='twitter_app' class='icons' >
									<div class='label_icon'>Twitter</div>
								</div>
								<div id='0' class='iconsFondo'></div>
								<div id='1' class='iconsFondo'></div>
								<div id='2' class='iconsFondo'></div>
								<div id='3' class='iconsFondo'></div>
								<div id='4' class='iconsFondo'></div>
								<div id='5' class='iconsFondo'></div>
							</div>
						</div>
						<div id='main_app'><object id="window_app" data="" width="100%" height="100%"></object></div>
						<div id='main_menu'></div>
					</div>
				</div>
				
			</section>
		</section>

		<footer>
		</footer>
	</div>
</body>

</html>