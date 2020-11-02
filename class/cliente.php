<?php


class Cliente
{
    // Connection
    private $conn;

    // Table
    private $db_table = "clientes";

    // Columns
    public $id;
    public $rut;
    public $nombre;
    public $apellidos;
    public $celular;
    public $telefono;
    public $compañia;
    public $comuna_id;
    public $usuario_id;
    public $estado;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getClientes(){
        $sqlQuery = "SELECT id, rut, nombre, apellidos, celular, telefono, compañia, comuna_id, usuario_id, estado, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

}