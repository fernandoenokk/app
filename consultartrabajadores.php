<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'class/trabajador.php';

$database = new Database();
$db = $database->getConnection();

$items = new Trabajador($db);

$stmt = $items->getTrabajadores();
$itemCount = $stmt->rowCount();

if($itemCount > 0){

    $Array = array();
    $Array["trabajadores"] = array();
    //$projectArray["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "rut" => $rut,
            "nombre" => $nombre,
            "apellidos" => $apellidos,
            "edad" => $edad,
            "celular" => $celular,
            "email" => $email,
            "estado" => $estado
        );

        array_push($Array["trabajadores"], $e);
    }
    echo json_encode($Array);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
