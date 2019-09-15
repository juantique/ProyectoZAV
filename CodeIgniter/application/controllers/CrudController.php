<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CrudController extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('crudModel');
        $this->load->helper('url');
    }
    public function index()
    {
        $this->load->view('inicio');
    }
    function show(){
        $data=$this->ClientesModel->ClienteList();
        echo json_encode($data);
      }
      function save(){
        $data=$this->ClientesModel->GuardarCliente();
        echo json_encode($data);
      }
      function update(){
        $data=$this->ClientesModel->ActualizarCliente();
        echo json_encode($data);
      }
      function delete(){
        $data=$this->ClientesModel->EliminarCliente();
        echo json_encode($data);
    }

}