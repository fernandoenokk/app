<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'class/movimiento.php';

$fecha = $_POST['fecha'];
$costo = $_POST['costo'];
$tieneDetalle = $_POST['tieneDetalle'];
$proyecto_id = $_POST['proyecto_id'];
$centroCosto_id =$_POST['centroCosto_id'];
$tipoMovimiento_id =$_POST['tipoMovimiento_id'];

$database = new Database();
$db = $database->getConnection();

$item = new Movimiento($db);

//values
$item->fecha = $fecha;
$item->costo = $costo;
$item->tieneDetalle = $tieneDetalle;
$item->proyecto_id = $proyecto_id;
$item->centroCosto_id = $centroCosto_id;
$item->tipoMovimiento_id = $tipoMovimiento_id;

if($item->createMovimiento()){
    echo 'Movimiento creado exitosamente';
} else{
    echo 'Error no se pudo crear el movimiento';
}

?>