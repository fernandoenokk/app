<?php


class Detalle
{
    // Connection
    private $conn;

    // Table
    private $db_table = "detalles";

    // Columns
    public $id;
    public $descripcion;
    public $movimiento_id;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getDetalles(){
        $sqlQuery = "SELECT id, descripcion, movimiento_id, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createDetalle(){
        $sqlQuery = "INSERT INTO ". $this->db_table ." SET descripcion = :descripcion, movimiento_id = :movimiento_id, created_at = :created_at, updated_at = :updated_at";
        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->movimiento_id=htmlspecialchars(strip_tags($this->movimiento_id));

        // bind data
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":movimiento_id", $this->movimiento_id);

        $timestamp = date("Y-m-d H:i:s");
        $stmt->bindParam(":created_at", $timestamp);
        $stmt->bindParam(":updated_at", $timestamp);

        if($stmt->execute()){
            return true;
        }
        return false;
    }


}