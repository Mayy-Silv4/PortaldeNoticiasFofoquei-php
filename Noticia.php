<?php
class Noticia {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    // 🔥 CRIAR NOTÍCIA
    public function criar($titulo, $noticia, $autor, $categoria, $imagem = null){

        $stmt = $this->db->prepare(
            "INSERT INTO noticias (titulo, noticia, autor, imagem, data, categoria)
             VALUES (?, ?, ?, ?, NOW(), ?)"
        );

        // todos são string
        $stmt->bind_param("sssss", $titulo, $noticia, $autor, $imagem, $categoria);

        return $stmt->execute();
    }

    // 🔥 LISTAR
    public function listar($categoria = null){

        if(!$categoria || $categoria == 'ultimas'){
            $stmt = $this->db->prepare(
                "SELECT * FROM noticias ORDER BY data DESC"
            );
        } else {
            $stmt = $this->db->prepare(
                "SELECT * FROM noticias WHERE categoria = ? ORDER BY data DESC"
            );
            $stmt->bind_param("s", $categoria);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    // 🔥 BUSCAR
    public function buscar($id){
        $stmt = $this->db->prepare(
            "SELECT * FROM noticias WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 🔥 ATUALIZAR (CORRIGIDO E ALINHADO)
    public function atualizar($id, $titulo, $noticia, $autor, $imagem, $categoria){

        $stmt = $this->db->prepare(
            "UPDATE noticias 
             SET titulo = ?, noticia = ?, imagem = ?, categoria = ?
             WHERE id = ? AND autor = ?"
        );

        // id = int, resto string
        $stmt->bind_param(
            "ssssis",
            $titulo,
            $noticia,
            $imagem,
            $categoria,
            $id,
            $autor
        );

        return $stmt->execute();
    }

    // 🔥 EXCLUIR (CORRIGIDO)
    public function excluir($id, $autor){

        $stmt = $this->db->prepare(
            "DELETE FROM noticias WHERE id = ? AND autor = ?"
        );

        $stmt->bind_param("is", $id, $autor);

        return $stmt->execute();
    }
}
?>