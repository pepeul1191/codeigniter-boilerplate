<?php

class Distrito extends CI_Controller
{
  public function listar($provincia_id)
  {
    $rpta = '';
    $status = 200;
    try {
      $rs = \Model::factory('\Models\Distrito', 'ubicaciones')
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
    $rpta = '';
    $status = 200;
    try {
      $rs = \Model::factory('\Models\VWDistritoProvinciaDepartamento', 'ubicaciones')
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
    $rpta = '';
    $status = 200;
    try {
      $rs = \Model::factory('\Models\VWDistritoProvinciaDepartamento', 'ubicaciones')
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
