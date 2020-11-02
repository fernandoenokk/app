<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'class/movimiento.php';

$id = $_POST['id'];
$tieneDetalle = $_POST['tieneDetalle'];

$database = new Database();
$db = $database->getConnection();

$item = new Movimiento($db);

//values
$item->id = $id;
$item->tieneDetalle = $tieneDetalle;

if($item->updateDetalle()){
    echo json_encode("Detalle Actualizado");
} else{
    echo json_encode("No se Actualizo");
}

?>