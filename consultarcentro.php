<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'class/centroCosto.php';

$database = new Database();
$db = $database->getConnection();

$items = new CentroCosto($db);

$stmt = $items->getCentrosCostos();
$itemCount = $stmt->rowCount();

if($itemCount > 0){

    $Array = array();
    $Array["centro_costos"] = array();
    //$projectArray["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "nombre" => $nombre
        );

        array_push($Array["centro_costos"], $e);
    }
    echo json_encode($Array);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
