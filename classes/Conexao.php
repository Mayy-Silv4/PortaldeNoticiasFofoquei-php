<?php
class Conexao {
    private $host = "localhost";
    private $db = "fofoquei";
    private $user = "root";
    private $pass = "";

    public function conectar() {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($conn->connect_error) {
            die("Erro: " . $conn->connect_error);
        }

        return $conn;
    }
}
?>