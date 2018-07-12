<?php

require_once 'application/models/ubicaciones/Provincia_model.php';

class Provincia extends CI_Controller 
{
  public function listar($departamento_id)
  {
  	$this->load->library('HttpAccess', 
  		array(
  			'config' => $this->config, 
  			'allow' => ['GET'], 
  			'received' => $this->input->method(TRUE)
  		)
  	);
    $rs = Model::factory('Provincia_model', 'ubicaciones')
    	->select('id')
    	->select('nombre')
    	->where('departamento_id', $departamento_id)
    	->find_array();
    echo json_encode($rs);
  }
}

?>