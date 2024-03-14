<?php
class Conexao
{
    private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $base  = "dbcad";
        private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user , $this->pass) or die ("Conexao com o banco ".mysqli_error($this->conn));
        mysqli_select_db($this->conn,$this->base)or die ("erro ao conectar ".mysqli_error($this->conn));

    }
    public function getConn()
    {
        return $this->conn;
    }
}

