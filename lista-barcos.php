<?php
        include_once 'funciones/sesiones.php';
        include_once 'funciones/funciones.php';
        include_once 'templates/header.php';
        include_once 'templates/barra.php';
        include_once 'templates/navegacion.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
          <h1>
            Listado de Barcos
          </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Administra los Barcos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <div class="container">
                </div>  
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Barco</th>
                  <th>Fecha Inicio</th>
                  <th>Operacion</th>
                  <th>Producto</th>
                  <th>Cantidad Producto</th>
                  <th>Cobro de Servicios</th>
                  <th>Cobro de Maniobras</th>
                  <th>Cobro Total</th>
                  <th>Estatus Facturacion</th> 
                  <th>Fecha Facturacion</th>                            
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                        <?php
                            try {
                                $sql = "SELECT * FROM barcos";
                                $resultado = $conn->query($sql);
                            } catch (Exception $e) {
                                $error = $e->getMessage();
                                echo $error;
                            }
                            while($barco = $resultado->fetch_assoc() ) { ?>
                                
                                <tr>
                                    <td><?php echo $barco['nombre_barco']; ?></td>
                                    <td><?php echo $barco['fecha_inicio']; ?></td>
                                    <td><?php echo $barco['operacion']; ?></td>
                                    <td><?php echo $barco['producto']; ?></td>
                                    <td><?php echo $barco['cantidad_producto']; ?></td>
                                    <td><?php echo $barco['servicios']; ?></td>
                                    <td><?php echo $barco['maniobras']; ?></td>
                                    <td><?php echo $barco['cobro']; ?></td>
                                    <td estatus_id =<?php echo $barco['id_barco']; ?> ><?php echo $barco['estatus']; ?></td>
                                    <td><?php echo $barco['fecha_facturacion']; ?></td>                                                             
                                    <td>
                                        <a href="#" factura_id ="<?php echo $barco['id_barco'] ?>"  data-id="<?php echo $barco['id_barco'] ?>" data-tipo="barco" class="btn bg-blue bnt-flat margin marcar_registro">
                                            <i class="fa fa-receipt"></i>
                                        </a>
                                        
                                       <a href="#" data-id="<?php echo $barco['id_barco'] ?>" data-tipo="barco" class="btn bg-maroon bnt-flat margin borrar_registro">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            <?php }  ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Barco</th>
                  <th>Fecha Inicio</th>
                  <th>Operacion</th>
                  <th>Producto</th>
                  <th>Cantidad Producto</th>
                  <th>Servicios</th>
                  <th>Maniobras</th>
                  <th>Cobro</th>
                  <th>Estatus Facturacion</th> 
                  <th>Fecha Facturacion</th>                  
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
<script>
  
</script>
  <?php
          include_once 'templates/footer.php';
  ?>