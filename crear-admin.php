<?php 
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
 include_once 'templates/barra.php';
 include_once 'templates/navegacion.php';
 ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Administrador
        <small>llena el formulario para crear un administrador</small>
      </h1>
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Crear Administrador</h3>
        </div>
        <div class="box-body">
          <div class="row">
          <div class="col-md-8"> 
            <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-admin.php">
              <div class="box-body">

                <div class="form-group">
                  <label for="exampleInputEmail1">Usuario(Correo):</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                </div>

                <div class="form-group">
                  <label for="nombre">Tu nombre:</label>
                  <input type="text" class="form-control" id="nombre"name="nombre" placeholder="Tu nombre completo">
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>                   
              

                <div class="form-group">
                    <label>Rol</label>
                      <select class="form-control select2" name="rol" style="width: 100%;">
                        <option selected="selected">---Selecionar----</option>
                        <option value="Full Admin">Full Admin</option>
                        <option value="Administracion">Administracion</option>
                        <option value="Contabilidad">Contabilidad</option>
                        <option value="Recursos Humanos">Recursos Humanos</option>
                        <option value="Recinto Fiscal">Recinto Fiscal</option>
                        <option value="Almacen">Almacen</option>
                        <option value="Operacion">Operacion</option>
                        <option value="Ingenieria">Ingenieria</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Subdireccion De Operaciones">Subdireccion De Operaciones</option>
                        <option value="Compras">Compras</option>
                      </select>
                </div>
                </div>
              <div class="box-footer">
                <input type="hidden" name='registro' value='nuevo'>
                <button type="submit" class="btn btn-primary">Añadir</button>
              </div>
            </form>
          </div>
        </div>
       
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  
 

  <?php include_once 'templates/footer.php';  ?>
<!-- jQuery 3 -->

