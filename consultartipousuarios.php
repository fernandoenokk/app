<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'class/perfilUsuario.php';

$database = new Database();
$db = $database->getConnection();

$items = new PerfilUsuario($db);

$stmt = $items->getPerfilUsuarios();
$itemCount = $stmt->rowCount();

if($itemCount > 0){

    $Array = array();
    $Array["perfil_usuarios"] = array();
    //$projectArray["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "descripcion" => $descripcion
        );

        array_push($Array["perfil_usuarios"], $e);
    }
    echo json_encode($Array);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
