<?php

class Distrito extends CI_Controller
{
  public function listar($provincia_id)
  {
  	$this->load->library('HttpAccess',
  		array(
  			'config' => $this->config,
  			'allow' => ['GET'],
  			'received' => $this->input->method(TRUE)
  		)
  	);
    $rs = \Model::factory('\Models\Distrito', 'ubicaciones')
    	->select('id')
    	->select('nombre')
    	->where('provincia_id', $provincia_id)
    	->find_array();
    echo json_encode($rs);
  }

  public function buscar()
  {
  	$this->load->library('HttpAccess',
  		array(
  			'config' => $this->config,
  			'allow' => ['GET'],
  			'received' => $this->input->method(TRUE)
  		)
  	);
  	$rs = \Model::factory('\Models\VWDistritoProvinciaDepartamento', 'ubicaciones')
  		->select('id')
  		->select('nombre')
  		->where_like('nombre', $this->input->get('nombre') . '%')
  		->limit(10)
  		->find_array();
  	echo json_encode($rs);
  }

  public function nombre($distrito_id)
  {
		$rs = \Model::factory('\Models\VWDistritoProvinciaDepartamento', 'ubicaciones')
			->select('nombre')
			->where('id', $distrito_id)
			->find_one()
			->as_array();
		echo $rs['nombre'];
  }
}

?>
