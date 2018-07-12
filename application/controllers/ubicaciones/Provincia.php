<?php

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
    $rs = \Model::factory('\Models\Provincia', 'ubicaciones')
    	->select('id')
    	->select('nombre')
    	->where('departamento_id', $departamento_id)
    	->find_array();
    $this->output
        ->set_output(json_encode($rs));
  }
}

?>
