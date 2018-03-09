<?php

require_once 'application/config/database.php';

class Departamento_model extends Model 
{
	public static $_table = 'departamentos';
	public static $_connection_name = 'ubicaciones';
}

?>