<?php
include_once '../funciones/sesiones.php';
include_once '../templates/header2.php';
include_once '../funciones/funciones.php';

include_once '../templates/barra.php';

include_once '../templates/navegacion.php';

$id_orden = $_GET["id"];

$stmt = $conn->prepare("SELECT productos FROM orden WHERE id_orden_compra=?");
$stmt->bind_param("i", $id_orden);
$stmt->execute();
$orden=$stmt->get_result();
$orden = $orden->fetch_assoc();

$stmt->close();
$conn->close();
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Orden de Compra
            <small>Llena la informacion de la Orden de Compra</small>
        </h1>
    </section>

    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    
                    <div class="box-body">
                        <!-- form start -->
                        <form role="form" name="guardar-orden" id="guardar-orden" method="post" action="modelo-orden.php">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="proveedor">Nombre del Proveedor</label>
                                    <input type="text" class="form-control" name="proveedor">
                                </div>

                                <div class="form-group">
                                    <label for="cheque">Cheque a Favor</label>
                                    <input type="text" class="form-control" name="cheque">
                                </div>

                                <div class="form-group">
                                    <label for="contado">Contado</label>
                                    <input type="text" class="form-control" name="contado">
                                </div>

                                <div class="form-group">
                                    <label for="credito">Credito</label>
                                    <input type="text" class="form-control" name="credito">
                                </div>

                                <div class="form-group">
                                    <label for="datos_pago">Datos del Pago</label>
                                    <input type="text" class="form-control" name="datos_pago">
                                </div>

                                <div class="form-group">
                                    <label for="banco">Banco</label>
                                    <input type="text" class="form-control" name="banco">
                                </div>

                                <div class="form-group">
                                    <label for="cuenta_abono">Cuenta de Abono</label>
                                    <input type="text" class="form-control" name="cuenta_abono">
                                </div>

                                <div class="form-group">
                                    <label for="sucursal">Sucursal</label>
                                    <input type="text" class="form-control" name="sucursal">
                                </div>

                                <div class="form-group">
                                    <label for="clabe">Clabe</label>
                                    <input type="text" class="form-control" name="clabe">
                                </div>

                                <div class="form-group">
                                    <label for="referencia">Referencia Bancaria</label>
                                    <input type="text" class="form-control" name="referencia">
                                </div>
                                

                                <?php 
                                $productos = json_decode($orden["productos"],true);

                                ?>

                                <div class="form-group my-4">
                                    <div class="my-4">
                                        <div class="col-lg-10 mx-auto">
                                            <div class="card shadow">
                                                <div class="card-header">
                                                    <h4>Productos</h4>
                                                </div>
                                                <div class="card-body p-4" style="display:block ;">
                                                        <div id="show_item">
                                                            <?php foreach($productos as $producto){  ?>
                                                            <div class="row" style="margin:10px 0;">
                                                                <div class="col-md-2 mb-3">
                                                                    <input type="number"  class="form-control" value="<?php echo $producto[0]?>" name="cantidad[]" readonly>
                                                                </div>

                                                                <div class="col-md-3 mb-3">
                                                                    <input type="text"  class="form-control" value="<?php echo $producto[1]?>" name="unidad[]" readonly>
                                                                </div>

                                                                <div class="col-md-3 mb-3">
                                                                    <input type="text"  class="form-control" value="<?php echo $producto[2]?>" name="concepto[]" readonly>
                                                                </div>

                                                                <div class="col-md-2 mb-3">
                                                                    <input type="number" step="0.01"  class="form-control" name="precio_unitario[]" placeholder="Precio Unitario(MXN)">
                                                                </div>
                                                                
                                                                <div class="col-md-2 mb-3 d-grid">
                                                                    <button class="btn btn-danger remove_item_btn">Remover</button>
                                                                </div>

                                                            </div>
                                                            <?php }?>
                                                        </div>                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer " >
                                    <input type="hidden" name="id" value="<?php echo $id_orden?>">
                                    <input type="hidden" name="registro" value="editar">
                                    <button type="submit" class="btn btn-primary" id="crear_registro" style="width:100%; margin-top:3rem;">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>
            <!-- /.content -->

        </div>
    </div>
</div>
<!-- /.content-wrapper -->



</div>

<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../js/bootstrap.min.js"></script>

<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/demo.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>



<script src="../js/administradores-ajax.js"></script>
<script src="../js/app.js"></script>

<script>
    $(document).on("click",".remove_item_btn",function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        })

        $('#guardar-orden').on('submit', function(e) {
        e.preventDefault();
        let datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                let resultado = data;
                console.log(resultado);
                if (resultado.respuesta == "exito") {
                    Swal.fire(
                        'Correcto',
                        'Se ha registrado la orden de compra',
                        'success'
                    )
                    console.log(resultado.id_insertado)
                    setTimeout(() => {
                        window.location.href = `../compras/descarga_compra.php?id=${resultado.id_insertado}`;
                    }, 2500);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error',
                        text: 'Algo ha Salido mal',
                        footer: ''
                    })
                }

            }
        })
    });
</script>
</body>

</html>



