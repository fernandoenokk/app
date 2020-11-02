<?php


class Proyecto
{
    // Connection
    private $conn;

    // Table
    private $db_table = "proyectos";

    // Columns
    public $id;
    public $nombre;
    public $descripcion;
    public $fechaInicio;
    public $fechaTermino;
    public $comuna_id;
    public $cliente_id;
    public $estado_id;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getProyectos(){
        $sqlQuery = "SELECT id, nombre, descripcion, fechaInicio, fechaTermino, comuna_id, cliente_id, estado_id, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // READ single
    public function getProyecto(){
        $sqlQuery = "SELECT id, nombre, descripcion, fechaInicio, fechaTermino, comuna_id, cliente_id, estado_id, created_at, updated_at FROM ". $this->db_table ." WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->nombre = $dataRow['nombre'];
        $this->descripcion = $dataRow['descripcion'];
        $this->fechaInicio = $dataRow['fechaInicio'];
        $this->fechaTermino = $dataRow['fechaTermino'];
        $this->comuna_id = $dataRow['comuna_id'];
        $this->cliente_id = $dataRow['cliente_id'];
        $this->estado_id = $dataRow['estado_id'];
        $this->created_at = $dataRow['created_at'];
        $this->updated_at = $dataRow['updated_at'];
    }

}