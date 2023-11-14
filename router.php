<?php
    require_once 'config.php';
    require_once 'libs/router.php';
    require_once 'app/controlador/controladorLibrosApi.php';
    require_once 'app/controlador/controladorGenerosApi.php';
//    require_once './app/controlador/controladorAutApi.php';

    $router = new Router();

    //                  endpoint                     verbo       controller                 método
    $router->addRoute ('libros',                    'GET',      'controladorLibrosApi',    'obtener');
    $router->addRoute ('libros/:ID',                'GET',      'controladorLibrosApi',    'obtener');
    $router->addRoute ('libro/:TITULO',             'GET',      'ControladorLibros',       'buscadorLibro');
    $router->addRoute ('libros',                    'POST',     'controladorLibrosApi',    'crear');
    $router->addRoute ('libros/:ID',                'DELETE',   'controladorLibrosApi',    'eliminar');
    $router->addRoute ('libros/:ID',                'PUT',      'controladorLibrosApi',    'actualizar');
    $router->addRoute ('generos',                   'GET',      'controladorGenerosApi',   'obtener');
    $router->addRoute ('generos/:ID',               'GET',      'controladorGenerosApi',   'obtener');
    $router->addRoute ('generos',                   'POST',     'controladorGenerosApi',   'crear');
    $router->addRoute ('generos/:ID',               'DELETE',   'controladorGenerosApi',   'eliminar');
    $router->addRoute ('generos/:ID',               'PUT',      'controladorGenerosApi',   'actualizar');
    
    $router->route($_GET['resource']        , $_SERVER['REQUEST_METHOD']);