<?php
require_once('tools/tools.php');
// ROUTING
require_once('routes.php');

session_start ();

if ( empty($_GET['action']) ){
	$action = 'home';
} else{
	$action = $_GET['action'];
}

// CONTROLLER
if(!array_key_exists($action, $routes))
	error404('illegal action : '.$action);

$controller_path = 'controllers/'.$routes[$action].'.php';

if (is_file($controller_path))
	include($controller_path);
else
	error404('controller missing : '.$controller_path);

// VIEW
/* $view_path = 'views/'.$action.'.php'; */
$view_path = 'views/room_publique.php';
$css_path = './dists/css/index.css';
$fontawesome_path = './dists/font-awesome/css/font-awesome.min.css';

if (is_file($view_path))
	include('layouts/layout.php');
else
	error404('view missing : '.$view_path);