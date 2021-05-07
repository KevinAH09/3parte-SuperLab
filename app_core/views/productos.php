<?php


require_once(__LIB_PATH . "html.php");
require_once(__CTR_PATH . "ctr_producto.php");
$html = new HTML();
$producto = new CTR_producto(); 

$message = ""; 

if (isset($_POST['btn_guardar'])) {
    $codigo = $_POST['txt_cod'];
    $nombre = $_POST['txt_nom'];
    $precio = $_POST['txt_prec'];
    $cantidad = $_POST['txt_cant'];
    $vencimiento = $_POST['txt_venc'];
    $proveedor = $_POST['txt_prov'];

    $message = $producto->btn_save_click();
}

if (isset($_POST['btn_eliminar'])) {
    $codigo = $_POST['txt_cod'];

    $message = $producto->btn_delete_click($codigo);
}

if (isset($_GET['datobusqueda'])) {
    $producto->buscarProductoss($_GET['datobusqueda']);
}

if (isset($_GET['id'])) {

    echo "<label id='selectProducto'>";
    $producto->obtenerProductoUnicoo($_GET['id']);
    echo "</label>";
}
if (isset($_GET['chart'])) {

    echo "<label id='chartProducto'>";
    $producto->datos();
    echo "</label>";
}

?>
<div class="modal fade" id="myModalProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-center" id="mdialTamanio" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Producto</h4>
            </div>
            <div class="modal-body">
                <div id="panel_app">
                    <?php echo $message; ?>

                    <section id="panel_form">
                        <form method="post" id="frm_productos" name="frm_productos" action="formulario.php">
                            <label>Codigo:</label>
                            <input type="text" class="campo_texto" maxlength="8" value="" tabindex="1" id="txt_cod" name="txt_cod" required="required">
                            <label>Nombre:</label>
                            <input type="text" class="campo_texto" maxlength="64" value="" tabindex="2" id="txt_nom" name="txt_nom" required="required">
                            <label>Precio:</label>
                            <input type="number" class="campo_texto" maxlength="11" value="" tabindex="3" id="txt_prec" name="txt_prec" onkeypress="validarNum(event)" required="required">
                            <label>Cantidad:</label>
                            <input type="number" class="campo_texto" maxlength="11" value="" tabindex="4" id="txt_cant" name="txt_cant" onkeypress="validarNum(event)" required="required">
                            <label>Fecha de Vencimiento:</label>
                            <input type="date" class="campo_texto" maxlength="10" value="" tabindex="5" id="txt_venc" name="txt_venc" required="required">
                            <label>Proveedor:</label>
                            <input type="text" class="campo_texto" maxlength="64" value="" tabindex="6" id="txt_prov" name="txt_prov" required="required">
                            <br>
                            <button type="button" name="btn_guardar" id="btn_guardar" tabindex="5" onclick="insertarAjax()">Guardar</button>

                            <button type="button" name="deleteAJAX" id="deleteAJAX" tabindex="6" onclick="eliminarAjax()">Eliminar</button>
                        </form>
                    </section>

                    <section id="panel_data">
                        <form method="post" id="frm_busqueda" name="frm_busqueda">
                            <input type="text" value="" placeholder="Buscar por Nombre o Código del Producto" size="50" name="txt_busq" id="txt_busq" class="search" tabindex="7" onkeyup="cargarProductos(this.value)">
                        </form>
                        <br><br>
                        <div id="resultados">
                            <table>
                                <thead>
                                    <td>CÓDIGO</td>
                                    <td>NOMBRE</td>
                                    <td>PRECIO</td>
                                    <td>CANTIDAD</td>
                                    <td>VENCIMIENTO</td>
                                    <td>PROVEEDOR</td>
                                </thead>
                                <tbody id="grid">
                                    <?php
                                    if (isset($_GET['datobusqueda'])) {
                                        $producto->buscarProductoss($_GET['datobusqueda']);
                                    } else {
                                        echo $producto->obtener_productoss();
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </section>
                    <div id="grafico">
                        <canvas id="myChartLineal" width="400" height="250" ></canvas>
                        <br>
                        <canvas id="myChart" width="400" height="250"></canvas>
                        <br>
                        <canvas id="myChartCircular" width="400" height="250"></canvas>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<br>
<script type="text/javascript">
    $('#bd_productos_app').on('click', function() {
        $('#myModalProducto').modal();
        $('#myModalProducto').draggable({
            containment: '#main_screen',
            cursor: "crosshair",
            handle: ".modal-header"

        });
        $('#myModalProducto').css({
            'height': '450px',
            'width': '450px',
            'overflow': 'hidden',
            'position': 'absolute',
            'left': '31%',
            'top': '110px'
        });

    });
</script>