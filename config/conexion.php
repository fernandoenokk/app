<?php

class Conexion {

    public $miConexion;

    function conectar() {

        $hostname='127.0.0.1';
        $database='db_verdeurbano';
        $username='db_user';
        $password='IgnaFer2020';

        $this->miConexion = new mysqli($hostname, $username, $password, $database);
        if ($this->miConexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->miConexion->connect_errno . ") ";
        }
    }

    function desconectar() {
        if ($this->miConexion != null) {
            $this->miConexion->close();
        }
    }

}