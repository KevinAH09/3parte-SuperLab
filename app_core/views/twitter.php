<?php

require_once(__LIB_PATH . "html.php");
$html = new HTML();
$twitter = new CTR_twitter();


if (isset($_POST['btn_save'])) {
    $twitter->btn_save_click();
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

                    <div id="post_box">
                        <?php echo $html->html_form_tag("frm_service", "", "", "post"); ?>
                        <br>
                        <?php echo $html->html_textarea(4, 6, "txt_post", "txt_post", "textarea", "", 1, "", "placeholder='Escribe algo!'", "required"); ?>
                        <?php echo $html->html_input_button("submit", "btn_save", "btn_save", "boton", "Publicar", 2, "", ""); ?>
                        <?php echo $html->html_form_end(); ?>
                    </div>
                    <div id="main_panel">
                        <?php
                        $caja_post = "";
                        $contposts = 0;

                        foreach ($twitter->obtener_tweets() as $value) {
                            $caja_post .= "<div class = 'post_block'>
                            <span class = 'post_text' id='post_'" . $value[0] . "'>
                                <div class = 'published_date'>
                                    <span>Publicado el " . $value[2] . "</span>
                                </div>
                            </span>
                            <div id='content_post_" . $contposts . "'>
                                <div class = 'post_detail'> " . $value[1] . "</div>
                            </div>
                        </div>";
                            $contposts++;
                        }
                        echo $caja_post;
                        ?>
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
</div>