<?php
include_once '../funciones/funciones.php';
include_once '../funciones/ruta.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($_POST['registro'] == 'enviar'){

    $id_orden = $_POST['id_orden'];


    try {
        //Editar estado
        $stmt1 = $conn->prepare("UPDATE orden SET enviado='True' WHERE id_orden_compra=?");
        $stmt1->bind_param('i', $id_orden);
        $stmt1->execute();
    

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

        $stmt1->close();
        $conn->close();
        
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}

if($_POST['registro'] == 'editar'){
    $id = (int)$_POST["id"];

    $cheque = $_POST["cheque"];
    $contado = $_POST["contado"];
    $credito = $_POST["credito"];

    $nombre_fiscal = $_POST["nombre_fiscal"];
    $rfc = $_POST["rfc"];
    $direccion = $_POST["direccion"];
    $cuenta = $_POST["cuenta"];
    $clabe = $_POST["clabe"];
    $banco = $_POST["banco"];
    $nombre_comercial = $_POST["nombre_comercial"];


    $cantidad = array_map('intval', $_POST["cantidad"]);
    $unidad = $_POST["unidad"];
    $concepto = $_POST["concepto"];
    $precio_unitario = array_map('doubleval', $_POST["precio_unitario"]);
    $importe = array();
    $subtotal = (double)0;
    for($i = 0;$i<count($cantidad);$i++){
        $importe[] = $cantidad[$i]*$precio_unitario[$i];
        $subtotal += $importe[$i];
    }
    $iva = $subtotal*0.16;
    $total = $subtotal+$iva;
    
    $productos_entrada = array();

    for($i = 0;$i<count($cantidad);$i++){
        $productos_entrada[] = array($cantidad[$i],$unidad[$i],$concepto[$i],$precio_unitario[$i],$importe[$i]);
    }

    $productos = json_encode($productos_entrada);
    

    try {
        $conn->autocommit(false);
        //Actualizar la orden de compra con lo datos
        $stmt1 = $conn->prepare("UPDATE orden SET cheque=?,contado=?,credito=?,nombre_fiscal=?,rfc=?,direccion=?,cuenta=?,clabe=?,banco=?,nombre_comercial=?,
                                productos=?,subtotal=?,iva=?,total=?,mostrar='False' WHERE id_orden_compra=?");
        $stmt1->bind_param('sssssssssssdddi', $cheque,$contado,$credito,$nombre_fiscal,$rfc,$direccion,$cuenta,$clabe,$banco,$nombre_comercial
                                            ,$productos,$subtotal,$iva,$total,$id);
        $stmt1->execute();
        //Introducir el registro para definir el pago
        $stmt2 = $conn->prepare('INSERT INTO pago (provedor,costo,id_orden) VALUES (?,?,?) ');
        $stmt2->bind_param("sds",$nombre_comercial,$total,$id );
        $stmt2->execute();
        //Actualizar el status de la compra
        $stmt3 = $conn->prepare('UPDATE compras SET status="Modo de Pago",costo_total=? WHERE id_compra=?');
        $stmt3->bind_param("di",$total,$id );
        $stmt3->execute();

        if($stmt1->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id
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
        $conn->close();
        
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}
