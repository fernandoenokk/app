<?php


class Comuna
{
    // Connection
    private $conn;

    // Table
    private $db_table = "comunas";

    // Columns
    public $id;
    public $nombre;
    public $region_id;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getComunas(){
        $sqlQuery = "SELECT id, nombre, region_id, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

}