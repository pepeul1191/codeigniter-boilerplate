<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HttpAccess {
  function __construct($params)
  {
		if (!in_array($params['received'], $params['allow'])){
      $rpta = json_encode(
        [
          'tipo_mensaje' => 'error',
          'mensaje' => [
            'Recurso no disponible a dicho método HTTP',
            'Error 500'
          ]
        ]
      );
      echo $rpta;
      $params['instance']->output
        ->set_status_header(500)
        ->set_output($rpta);
      exit();
    }
  }
}

?>
