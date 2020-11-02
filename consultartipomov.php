<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'class/tipoMovimiento.php';

$database = new Database();
$db = $database->getConnection();

$items = new TipoMovimiento($db);

$stmt = $items->getTipoMovimientos();
$itemCount = $stmt->rowCount();

if($itemCount > 0){

    $Array = array();
    $Array["tipo_movimientos"] = array();
    //$projectArray["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "descripcion" => $descripcion
        );

        array_push($Array["tipo_movimientos"], $e);
    }
    echo json_encode($Array);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
