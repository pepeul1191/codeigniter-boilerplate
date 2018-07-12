<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('load_csss'))
{
  function load_csss($config, $array_css)
  {
    $rpta = '';
    foreach ($array_css as &$css) {
      $temp = '<link rel="stylesheet" type="text/css" href="' . $config->item('static_url') . $css . '.css"/>';
      $rpta = $rpta . $temp;
    }
    return $rpta;
  }
}

if ( ! function_exists('load_jss'))
{
  function load_jss($config, $array_js)
  {
		$rpta = '';
		foreach ($array_js as &$js) {
			$temp = '<script src="' . $config->item('static_url') . $js . '.js" type="text/javascript"></script>';
			$rpta = $rpta . $temp;
		}
		return $rpta;
  }
}

?>
