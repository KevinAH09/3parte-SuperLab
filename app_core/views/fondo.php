<div class="modal fade" id="myModalfondo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-center" id="mdialTamanio" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Seleccion de fondos de pantalla</h4>
            </div>
            <div class="modal-body">
                <div id='panel_fond'>
                    <div id='panel_fondo'>

                        <div id='app_core/resources/icons/asus.jpg' class='fond' style="background:url('app_core/resources/icons/asus.jpg') no-repeat center center; background-size: 100% 100%;">
                            <div class='label_fond'>Fondo1</div>
                        </div>
                        
                        <div id='app_core/resources/icons/gamer.jpg' class='fond' style="background:url('app_core/resources/icons/gamer.jpg') no-repeat center center; background-size: 100% 100%;">
                            <div class='label_fond'>Fondo2</div>
                        </div>
                       
                        <div id='app_core/resources/icons/leon.jpg' class='fond' style="background:url('app_core/resources/icons/leon.jpg') no-repeat center center; background-size: 100% 100%;">
                            <div class='label_fond'>Fondo3</div>
                        </div>
                        <div id='app_core/resources/icons/planeta.jpg' class='fond' style="background:url('app_core/resources/icons/planeta.jpg') no-repeat center center; background-size: 100% 100%;">
                            <div class='label_fond'>Fondo4</div>
                        </div>
                        <div id='app_core/resources/icons/sonic.jpg' class='fond' style="background:url('app_core/resources/icons/sonic.jpg') no-repeat center center; background-size: 100% 100%;">
                            <div class='label_fond'>Fondo5</div>
                        </div>
                        <div id='app_core/resources/icons/windows.jpg' class='fond' style="background:url('app_core/resources/icons/windows.jpg') no-repeat center center; background-size: 100% 100%;">
                            <div class='label_fond'>Fondo6</div>
                        </div>
                        <!-- <div id='0' class='iconsFondo'></div>
							<div id='1' class='iconsFondo'></div>
							<div id='2' class='iconsFondo'></div>
							<div id='3' class='iconsFondo'></div>
							<div id='4' class='iconsFondo'></div>
							<div id='5' class='iconsFondo'></div> -->
                    </div>              
                </div>
                <!-- <div id="signature-pad" class="signature-pad">
          <div class="description"></div>
          <div class="signature-pad--body">
            <div style="width: 60%; float:left; margin-bottom:10px">
              <label for="color">Mantenga el clic izquierdo presionado y arrastre el mouse</label>
              <canvas id="canvas"></canvas>
            </div>

            <div style="width: 40%; float:right; margin-top: 40px;">
              <label for="color">Cambiar el color del trazado</label>
              <input type="color" value="#ff0000" id="muestrario">
              <br>
              <button style="margin-top: 10px;" id="limpiar">Eliminar todo</button>
            </div>
            <button style="margin-top: 10px;" onclick="GuardarTrazado()" id="btnDescargar">Descargar trazado</button>

          </div>
          <div style="width: 50%;">
            <input style="margin-top: 10px;" type="file" name="file-1" id="file-1" accept='image/jpeg,image/jpg,image/png' class="inputfile inputfile-1" />
            <label for="file-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17">
                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
              </svg>
              <span class="iborrainputfile">Insertar Imagen</span>
            </label>
          </div>
        </div> -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#btn_config').on('click', function() {
        $('#myModalfondo').modal({

        });
        $('#myModalfondo').draggable({
            containment: '#main_screen',
            cursor: "crosshair",
            handle: ".modal-header"

        });
        $('#myModalfondo').css({
            'height': '390px',
            'width': '450px',
            'overflow': 'hidden',
            'position': 'absolute',
            'left': '31%',
            'top': '110px'
        });
    });
</script>