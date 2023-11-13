<?php

require_once 'app/controller/api.controller.php';
require_once 'app/model/rutina.model.php';

class RutinasController extends ApiController{
    protected $model;

    function __construct() {
        parent::__construct();
        $this->model = new RutinasModel();
    }
    
    function obtenerRutinas($parametros = []){
        $sql = 'SELECT * FROM rutina';

        if (isset($parametros['order'])) {
            // Lista blanca de nombres de columnas permitidos
            $columnasPermitidas = ['tren','musculo','ejercicio','repeticiones','series'];

            // Verifica si el nombre de columna es permitido
            $ordenColumna = in_array($parametros['order'], $columnasPermitidas) ? $parametros['order'] : 'id';

            $sql .= ' ORDER BY ' . $ordenColumna;

            if (isset($parametros['sort'])) {
                // Asegúrate de que el valor de sort sea "ASC" o "DESC"
                $ordenSort = strtoupper($parametros['sort']) == 'DESC' ? 'DESC' : 'ASC';
                $sql .= ' ' . $ordenSort;
            }
        }

        if (!empty($sql)) {
            try {
                $query = $this->bd->prepare($sql);
                $query->execute();
                $rutinas = $query->fetchAll(PDO::FETCH_OBJ);
                $this->view->response($rutinas, 200);
                return $rutinas;
            } catch (PDOException $e) {
                die("Error de base de datos: " . $e->getMessage());
            }
        }
    }
    


    function obtenerRutinaCliente($params = []){
        if(empty($params)){
        $rutinas = $this->model->obtenerRutinas();
        $this->view->response($rutinas, 200);
        }
        else{
            $rutina = $this->model->obtenerRutinasCliente($params[":ID"]);
            if(!empty($rutina)){
                return $this->view->response($rutina,200);
            }
            else{
                $this->view->response('No existe un usuario con ID '.$params[':ID'], 404);
            }
        }
    }

    function agregarRutina($params = []){
        $body = $this->getData();

        $tren = $body->tren;
        $musculo = $body->musculo;
        $ejercicio = $body->ejercicio;
        $repeticiones = $body->repeticiones;
        $series = $body->series;
        
        $cliente_id = $body->cliente_id; 
        //En una web completa este dato se obtendría desde el login con $_SESSION['CLIENTE_ID]'
        
        
        $id = $this->model->agregarRutina($tren,$musculo,$ejercicio,$repeticiones,$series,$cliente_id);

        $this->view->response('La rutina fue creada con el id = '. $id, 201);


    }

    public function actualizarRutina($params = []) {
        $id = $params[':ID'];
        if ($this->model->obtenerRutina($id)) {
            $body = $this->getData();

            $tren = $body->tren;
            $musculo = $body->musculo;
            $ejercicio = $body->ejercicio;
            $repeticiones = $body->repeticiones;
            $series = $body->series;
            
            $this->model->actualizarRutina($tren, $musculo, $ejercicio, $repeticiones, $series, $id);
            $this->view->response('La rutina id = '. $id . ' se ha actualizado con éxito', 200);
        }
        else{
            $this->view->response('La rutina con id = '. $id . ' no existe', 404);
        }
    }
}