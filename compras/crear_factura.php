<?php
include_once '../funciones/sesiones.php';
include_once '../templates/header2.php';
include_once '../funciones/funciones.php';

include_once '../templates/barra.php';

include_once '../templates/navegacion.php';

$id_compra = $_GET["id"];
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Facturacion
            <small>Rellena el formulario con la información de facturación</small>
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
                        <form role="form" name="guardar-factura" id="guardar-factura" method="post" action="modelo-factura.php">
                            <div class="box-body">

                                

                                <div class="form-group">
                                    <label for="numero">Numero de factura</label>
                                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Numero de Factura">
                                </div>

                                <div class="form-group">
                                    <label for="fecha_pago">Fecha de Pago</label>
                                    <input type="text" class="form-control" id="fecha_pago" name="fecha_pago" placeholder="dia/mes/año">
                                </div>

                                <div class="form-group">
                                    <label for="monto">Monto antes de IVA</label>
                                    <input type="text" class="form-control" id="monto" name="monto" placeholder="Costo antes de IVA">
                                </div>


                                <div class="box-footer " >
                                    <input type="hidden" name="id_compra" value="<?php echo $id_compra; ?>">
                                    <button type="submit" class="btn btn-primary" id="crear_registro" style="width:100%; margin-top:3rem;">Añadir</button>
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