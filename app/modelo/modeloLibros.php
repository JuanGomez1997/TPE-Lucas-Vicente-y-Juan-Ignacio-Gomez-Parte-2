<?php

    class ModeloLibros {
        private $db;

        function __construct() {
            $this->db = new PDO('mysql:host=localhost;dbname=biblioteca;charset=utf8', 'root', '');    
        }

        function obtenerLibros () {
            $query = $this->db->prepare('SELECT * FROM libros JOIN generos ON libros.genero=generos.id_genero');
            $query->execute();
            $libros = $query->fetchAll(PDO::FETCH_OBJ);
            return $libros;
        }

        public function obtenerLibroId ($id){
            $query = $this->db->prepare('SELECT * FROM libros JOIN generos ON libros.genero=generos.id_genero WHERE id=?');
            $query->execute([$id]);
            $libro = $query->fetchAll(PDO::FETCH_OBJ);
            return  $libro;
        }  

        public function InsertarLibro ($titulo, $autor, $sinopsis, $anio, $genero, $precio) {
            $query = $this->db->prepare('INSERT INTO libros (titulo, autor, sinopsis, anio, genero, precio, disponibilidad) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $query->execute([$titulo, $autor, $sinopsis, $anio, $genero, $precio,1]);
            return $this->db->lastInsertId();
        }

        public function encontrarLibro($titulo){
            $query = $this->db->prepare('SELECT * FROM libros JOIN generos ON libros.genero=generos.id_genero WHERE titulo=?');
            $query->execute([$titulo]);
            $libros = $query->fetchAll(PDO::FETCH_OBJ);
            return $libros;
        }
        
    }