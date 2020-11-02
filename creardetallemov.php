<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'class/detalle.php';

$descripcion = $_POST['descripcion'];
$movimientoId = $_POST['movimiento_id'];

$database = new Database();
$db = $database->getConnection();

$item = new Detalle($db);

//values
$item->descripcion = $descripcion;
$item->movimiento_id = $movimientoId;

if($item->createDetalle()){
    echo 'Detalle creado exitosamente';
} else{
    echo 'Error no se pudo crear el detalle';
}

?>