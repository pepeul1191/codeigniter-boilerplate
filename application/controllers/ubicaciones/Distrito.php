<?php

class Distrito extends CI_Controller
{
  public function listar($provincia_id)
  {
    //libraries as filters
    $this->load->library('HttpAccess',
      array(
        'config' => $this->config,
        'allow' => ['GET'],
        'received' => $this->input->server('REQUEST_METHOD'),
        'instance' => $this,
      )
    );
    //controller function
    $rpta = '';
    $status = 200;
    try {
      $rs = \Model::factory('\Models\Ubicaciones\Distrito', 'ubicaciones')
      	->select('id')
      	->select('nombre')
      	->where('provincia_id', $provincia_id)
      	->find_array();
      $rpta = json_encode($rs);
    }catch (Exception $e) {
      $status = 500;
      $rpta = json_encode(
        [
          'tipo_mensaje' => 'error',
          'mensaje' => [
  					'No se ha podido listar los distritos de la provincia',
  					$e->getMessage()
  				]
        ]
      );
    }
    $this->output
      ->set_status_header($status)
      ->set_output($rpta);
  }

  public function buscar()
  {
    //libraries as filters
    $this->load->library('HttpAccess',
      array(
        'config' => $this->config,
        'allow' => ['GET'],
        'received' => $this->input->server('REQUEST_METHOD'),
        'instance' => $this,
      )
    );
    //controller function
    $rpta = '';
    $status = 200;
    try {
      $rs = \Model::factory('\Models\Ubicaciones\VWDistritoProvinciaDepartamento', 'ubicaciones')
    		->select('id')
    		->select('nombre')
    		->where_like('nombre', $this->input->get('nombre') . '%')
    		->limit(10)
    		->find_array();
      $rpta = json_encode($rs);
    }catch (Exception $e) {
      $status = 500;
      $rpta = json_encode(
        [
          'tipo_mensaje' => 'error',
          'mensaje' => [
  					'No se ha podido buscar las coincidencias de nombres de distritos',
  					$e->getMessage()
  				]
        ]
      );
    }
    $this->output
      ->set_status_header($status)
      ->set_output($rpta);
  }

  public function nombre($distrito_id)
  {
    //libraries as filters
    $this->load->library('HttpAccess',
      array(
        'config' => $this->config,
        'allow' => ['GET'],
        'received' => $this->input->server('REQUEST_METHOD'),
        'instance' => $this,
      )
    );
    //controller function
    $rpta = '';
    $status = 200;
    try {
      $rs = \Model::factory('\Models\Ubicaciones\VWDistritoProvinciaDepartamento', 'ubicaciones')
  			->select('nombre')
  			->where('id', $distrito_id)
  			->find_one()
  			->as_array();
  		$rpta = $rs['nombre'];
    }catch (Exception $e) {
      $status = 500;
      $rpta = json_encode(
        [
          'tipo_mensaje' => 'error',
          'mensaje' => [
  					'No se ha podido listar el nomnbre de distrito',
  					$e->getMessage()
  				]
        ]
      );
    }
    $this->output
      ->set_status_header($status)
      ->set_output($rpta);
  }
}

?>
