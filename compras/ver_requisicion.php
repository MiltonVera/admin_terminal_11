<?php
include_once '../funciones/sesiones.php';
include_once '../templates/header2.php';
include_once '../funciones/funciones.php';

include_once '../templates/barra.php';

include_once '../templates/navegacion.php';

$id_requisicion = $_GET["id"];

$stmt = $conn->prepare("SELECT fecha,area,nombre_solicitante,lugar_entrega,productos FROM requisicion WHERE id_requisicion=?");
$stmt->bind_param("i", $id_requisicion);
$stmt->execute();
$requisicion=$stmt->get_result();
$requisicion = $requisicion->fetch_assoc();

$stmt->close();
$conn->close();
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Requisicion
            <small>Informacion de la Requisicion</small>
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
                        <form role="form" name="guardar-requisicion" id="guardar-requisicion" method="post" action="modelo-requisicion.php">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="solicitante">Fecha</label>
                                    <input type="text" class="form-control" value="<?php echo $requisicion["fecha"]; ?>"  disabled>
                                </div>

                                <div class="form-group">
                                    <label for="solicitante">Area que Solicita</label>
                                    <input type="text" class="form-control" value="<?php echo $requisicion["area"]; ?>"  disabled>
                                </div>

                                <div class="form-group">
                                    <label for="solicitante">Nombre de Solicitante</label>
                                    <input type="text" class="form-control" value="<?php echo $requisicion["nombre_solicitante"]; ?>"  disabled>
                                </div>

                                <div class="form-group">
                                    <label for="lugar">Lugar de Entrega</label>
                                    <input type="text" class="form-control"  value="<?php echo $requisicion["lugar_entrega"]; ?>" disabled>
                                </div>

                                <?php 
                                $productos = json_decode($requisicion["productos"],true);

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
                                                                <div class="col-md-4 mb-3">
                                                                    <input type="text"  class="form-control" value="<?php echo $producto[0]?>" disabled>
                                                                </div>

                                                                <div class="col-md-3 mb-3">
                                                                    <input type="text"  class="form-control" value="<?php echo $producto[1]?>" disabled>
                                                                </div>

                                                                <div class="col-md-3 mb-3">
                                                                    <textarea style="width:100%; max-width: 200%;max-height:30%;" type="text" class="form-control" disabled><?php echo $producto[2]?></textarea>
                                                                </div>

                                                                

                                                            </div>
                                                            <?php }?>
                                                        </div>                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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



