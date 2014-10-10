<?php
require 'PdoConnector.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();


$app 	= new \Slim\Slim();

$dsn	= 'mysql:host=localhost;dbname=directory';
$username= 'root';
$password= 'root';
$bdCon 	= PdoConnector::getInstance( $dsn, $username, $password );

$app->get('/test', function() use( $bdCon ) {
	var_dump($bdCon->query("select * from directory"));
	var_dump($bdCon->errorInfo());
});


$app->run();