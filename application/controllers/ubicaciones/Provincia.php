<?php

class Provincia extends CI_Controller
{
  public function listar($departamento_id)
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
      $rs = \Model::factory('\Models\Ubicaciones\Provincia', 'ubicaciones')
      	->select('id')
      	->select('nombre')
      	->where('departamento_id', $departamento_id)
      	->find_array();
      $rpta = json_encode($rs);
    }catch (Exception $e) {
      $status = 500;
      $rpta = json_encode(
        [
          'tipo_mensaje' => 'error',
          'mensaje' => [
            'No se ha podido listar las provincias del departamento',
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
