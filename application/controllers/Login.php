<?php

class Login extends CI_Controller 
{
  public function index()
  {
  	$this->load->library('HttpAccess', 
  		array(
  			'config' => $this->config, 
  			'allow' => ['GET'], 
  			'received' => $this->input->method(TRUE)
  		)
  	);
    $data_top = array(
      'mensaje' => false,
      'titulo_pagina' => 'Gestión de Accesos', 
      'modulo' => 'Accesos',
      'title' => 'Bienvenido', 
      'csss' => [
      	'bower_components/bootstrap/dist/css/bootstrap.min',
				'bower_components/font-awesome/css/font-awesome.min',
				'css/style'
      ],
      'jss' => [
      	'bower_components/jquery/dist/jquery.min',
				'bower_components/bootstrap/dist/js/bootstrap.min'
      ],
    );
    $data_bottom = array(
      'js_bottom' => 'dist/accesos.min.js',
    );
    $this->load->helper('View');
    $this->load->view('layouts/blank_header', $data_top);
    $this->load->view('login/index');
    $this->load->view('layouts/blank_footer', $data_bottom);
  }

  public function acceder()
  {
    $this->load->library('HttpAccess', 
      array(
        'config' => $this->config, 
        'allow' => ['POST'], 
        'received' => $this->input->method(TRUE)
      )
    );
    $usuario = $this->input->post('usuario');
    $contrasenia = $this->input->post('contrasenia'); 
    $uri = $this->config->item('servicios')['accesos'] 
      . 'usuario/acceder?usuario=' . $usuario 
      . '&contrasenia=' . $contrasenia;
    $this->load->library('Httpful'); 
    $response = \Httpful\Request::post($uri)
      ->send();
    if ($response->body == '1'){
      $_SESSION['usuario'] = $usuario;
      $_SESSION['estado'] = 'activo';
      $_SESSION['tiempo'] = date('Y-m-d H:i:s');
      header('Location: ' . $this->config->item('base_url'));
    }else{
      $data_top = array(
        'mensaje' => true,
        'titulo_pagina' => 'Gestión de Accesos', 
        'modulo' => 'Accesos',
        'title' => 'Bienvenido', 
        'csss' => [
          'bower_components/bootstrap/dist/css/bootstrap.min',
          'bower_components/font-awesome/css/font-awesome.min',
          'css/style'
        ],
        'jss' => [
          'bower_components/jquery/dist/jquery.min',
          'bower_components/bootstrap/dist/js/bootstrap.min'
        ],
      );
      $data_bottom = array(
        'js_bottom' => 'dist/accesos.min.js',
      );
      $this->load->helper('View');
      $this->load->view('layouts/blank_header', $data_top);
      $this->load->view('login/index');
      $this->load->view('layouts/blank_footer', $data_bottom);
    }
  }

  public function ver()
  {
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
    session_destroy();
    header('Location: ' . $this->config->item('base_url') . 'login');
  }
}

?>