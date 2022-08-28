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
            Tipo de Pago de Compras
          </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">

            <div class="container">
                </div>  
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Proveedor</th>
                  <th>Costo</th>        
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                        <?php
                            try {
                                $sql = "SELECT * FROM pago";
                                $resultado = $conn->query($sql);
                            } catch (Exception $e) {
                                $error = $e->getMessage();
                                echo $error;
                            }
                            while($pago = $resultado->fetch_assoc() ) { 
                                ?>                              
                                <tr>    
                                    <td><?php echo $pago['id_pago']; ?></td>
                                    <td><?php echo $pago['provedor']; ?></td>
                                    <td><?php echo $pago['costo']; ?></td>                                                                                                                           
                                    <td>
                                        <button data-id="<?php echo $pago['id_pago'] ?>" orden-id="<?php echo $pago['id_orden'] ?>" tipo="efectivo" data-tipo="pago" class="btn bg-green bnt-flat margin enviar_pago">
                                            <i class="fa-solid fa-money-bill"></i>
                                        </button>

                                        <button data-id="<?php echo $pago['id_pago'] ?>" orden-id="<?php echo $pago['id_orden'] ?>" tipo="cheque" data-tipo="pago" class="btn bg-blue bnt-flat margin enviar_pago">
                                            <i class="fa-solid fa-money-check"></i>
                                        </button>

                                        <button data-id="<?php echo $pago['id_pago'] ?>" orden-id="<?php echo $pago['id_orden'] ?>" tipo="transferencia" data-tipo="pago" class="btn bg-yellow bnt-flat margin enviar_pago">
                                            <i class="fa-solid fa-money-bill-transfer"></i>
                                        </button>
                                        

                                    </td>
                                </tr>
                            <?php }  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Proveedor</th>
                  <th>Costo</th>        
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

  $('.enviar_pago').on('click', function(e) {
        e.preventDefault();
        let id_pago = $(this).attr('data-id');
        let tipo = $(this).attr('data-tipo');
        let id_orden = $(this).attr('orden-id');
        let tipo_pago = $(this).attr('tipo');
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.value) {              
                $.ajax({
                    type: 'post',
                    data: {
                        'id_pago': id_pago,
                        'id_orden' : id_orden,
                        'tipo_pago' : tipo_pago

                    },
                    url: 'modelo-' + tipo + '.php',
                    success: function(data) {                       
                        let resultado = JSON.parse(data);
                        this.disabled = true;
                        jQuery('[data-id="' + id_pago + '"]').parents('tr').remove();
                        Swal.fire(
                          'Correcto',
                          `Se ha declarado el tipo de pago como ${tipo_pago}`,
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