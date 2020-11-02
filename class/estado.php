<?php


class Estado
{
    // Connection
    private $conn;

    // Table
    private $db_table = "estados";

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
    public function getEstados(){
        $sqlQuery = "SELECT id, descripcion, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }


}