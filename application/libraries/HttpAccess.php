<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HttpAccess {
    function __construct($params)
    {
		if (!in_array($params['received'], $params['allow'])){
			header( 'Location: ' . $params['config']->item('base_url') . 'error/access/404' );
		}
    }
}

?>