<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'class/movimiento.php';

$database = new Database();
$db = $database->getConnection();

$items = new Movimiento($db);

$stmt = $items->getMovimientos();
$itemCount = $stmt->rowCount();

if($itemCount > 0){

    $Array = array();
    $Array["movimientos"] = array();
    //$projectArray["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "fecha" => $fecha,
            "costo" => $costo,
            "tieneDetalle" => $tieneDetalle,
            "proyecto_id" => $proyecto_id,
            "centroCosto_id" => $centroCosto_id,
            "tipoMovimiento_id" => $tipoMovimiento_id
        );

        array_push($Array["movimientos"], $e);
    }
    echo json_encode($Array);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
