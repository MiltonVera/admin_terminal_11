<aside class="main-sidebar">
<?php echo $_SESSION['nivel'] ?> 
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="info">
          <p><?php echo $_SESSION['nombre']; ?></p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu de Administracion</li>

        <li>
          <a href="admin-area.php">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>           
          </a>
        </li>

      <?php if($_SESSION['nivel'] >= 3 or $_SESSION['nivel'] == 1){ ?>  
        <li class="treeview">
          <a href="#">
          <i class="fas fa-ship"></i>
            <span>Barcos</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="crear-barco.php"><i class="fa-solid fa-pen"></i> Registrar Barco</a></li>
            <li><a href="lista-barcos.php"><i class="far fa-eye"></i> Administrar Barcos</a></li>
          </ul>
        </li>
      <?php } ?> 

      <?php if($_SESSION['nivel'] >= 2){ ?> 
        <li class="treeview">
          <a href="#">
          <i class="fas fa-dollar-sign"></i>
            <span>Saldos</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="crear-saldo.php"><i class="fa-solid fa-pen"></i> Actualizar Saldos</a></li>
            <li><a href="lista-saldo.php"><i class="far fa-eye"> Ver Saldos</a></li>
          </ul>
        </li>
      <?php } ?>   


        <?php if($_SESSION['nivel'] == 4){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-user-cog"></i>
            <span>Administradores</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-admin.php"><i class="far fa-eye"></i> Ver Todos</a></li>
            <li><a href="crear-admin.php"><i class="fas fa-plus-square"></i> Agregar</a></li>
          </ul>
        </li>
        <?php } ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script src="https://kit.fontawesome.com/3ee71cf885.js" crossorigin="anonymous"></script>