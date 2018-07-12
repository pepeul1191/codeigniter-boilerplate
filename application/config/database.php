<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ORM::configure('sqlite:' . DBPATH . 'ubicaciones.db',  null, 'ubicaciones');
ORM::configure('return_result_sets', true);
ORM::configure('error_mode', PDO::ERRMODE_WARNING);
ORM::configure('logging', true);
