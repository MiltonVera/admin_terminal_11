<?php

//error_reporting(-1); // reports all errors
//ini_set("display_errors", "1"); // shows all errors
//ini_set("log_errors", 1);
//ini_set("error_log", "/tmp/php-error.log");
include_once 'funciones/funciones.php';

date_default_timezone_set('America/Monterrey');

$id = $_POST['id_saldo'];
$fecha = date('d/m/Y', time());
$banbajio = (float)$_POST["banbajio"];
$banregio = (float)$_POST["banregio"];
$banorte = (float)$_POST["banorte"];
$bancobase = (float)$_POST["bancobase"];
$gastos =(float) $_POST["gastos"];
$ingresos = (float) $_POST["ingresos"];
$suma = $ingresos-$gastos;
$saldo = $banbajio+$banregio+$banorte+$bancobase;


if($_POST['registro'] == 'nuevo'){
    try {
        $sql = "SELECT saldo from saldos ORDER BY id_saldo DESC LIMIT 1"; // SQL with parameters
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $saldo_anterior = $result->fetch_assoc(); // fetch data
        $saldo_anterior = $saldo_anterior["saldo"];

        $stmt = $conn->prepare('INSERT INTO saldos(saldo_anterior,banbajio,banregio,banorte,bancobase,gastos,ingresos,suma,saldo,fecha) VALUES (?,?,?,?,?,?,?,?,?,?) ');
        $stmt->bind_param("ddddddddds", $saldo_anterior,$banbajio,$banregio,$banorte,$bancobase,$gastos,$ingresos,$suma,$saldo,$fecha);
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

