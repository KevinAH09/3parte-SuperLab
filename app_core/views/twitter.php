<?php

require_once(__LIB_PATH . "html.php");
require_once(__CTR_PATH . "ctr_twitter.php");

$html = new HTML();
$twitter = new CTR_twitter(); //variable del Controlador

//Evento click (PUBLICAR) se activa al hacer click en el boton via POST
if (isset($_POST['btn_save'])) {
    $twitter->btn_save_click();
}

if (isset($_POST['btn_delete'])) {
    $twitter->btn_delete_click();
}

if (isset($_POST['btn_edit'])) {
    $twitter->btn_edit_click();
}
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Twitter</h4>
            </div>
            <div class="modal-body">
                <div id="panel_app">
                    <div id="user_box">
                    </div>

                    <!--En el siguiente bloque imprimimos EL FORMULARIO HTML de envio de posts -->

                    <div id="post_box">
                        <form method="post">
                            <br>
                            <?php echo $html->html_textarea(4, 6, "txt_post", "txt_post", "textarea", "", 1, "", "placeholder='Escribe algo!'", "required") ?>
                            <input type="file" name="txt_file" id="txt_file">
                            <?php echo $html->html_input_button("button", "btn_save", "btn_save", "boton", "Publicar", 2, "", "onclick='publicarAjax()'"); ?>
                            <?php echo $html->html_input_button("button", "btn_search", "btn_search", "boton", "Buscar", 2, "", "onclick='buscarAjax()'"); ?>
                            <?php echo $html->html_form_end(); ?>
                    </div>



                    <?php

                    //Almacenará ya sea todos los tweets o los filtrados por la búsqueda
                    //dependiendo de si presionamos el botón buscar
                    $tweets = "";

                    if (isset($_POST['btn_search'])) {
                        $tweets = $twitter->obtener_tweets_filtro();
                    } else {
                        $tweets = $twitter->obtener_tweets();
                    }

                    ?>

                    <div id="main_panel">

                        <?php foreach ($tweets as $t) { ?>

                            <div class='post_block'>
                                <span class='post_text' id='post_<?php echo $t[0]; ?>'>
                                    <div class='published_date'>
                                        <span>Publicado el <?php echo $t[2]; ?></span>
                                    </div>
                                </span>
                                <div id='content_post_<?php echo $t[0]; ?>'>
                                    <div class='post_detail'><?php echo $t[1]; ?></div><br />
                                </div>
                                <button id='btn_delete' type='button' name='btn_delete'  class='boton_crud' onclick='eliminarAjax(<?php echo $t[0] ?>)'><i class="fa fa-times"></i></button>
                                <button id='btn_edit' type='button' name='btn_edit' class='boton_crud' onclick='editarAjax(<?php echo $t[0] ?>)'><i class="fa fa-edit"></i></button>
                                <button id='btn_resp' type='button' name='btn_resp' class='boton_crud' onclick='reponderAjax(<?php echo $t[0] ?>)'><i class="fa fa-reply"></i></button>
                            </div>

                        <?php } ?>

                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#twitter_app').on('click', function() {
        $('#myModal').modal();
        $('#myModal').draggable({
            containment: '#main_screen',
            cursor: "crosshair",
            handle: ".modal-header"

        });
        $('#myModal').css({
            'height': '390px',
            'width': '450px',
            'overflow': 'hidden',
            'position': 'absolute',
            'left': '40%',
            'top': '30%'
        });

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