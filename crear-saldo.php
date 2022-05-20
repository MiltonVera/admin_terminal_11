<?php
include_once 'funciones/sesiones.php';
include_once 'templates/header.php';
include_once 'funciones/funciones.php';

include_once 'templates/barra.php';

include_once 'templates/navegacion.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Registrar Saldo
            <small>Formulario para llenar el saldo</small>
        </h1>
    </section>

    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">Registro de saldo</h3>
                    </div>

                    <div class="box-body">
                        <!-- form start -->
                        <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-saldo.php">

                            <div class="box-body">

                                <div class="form-group">
                                    <label for="banamex">Banamex</label>
                                    <input type="text" class="form-control" name="banamex" id="banamex">
                                </div>

                                <div class="form-group">
                                    <label for="banci">Banci</label>
                                    <input type="text" class="form-control" name="banci" id="banci">
                                </div>

                                <div class="form-group">
                                    <label for="banorte">Banorte</label>
                                    <input type="text" class="form-control" name="banorte" id="banorte">
                                </div>

                                <div class="form-group">
                                    <label for="gastos">Gastos</label>
                                    <input type="text" class="form-control" name="gastos" id="gastos">
                                </div>

                                <div class="form-group">
                                    <label for="ingresos">Ingresos</label>
                                    <input type="text" class="form-control" name="ingresos" id="ingresos">
                                </div>
                                

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name='registro' value='nuevo'>
                                <button type="submit" class="btn btn-primary">Crear</button>
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