<?php
require_once 'app/view/api.view.php';
    abstract class ApiController{
        protected $view;
        protected $model;

        private $data;

        public function __construct(){
            $this->view = new APIView();
            $this->data = file_get_contents('php://input');
        }

        function getData(){
            return json_decode($this->data);
        }
    }