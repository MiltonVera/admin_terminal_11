<?php
include_once '../funciones/sesiones.php';
include_once '../templates/header2.php';
include_once '../funciones/funciones.php';

include_once '../templates/barra.php';

include_once '../templates/navegacion.php';

$id_factura = $_GET["id"];

$stmt = $conn->prepare("SELECT * FROM factura WHERE id_factura=?");
$stmt->bind_param("i", $id_factura);
$stmt->execute();
$factura=$stmt->get_result();
$factura = $factura->fetch_assoc();

$stmt->close();
$conn->close();
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    
                    <div class="box-body">
                        <!-- form start -->
                        <form role="form" name="guardar-factura" id="guardar-factura" method="post" action="modelo-factura.php">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="numero">Fecha de Creacion</label>
                                    <input type="text" class="form-control" value="<?php echo $factura["fecha"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="numero">Numero de factura</label>
                                    <input type="text" class="form-control" value="<?php echo $factura["numero_factura"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="fecha_pago">Fecha de Pago</label>
                                    <input type="text" class="form-control" value="<?php echo $factura["fecha_pago"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="monto">Monto antes de IVA</label>
                                    <input type="number" step=0.02 class="form-control" value="<?php echo $factura["monto_antes_iva"]; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="monto">Monto con IVA</label>
                                    <input type="number" step=0.02 class="form-control" value="<?php echo $factura["monto_despues_iva"]; ?>" disabled>
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
    $(document).ready(function(){
        
        //Llamada a ajax para insertar en la base de datos
        $('#guardar-factura').on('submit', function(e) {
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
                        'Se ha registrado la factura',
                        'success'
                    )
                    setTimeout(() => {
                        window.close();
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

    });
  </script>
</body>

</html>