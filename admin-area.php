<?php 
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
 include_once 'templates/barra.php';
 include_once 'templates/navegacion.php';

//Cantidad de barcos, barcos facturados, utilidad del dia, saldo total
 try {
   $sql = "SELECT count(*) as cantidad FROM requisicion WHERE MONTH(STR_TO_DATE(fecha, '%d/%m/%Y')) = MONTH(CURDATE())";
   $totales = $conn->query($sql);
   $totales = $totales->fetch_assoc();

   $sql = "SELECT ROUND(SUM(costo_total),2) as suma FROM compras WHERE MONTH(STR_TO_DATE(fecha, '%d/%m/%Y')) = MONTH(CURDATE()) AND status='Entregado'";
   $suma = $conn->query($sql);
   $suma = $suma->fetch_assoc();

   $sql = "SELECT count(*) as cantidad FROM compras WHERE MONTH(STR_TO_DATE(fecha, '%d/%m/%Y')) = MONTH(CURDATE()) AND status='Entregado'";
   $concretadas = $conn->query($sql);
   $concretadas = $concretadas->fetch_assoc();

 } catch (\Throwable $th) {
   
 }
 ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DashBoard
        <small>Informacion</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $totales['cantidad'] ?></h3>

              <p>Requisiciones del Mes</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-bag-shopping"></i>
            </div>
            <a href="compras/lista_compras.php" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $concretadas['cantidad'] ?></h3>

              <p>Requisiciones Concretadas</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-check-double"></i>
            </div>
            <a href="compras/lista_compras.php" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $suma['suma'] ?></h3>

              <p>Gasto total del mes</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-coins"></i>
            </div>
            <a href="compras/lista_compras.php" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    
    </section>
    <!-- /.content -->
  
 

  <?php include_once 'templates/footer.php';  ?>
<!-- jQuery 3 -->

<script src="https://kit.fontawesome.com/3ee71cf885.js" crossorigin="anonymous"></script>