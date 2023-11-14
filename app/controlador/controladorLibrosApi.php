<?php
require_once './app/modelo/modeloLibros.php';
require_once './app/controlador/controladorApi.php';

class ControladorLibrosApi extends ControladorApi {
    private $modelo;

    function __construct () {
        parent::__construct();
        $this->modelo = new ModeloLibros();
    }

    function obtener ($params = []) {
        if (empty($params)) {
            $libros = $this->modelo->obtenerLibros();
            $this->vista->respuesta($libros, 200);
            return;
        }
        else {
            $libro = $this->modelo->obtenerLibroId($params[':ID']);
            if(!empty($libro)) {
                $this->vista->respuesta($libro, 200);
                return;
            }
            else {
                $this->vista->respuesta('El libro con el id=' . $params[':ID'] . ' no existe', 404);
                return;
            }
        }
    }

    public function crear () {
        $dato = $this->obtenerDatos();

        $titulo = $dato->titulo;
        $autor = $dato->autor;
        $sinopsis = $dato->sinopsis;
        $anio = $dato->anio;
        $genero = $dato->genero;
        $precio = $dato->precio;

        if (empty($titulo) || empty($autor) || empty($sinopsis) || empty($anio) || empty($genero) || empty($precio)) {
            $this->vista->respuesta("Complete los datos", 400);         
            return;
        }
        else {
            $id = $this->modelo->agregarLibro($titulo, $autor, $sinopsis, $anio, $genero, $precio);
            $libro = $this->modelo->obtenerLibroId($id);
            $this->vista->respuesta($libro, 201);
            return;
        }

    }

    function acutalizar($params = []) {
        $id = $params[';ID'];
        $libro = $this->modelo->obtenerLibroId($id);

        if ($libro) {
            $datos = $this->obtenerDatos();
            $titulo = $datos->titulo;
            $autor = $datos->autor;
            $sinopsis = $datos->sinopsis;
            $anio = $datos->anio;
            $genero = $datos->genero;
            $precio = $datos->precio;
            $disponibilidad = $datos->disponibilidad;

            if (empty($titulo) || empty($autor) || empty($sinopsis) || empty($anio) || empty($genero) || empty($precio) || empty($disponibilidad)) {
                $this->vista->respuesta("Faltan datos por completar", 400);
                return;
            }
            else {
                $this->modelo->editarLibro($titulo, $autor, $sinopsis, $anio, $genero, $precio, $disponibilidad, $id);
                $libro = $this->modelo->obtenerLibroId($id);
                $this->vista->respuesta($libro, 200);
                return;
            }
        }
        else {
            $this->vista->respuesta('El libro con el id=' . $id . ' no existe', 404);
            return;
        }
    }

    public function buscadorLibro($params = null){
        $titulo = $params[':TITULO'] ?? '';
        if (empty($titulo)) {
            $this->vista->respuesta("Por favor, proporcione un título", 400);
            return;
        }
    
        $librosEncontrados = $this->modelo->encontrarLibro($titulo);
    
        if (!$librosEncontrados) {
            $this->vista->respuesta("No se encontró ningún libro con el título proporcionado", 404);
            return;
        }
    
        $this->vista->respuesta($librosEncontrados, 200);
        return;
    }

}    