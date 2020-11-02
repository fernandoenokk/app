<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'class/proyecto.php';

$database = new Database();
$db = $database->getConnection();

$items = new Proyecto($db);

$stmt = $items->getProyectos();
$itemCount = $stmt->rowCount();

if($itemCount > 0){

    $Array = array();
    $Array["proyectos"] = array();
    //$projectArray["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "nombre" => $nombre,
            "descripcion" => $descripcion,
            "fechaInicio" => $fechaInicio,
            "fechaTermino" => $fechaTermino,
            "comuna_id" => $comuna_id,
            "cliente_id" => $cliente_id,
            "estado_id" => $estado_id
        );

        array_push($Array["proyectos"], $e);
    }
    echo json_encode($Array);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
