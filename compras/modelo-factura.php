<?php
include_once '../funciones/funciones.php';
include_once '../funciones/ruta.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Monterrey');


$id_compra = (int)$_POST['id_compra'];
$numero_factura = $_POST["numero"];
$fecha_pago = $_POST["fecha_pago"];
$monto = (float)$_POST["monto"];
$monto_iva = $monto * 1.16;
$fecha = date('d/m/Y', time());

 try {
    $conn->autocommit(false);
    //Insertar Factura
    $stmt1 = $conn->prepare("INSERT INTO factura (fecha,numero_factura,fecha_pago,monto_antes_iva,monto_despues_iva) VALUES (?,?,?,?,?)");
    $stmt1->bind_param('sssdd', $fecha,$numero_factura,$fecha_pago,$monto,$monto_iva);
    $stmt1->execute();
    $id_insertado1 = $stmt1->insert_id;
    //Definir el ID de factura en compra
    $stmt2 = $conn->prepare("UPDATE compras SET id_factura=? WHERE id_compra=?");
    $stmt2->bind_param('ii', $id_insertado1,$id_compra);
    $stmt2->execute();
    

    if($stmt1->affected_rows) {
        $respuesta = array(
            'respuesta' => 'exito'
        );
    } else {
        $respuesta = array(
            'respuesta' => 'error'
        );
    }
    $conn->autocommit(true);
    $stmt1->close();
    $stmt2->close();
    $conn->close();
        
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));


