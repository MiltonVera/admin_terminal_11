<?php
include_once '../funciones/funciones.php';
include_once '../funciones/ruta.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Monterrey');

$id_compra = (int)$_POST["id_compra"];
$fecha = date('d/m/Y', time());
    
    try {
       
        $stmt1 = $conn->prepare('UPDATE compras SET status="Entregado",fecha=? WHERE id_compra=? ');
        $stmt1->bind_param("si",$fecha ,$id_compra);
        $stmt1->execute();
      
        if($stmt1->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                "id_insertado" => $stmt1->insert_id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                "error" => $conn->error
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

    


