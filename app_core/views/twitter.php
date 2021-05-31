<?php

require_once(__LIB_PATH . "html.php");
require_once(__CTR_PATH . "ctr_twitter.php");

$html = new HTML();
$twitter = new CTR_twitter();
$htmlpost = "";
if (isset($_POST['btn_save'])) {
    $twitter->btn_save_click();
}

if (isset($_POST['btn_delete'])) {
    $twitter->btn_delete_click($_POST["id_post"], $_POST["img_post"]);
}

if (isset($_POST['btn_edit'])) {
    $twitter->btn_edit_click();
}

function imprimirTweets($tweet, $pos, $html, $band)
{
    $tamano =  550;
    $postHtml = "";
    if ($band == false) {
        $espacio = 25;
        $espacio = $espacio * $pos;
        $tamano = $tamano - $espacio;
        foreach ($tweet as $p) {
            $postHtml .=  "<div class='post_block' style='margin-left: " . $espacio . "px; width:$tamano'>
                                <span class='post_text' id='post_" . $p->post[0] . "'>
                                    <div class='published_date'><span>Publicado el " . $p->post[2] . "</span>
                                    </div>
                                </span>
                                <div id='content_post_" . $p->post[0] . "'><div class='post_detail'>" . $p->post[1] . "</div>
                                <br>
                                </div>
                                <button id='btn_delete' type='button' name='btn_delete'  class='boton_crud' onclick='elim(" . $p->post[0] . ")'><i class='fa fa-times'></i></button>
                                <button id='btn_edit' type='button' name='btn_edit' class='boton_crud' onclick='editarAjax(" . $p->post[0] . ")'><i class='fa fa-edit'></i></button>
                                <button id='btn_resp' type='button' name='btn_resp' class='boton_crud' onclick='publicarAjax(" . $p->post[0] . ")'><i class='fa fa-reply'></i></button>
                            </div> 
                            <div>" . imprimirTweets($p->respuestas, $pos + 1, $html, false) . "</div>";
        }
    }else{
        foreach ($tweet as $t) {
            $postHtml .= " <div class='post_block'>
                            <span class='post_text' id='post_" . $t[0] . "'>
                                <div class='published_date'>
                                    <span>Publicado el " . $t[2] . "</span>
                                </div>
                            </span>
                            <div id='content_post_" . $t[0] . "'>
                                <div class='post_detail'>" . $t[1] . "</div><br/>
                            </div>
                            <button id='btn_delete' type='button' name='btn_delete'  class='boton_crud' onclick='elim(" . $t[0] . ")'><i class='fa fa-times'></i></button>
                            <button id='btn_edit' type='button' name='btn_edit' class='boton_crud' onclick='editarAjax(" . $t[0] . ")'><i class='fa fa-edit'></i></button>
                            <button id='btn_resp' type='button' name='btn_resp' class='boton_crud' onclick='publicarAjax(" . $t[0] . ")'><i class='fa fa-reply'></i></button>
                        </div>";
        }
    }

    return $postHtml;
}
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-center" id="mdialTamanio" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Twitter</h4>
            </div>
            <div class="modal-body">
                <div id="panel_app">
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
                    $tweets = "";
                    $band = "";
                    if (isset($_POST['btn_search']) AND $_POST['txt_post'] != "") {
                        $tweets = $twitter->obtener_tweets_filtro();
                        $band = true;
                    } else {
                        $tweets = $twitter->obtener_tweets();
                        $band = false;
                    }
                    ?>
                    <div id="main_panel">
                        <?php echo imprimirTweets($tweets, 0, $html, $band); ?>
                    </div>
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
            'left': '31%',
            'top': '110px'
        });

    });
</script>