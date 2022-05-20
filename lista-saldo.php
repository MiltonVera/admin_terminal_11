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
            Saldos de Cuentas
            <small></small>
          </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Administra las cuentas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Saldo Anterior</th>
                  <th>Banamex</th>
                  <th>Banci</th>
                  <th>Banorte</th>
                  <th>Gastos</th>
                  <th>Ingresos</th>
                  <th>Suma</th>
                  <th>Saldo Total</th>
                </tr>
                </thead>
                <tbody>
                  
                        <?php
                            try {
                                $sql = "SELECT * FROM `saldos` ORDER BY `saldos`.`id_saldo` DESC";
                                $resultado = $conn->query($sql);
                            } catch (Exception $e) {
                                $error = $e->getMessage();
                                echo $error;
                            }
                            while($saldo = $resultado->fetch_assoc() ) { ?>
                                
                                <tr>
                                    <td><?php echo $saldo['fecha']; ?></td>
                                    <td><?php echo $saldo['saldo_anterior']; ?></td>
                                    <td><?php echo $saldo['banamex']; ?></td>
                                    <td><?php echo $saldo['banci']; ?></td>
                                    <td><?php echo $saldo['banorte']; ?></td>
                                    <td><?php echo $saldo['gastos']; ?></td>
                                    <td><?php echo $saldo['suma']; ?></td>
                                    <td><?php echo $saldo['ingresos']; ?></td>
                                    <td><?php echo $saldo['saldo']; ?></td>
                                </tr>
                            <?php }  ?>
                </tbody>
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

  <?php
          include_once 'templates/footer.php';
  ?>