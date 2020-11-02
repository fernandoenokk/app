<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'class/usuario.php';

$database = new Database();
$db = $database->getConnection();

$items = new Usuario($db);

$stmt = $items->getUsuarios();
$itemCount = $stmt->rowCount();

if($itemCount > 0){

    $Array = array();
    $Array["users"] = array();
    //$projectArray["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "nombre" => $nombre,
            "email" => $email,
            "perfilUsuario_id" => $perfilUsuario_id
        );

        array_push($Array["users"], $e);
    }
    echo json_encode($Array);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
