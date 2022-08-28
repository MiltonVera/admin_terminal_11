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
            Ordenes de Compra
          </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Envia requisiciones a proveedor y rellena ordenes de compra</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <div class="container">
                </div>  
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Area</th>        
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                        <?php
                            try {
                                $sql = "SELECT * FROM orden";
                                $resultado = $conn->query($sql);
                            } catch (Exception $e) {
                                $error = $e->getMessage();
                                echo $error;
                            }
                            while($orden = $resultado->fetch_assoc() ) { 
                                if($orden["mostrar"] == "True"){?>                              
                                <tr>    
                                    <td><?php echo $orden['id_orden_compra']; ?></td>
                                    <td><?php echo $orden['area']; ?></td>                                                                                                                         
                                    <td>

                                        <?php if($orden["enviado"] == "True"){ ?>
                                          <button data-id="<?php echo $orden['id_orden_compra'] ?>" data-tipo="orden" class="btn bg-green bnt-flat margin enviar_orden">
                                            <i class="fa-solid fa-cart-flatbed"></i>
                                          </button>
                                        <?php }else{ ?>
                                          <button data-id="<?php echo $orden['id_orden_compra'] ?>" data-tipo="orden" class="btn bg-red bnt-flat margin enviar_orden">
                                            <i class="fa-solid fa-cart-flatbed"></i>
                                          </button>
                                        <?php } ?>
                                        
 
                                        <a class="btn bg-blue bnt-flat margin" target="_blank" href="editar_orden.php?id=<?php echo $orden['id_orden_compra']; ?>">
                                            <i class="fa-solid fa-file-circle-check"></i>
                                        </a>

                                    </td>
                                </tr>
                            <?php }}  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Area</th>        
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

  $('.enviar_orden').on('click', function(e) {
        e.preventDefault();
        let id_orden = $(this).attr('data-id');
        let tipo = $(this).attr('data-tipo');
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Enviar'
        }).then((result) => {
            if (result.value) {              
                $.ajax({
                    type: 'post',
                    data: {
                        'id_orden': id_orden,
                        'registro': 'enviar'

                    },
                    url: 'modelo-' + tipo + '.php',
                    success: function(data) {                       
                        console.log(id_orden);

                        jQuery(`[data-id=${id_orden}]`).removeClass("bg-red");
                        jQuery(`[data-id=${id_orden}]`).addClass("bg-green");
                        Swal.fire(
                          'Enviado',
                          'La requisicion ha sido marcada como enviada',
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