<?php
include_once '../funciones/funciones.php';
include_once '../funciones/ruta.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

   
    if(isset($_POST['registro'])){
        $nombre_fiscal = $_POST["nombre_fiscal"];
        $rfc = $_POST["rfc"];
        $direccion = $_POST["direccion"];
        $cuenta = $_POST["cuenta"];
        $clabe = $_POST["clabe"];
        $banco = $_POST["banco"];
        $nombre_comercial = $_POST["nombre_comercial"];
    try {
        
        //Insertandos los datos a la base de datos proveedores
        $stmt = $conn->prepare('INSERT INTO proveedores (nombre_fiscal, rfc,direccion, cuenta,clabe,banco,nombre_comercial) VALUES (?,?,?,?,?,?,?)');
        $stmt->bind_param("sssssss", $nombre_fiscal, $rfc, $direccion,$cuenta,$clabe,$banco,$nombre_comercial);
        $stmt->execute();
        $id_insertado1 = $stmt->insert_id;
        
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado1
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

}else{
    $id = (int)$_POST["id_proveedor"];
    $stmt = $conn->prepare("SELECT * FROM proveedores WHERE id_proveedor = ?");
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $datos = $stmt->get_result();
    $datos = $datos->fetch_assoc();
    
    $proveedor = array("nombre_fiscal" => $datos["nombre_fiscal"],"rfc" => $datos["rfc"] , "direccion" => $datos["direccion"],
                    "cuenta" => $datos["cuenta"], "clabe" => $datos["clabe"], "banco" => $datos["banco"],
                     "nombre_comercial" => $datos["nombre_comercial"]);
    error_log(print_r($proveedor,true));
    error_log(print_r(json_encode($proveedor),true));
    $stmt->close();
    $conn->close();
    die(json_encode($proveedor));

}


