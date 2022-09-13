<?php
include_once '../funciones/funciones.php';
include_once '../funciones/ruta.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Monterrey');

$area = $_POST["area"];
$solicitante = $_POST["solicitante"];
$entrega = $_POST["lugar"];

$cantidad = $_POST["cantidad"];
$unidad = $_POST["unidad"];
$concepto = $_POST["concepto"];
$clasificacion = $_POST["clasificacion"];

$productos_entrada = array();

for($i = 0;$i<count($cantidad);$i++){
    $productos_entrada[] = array($cantidad[$i],$unidad[$i],$concepto[$i]);
}


$productos = json_encode($productos_entrada);

/* Salida final de JSON con datos
{"cantidad":["20","10","5"],"unidad":["metros","litros","papeles"],"concepto":["lamina","gasolina","papel"]} */


//$fecha = date('d/m/Y', time()); esto debe descomentarse despues del ingreso de los datos historicos
$fecha = $_POST["fecha"];//Esto se debe quitar despues del ingreso de los datos

$false = "False";
    
    try {
        $conn->autocommit(false);
        //Insertandos los datos a requisicion
        $stmt1 = $conn->prepare('INSERT INTO requisicion (fecha,area,nombre_solicitante,lugar_entrega,productos,clasificacion) VALUES (?,?,?,?,?,?)');
        $stmt1->bind_param("ssssss", $fecha,$area,$solicitante,$entrega,$productos,$clasificacion);
        $stmt1->execute();
        $id_insertado1 = $stmt1->insert_id;
        //Insertando la orden con los datos conocidos
        $stmt2 = $conn->prepare('INSERT INTO orden (id_orden_compra,fecha,area,productos,mostrar,clasificacion) VALUES (?,?,?,?,?,?) ');
        $stmt2->bind_param("isssss", $id_insertado1,$fecha,$area,$productos,$false,$clasificacion);
        $stmt2->execute();
        
        $status = "Autorizacion";
        //Declarando la compra

         //Pondremos la fecha desde que se inserta, esto se debe quitar cuando se ingresen los datos   

        $stmt3 = $conn->prepare('INSERT INTO compras (id_compra,id_requisicion,id_orden_compra,status,area,nombre,clasificacion,fecha) VALUES (?,?,?,?,?,?,?,?)');
        $stmt3->bind_param("iiisssss", $id_insertado1,$id_insertado1,$id_insertado1,$status,$area,$solicitante,$clasificacion,$fecha);
        $stmt3->execute();
        //Añadir el registro a autorizacion
        $stmt4 = $conn->prepare('INSERT INTO autorizacion (area,nombre,id_requisicion) VALUES (?,?,?)');
        $stmt4->bind_param("ssi", $area,$solicitante,$id_insertado1);
        $stmt4->execute();

        if($stmt1->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado1
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }




        $conn->autocommit(true);
        $stmt1->close();
        $stmt2->close();
        $stmt3->close();
        $stmt4->close();
        $conn->close();

        
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));

    


