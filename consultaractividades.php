<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'class/actividad.php';

$database = new Database();
$db = $database->getConnection();

$items = new Actividad($db);

$stmt = $items->getActividades();
$itemCount = $stmt->rowCount();

if($itemCount > 0){

    $Array = array();
    $Array["actividades"] = array();
    //$projectArray["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "fechaInicio" => $fechaInicio,
            "fechaTermino" => $fechaTermino,
            "horaInicio" => $horaInicio,
            "horaTermino" => $horaTermino,
            "detalle" => $detalle,
            "proyecto_id" => $proyecto_id
        );

        array_push($Array["actividades"], $e);
    }
    echo json_encode($Array);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
