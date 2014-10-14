<?php
require 'PdoConnector.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();


$app 		= new \Slim\Slim();
$dsn		= 'mysql:host=localhost;dbname=directory';
$username	= 'root';
$password	= '';
$bdCon 		= PdoConnector::getInstance( $dsn, $username, $password );

function verifEmail( $email )
{
	$regex = '/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/';

	if ( preg_match($regex, $email) )
		return true;
	else
		return false;
}

function cleanpost( $data )
{
	$data = trim( $data );
	$data = stripslashes( $data );
	$data = htmlspecialchars( $data, ENT_QUOTES, 'utf-8' );

	return $data;
}

$app->get('/', function(){
	echo 'Welcome';
});

/**
 * retourne un contact selon son id
 * @param int $id identifiant
 */
$app->get('/contact/:id', function( $id ) use( $bdCon ) {
	echo json_encode( $bdCon->fetch("SELECT * FROM employee WHERE id = $id") );
});

/**
 * retourne tous les contacts
 */
$app->get('/contacts', function() use( $bdCon ) {
	echo json_encode( $bdCon->fetchAll("SELECT * FROM employee") );
});

$app->post('/addContact', function() use( $app, $bdCon ) {
	$contact = $app->request()->post();
});

$app->run();