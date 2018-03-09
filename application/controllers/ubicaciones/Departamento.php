<?php

require_once 'application/models/ubicaciones/Departamento_model.php';

class Departamento extends CI_Controller 
{
  public function listar()
  {
    $rs = Model::factory('Departamento_model', 'ubicaciones')->select('id')->select('nombre')->find_array();
    echo json_encode($rs);
  }
}

?>