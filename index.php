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

/**
 * ajout d'un contact
 */
$app->post('/addContact', function() use( $app, $bdCon ) {
	$contact = json_decode( $app->request()->getBody() );

	$lastname = $contact->lastname;
	$firstname= $contact->firstname;

	try 
	{
		$bdCon->beginTransaction();
		$sth = $bdCon->prepare("INSERT INTO employee (firstName, lastName) VALUES (:firstname, :lastname)");
		$sth->bindParam(':firstname', $firstname, PDO::PARAM_STR);
		$sth->bindParam(':lastname', $lastname, PDO::PARAM_STR);
		$sth->execute();
		$employeeId = $bdCon->lastInsertId('employee');
		$bdCon->commit();

		echo json_encode( array('success'=>1, 'id'=>$employeeId) );
	} 
	catch (Exception $e) 
	{
		echo json_encode(array('success'=>0, 'message'=>$bdCon->errorInfo(), 'codeError'=>$bdCon->errorCode() ));
		$bdCon->rollBack();
	}
	
	
});

$app->run();