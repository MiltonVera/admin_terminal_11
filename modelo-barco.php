<?php
include_once 'funciones/funciones.php';
include_once 'funciones/ruta.php';

$id = $_POST['id_registro'];
$nombre = $_POST["nombre"];
$operacion = $_POST["operacion"];
$producto = $_POST["producto"];
$cantidad_producto = $_POST["cantidad_producto"];
$servicios = (float)$_POST["servicios"];
$maniobras = (float)$_POST["maniobras"];
$cobro = $servicios + $maniobras;

//Variables internas
//$directorio = "../DakarWeb/img/productos/";

if($_POST['registro'] == 'nuevo'){
    
    date_default_timezone_set('America/Monterrey');
    $fecha_inicio = date('d/m/Y h:i:s a', time());
    
    try {
        $stmt = $conn->prepare('INSERT INTO barcos (nombre_barco,fecha_inicio,operacion,producto,cantidad_producto,servicios,maniobras,cobro) VALUES (?,?,?,?,?,?,?,?) ');
        $stmt->bind_param("ssssssss", $nombre,$fecha_inicio,$operacion,$producto,$cantidad_producto,$servicios,$maniobras,$cobro);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
    
}

if($_POST['registro'] == 'cambio'){

    $id_cambio = $_POST['id'];
    $cambio = "facturado";
    date_default_timezone_set('America/Monterrey');
    $fecha_cambio = date('d/m/Y h:i:s a', time());
    try {
        $stmt = $conn->prepare("UPDATE barcos SET estatus=?,fecha_facturacion = ? WHERE id_barco = ?");
        $stmt->bind_param('ssi',$cambio,$fecha_cambio, $id_cambio);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_cambiado' => $id_cambio
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
    
}

if($_POST['registro'] == 'eliminar'){

    $id_borrar = $_POST['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM barcos WHERE id_barco = ?");
        $stmt->bind_param('i', $id_borrar);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}