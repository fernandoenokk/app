<?php


class Usuario
{
    // Connection
    private $conn;

    // Table
    private $db_table = "users";

    // Columns
    public $id;
    public $name;
    public $email;
    public $email_verified_at;
    public $password;
    public $imagen;
    public $perfilUsuario_id;
    public $remember_token;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getUsuarios(){
        $sqlQuery = "SELECT id, name, email, email_verified_at, password, imagen, perfilUsuario_id, remember_token, created_at, updated_at FROM ". $this->db_table ."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }


}