<?php

require_once "modelo.php";

class ModeloLibros extends Modelo {
    protected $db;

    function obtenerLibros () {
        $query = $this->db->prepare('SELECT * FROM libros JOIN generos ON libros.genero=generos.id_genero ORDER BY libros.id');
        $query->execute();
        $libros = $query->fetchAll(PDO::FETCH_OBJ);
        return $libros;
    }

    public function obtenerLibroId ($id) {
        $query = $this->db->prepare('SELECT * FROM libros JOIN generos ON libros.genero=generos.id_genero WHERE id=?');
        $query->execute([$id]);
        $libro = $query->fetchAll(PDO::FETCH_OBJ);
        return $libro;
    }  

    public function agregarLibro ($titulo, $autor, $sinopsis, $anio, $genero, $precio) {
        $query = $this->db->prepare('INSERT INTO libros (titulo, autor, sinopsis, anio, genero, precio, disponibilidad) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $query->execute([$titulo, $autor, $sinopsis, $anio, $genero, $precio, 1]);
        return $this->db->lastInsertId();
    }

    public function editarLibro ($titulo, $autor, $sinopsis, $anio, $genero, $precio, $disponibilidad, $id) {
        $query = $this->db->prepare('UPDATE libros SET titulo=?, autor=?, sinopsis=?, anio=?, genero=?, precio=?, disponibilidad=? WHERE libros.id=?');
        $query->execute([$titulo, $autor, $sinopsis, $anio, $genero, $precio, $disponibilidad, $id]);
    }

    public function eliminarLibro ($id) {
        $query = $this->db->prepare('DELETE FROM libros WHERE id=?');
        $query->execute([$id]);
    }

    public function obtenerLibroGenero ($genero) {
        $query = $this->db->prepare('SELECT * FROM libros WHERE genero=?');
        $query->execute([$genero]);
        $libro = $query->fetchAll(PDO::FETCH_OBJ);
        return $libro;
    }
    
        public function encontrarLibro($titulo){
            $query = $this->db->prepare('SELECT * FROM libros JOIN generos ON libros.genero=generos.id_genero WHERE titulo=?');
            $query->execute([$titulo]);
            $libros = $query->fetchAll(PDO::FETCH_OBJ);
            return $libros;
        }
        
    }