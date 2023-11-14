<?php
require_once './app/modelo/modeloGeneros.php';
require_once './app/controlador/controladorApi.php';

class ControladorGenerosApi extends ControladorApi{
    private $modelo;

    public function __construct(){
        parent::__construct();
        $this->modelo = new ModeloGeneros();
    }

    public function obtener ($params = []){
        if (empty($params)) {
            $generos=$this->modelo->obtenerGeneros();
            $this->vista->respuesta($generos);
        }
        else {
            $genero = $this->modelo->obtenerGeneroId($params[':ID']);
            if(!empty($genero)) {
                $this->vista->respuesta($genero, 200);
            }
            else {
                $this->vista->respuesta('El género con el id=' . $params[':ID'] . ' no existe', 404);
            }
        }
    }

    public function crear () {
        $dato = $this->obtenerDatos();
        $genero = $dato->genero;

        if (empty($genero)) {
            $this->vista->respuesta("Complete el dato", 400);         
            return;
        }
        else {
            $id = $this->modelo->agregarGenero($genero);
            $genero = $this->modelo->obtenerGeneroId($id);
            $this->vista->respuesta($genero, 201);
        }

    }

    function acutalizar($params = []) {
        $id = $params[';ID'];
        $genero = $this->modelo->obtenerGeneroId($id);

        if ($genero) {
            $datos = $this->obtenerDatos();
            $genero = $datos->genero;

            if (empty($genero)) {
                $this->vista->respuesta("Falta completar el dato", 400);
            }
            else {
                $this->modelo->actualizarGenero($genero, $id);
                $genero = $this->modelo->obtenerGeneroId($id);
                $this->vista->respuesta($genero, 200);
            }
        }
        else {
            $this->vista->respuesta('El género con el id=' . $id . ' no existe', 404);
        }
    }
    
}