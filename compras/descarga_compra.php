<?php

include_once '../funciones/sesiones.php';
include_once '../funciones/funciones.php';;
$id_orden = $_GET["id"];


$stmt = $conn->prepare("SELECT * FROM orden WHERE id_orden_compra=?");
$stmt->bind_param("i", $id_orden);
$stmt->execute();
$orden=$stmt->get_result();
$orden = $orden->fetch_assoc();

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html>
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
            grid-template-columns: 1fr 1fr;
            align-items: center;
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
            grid-template-columns: repeat(4,1fr);
            align-items: center;
        }
        .fila > *{
            text-align: center;
            border: 1px solid var(--color_oscuro);
            margin: 0;
            
            
        }
        .fila:nth-child(1),.fila:nth-child(2){
            height: 100%;
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
            <p style="color: var(--color_oscuro) ;">ORDEN DE COMPRA</p>
        </div>
        <img src="logo.jpg" alt="Imagen Terminal">
        
        
    </header>

    <main class="contenedor ">

    <div class="campos">

        <div class="campo" style="grid-row:1 / 3 ; grid-column: 2 / 3;">
            <h3>Numero de requisicion:</h3>
            <p style="font-size:2.5rem ;"><?php echo $orden["id_orden_compra"]; ?></p>
        </div>

        <div class="campo" style="grid-row:2 / 4 ; grid-column: 2 / 3;">
            <h3>Fecha:</h3>
            <p style="font-size:2.5rem ;"><?php echo $orden["fecha"]; ?></p>
        </div>
                                                                
        <div class="campo" style="grid-row:3 / 5 ; grid-column: 2 / 3;">
            <h3>Area que Solicita</h3>
            <p style="font-size:2.5rem ;"><?php echo $orden["area"]; ?></p>
        </div>
        

        <div class="campo" style=" grid-column: 1 / 2;">
            <h3>Cheque a Favor</h3>
            <p><?php echo $orden["cheque"]; ?></p>
        </div>

        <div class="campo" style=" grid-column: 1 / 2;">
            <h3>Contado</h3>
            <p><?php echo $orden["contado"]; ?></p>
        </div>

        <div class="campo" style=" grid-column: 1 / 2;">
            <h3>Credito</h3>
            <p><?php echo $orden["credito"]; ?></p>
        </div>

        <div class="campo" style=" grid-column: 1 / 2;">
            <h3>Nombre Comercial</h3>
            <p><?php echo $orden["nombre_comercial"]; ?></p>
        </div>

        <h2 class="campo" style="margin: 15rem 0 3rem 0 ; grid-column: 1 / 3; color:var(--color_oscuro);">Datos del Pago</h2>

        <div class="campo">
            <h3>Nombre Fiscal</h3>
            <p><?php echo $orden["nombre_fiscal"]; ?></p>
        </div>
        <div class="campo">
            <h3>RFC</h3>
            <p><?php echo $orden["rfc"]; ?></p>
        </div>

        <div class="campo">
            <h3>Direccion</h3>
            <p><?php echo $orden["direccion"]; ?></p>
        </div>
                                                            
        <div class="campo">
            <h3>Cuenta</h3>
            <p><?php echo $orden["cuenta"]; ?></p>
        </div>

        <div class="campo">
            <h3>Clabe</h3>
            <p><?php echo $orden["clabe"]; ?></p>
        </div>

        <div class="campo">
            <h3>Banco</h3>
            <p><?php echo $orden["banco"]; ?></p>
        </div>

    </div>

    <?php 
        $productos = json_decode($orden["productos"],true);

    ?>                                                         

        <div style="margin-top:2rem ;">
            <h3>Productos</h3>
            <div class="tabla">
                <div class="fila fila-titulo">
                    <p>Cantidad</p>
                    <p>Unidad</p>
                    <p>Concepto</p>
                    <p>Precio Unitario</p>
                </div>
                <?php foreach($productos as $producto){  ?>
                    <div class="fila">
                        <p style="height: 100%;"><?php echo $producto[0]?></p>
                        <p style="height: 100%;"><?php echo $producto[1]?></p>
                        <p><?php echo $producto[2]?></p>
                        <p style="height: 100%;"><?php echo $producto[3]?></p>
                    </div>
                <?php }?>
            </div>
        </div>

        <div >
            
                <h3 style="text-align: left ;">Subtotal: <span style="color:black"><?php echo $orden["subtotal"]; ?></span> </h3>                
            
                <h3 style="text-align: left ;">IVA: <span style="color:black"><?php echo $orden["iva"]; ?></span> </h3>

                <h3 style="text-align: left ;">Total: <span style="color:black"><?php echo $orden["total"]; ?></span></h3>
                
            
        </div>

    </main>

</body>


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
$dompdf->stream("Orden.pdf",array("Attachment" => true));
*/
?>
<script>
    print();
</script>
</html>