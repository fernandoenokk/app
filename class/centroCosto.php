<?php


class CentroCosto
{
    // Connection
    private $conn;

    // Table
    private $db_table = "centro_costos";

    // Columns
    public $id;
    public $nombre;
    public $detalle;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getCentrosCostos(){
        $sqlQuery = "SELECT id, nombre, detalle, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

}