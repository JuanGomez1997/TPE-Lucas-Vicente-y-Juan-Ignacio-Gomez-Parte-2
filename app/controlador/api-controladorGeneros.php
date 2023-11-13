<?php
require_once './app/modelo/modeloGeneros.php';
require_once './app/vista/vistaAPI.php';
require_once './app/controlador/controladorApi.php';

    class ControladorGeneros extends ControladorApi{
        private $modeloGenero;

        public function __construct(){
            parent::__construct();
            $this->modeloGenero=new ModeloGeneros();
        }

        public function listarGeneros(){
            $generos=$this->modeloGenero->obtenerGeneros();
            $this->Vista->respuesta($generos);
        }

        public function listarLibrosporGenero($params = null){
            $id = $params[':ID'];
            $genero=$this->modeloGenero->obtenerGenerosId($id);
            if ($genero){
                $this->Vista->respuesta($genero,200);
            } else {
                $this->Vista->respuesta("El genero con el ID=$id no existe",404);
            }

           
        }
     
    }