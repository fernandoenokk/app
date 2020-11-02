<?php


class Movimiento
{
    // Connection
    private $conn;

    // Table
    private $db_table = "movimientos";

    // Columns
    public $id;
    public $fecha;
    public $costo;
    public $tieneDetalle;
    public $proyecto_id;
    public $centroCosto_id;
    public $tipoMovimiento_id;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getMovimientos(){
        $sqlQuery = "SELECT id, fecha, costo, tieneDetalle, proyecto_id, centroCosto_id, tipoMovimiento_id, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createMovimiento(){
        $sqlQuery = "INSERT INTO ". $this->db_table ." SET fecha = :fecha, costo = :costo, tieneDetalle = :tieneDetalle, proyecto_id = :proyecto_id, centroCosto_id = :centroCosto_id, tipoMovimiento_id = :tipoMovimiento_id, created_at = :created_at, updated_at = :updated_at";
        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->fecha=htmlspecialchars(strip_tags($this->fecha));
        $this->costo=htmlspecialchars(strip_tags($this->costo));
        $this->tieneDetalle=htmlspecialchars(strip_tags($this->tieneDetalle));
        $this->proyecto_id=htmlspecialchars(strip_tags($this->proyecto_id));
        $this->centroCosto_id=htmlspecialchars(strip_tags($this->centroCosto_id));
        $this->tipoMovimiento_id=htmlspecialchars(strip_tags($this->tipoMovimiento_id));

        // bind data
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":costo", $this->costo);
        $stmt->bindParam(":tieneDetalle", $this->tieneDetalle);
        $stmt->bindParam(":proyecto_id", $this->proyecto_id);
        $stmt->bindParam(":centroCosto_id", $this->centroCosto_id);
        $stmt->bindParam(":tipoMovimiento_id", $this->tipoMovimiento_id);

        $timestamp = date("Y-m-d H:i:s");
        $stmt->bindParam(":created_at", $timestamp);
        $stmt->bindParam(":updated_at", $timestamp);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // UPDATE DETALLE
    public function updateDetalle(){
        $sqlQuery = "UPDATE ". $this->db_table ." SET tieneDetalle = :tieneDetalle, updated_at = :updated_at WHERE id = :id";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->tieneDetalle=htmlspecialchars(strip_tags($this->tieneDetalle));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":tieneDetalle", $this->tieneDetalle);
        $stmt->bindParam(":id", $this->id);

        $timestamp = date("Y-m-d H:i:s");
        $stmt->bindParam(":updated_at", $timestamp);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}