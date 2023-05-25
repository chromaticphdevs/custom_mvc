<?php
	
	$routes = [];

	$controller = '/ForgetPasswordController';
	$routes['forget-pw'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'send'   => $controller.'/send',
		'resetPassword' => $controller .'/resetPassword '
	];


	$controller = '/MailerController';
	$routes['mailer'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'send'   => $controller.'/send'
	];

	$controller = '/ViewerController';
	$routes['viewer'] = [
		'index' => $controller.'/index',
		'show' => $controller.'/show',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
	];

	$controller = '/UserController';
	$routes['user'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'sendCredential' => $controller.'/sendCredential',
		'subadmin-list' => $controller. '/subAdmins',
		'approve-sub-admin' => $controller . '/approveSubAdmin'
	];

	$controller = '/AuthController';
	$routes['auth'] = [
		'login' => $controller.'/login',
		'register' => $controller.'/register',
		'logout' => $controller.'/logout',
		'code'  => $controller.'/code'
	];

	$controller = '/AttachmentController';
	$routes['attachment'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show'
	];


	_routeInstance('test', 'TestController', $routes);
	
	return $routes;
?>