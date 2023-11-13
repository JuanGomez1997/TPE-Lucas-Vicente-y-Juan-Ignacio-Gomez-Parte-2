<?php
require_once './app/modelo/modeloLibros.php';
require_once './app/controlador/controladorApi.php';
require_once './app/vista/vistaAPI.php';

class ControladorLibros extends ControladorApi{
    private $modelo;

    function __construct () {
        parent::__construct();
        $this->modelo = new ModeloLibros();
    }

    public function mostrarLista() {
        $libros = $this->modelo->obtenerLibros();
        $this->Vista->respuesta($libros,200);
    }

    public function mostrarLibroId($params = null) {
        $id = $params[':ID'];
        $libros = $this->modelo->obtenerLibroId($id);
        if ($libros){
            $this->Vista->respuesta($libros,200);
        }else{
            $this->Vista->respuesta("El libro con el $id no existe",404);
        }
        
    }

    public function aniadirLibro() {
        $dato= $this->MostrarDatos();

        $titulo = $dato->titulo;
        $autor = $dato->autor;
        $sinopsis = $dato->sinopsis;
        $anio = $dato->anio;
        $genero = $dato->genero;
        $precio = $dato->precio;

        if (empty($titulo) || empty($autor) || empty($sinopsis) || empty($anio) || empty($genero) || empty($precio)) {
            $this->Vista->respuesta("Complete los datos", 400);         
            return;
        }else {
            $id = $this->modelo->insertarLibro($titulo, $autor, $sinopsis, $anio, $genero, $precio);
            $libro = $this->modelo->obtenerLibroId($id);
            $this->Vista->respuesta($libro, 201);
        }

    }

    public function buscadorLibro(){
        $dato= $this->MostrarDatos();
        if (empty($dato->titulo)) {
            $this->Vista->respuesta("Por favor, proporcione un título", 400);
            return;
        }
        $titulo = $dato->titulo;
        $librosEncontrado = $this->modelo->encontrarLibro($titulo);
        if (!$librosEncontrado) {
            $this->Vista->respuesta("No se encontró ningún libro con el título proporcionado", 404);
            return;
        }
        $this->Vista->respuesta($librosEncontrado, 200);
    }


}    

    
