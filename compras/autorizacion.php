<?php
        include_once '../funciones/sesiones.php';
        include_once '../funciones/funciones.php';
        include_once '../templates/header2.php';
        include_once '../templates/barra.php';
        include_once '../templates/navegacion.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
          <h1>
            Autorizacion de Compras
          </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Autoriza o Rechaza las compras</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <div class="container">
                </div>  
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Area</th>
                  <th>Nombre</th>          
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                        <?php
                            try {
                                $sql = "SELECT * FROM autorizacion";
                                $resultado = $conn->query($sql);
                            } catch (Exception $e) {
                                $error = $e->getMessage();
                                echo $error;
                            }
                            while($autorizacion = $resultado->fetch_assoc() ) { ?>
                                
                                <tr>    
                                    <td><?php echo $autorizacion['area']; ?></td>
                                    <td><?php echo $autorizacion['nombre']; ?></td>                                                                                               
                                    <td>
                                        <a class="btn bg-blue bnt-flat margin" target="_blank" href="ver_requisicion.php?id=<?php echo $autorizacion["id_requisicion"]; ?>"><i class="fa-solid fa-file-invoice"></i></a>

                                        <a href="#" data-id="<?php echo $autorizacion['id_autorizacion'] ?>" id-requisicion="<?php echo $autorizacion['id_requisicion'] ?>" data-tipo="autorizacion" class="btn bg-green bnt-flat margin aceptar_requisicion">
                                          <i class="fa-solid fa-check"></i>
                                        </a>
                                        
                                       <a href="#" data-id="<?php echo $autorizacion['id_autorizacion'] ?>" id-requisicion="<?php echo $autorizacion['id_requisicion'] ?>" data-tipo="autorizacion" class="btn bg-maroon bnt-flat margin negar_requisicion">
                                          <i class="fa-solid fa-xmark"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            <?php }  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Area</th>
                  <th>Nombre</th>          
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
           
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


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
  $('.negar_requisicion').on('click', function(e) {
        e.preventDefault();
        let id_autorizacion = $(this).attr('data-id');
        let id_requisicion = $(this).attr('id-requisicion');
        let tipo = $(this).attr('data-tipo');
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Negar'
        }).then((result) => {
            if (result.value) {              
                $.ajax({
                    type: 'post',
                    data: {
                        'id_autorizacion': id_autorizacion,
                        'id_requisicion':id_requisicion,
                        'registro': 'eliminar'

                    },
                    url: 'modelo-' + tipo + '.php',
                    success: function(data) {                       
                        let resultado = JSON.parse(data);
                        jQuery('[data-id="' + id_autorizacion + '"]').parents('tr').remove();
                        Swal.fire(
                          'Negado',
                          'La requisicion ha sido negada',
                          'success'
                        )
                    }
                })
            }
        })
    });

    $('.aceptar_requisicion').on('click', function(e) {
        e.preventDefault();
        let id_autorizacion = $(this).attr('data-id');
        let id_requisicion = $(this).attr('id-requisicion');
        let tipo = $(this).attr('data-tipo');
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Autorizar'
        }).then((result) => {
            if (result.value) {              
                $.ajax({
                    type: 'post',
                    data: {
                        'id_autorizacion': id_autorizacion,
                        'id_requisicion':id_requisicion,
                        'registro': 'aceptar'

                    },
                    url: 'modelo-' + tipo + '.php',
                    success: function(data) {                       
                        let resultado = JSON.parse(data);
                        jQuery('[data-id="' + id_autorizacion + '"]').parents('tr').remove();
                        Swal.fire(
                          'Aceptada',
                          'La requisicion ha sido aceptada',
                          'success'
                        )
                    }
                })
            }
        })
    });


</script>
</body>

</html>