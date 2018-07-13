<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ViewSessionFalse
{
  function __construct($params)
  {
    $continuar = true;
		if($params['config']->item('ambiente_session') == 'activo'){
      if (array_key_exists('estado', $_SESSION)) {
        if($_SESSION['estado'] == 'activo'){
          $continuar = false;
        }
      }else{
        $continuar = true;
      }
      if($continuar == false){
        header('Location: ' . $params['config']->item('base_url'));
        exit();
      }
    }
  }
}
