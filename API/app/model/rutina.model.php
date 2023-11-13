<?php

class RutinasModel{
    private $bd;

    function __construct(){
        $this->bd = new PDO('mysql:host=localhost;dbname=gimnasio;charset=utf8','root','');
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    function obtenerRutinas(){
        $query = $this->bd->prepare();
        $query->execute();
        $rutinas = $query->fetchAll(PDO::FETCH_OBJ);
        return $rutinas;
    }

    function obtenerRutina($id){
        $query = $this->bd->prepare('SELECT * FROM rutina WHERE rutina_id = ?');
        $query->execute([$id]);
        $rutina = $query->fetch(PDO::FETCH_OBJ);
        return $rutina;
    }

    function obtenerRutinasCliente($id){
        $query = $this->bd->prepare('SELECT * FROM rutina where cliente_id = ?');
        $query->execute([$id]);

        $rutina = $query->fetchAll(PDO::FETCH_OBJ);

        return $rutina;
    }

    function agregarRutina($tren,$musculo,$ejercicio,$repeticiones,$series,$cliente_id){
        $query = $this->bd->prepare('INSERT INTO rutina(tren,musculo,ejercicio,repeticiones,series,cliente_id) VALUES (?,?,?,?,?,?)');
        $query->execute([$tren,$musculo,$ejercicio,$repeticiones,$series,$cliente_id]);
        return $this->bd->lastInsertId();
    }

    function actualizarRutina($tren, $musculo, $ejercicio, $repeticiones, $series, $rutina_id){
        $query = $this->bd->prepare('UPDATE rutina SET tren = ?, musculo = ?, ejercicio = ?, repeticiones = ?, series = ? WHERE rutina_id = ?');
        $query->execute([$tren, $musculo, $ejercicio, $repeticiones, $series, $rutina_id]);
    }
}