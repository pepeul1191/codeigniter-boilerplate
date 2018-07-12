<?php

class Departamento extends CI_Controller
{
  public function listar()
  {
  	$this->load->library('HttpAccess',
  		array(
  			'config' => $this->config,
  			'allow' => ['GET'],
  			'received' => $this->input->method(TRUE)
  		)
  	);
    $rs = \Model::factory('\Models\Departamento', 'ubicaciones')
    	->select('id')
    	->select('nombre')
    	->find_array();
    $this->output
      ->set_output(json_encode($rs));
  }
}

?>
