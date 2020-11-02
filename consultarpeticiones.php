<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'class/peticion.php';

$database = new Database();
$db = $database->getConnection();

$items = new Peticion($db);

$stmt = $items->getPeticiones();
$itemCount = $stmt->rowCount();

if($itemCount > 0){

    $Array = array();
    $Array["orden_compras"] = array();
    //$projectArray["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "asunto" => $asunto,
            "detalle" => $detalle,
            "fecha" => $fecha,
            "cliente_id" => $cliente_id,
            "estado_id" => $estado_id
        );

        array_push($Array["orden_compras"], $e);
    }
    echo json_encode($Array);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
