<?php

class Login extends CI_Controller
{
  public function index()
  {
    //libraries as filters
    $this->load->library('ViewSessionFalse', array(
      'config' => $this->config,
    ));
    $this->load->library('HttpAccess',
      array(
        'config' => $this->config,
        'allow' => ['GET'],
        'received' => $this->input->server('REQUEST_METHOD'),
        'instance' => $this,
      )
    );
    //controller function
    $this->load->helper('Login');
    $data_top = array(
      'title' => 'Bienvenido',
      'csss' => index_css($this->config),
      'jss' => index_js($this->config),
      'mensaje' => '',
    );
    $this->load->view('layouts/blank_header', $data_top);
    $this->load->view('login/index');
    $this->load->view('layouts/blank_footer', array());
  }

  public function acceder()
  {
    //libraries as filters
    $this->load->library('ViewSessionFalse', array(
      'config' => $this->config,
    ));
    $this->load->library('HttpAccess',
      array(
        'config' => $this->config,
        'allow' => ['POST'],
        'received' => $this->input->server('REQUEST_METHOD'),
        'instance' => $this,
      )
    );
    //controller function
    $usuario = $this->input->post('usuario');
    $url1 = $this->config->item('servicios')['accesos']['url'] . 'sistema/usuario/validar';
    try {
      $response = Httpful\Request::post($url1)
        ->addHeader(
          $this->config->item('servicios')['accesos']['key'],
          $this->config->item('servicios')['accesos']['secret'])
        ->body(array(
            'usuario' => $usuario,
            'sistema_id' => $this->config->item('sistema_id'),
          ), Httpful\Mime::FORM)
        ->send();
      $mensaje = '';
      $continuar = true;
      switch($response->code){
        case 200:
          if ($response->raw_body != '1'){
            $continuar = false;
            $mensaje = 'Usuario no se encuentra registrado en el sistema';
          }
          break;
        case 404:
          $continuar = false;
          $resp = json_decode($response->body);
          $mensaje = $resp->{'mensaje'}[0] . ', '. $resp->{'mensaje'}[0];
          break;
        case 500:
          $continuar = false;
          $resp = json_decode($response->body);
          $mensaje = $resp->{'mensaje'}[0] . ', '. $resp->{'mensaje'}[0];
          break;
        default:
          $mensaje = 'Se ha producido un error no esperado al validar usuario/sistema';
      }
    } catch (Httpful\Exception\ConnectionErrorException $e) {
      $mensaje = 'No se puede acceder al servicio de validación de usuario/sistema';
    } catch (Exception $e) {
      $mensaje = 'Se ha producido un error no controlado al validar usuario/sistema';
    }
    if($continuar == true){
      $contrasenia = $this->input->post('contrasenia');
      $url2 = $this->config->item('servicios')['accesos']['url'] . 'usuario/externo/validar';
      try {
        $response = Httpful\Request::post($url2)
          ->addHeader(
            $this->config->item('servicios')['accesos']['key'],
            $this->config->item('servicios')['accesos']['secret'])
          ->body(array(
              'usuario' => $usuario,
              'contrasenia' => $contrasenia,
            ), Httpful\Mime::FORM)
          ->send();
        $mensaje = '';
        switch($response->code){
          case 200:
            if ($response->raw_body == '1'){
              $_SESSION['usuario'] = $usuario;
              $_SESSION['estado'] = 'activo';
              $_SESSION['tiempo'] = date('Y-m-d H:i:s');
              header('Location: ' . $this->config->item('base_url'));
              exit();
            }else{
              $mensaje = 'Usuario y/o contraseña no coincide';
            }
            break;
          case 404:
            $resp = json_decode($response->body);
            $mensaje = $resp->{'mensaje'}[0] . ', '. $resp->{'mensaje'}[0];
            break;
          case 500:
            $resp = json_decode($response->body);
            $mensaje = $resp->{'mensaje'}[0] . ', '. $resp->{'mensaje'}[0];
            break;
          default:
            $mensaje = 'Se ha producido un error no esperado al validar usuario/contraseña';
        }
      } catch (Httpful\Exception\ConnectionErrorException $e) {
        $mensaje = 'No se puede acceder al servicio de validación de usuario/contraseña';
      } catch (Exception $e) {
        $mensaje = 'Se ha producido un error no controlado al validar usuario/contraseña';
      }
    }
    $this->load->helper('Login');
    $data_top = array(
      'title' => 'Bienvenido',
      'csss' => index_css($this->config),
      'jss' => index_js($this->config),
      'mensaje' => $mensaje,
    );
    $this->load->view('layouts/blank_header', $data_top);
    $this->load->view('login/index');
    $this->load->view('layouts/blank_footer', array());
    $this->output->set_status_header(500);
  }

  public function ver()
  {
    //libraries as filters
    //controller function
    if (array_key_exists('estado', $_SESSION)) {
      if($_SESSION['estado'] != 'activo'){
        echo '<h1>El usuario no se encuentra logueado</h1>';
      }else{
        $rpta =
          '<h1>Usuario Logeado</h1><ul><li>' .
          $_SESSION['usuario'] . '</li><li>' .
          $_SESSION['tiempo'] . '</li><li>' .
          $_SESSION['estado'] . '</li></ul>';
        echo $rpta;
      }
    }else{
      echo '<h2>El usuario no se encuentra logueado</h2>';
    }
  }

  public function salir()
  {
    //libraries as filters
    //controller function
    session_destroy();
    header('Location: ' . $this->config->item('base_url') . 'login');
    exit();
  }
}

?>
