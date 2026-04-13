<?php
class Usuario {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function cadastrar($nome, $email, $senha, $tipo = 'leitor'){
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        if($stmt->get_result()->num_rows > 0) return false;

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO usuarios (nome,email,senha,tipo) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $nome,$email,$senha_hash,$tipo);

        return $stmt->execute();
    }

    public function login($email, $senha){
        $stmt = $this->db->prepare("SELECT id,nome,senha,tipo FROM usuarios WHERE email=?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $res = $stmt->get_result();

        if($res->num_rows === 1){
            $user = $res->fetch_assoc();

            if(password_verify($senha,$user['senha'])){
                return $user; // CORRIGIDO
            }
        }
        return false;
    }

    public function buscarPorId($id){
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function atualizar($id,$nome,$email){
        $stmt = $this->db->prepare("UPDATE usuarios SET nome=?, email=? WHERE id=?");
        $stmt->bind_param("ssi",$nome,$email,$id);
        return $stmt->execute();
    }

    public function excluir($id){
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id=?");
        $stmt->bind_param("i",$id);
        return $stmt->execute();
    }
}
?>