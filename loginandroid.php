<?php

include 'config/conexion.php';

if(strstr( $_SERVER[ 'HTTP_USER_AGENT' ], 'Android')){
    $response = array();
    $response = false;
    if(isset($_POST['usuario']) && isset($_POST['password'])){
        $user = $_POST['usuario'];
        $pass = $_POST['password'];

        $conexion = new Conexion();
        $conexion->conectar();
        $sql = "select * from users where email = ?";
        $stmt = $conexion->miConexion->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $resultados = $stmt->get_result();
        while ($fila = $resultados->fetch_assoc()) {
            $hash = $fila['password'];
            $rol = $fila['perfilUsuario_id'];
            if (password_verify($pass, $hash) && $rol == 1) {
                $response = true;
                
            }
        }       
        $conexion->desconectar();
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}