<?php

require_once("global.php"); //ARCHIVO BÁSICO GLOBAL DE CONFIGURACIÓN
require_once(__LIB_PATH . "html.php");
require_once(__CTR_PATH . "ctr_twitter.php");

$html = new HTML(); //Invocamos al html helper
$twitter = new CTR_twitter(); //Invocamos al controlador
$page = "<button id='holaa' onclick='hola()'>hola</button>";
if (isset($_GET['cargarDatos'])) {
	$twitter->btn_save_click($_GET['cargarDatos']);
}
if (isset($_GET['eliminarPost'])) {
	$twitter->eliminar_tweets_AXIOS($_GET['eliminarPost']);
}
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

		<?php
		echo $html->html_js_header(__JS_PATH . "funciones.js");
		echo $html->html_css_header(__CSS_PATH . "style.css", "screen");
		?>

		<title>My Twitter</title>

	</head>

<body>
	<?php require_once(__VWS_PATH . "pantalla.php"); ?>
	<?php require_once(__VWS_PATH . "twitter.php"); ?>

	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$('#pixel_art_app').on('click', function() {
            $('#myModal').modal();

        });
        $('#myModal').draggable({
            containment: '#main_screen'

        });
        $('#myModal').css({
            'height': '350px',
            'width': '450px',
			'overflow': 'hidden'
        });
		// $('#myModal').on('show.bs.modal', function() {
        //     $(this).find('.modal-body').css({
        //         // 'min-height': '300px',
        //         // 'min-width': '200px',
		// 		// 'overflow': 'scroll'
        //         // 'overflow-y': 'auto'
        //     });
        // });
	</script>
</body>

</html>