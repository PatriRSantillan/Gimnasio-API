<?php
require_once 'libs/Router.php';
require_once 'app/controller/rutina.api.controller.php';

$router = new Router();

$router->addRoute('rutinas','GET','RutinasController','obtenerRutinas');
$router->addRoute('rutinas/:ID','GET','RutinasController','obtenerRutinaCliente');
$router->addRoute('rutinas','POST','RutinasController','agregarRutina');
$router->addRoute('rutinas/:ID','PUT','RutinasController','actualizarRutina');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);