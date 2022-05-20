<?php
include_once 'funciones/sesiones.php';
include_once 'templates/header.php';
include_once 'funciones/funciones.php';

include_once 'templates/barra.php';

include_once 'templates/navegacion.php';

include_once 'funciones/ruta.php'
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Registrar Barco
            <small>Llena el formulario para registrar la entrada de un barco</small>
        </h1>
    </section>

    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Registrar barco</h3>
                    </div>
                    <div class="box-body">
                        <!-- form start -->
                        <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-barco.php" enctype="multipart/form-data">
                            <div class="box-body">


                                <div class="form-group">
                                    <label for="nombre">Nombre Barco</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Barco">
                                </div>

                                <div class="form-group">
                                    <label>Tipo de Operacion</label>
                                    <select class="form-control select2" name="operacion" style="width: 100%;">
                                        <option selected="selected">---Selecionar----</option>
                                        <option value="Carga">Carga</option>
                                        <option value="Descarga">Descarga</option>
                                    </select>
                                </div>

                                
                                <div class="form-group">
                                    <label for="producto">Producto</label>
                                    <input type="text" class="form-control" id="producto" name="producto" placeholder="Producto cargado/descargado">
                                </div>           

                                
                                <div class="form-group">
                                    <label for="cantidad_producto">Cantidad Producto(Toneladas)</label>
                                    <input type="text" class="form-control" id="cantidad_producto" name="cantidad_producto" placeholder="Toneladas de Producto">
                                </div>

                                <div class="form-group">
                                    <label for="servicios">Cobro por Servicios</label>
                                    <input type="text" class="form-control" id="servicios" name="servicios" placeholder="Ingresa el cobro por los servicios">
                                </div>
                        

                                <div class="form-group">
                                    <label for="maniobras">Cobro por Maniobras</label>
                                    <input type="text" class="form-control" id="maniobras" name="maniobras" placeholder="Ingresa el cobro por las maniobras">
                                </div>


                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                            <input type="hidden" name="registro" value="nuevo">
                            <button type="submit" class="btn btn-primary" id="crear_registro">Añadir</button>
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

<?php
include_once 'templates/footer.php';
?>