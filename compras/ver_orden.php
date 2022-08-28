<?php
include_once '../funciones/sesiones.php';
include_once '../templates/header2.php';
include_once '../funciones/funciones.php';

include_once '../templates/barra.php';

include_once '../templates/navegacion.php';

$id_orden = $_GET["id"];


$stmt = $conn->prepare("SELECT * FROM orden WHERE id_orden_compra=?");
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
                                    <label for="proveedor">Area</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["area"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="proveedor">Fecha</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["fecha"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="proveedor">Nombre del Proveedor</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["nombre_proveedor"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="cheque">Cheque a Favor</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["cheque_a_favor"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="contado">Contado</label>
                                    <input type="text" class="form-control"value="<?php echo $orden["contado"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="credito">Credito</label>
                                    <input type="text" class="form-control"value="<?php echo $orden["credito"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="datos_pago">Datos del Pago</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["datos_pago"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="banco">Banco</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["banco"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="cuenta_abono">Cuenta de Abono</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["cuenta_abono"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="sucursal">Sucursal</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["sucursal"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="clabe">Clabe</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["clabe"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="referencia">Referencia Bancaria</label>
                                    <input type="text" class="form-control"  value="<?php echo $orden["ref_bancaria"]; ?>" disabled>
                                </div>
                                

                                <?php 
                                $productos = json_decode($orden["productos"],true);

                                ?>

                                <div class="form-group my-4" style="display:inline-block;">
                                    <div class="my-4">
                                        <div class="col-lg-10 mx-auto">
                                            <div class="card shadow" style="display:block">
                                                <div class="card-header">
                                                    <h4>Productos</h4>
                                                </div>
                                                <div class="card-body p-4">
                                                        <div id="show_item">
                                                            <?php foreach($productos as $producto){  ?>
                                                            <div class="row" style="margin:10px 0;">
                                                                <div class="col-md-2 mb-3">
                                                                    <input type="text" disabled  class="form-control" value="<?php echo $producto[0]?>" name="cantidad[]" >
                                                                </div>

                                                                <div class="col-md-3 mb-3">
                                                                    <input type="text" disabled  class="form-control" value="<?php echo $producto[1]?>" name="unidad[]" >
                                                                </div>

                                                                <div class="col-md-3 mb-3">
                                                                    <textarea style="width:100%; height:80%; max-width: 200%;max-height:80%;" type="text" class="form-control" disabled><?php echo $producto[2]?></textarea>
                                                                </div>

                                                                <div class="col-md-2 mb-3">
                                                                    <input type="text" disabled  class="form-control" name="concepto[]" value="<?php echo $producto[3]?>">
                                                                </div>
                                                                

                                                            </div>
                                                            <?php }?>
                                                        </div>                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                 

                                <div class="form-group">
                                    <label for="">Subtotal</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["subtotal"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">IVA</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["iva"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Total</label>
                                    <input type="text" class="form-control" value="<?php echo $orden["total"]; ?>" disabled>
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


</body>

</html>



