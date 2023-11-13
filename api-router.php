<?php
    require_once 'libs/router.php';
    require_once './app/controlador/api-controladorLibros.php';
    require_once './app/controlador/api-controladorGeneros.php';


    $router = new Router();
    $router->addRoute('libros',     'GET',    'ControladorLibros', 'mostrarLista'); 
    $router->addRoute('libros',     'POST',   'ControladorLibros', 'aniadirLibro');
    $router->addRoute('libros/:ID', 'GET',    'ControladorLibros', 'mostrarLibroId');
    $router->addRoute('libros/:ID', 'POST',    'ControladorLibros', 'buscadorLibro');
    $router->addRoute('generos',     'GET',    'ControladorGeneros', 'listarGeneros');
    $router->addRoute('generos/:ID',     'GET',    'ControladorGeneros', 'listarLibrosporGenero');

    
    $router->route($_GET['accion']        , $_SERVER['REQUEST_METHOD']);
