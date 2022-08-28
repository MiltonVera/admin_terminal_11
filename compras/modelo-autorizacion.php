<?php
include_once '../funciones/funciones.php';
include_once '../funciones/ruta.php';





if($_POST['registro'] == 'eliminar'){

    $id_autorizacion = $_POST['id_autorizacion'];
    $id_requisicion = $_POST["id_requisicion"];


    try {
        $conn->autocommit(false);
        //borrar autorizacion
        $stmt1 = $conn->prepare("DELETE FROM autorizacion WHERE id_autorizacion = ?");
        $stmt1->bind_param('i', $id_autorizacion);
        $stmt1->execute();
        //borrar requisicion
        $stmt2 = $conn->prepare("DELETE FROM requisicion WHERE id_requisicion = ?");
        $stmt2->bind_param('i', $id_requisicion);
        $stmt2->execute();
        //borrar orden_compra
        $stmt3 = $conn->prepare("DELETE FROM orden WHERE id_orden_compra = ?");
        $stmt3->bind_param('i', $id_requisicion);
        $stmt3->execute();
        //Actualizar estado de compra
        $stmt4 = $conn->prepare("UPDATE compras SET status='Denegado' WHERE id_compra=?");
        $stmt4->bind_param('i',$id_requisicion);
        $stmt4->execute();

        if($stmt1->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
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
}

if($_POST['registro'] == 'aceptar'){

    $id_autorizacion = $_POST['id_autorizacion'];
    $id_requisicion = $_POST["id_requisicion"];


    try {
        $conn->autocommit(false);
        //borrar autorizacion
        $stmt1 = $conn->prepare("DELETE FROM autorizacion WHERE id_autorizacion = ?");
        $stmt1->bind_param('i', $id_autorizacion);
        $stmt1->execute();
        //Actualizar orden_compra
        $stmt3 = $conn->prepare("UPDATE orden SET mostrar='True' WHERE id_orden_compra=?");
        $stmt3->bind_param('i', $id_requisicion);
        $stmt3->execute();
        //Actualizar estado de compra
        $stmt4 = $conn->prepare("UPDATE compras SET status='Orden Compra' WHERE id_compra=?");
        $stmt4->bind_param('i',$id_requisicion);
        $stmt4->execute();

        if($stmt1->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }

        $conn->autocommit(true);
        $stmt1->close();
        $stmt3->close();
        $stmt4->close();
        $conn->close();
        
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}