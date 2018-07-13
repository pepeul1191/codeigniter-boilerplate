<?php

class CustomError extends CI_Controller
{
  public function orverride()
  {
    if($this->input->server('REQUEST_METHOD') == 'GET'){
      header('Location: ' . $this->config->item('base_url') . 'error/access/404');
      exit();
    }else{
      $rpta = json_encode(
        [
          'tipo_mensaje' => 'error',
          'mensaje' => [
            'Recurso no encontrado',
            'Error 404'
          ]
        ]
      );
      $this->output
        ->set_status_header(404)
        ->set_output($rpta);
    }
  }

  public function access($error)
  {
    //libraries as filters
    //controller function
    $this->load->helper('Error');
    $rpta = '';
    $status = 404;
    $numero = $error + '';
    $error = [];
    switch ($numero) {
      case '404':
        $error = [
          'numero' => 404,
          'mensaje' => 'Archivo no encontrado',
          'descripcion' => 'La página que busca no se encuentra en el servidor',
          'icono' => 'fa fa-exclamation-triangle'
        ];
        $status = 404;
        break;
      case '501':
        $error = [
          'numero' => 501,
          'mensaje' => 'Página en Contrucción',
          'descripcion' => 'Lamentamos el incoveniente, estamos trabajando en ello.',
          'icono' => 'fa fa-code-fork'
        ];
        $status = 500;
        break;
      case '5050':
        $error = [
          'numero' => 5050,
          'mensaje' => 'Acceso restringido',
          'descripcion' => 'No cuenta con los privilegios necesarios.',
          'icono' => 'fa fa-ban'
        ];
        $status = 500;
        break;
      case '505':
        $error = [
          'numero' => 5050,
          'mensaje' => 'Acceso restringido',
          'descripcion' => 'Necesita estar logueado.',
          'icono' => 'fa fa-ban'
        ];
        $status = 500;
        break;
      case '8080':
        $error = [
          'numero' => 8080,
          'mensaje' => 'Tiempo de la sesion agotado',
          'descripcion' => 'Vuelva a ingresar al sistema.',
          'icono' => 'fa fa-clock-o'
        ];
        $status = 500;
        break;
      default:
        $error = [
          'numero' => 404,
          'mensaje' => 'Archivo no encontrado',
          'descripcion' => 'La página que busca no se encuentra en el servidor',
          'icono' => 'fa fa-exclamation-triangle'
        ];
        $status = 404;
    }
    $data_top = array(
      'title' => 'Error',
      'csss' => access_css($this->config),
      'jss' => access_js($this->config),
      'error' => $error
    );
    $this->load->view('layouts/blank_header', $data_top);
    $this->load->view('custom_error/access');
    $this->load->view('layouts/blank_footer', array());
    $this->output->set_status_header($status);
  }
}

?>
