<?php 
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
 include_once 'templates/barra.php';
 include_once 'templates/navegacion.php';

//Cantidad de barcos, barcos facturados, utilidad del dia, saldo total
 try {
   $sql = "SELECT count(*) as cantidad FROM barcos";
   $barcos = $conn->query($sql);
   $barcos = $barcos->fetch_assoc();

   $sql = "SELECT count(estatus) as cantidad FROM barcos WHERE estatus='facturado'";
   $facturas = $conn->query($sql);
   $facturas = $facturas->fetch_assoc();

   $sql = "SELECT saldo from saldos ORDER BY id_saldo DESC LIMIT 1";
   $saldo = $conn->query($sql);
   $saldo = $saldo->fetch_assoc();

   $sql = "SELECT suma from saldos ORDER BY id_saldo DESC LIMIT 1";
   $suma = $conn->query($sql);
   $suma = $suma->fetch_assoc();


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

    <?php if($_SESSION['nivel'] >= 3 or $_SESSION['nivel'] == 1){ ?>  
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $barcos['cantidad'] ?></h3>

              <p>Barcos</p>
            </div>
            <div class="icon">
              <i class="fas fa-ship"></i>
            </div>
            <a href="lista-barcos.php" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php echo $facturas['cantidad'] ?></h3>

              <p>Facturas Barcos</p>
            </div>
            <div class="icon">
              <i class="fas fa-receipt"></i>
            </div>
            <a href="lista-barcos.php" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php } ?> 


      <?php if($_SESSION['nivel'] >= 2){ ?> 
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $saldo['saldo'] ?></h3>

              <p>Saldo Total</p>
            </div>
            <div class="icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <a href="lista-saldo.php" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $suma['suma'] ?></h3>

              <p>Utilidad Diaria</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-arrow-trend-up"></i>
            </div>
            <a href="lista-saldo.php" class="small-box-footer">Administrar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <?php } ?> 
    </section>
    <!-- /.content -->
  
 

  <?php include_once 'templates/footer.php';  ?>
<!-- jQuery 3 -->

<script src="https://kit.fontawesome.com/3ee71cf885.js" crossorigin="anonymous"></script>