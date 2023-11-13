<?php
    require_once './app/vista/vistaAPI.php';
    
    abstract class ControladorApi {
        protected $Vista;
        private $dato;
        
        function __construct() {
            $this->Vista = new VistaApi();
            $this->dato = file_get_contents('php://input');
        }

        function MostrarDatos() {
            return json_decode($this->dato);
        }
    }
