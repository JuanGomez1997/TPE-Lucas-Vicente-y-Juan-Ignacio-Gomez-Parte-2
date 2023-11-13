<?php
    class ModeloGeneros{
        private $db_bibliotea;
        public function __construct(){
            $this->db_bibliotea = new PDO('mysql:host=localhost;'.'dbname=biblioteca;charset=utf8', 'root', '');
        }

        public function obtenerGeneros(){
            $query = $this->db_bibliotea->prepare("SELECT * FROM generos");
            $query->execute();
            $generos = $query->fetchAll(PDO::FETCH_OBJ);
            return $generos;
        }

        public function obtenerGenerosId($id){
            $query = $this->db_bibliotea->prepare("SELECT * FROM libros JOIN generos ON libros.genero=generos.id_genero WHERE generos.id_genero=?");
            $query->execute([$id]);
            $generos = $query->fetchAll(PDO::FETCH_OBJ);
            return $generos;
        }  

              


    }