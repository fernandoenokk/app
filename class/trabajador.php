<?php


class Trabajador
{
    // Connection
    private $conn;

    // Table
    private $db_table = "trabajadores";

    // Columns
    public $id;
    public $rut;
    public $nombre;
    public $apellidos;
    public $edad;
    public $celular;
    public $email;
    public $estado;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getTrabajadores(){
        $sqlQuery = "SELECT id, rut, nombre, apellidos, edad, celular, email, estado, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

}