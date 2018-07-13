<?php

class Home extends CI_Controller
{
  public function index()
  {
    //libraries as filters
    $this->load->library('ViewSessionTrue', array(
      'config' => $this->config,
    ));
    //controller function
    $this->load->helper('Home');
    $data_top = array(
      'mensaje' => false,
      'titulo_pagina' => 'Gestión de Accesos',
      'modulo' => 'Accesos',
      'title' => 'Home',
      'csss' => index_css($this->config),
      'jss' => index_js($this->config),
      'menu' => '[{"url" : "accesos", "nombre" : "Accesos"},{"url" : "libros", "nombre" : "Libros"}]',
      'items' => '[{"subtitulo":"","items":[{"item":"Gestión de Sistemas","url":"accesos/#/sistema"},{"item":"Gestión de Usuarios","url":"accesos/#/usuario"}]}]',
      'data' => json_encode(array(
        'mensaje' => false,
        'titulo_pagina' => 'Gestión de Accesos',
        'modulo' => 'Accesos'
      )),
    );
    $this->load->view('layouts/app_header', $data_top);
    $this->load->view('home/index');
    $this->load->view('layouts/app_footer', array());
  }
}

?>
