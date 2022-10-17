<?php 
include_once '../funciones/funciones.php';
include_once '../funciones/ruta.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$mes = (int)$_POST["mes"];
$anio = (int)$_POST["anio"];
$area = $_POST["area"];
$clasificacion = $_POST["clasificacion"];

$array_mes = array();
$array_anio= array();
$array_clasificacion= array();
$array_area= array();

$especifico = array(false,false,false,false,false);
try {
    $conn->autocommit(false);

    //Consulta a la base de datos para cuando los datos son sin filtro
    $stmt1 = $conn->prepare("SELECT id_compra,area,costo_total,clasificacion FROM `compras` WHERE status='Entregado'");
    $stmt1->execute();
    $datos_general = array();
    $general = $stmt1->get_result();
    //Metemos los datos de la base de datos dentro de un array asociativo
    while($fila = $general->fetch_assoc()){
        $datos_general[] = $fila;
    }
    //Creamos un array de ids de los datos generales para definir en caso general
    $datos_general_ids = array();
    foreach($datos_general as $registro){
        $datos_general_ids[] = $registro["id_compra"];
    }
    //Obtener el array de meses en caso de ser especifico
    if($mes != 0){
    $especifico[0] = true;
    $stmt2 = $conn->prepare("SELECT id_compra FROM `compras` WHERE MONTH(STR_TO_DATE(fecha, '%d/%m/%Y')) = ?");
    $stmt2->bind_param("i", $mes);
    $stmt2->execute();
    //Creamos un array con los datos filtrados
    $datos_mes = $stmt2->get_result();
    while($fila = $datos_mes->fetch_assoc()){
        $array_mes[] = $fila["id_compra"];
    }
    $stmt2->close();
    }else{
        //En caso de ser general igualamos el array de los meses a los datos generales
        $array_mes = $datos_general_ids;
    }


    //Obtener el array de años en caso de ser especifico
    if($anio != 0){
        $especifico[1] = true;
        $stmt3 = $conn->prepare("SELECT id_compra FROM `compras` WHERE YEAR(STR_TO_DATE(fecha, '%d/%m/%Y')) = ?");
        $stmt3->bind_param("i", $anio);
        $stmt3->execute();
        //Creamos un array con los datos filtrados
        $datos_anio = $stmt3->get_result();
        while($fila = $datos_anio->fetch_assoc()){
            $array_anio[] = $fila["id_compra"];
        }
        $stmt3->close();
    }else{
        $array_anio = $datos_general_ids;
    }

    //Obtenemos el array de areas en caso de ser especifico
    if($area != "todos"){
        $especifico[2] = true;
        $stmt4 = $conn->prepare("SELECT id_compra FROM `compras` WHERE area = ?");
        $stmt4->bind_param("s", $area);
        $stmt4->execute();
        //Creamos un array con los datos filtrados
        $datos_area = $stmt4->get_result();
        while($fila = $datos_area->fetch_assoc()){
            $array_area[] = $fila["id_compra"];
        }
        $stmt4->close();
    }else{
        $array_area = $datos_general_ids;
    }
    //Obtenemos el array de clasificacion en caso de der especifico
    if($clasificacion != "todos"){
        $especifico[3] = true;
        $stmt5 = $conn->prepare("SELECT id_compra FROM `compras` WHERE clasificacion = ?");
        $stmt5->bind_param("s", $clasificacion);
        $stmt5->execute();
        //Creamos un array con los datos filtrados
        $datos_clasificacion = $stmt5->get_result();
        while($fila = $datos_clasificacion->fetch_assoc()){
            $array_clasificacion[] = $fila["id_compra"];
        }
        $stmt5->close();
    }else{
        $array_clasificacion = $datos_general_ids;
    }
    
    //Creamos un arreglo que sea la interseccion de todos los arreglos pasados
    $consulta_filtrada = array_intersect($array_mes,$array_anio,$array_area,$array_clasificacion);

    //Creamos un arreglo asociativo en el que se puedan ir sumando los costos
    $gasto_area = array("Administracion" => 0,"Contabilidad"=> 0,"Recursos_Humanos"=> 0,
                        "Seguridad"=> 0,"Medio_Ambiente"=> 0,"Recinto_Fiscal"=> 0,
                        "Almacen"=> 0,"Operacion"=> 0,"Ingenieria"=> 0, "Mantenimiento"=> 0, "Direccion" => 0, "Comercial" => 0);
    
   //Usando los ids resultado de la consulta y la base de datos original llenamos gasto area
   foreach($consulta_filtrada as $id){
        //Buscamos el id en la base de datos original
        foreach($datos_general as $registro){

            if($registro["id_compra"] == $id){
                //Se encontro el registro correspondiente
                //Guardamos el area
                $area = $registro["area"];
                //atrapamos los atipicos
                if($area == "Recursos Humanos"){
                    $gasto_area["Recursos_Humanos"] += (float)$registro["costo_total"];
                }
                else if($area == "Medio Ambiente" ){
                    $gasto_area["Medio_Ambiente"] += (float)$registro["costo_total"];
                }else if($area == "Recinto Fiscal"){
                    $gasto_area["Recinto_Fiscal"] += (float)$registro["costo_total"];
                }
                else{
                    $gasto_area[$area] += (float)$registro["costo_total"];
                }
                

            }
        }
   }

   //Contando con los gastos de cada area procedemos a convertir el array asociativo en dos arrays
   $labels = array_keys($gasto_area);
   $values = array_values($gasto_area);

    if($stmt1->affected_rows) {
        $respuesta = array(
            'respuesta' => 'exito',
            'labels' => $labels,
            'values' => $values

        );
    } else {
        $respuesta = array(
            'respuesta' => 'error'
        );
    }


    //Analizar los casos especificos y devolver 


    $conn->autocommit(true);
    $stmt1->close();
    $conn->close();

    
} catch (Exception $e) {
    $respuesta = array(
        'respuesta' => $e->getMessage()
    );
}
die(json_encode($respuesta));


?>