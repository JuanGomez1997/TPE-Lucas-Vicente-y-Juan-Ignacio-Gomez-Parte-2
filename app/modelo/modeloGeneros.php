<?php

require_once "modelo.php";

class ModeloGeneros extends Modelo {
    protected $db;

    public function obtenerGeneros() {
        $query = $this->db->prepare("SELECT * FROM generos");
        $query->execute();
        $generos = $query->fetchAll(PDO::FETCH_OBJ);
        return $generos;
    }

    public function obtenerGeneroId($id) {
        $query = $this->db->prepare('SELECT * FROM generos WHERE id_genero=?');
        $query->execute([$id]);
        $genero = $query->fetchAll(PDO::FETCH_OBJ);
        return $genero;
    }

    public function agregarGenero($genero) {
        $query = $this->db->prepare('INSERT INTO generos(genero) VALUES (?)');
        $query->execute([$genero]);
        return $this->db->lastInsertId();
    }

    public function eliminarGenero($id) {
        $query = $this->db->prepare('DELETE FROM generos WHERE id_genero=?');
        $query->execute([$id]);
    }

    public function actualizarGenero($genero, $id) {
        $query = $this->db->prepare('UPDATE generos SET genero=? WHERE generos.id_genero=?');
        $query->execute([$genero, $id]);
    }

}