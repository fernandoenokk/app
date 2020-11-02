<?php


class TipoMovimiento
{
    // Connection
    private $conn;

    // Table
    private $db_table = "tipo_movimientos";

    // Columns
    public $id;
    public $descripcion;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getTipoMovimientos(){
        $sqlQuery = "SELECT id, descripcion, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }


}