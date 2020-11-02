<?php


class Peticion
{
    // Connection
    private $conn;

    // Table
    private $db_table = "orden_compras";

    // Columns
    public $id;
    public $asunto;
    public $detalle;
    public $fecha;
    public $cliente_id;
    public $estado_id;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getPeticiones(){
        $sqlQuery = "SELECT id, asunto, detalle, fecha, cliente_id, estado_id, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createPeticion(){
        $sqlQuery = "INSERT INTO ". $this->db_table ." SET asunto = :asunto, detalle = :detalle, fecha = :fecha, cliente_id = :cliente_id, estado_id = :estado_id, created_at = :created_at, updated_at = :updated_at";
        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->asunto=htmlspecialchars(strip_tags($this->asunto));
        $this->detalle=htmlspecialchars(strip_tags($this->detalle));
        $this->fecha=htmlspecialchars(strip_tags($this->fecha));
        $this->cliente_id=htmlspecialchars(strip_tags($this->cliente_id));
        $this->estado_id=htmlspecialchars(strip_tags($this->estado_id));

        // bind data
        $stmt->bindParam(":asunto", $this->asunto);
        $stmt->bindParam(":detalle", $this->detalle);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":cliente_id", $this->cliente_id);
        $stmt->bindParam(":estado_id", $this->estado_id);

        $timestamp = date("Y-m-d H:i:s");
        $stmt->bindParam(":created_at", $timestamp);
        $stmt->bindParam(":updated_at", $timestamp);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}