<?php

	$database = [];


	$database['prod'] = [
		'driver' => 'mysql',
		'host' => 'localhost',
		'username' => 'root',
		'dbname' => 'stv_uat',
		'password' => '',
		'port' => '',
		'chartset' => ''
	];

	$database['uat'] = [
		'driver' => 'mysql',
		'host' => 'localhost',
		'username' => 'root',
		'dbname' => 'stv_uat',
		'password' => '',
		'port' => '',
		'chartset' => ''
	];

	$database['dev'] = [
		'driver' => '',
		'host' => '',
		'username' => '',
		'dbname' => '',
		'password' => '',
		'port' => '',
		'chartset' => ''
	];

return $database;