<?php
include_once '../funciones/funciones.php';
include_once '../funciones/ruta.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$id_pago = (int)$_POST['id_pago'];
$id_orden = (int)$_POST["id_orden"];
$tipo_pago = $_POST["tipo_pago"];

 try {
    $conn->autocommit(false);
    //Eliminar Pago
    $stmt1 = $conn->prepare("DELETE FROM pago WHERE id_pago=?");
    $stmt1->bind_param('i', $id_pago);
    $stmt1->execute();
    //Declarar tipo de pago en orden
    $stmt2 = $conn->prepare("UPDATE compras SET tipo_pago=?,status='Entrega Pendiente' WHERE id_compra=?");
    $stmt2->bind_param('si', $tipo_pago,$id_orden);
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


