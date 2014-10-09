<?php
require 'PdoConnector.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();


$app 	= new \Slim\Slim();

$dsn	= 'mysql:host=localhost;dbname=annuaire';
$username= 'root';
$password= '';
$bdCon 	= PdoConnector::getInstance( $dsn, $username, $password );

$app->get('/test', function(){
	var_dump($bdCon);
});


$app->run();