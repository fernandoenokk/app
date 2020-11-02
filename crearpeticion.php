<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'class/peticion.php';

$asunto = $_POST['asunto'];
$detalle = $_POST['detalle'];
$fecha = $_POST['fecha'];
$cliente_id = $_POST['cliente_id'];
$estado_id =$_POST['estado_id'];

$database = new Database();
$db = $database->getConnection();

$item = new Peticion($db);

//values
$item->asunto = $asunto;
$item->detalle = $detalle;
$item->fecha = $fecha;
$item->cliente_id = $cliente_id;
$item->estado_id = $estado_id;

if($item->createMovimiento()){
    echo 'Movimiento creado exitosamente';
} else{
    echo 'Error no se pudo crear el movimiento';
}

?>