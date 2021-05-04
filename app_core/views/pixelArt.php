<div class="modal fade" id="myModalpixel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-center" role="document">
    <div class="modal-content">
      <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pixel Art</h4>
      </div>
      <div class="modal-body">
        <div id="signature-pad" class="signature-pad">
          <div class="description">Dibujar aqui</div>
          <div class="signature-pad--body">
            <div>
              <canvas id="canvas"></canvas>
              <div>
                <button id="limpiar">Eliminar todo</button>
              </div>
            </div>
            <input type="color" value="#ff0000" id="muestrario">
          </div>
          <input type="file" id="image_uploads" name="image_uploads" accept=".jpg,.jpeg,.png">
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#pixel_art_app').on('click', function() {
    $('#myModalpixel').modal(

    );
    $('#myModalpixel').draggable({
      containment: '#main_screen',
      cursor: "crosshair",
      handle: ".modal-header"

    });
    $('#myModalpixel').css({
      'height': '390px',
      'width': '450px',
      'overflow': 'hidden',
      'position': 'absolute',
      'left': '40%',
      'top': '30%'
    });
  });
</script>