<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('access_css'))
{
  function access_css($config)
  {
    $rpta = null;
    switch($config->item('ambiente_static')){
      case 'desarrollo':
        $rpta = [
          'bower_components/bootstrap/dist/css/bootstrap.min',
          'bower_components/font-awesome/css/font-awesome.min',
          'assets/css/constants',
          'assets/css/error',
        ];
        break;
      case 'produccion':
        $rpta = [
          'dist/error.min',
        ];
        break;
    }
    return $rpta;
  }
}

if ( ! function_exists('access_js'))
{
  function access_js($config)
  {
    $rpta = null;
    switch($config->item('ambiente_static')){
      case 'desarrollo':
        $rpta = [
        ];
        break;
      case 'produccion':
        $rpta = [
        ];
        break;
    }
    return $rpta;
  }
}

?>
