<?php

include_once '../funciones/sesiones.php';
include_once '../funciones/funciones.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$id_requisicion = $_GET["id"];


$stmt = $conn->prepare("SELECT * FROM requisicion WHERE id_requisicion=?");
$stmt->bind_param("i", $id_requisicion);
$stmt->execute();
$requisicion=$stmt->get_result();
$requisicion = $requisicion->fetch_assoc();

$stmt->close();
$conn->close();

//ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&display=swap" rel="stylesheet">
  
    
    <style>
        :root{
            --fuente_principal : 'Oswald', sans-serif;
            --color_principal : rgb(51,150,255);
            --color_oscuro :  rgb(0,24,138)
        }
        html {
            box-sizing: border-box;
            font-size: 62.5%;
        }
        *, *:before, *:after {
            box-sizing: inherit;
        }
        /*Globales*/
        body{
            background-color: var(--primario);
            font-size: 1.6rem;
            line-height: 1.5;
        }
        p{
            font-size: 2rem;
            font-family: var(--fuente_principal);
            color: black
        }
        a{
            text-decoration: none;

        }
        img{
            width: 100%;
        }
        .contenedor{
            max-width: 100rem;
            margin: 0 auto;
        }
        h1,h2,h3{
            text-align: center;
            color: var(--color_oscuro);
            font-family: var(--fuente_principal);
        }
        h1{
            font-size: 4rem;
        }
        h2{
            font-size: 3.2rem;
        }
        h3{
            font-size: 2.4rem;
            color: var(--color_principal);
            font-family: var(--fuente_principal);
        }
        /*Estilos del header*/
        .header > *{
            border-radius: 24px 24px 24px 24px;
            -moz-border-radius: 24px 24px 24px 24px;
            -webkit-border-radius: 24px 24px 24px 24px;
            border: 3px solid #006aff;
            padding: 1rem;
        }
        .header{
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1rem;
        }
        /*Estilos de los campos*/
        .campos{
            display: grid;
            grid-template-columns: 1fr 2fr;
        }
        .campo{
            text-align: center;
        }
        /*Tabla de productos*/
        .tabla{
            display: block;
        }
        .fila{
            display: grid;
            grid-template-columns: repeat(3,1fr);
            align-items: center;
            height: 100%;
        }
        .fila > *{
            text-align: center;
            border: 1px solid var(--color_oscuro);
            margin: 0;
            
        }
        .fila-titulo{
            background-color: var(--color_principal);
        }
        
            
     </style>
</head>

<body>
    <header class="header">
        <div class="info">
            <h2>Tampico Terminal Marítima</h2>
            <p>R.F.C TTM2006049AA</p>
            <p>MONTE ATHOS No. 102,COUNTRY CLUB TAMPICO, TAMAULIPAS C.P. 89218</p>
            <hr>
            <p style="color: var(--color_oscuro) ;">REQUISICIONES</p>
            <p style="color: var(--color_oscuro) ;">REQUISICION DE MATERIALES, HERRAMIENTAS, EQUIPOS Y/O SERVICIOS</p>
        </div>
        <img src="logo.jpg" alt="Imagen Terminal">
        
        
    </header>

    <main class="contenedor ">

    <div class="campos clearfix">

        <div class="campo" style=" grid-column: 1 / 2;">
            <h3>Nombre del Solicitante</h3>
            <p><?php echo $requisicion["nombre_solicitante"]; ?></p>
        </div>

        <div class="campo" style="grid-row:2 / 3 ; grid-column: 2 / 3;">
            <h3>Numero de requisicion:</h3>
            <p style="font-size:2.5rem ;"><?php echo $requisicion["id_requisicion"]; ?></p>
        </div>

        <div class="campo" style=" grid-column: 1 / 2;">
            <h3>Area que Solicita</h3>
            <p><?php echo $requisicion["area"]; ?></p>
        </div>

        
        <div class="campo" style="grid-row:3 / 4 ; grid-column: 2 / 3;">
            <h3>Fecha:</h3>
            <p style="font-size:2.5rem ;"><?php echo $requisicion["fecha"]; ?></p>
        </div>

        <div class="campo" style=" grid-column: 1 / 2;">
            <h3>Lugar de entrega</h3>
            <p><?php echo $requisicion["lugar_entrega"]; ?></p>
        </div>
    </div>

    <?php 
        $productos = json_decode($requisicion["productos"],true);
    ?>
        <div style="margin-top:10rem ;">
            <h3>Productos</h3>
            <div class="tabla">
                <div class="fila fila-titulo">
                    <p>Cantidad</p>
                    <p>Unidad</p>
                    <p>Concepto</p>
                </div>
                <?php foreach($productos as $producto){  ?>
                    <div class="fila">
                        <p style="height: 100%;"><?php echo $producto[0]?></p>
                        <p style="height: 100%;"> <?php echo $producto[1]?></p>
                        <p><?php echo $producto[2]?></p>
                    </div>
                <?php }?>
            </div>
        </div>

    </main>

</body>

</html>

<?php
/*
$html = ob_get_clean();

require_once "../dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array("isRemoteEnabled" => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper("letter");
$dompdf->render();
$dompdf->stream("requisicion.pdf",array("Attachment" => true));
*/
?>
<script>
    print();
</script>
<?php ?>