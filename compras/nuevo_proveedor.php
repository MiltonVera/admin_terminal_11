<?php
include_once '../funciones/sesiones.php';
include_once '../templates/header2.php';
include_once '../funciones/funciones.php';

include_once '../templates/barra.php';

include_once '../templates/navegacion.php';
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Nuevo Proveedor
            <small>Rellena el formulario para añadir un proveedor</small>
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
                        <form role="form" name="guardar-proveedor" id="guardar-proveedor" method="post" action="modelo-proveedor.php">
                            <div class="box-body">

                                <!-- Esto se debe remover despues del ingreso de datos historicos -->
                                <div class="form-group">
                                    <label for="nombre_fiscal">Nombre Fiscal</label>
                                    <input type="text" class="form-control" id="nombre_fiscal" name="nombre_fiscal">
                                </div>

                                <div class="form-group">
                                    <label for="rfc">RFC</label>
                                    <input type="text" class="form-control" id="rfc" name="rfc">
                                </div>

                                <div class="form-group">
                                    <label for="direccion">Direccion del proveedor</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" >
                                </div>

                                <div class="form-group">
                                    <label for="cuenta">Numero de cuenta</label>
                                    <input type="text" class="form-control" id="cuenta" name="cuenta" >
                                </div>

                                <div class="form-group">
                                    <label for="clabe">Clabe</label>
                                    <input type="text" class="form-control" id="clabe" name="clabe">
                                </div>

                                <div class="form-group">
                                    <label for="clabe">Banco</label>
                                    <input type="text" class="form-control" id="clabe" name="banco">
                                </div>

                                <div class="form-group">
                                    <label for="nombre_comercial">Nombre Comercial</label>
                                    <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial">
                                </div>

                                
                                <div class="box-footer " >
                                    <input type="hidden" name="registro" value="nuevo">
                                    <input type="submit" class="btn btn-primary" id="crear_registro" style="width:100%; margin-top:3rem;" value="Enviar"></input>
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
        $('#guardar-proveedor').on('submit', function(e) {
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
                        'Se ha registrado el proveedor',
                        'success'
                    )
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