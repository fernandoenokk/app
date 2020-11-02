<?php


class Actividad
{
    // Connection
    private $conn;

    // Table
    private $db_table = "actividades";

    // Columns
    public $id;
    public $fechaInicio;
    public $fechaTermino;
    public $horaInicio;
    public $horaTermino;
    public $detalle;
    public $proyecto_id;
    public $tipoActividad_id;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getActividades(){
        $sqlQuery = "SELECT id, fechaInicio, fechaTermino, horaInicio, horaTermino, detalle, proyecto_id, tipoActividad_id, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

}