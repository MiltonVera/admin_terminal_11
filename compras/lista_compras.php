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
            Estatus Compras
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
                  <th>Area</th>
                  <th>Nombre</th>
                  <th>Status</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                        <?php
                            try {
                                $sql = "SELECT * FROM compras";
                                $resultado = $conn->query($sql);
                            } catch (Exception $e) {
                                $error = $e->getMessage();
                                echo $error;
                            }
                            while($compra = $resultado->fetch_assoc() ) { ?>                              
                                <tr>    
                                    <td><?php echo $compra['id_compra']; ?></td>
                                    <td><?php echo $compra['area']; ?></td>
                                    <td><?php echo $compra['nombre']; ?></td>
                                    <td><?php echo $compra['status']; ?></td>
                                    <td>
                                        <?php if($compra["id_factura"] == 0){?>
                                            <a class="btn bg-red bnt-flat margin" target="_blank" href="crear_factura.php?id=<?php echo $compra['id_compra']; ?>">
                                                <i class="fa-solid fa-receipt"></i>
                                            </a>
                                        <?php } else{ ?>
                                            <a class="btn bg-green bnt-flat margin" target="_blank" href="ver_factura.php?id=<?php echo $compra['id_factura']; ?>">
                                                <i class="fa-solid fa-receipt"></i>
                                            </a>
                                        <?php }  ?>





                                        <?php if($compra["status"] == "Modo de Pago" or $compra["status"] == "Entrega Pendiente" or $compra["status"] == "Entregado" ){ ?>
                                              <a class="btn bg-blue bnt-flat margin" target="_blank" href="ver_orden.php?id=<?php echo $compra['id_compra']; ?>">
                                                  <i class="fa-solid fa-file-invoice-dollar"></i>
                                              </a>
                                        <?php }else{ ?>
                                              <a class="btn bg-blue bnt-flat margin" target="_blank" href="ver_requisicion.php?id=<?php echo $compra['id_compra']; ?>">
                                                  <i class="fa-solid fa-file-invoice-dollar"></i>
                                              </a>
                                        <?php } ?>


                                        <button data-id="<?php echo $compra['id_compra'] ?>" data-tipo="compra" class="btn <?php echo $compra["status"] == 'Entregado' ? "bg-green" : "bg-red" ?> bnt-flat margin entregar_compra">
                                            <i class="fa-solid fa-clipboard-check"></i>
                                        </button>

                                        <?php if($compra["status"] == "Modo de Pago" or $compra["status"] == "Entrega Pendiente" or $compra["status"] == "Entregado" ){ ?>
                                          <a class="btn bg-yellow bnt-flat margin" target="_blank" href="descarga_compra.php?id=<?php echo $compra['id_compra']; ?>">
                                            <i class="fa-solid fa-download"></i>
                                          </a>
                                        <?php }else{ ?>
                                          <a class="btn bg-yellow bnt-flat margin" target="_blank" href="descarga_requisicion.php?id=<?php echo $compra['id_compra']; ?>">
                                            <i class="fa-solid fa-download"></i>
                                          </a>
                                        <?php } ?>
                                        

                                    </td>
                                </tr>
                            <?php }  ?>
                </tbody>
                <tfoot>
                <tr>
                <th>ID</th>
                  <th>Area</th>
                  <th>Nombre</th>
                  <th>Status</th>
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
    <?php if($_SESSION["rol"] == "Subdireccion De Operaciones" or $_SESSION["rol"] == "Full Admin"){ ?>
    <section class="content-header">
          <h1>
            Gráfica de Gastos
          </h1>
          <form action="modelo-grafica.php" id="selector_grafica" method="post">

            <div class="campo">
              <select class="select" name="mes" id="mes">
                <option value="0">Todos los Meses</option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
              </select>
            </div>

            <div class="campo">
              <select class="select" name="anio" id="anio">
                <option value="0">Todos los Años</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
              </select>
            </div>

            <div class="campo">
              <select class="select" name="area" id="area">
                <option value="todos">Todas las Areas</option>
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
              </select>
            </div>

            <div class="campo">
              <select class="select" name="clasificacion" id="clasificacion">
                <option value="todos">Todas las Clasificaciones</option>
                <option value="Papeleria">Papeleria</option>
                <option value="Refaccion">Refacciones</option>
                <option value="Combustible">Combustible</option>
                <option value="Construccion">Construccion</option>
                <option value="Mantenimiento">Mantenimiento</option>
                <option value="Rentas">Rentas</option>
              </select>
            </div>            
          </form>
          <canvas id="gastos" width="400" height="200"></canvas>
    </section>

    <?php } ?>
  
  </div>
  <!-- /.content-wrapper -->

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>


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
  $(document).ready(function() {

  //Mover a app js cuando funcione correctamente
    let labels = [];
    let values = [];
    const ctx = document.getElementById('gastos').getContext('2d');
    const grafica = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: labels,
                  datasets: [{
                      label: "Gastos(Pesos Mexicanos)",
                      data: values,
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(255, 206, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(255, 159, 64, 0.2)'
                      ],
                      borderColor: [
                          'rgba(255, 99, 132)',
                          'rgba(54, 162, 235)',
                          'rgba(255, 206, 86)',
                          'rgba(75, 192, 192)',
                          'rgba(153, 102, 255)',
                          'rgba(255, 159, 64)'
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          });
  /*Hacer una llamada a la base de datos con los datos por defecto*/
  $.ajax({
      type: 'post',
      data:$("#selector_grafica").serializeArray(),
      url: 'modelo-grafica.php',
      dataType :'json',
      success: function(data) {  
          labels = data.labels;
          values = data.values;

          grafica.data.labels = labels;
          grafica.data.datasets[0].data = values;
          grafica.update();
                             
      }
  })   

  /*Que hacer cuando cambia el estado de un select*/
  $(".select").change(function(e){

    $.ajax({
      type: 'post',
      data:$("#selector_grafica").serializeArray(),
      url: 'modelo-grafica.php',
      dataType :'json',
      success: function(data) {    
          labels = data.labels;
          values = data.values;
          
          grafica.data.labels = labels;
          grafica.data.datasets[0].data = values;
          grafica.update(); 
                             
      }
  })
  });
  
  

});

</script>
<script>

  $('.entregar_compra').on('click', function(e) {
        e.preventDefault();
        let id_compra = $(this).attr('data-id');
        let tipo = $(this).attr('data-tipo');
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Entregado'
        }).then((result) => {
            if (result.value) {              
                $.ajax({
                    type: 'post',
                    data: {
                        'id_compra': id_compra

                    },
                    url: 'modelo-' + tipo + '.php',
                    dataType: 'json',
                    success: function(data) {                       
                        console.log(data);
                        jQuery('[data-id="' + id_compra + '"]').removeClass("bg-red");
                        jQuery('[data-id="' + id_compra + '"]').addClass("bg-green");
                        Swal.fire(
                          'Enviado',
                          'La requisicion ha sido marcada como enviada',
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