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
	echo json_encode( $bdCon->fetchAll("SELECT * FROM employee ORDER BY lastName, firstName") );
});

/**
 * ajout d'un contact
 */
$app->post('/addContact', function() use( $app, $bdCon ) {
	$contact 	= json_decode( $app->request()->getBody() );

	$lastname 	= $contact->lastname;
	$firstname	= $contact->firstname;
	$title		= $contact->title;
	$department	= $contact->department;
	$officePhone= $contact->officePhone;
	$email		= $contact->email;

	try 
	{
		$bdCon->beginTransaction();
		$sth = $bdCon->prepare("INSERT INTO employee (firstName, lastName, title, department, officePhone, email) VALUES (:firstname, :lastname, :title, :department, :officePhone, :email)");
		$sth->bindParam(':firstname', $firstname, PDO::PARAM_STR);
		$sth->bindParam(':lastname', $lastname, PDO::PARAM_STR);
		$sth->bindParam(':title', $title, PDO::PARAM_STR);
		$sth->bindParam(':department', $department, PDO::PARAM_STR);
		$sth->bindParam(':officePhone', $officePhone, PDO::PARAM_STR);
		$sth->bindParam(':email', $email, PDO::PARAM_STR);
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


/**
 * supprimer un contact
 */
$app->delete('/deleteContact/:id', function( $id ) use( $app, $bdCon) {
	try
	{
		$bdCon->beginTransaction();
		$sth = $bdCon->prepare("DELETE FROM employee WHERE id=:id");
		$sth->bindParam(':id', $id, PDO::PARAM_INT);
		$sth->execute();
		$bdCon->commit();

		echo json_encode( array('success'=>1) );
	}
	catch ( Exception $e )
	{
		echo json_encode( array('success'=>0) );
	}
});

/**
 * mise à jour du contact
 */
$app->put('/updateContact/:id', function( $id ) use( $app, $bdCon) {
	$contact 	= json_decode( $app->request()->getBody() );

	$id 		= $contact->contactid;
	$lastname 	= $contact->lastname;
	$firstname	= $contact->firstname;
	$title		= $contact->title;
	$department	= $contact->department;
	$officePhone= $contact->officePhone;
	$email		= $contact->email;

	try
	{
		$bdCon->beginTransaction();
		$sth = $bdCon->prepare("UPDATE employee SET firstname=:firstname, lastname=:lastname, title=:title, department=:department, officePhone=:officePhone, email=:email WHERE id=:id");
		$sth->bindParam(':id', $id, PDO::PARAM_INT);
		$sth->bindParam(':firstname', $firstname, PDO::PARAM_STR);
		$sth->bindParam(':lastname', $lastname, PDO::PARAM_STR);
		$sth->bindParam(':title', $title, PDO::PARAM_STR);
		$sth->bindParam(':department', $department, PDO::PARAM_STR);
		$sth->bindParam(':officePhone', $officePhone, PDO::PARAM_STR);
		$sth->bindParam(':email', $email, PDO::PARAM_STR);
		$sth->execute();
		$bdCon->commit();

		echo json_encode( array('success'=>1) );
	}
	catch ( Exception $e )
	{
		echo json_encode( array('success'=>0) );
	}
});

$app->run();