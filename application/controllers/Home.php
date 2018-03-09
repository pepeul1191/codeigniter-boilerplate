<?php

class Home extends CI_Controller 
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
      'title' => 'Home', 
      'csss' => [
      	'bower_components/bootstrap/dist/css/bootstrap.min',
				'bower_components/font-awesome/css/font-awesome.min',
				'css/style'
      ],
      'jss' => [
      	'bower_components/jquery/dist/jquery.min',
				'bower_components/bootstrap/dist/js/bootstrap.min'
      ],
      'menu' => '[{"url" : "accesos", "nombre" : "Accesos"},{"url" : "libros", "nombre" : "Libros"}]', 
      'items' => '[{"subtitulo":"","items":[{"item":"Gestión de Sistemas","url":"accesos/#/sistema"},{"item":"Gestión de Usuarios","url":"accesos/#/usuario"}]}]', 
      'data' => json_encode(array(
        'mensaje' => false,
        'titulo_pagina' => 'Gestión de Accesos', 
        'modulo' => 'Accesos'
      )),
    );
    $data_bottom = array(
      'js_bottom' => 'dist/accesos.min.js',
    );
    $this->load->helper('View');
    $this->load->view('layouts/blank_header', $data_top);
    $this->load->view('home/index');
    $this->load->view('layouts/blank_footer', $data_bottom);
  }
}

?>