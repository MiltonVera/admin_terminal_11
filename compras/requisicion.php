<?php
include_once '../funciones/sesiones.php';
include_once '../templates/header2.php';
include_once '../funciones/funciones.php';

include_once '../templates/barra.php';

include_once '../templates/navegacion.php';
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Requisicion
            <small>Rellena el formulario para registrar una requisicion</small>
        </h1>
    </section>

    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    
                    <div class="box-body">
                        <!-- form start -->
                        <form role="form" name="guardar-requisicion" id="guardar-requisicion" method="post" action="modelo-requisicion.php">
                            <div class="box-body">

                                <div class="form-group">
                                    <label>Area que Solicita</label>
                                    <select class="form-control select2" name="area" style="width: 100%;">
                                        <option selected="selected">---Selecionar----</option>
                                        <option value="Administracion">Administracion</option>
                                        <option value="Contabilidad">Contabilidad</option>
                                        <option value="Recursos Humanos">Recursos Humanos</option>
                                        <option value="Seguridad">Seguridad</option>
                                        <option value="Medio Ambiente">Medio Ambiente</option>
                                        <option value="Recinto Fiscal">Recinto Fiscal</option>
                                        <option value="Almacen">Almacen</option>
                                        <option value="Operacion">Operacion</option>
                                        <option value="Ingenieria">Ingenieria</option>
                                        <option value="Mantenimiento">Mantenimiento</option>
                                        <option value="Direccion">Direccion</option>
                                        <option value="Comercial">Comercial</option>
                                    </select>
                                </div>

                                <!-- Esto se debe remover despues del ingreso de datos historicos -->
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="text" class="form-control" id="fecha" name="fecha" placeholder="dia/mes/año(01/01/2001)">
                                </div>

                                <div class="form-group">
                                    <label for="solicitante">Nombre de Solicitante</label>
                                    <input type="text" class="form-control" id="solicitante" name="solicitante" placeholder="Nombre de Solicitante">
                                </div>

                                <div class="form-group">
                                    <label for="lugar">Lugar de Entrega</label>
                                    <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Lugar de Entrega">
                                </div>

                                <div class="form-group">
                                    <label>Clasificacion</label>
                                    <select class="form-control select2" name="clasificacion" style="width: 100%;">
                                        <option selected="selected">---Selecionar----</option>
                                        <option value="Papeleria">Papeleria</option>
                                        <option value="Refaccion">Refacciones</option>
                                        <option value="Combustible">Combustible</option>
                                        <option value="Construccion">Construccion</option>
                                        <option value="Mantenimiento">Mantenimiento</option>
                                        <option value="Rentas">Rentas</option>
                                        <option value="Insumos">Insumos</option>
                                        <option value="Computacion">Computacion</option>
                                        <option value="Salud">Salud</option>
                                        <option value="Paqueteria">Paqueteria</option>
                                        <option value="Seguros">Seguros</option>
                                        <option value="Viaticos">Viaticos</option>
                                        <option value="Seguridad">Seguridad e Higiene</option>
                                        <option value="Maquinaria">Maquinaria</option>
                                        <option value="Otros">Otros</option>
                                    
                                    </select>
                                </div>


                                <div class="form-group my-4">
                                    <div class="my-4">
                                        <div class="col-lg-10 mx-auto">
                                            <div class="card shadow">
                                                <div class="card-header">
                                                    <h4>Productos</h4>
                                                </div>
                                                <div class="card-body p-4" style="display:block ;">
                                                        <div id="show_item">
                                                            <div class="row" style="margin:10px 0;">
                                                                <div class="col-md-4 mb-3">
                                                                    <input type="number" name="cantidad[]" class="form-control" placeholder="Cantidad" required>
                                                                </div>

                                                                <div class="col-md-3 mb-3">
                                                                    <input type="text" name="unidad[]" class="form-control" placeholder="Unidad(litros,metros)" required>
                                                                </div>

                                                                <div class="col-md-3 mb-3">
                                                                    <input type="text" name="concepto[]" class="form-control" placeholder="Concepto" required>
                                                                </div>

                                                                <div class="col-md-2 mb-3 d-grid">
                                                                    <button class="btn btn-success add_item_btn">Añadir Otro</button>
                                                                </div>

                                                            </div>
                                                        </div>                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer " >
                                    <input type="hidden" name="registro" value="nuevo">
                                    <input type="submit" class="btn btn-primary" id="crear_registro" style="width:100%; margin-top:3rem;" value="Enviar"></input>
                                </div>
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



</div>

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
    $(document).ready(function(){
        //Funcion que añade los campos
        $(".add_item_btn").click(function(e){
            e.preventDefault();
            $("#show_item").prepend(`<div class="row style="margin:10px 0;">
                                        <div class="col-md-4 mb-3">
                                            <input type="number" name="cantidad[]" class="form-control" placeholder="Cantidad" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <input type="text" name="unidad[]" class="form-control" placeholder="Unidad(litros,metros)" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <input type="text" name="concepto[]" class="form-control" placeholder="Concepto" required>
                                        </div>

                                    <div class="col-md-2 mb-3 d-grid">
                                        <button class="btn btn-danger remove_item_btn">Remover</button>
                                    </div>

                                </div>`)
        })
        //Funcion que elimina los campos
        $(document).on("click",".remove_item_btn",function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        })
        //Llamada a ajax para insertar en la base de datos
        $('#guardar-requisicion').on('submit', function(e) {
        e.preventDefault();
        let datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                let resultado = data;
                console.log(resultado);
                if (resultado.respuesta == "exito") {
                    Swal.fire(
                        'Correcto',
                        'Se ha registrado la requisicion',
                        'success'
                    )
                    console.log(resultado.id_insertado)
                    setTimeout(() => {
                        window.location.href = `../compras/descarga_requisicion.php?id=${resultado.id_insertado}`;
                    }, 2500);
                    
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un error',
                        text: 'Algo ha Salido mal',
                        footer: ''
                    })
                }

            }
        })
    });

    });
  </script>
</body>

</html>