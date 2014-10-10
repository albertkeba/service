<?php
/**
 * références:
 * - http://tonylandis.com/php/php5-pdo-singleton-class/
 * - http://stackoverflow.com/questions/130878/global-or-singleton-for-database-connection/219599#219599
 */
class PdoConnector
{
	private $PDOInstance;
	private static $instance;

	private function __construct( $dsn, $username, $password )
	{
		$this->PDOInstance = new PDO( $dsn, $username, $password );
	}

	/**
	 * crée et retourne l'objet PdoConnector
	 * @param  string $dsn
	 * @param  string $username
	 * @param  string $password
	 * @return PdoConnector instance
	 */
	public static function getInstance( $dsn, $username, $password )
	{
		if ( ! isset(self::$instance) )
		{
			try
			{
				self::$instance = new PdoConnector( $dsn, $username, $password );
			}
			catch( PDOException $e )
			{
				die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
			}
		}

		return self::$instance;
	}
	//-- eo getInstance

	/**
	 * Démarre une transaction
	 * référence: http://php.net/manual/fr/pdo.begintransaction.php
	 * @return bool
	 */
	public function beginTransaction()
	{
		return $this->PDOInstance->beginTransaction();
	}
	//-- eo beginTransaction

	/**
	 * valide une transaction
	 * référence: http://php.net/manual/fr/pdo.commit.php
	 * @return bool
	 */
	public function commit()
	{
		return $this->PDOInstance->commit();
	}
	//-- eo commit

	/**
	 *  Retourne le SQLSTATE associé avec la dernière opération
	 *  référence: http://php.net/manual/fr/pdo.errorcode.php
	 * @return SQLSTATE
	 */
	public function errorCode()
	{
		return $this->PDOInstance->errorCode();
	}
	//-- eo errorCode

	/**
	 * retourne les infos associées à l'erreur
	 * référence: http://php.net/manual/fr/pdo.errorinfo.php
	 * @return [type]
	 */
	public function errorInfo()
	{
		return $this->PDOInstance->errorInfo();
	}
	//-- eo errorInfo

	/**
	 * Exécute une requête SQL et retourne le nombre de lignes affectées
	 * référence: http://php.net/manual/fr/pdo.exec.php
	 * @param  string $statement
	 * @return int
	 */
	public function exec( $statement )
	{
		return $this->PDOInstance->exec( $statement );
	}
	//-- eo exec

	/**
	 * Récupère un attribut d'une connexion à une base de données
	 * référence: http://php.net/manual/fr/pdo.getattribute.php
	 * @param  string $attribute
	 * @return NULL || PDO value
	 */
	public function getAttribute( $attribute )
	{
		return $this->PDOInstance->getAttribute( $attribute );
	}
	//-- eo getAttribute

	/**
	 * Vérifie si nous sommes dans une transaction
	 * référence: http://php.net/manual/fr/pdo.intransaction.php
	 * @return bool
	 */
	public function inTransaction()
	{
		return $this->PDOInstance->inTransaction();
	}
	//-- eo inTransaction

	/**
	 * Retourne l'identifiant de la dernière ligne insérée
	 * référence: http://php.net/manual/fr/pdo.lastinsertid.php
	 * @param  string $name
	 * @return string || SQLSTATE
	 */
	public function lastInsertId( $name )
	{
		return $this->PDOInstance->lastInsertId( $name );
	}
	//-- eo lastInsertId

	/**
	 * Prépare une requête à l'exécution
	 * référence: http://php.net/manual/fr/pdo.prepare.php
	 * @param  string $statement
	 * @return object
	 */
	public function prepare( $statement )
	{
		return $this->PDOInstance->prepare( $statement );
	}
	//-- eo prepare

	/**
	 * Récupère la ligne suivante d'un jeu de résultats PDO
	 * référence: http://php.net/manual/fr/pdostatement.fetch.php
	 * @return array
	 */
	public function fetch( $statement )
	{
		return $this->PDOInstance->query( $statement )->fetch( PDO::FETCH_ASSOC );
	}
	//-- eo fetch

	/**
	 * Retourne un tableau contenant toutes les lignes du jeu d'enregistrements
	 * référence: http://php.net/manual/fr/pdostatement.fetchall.php
	 * @param  string $statement
	 * @return array
	 */
	public function fetchAll( $statement )
	{
		return $this->PDOInstance->query( $statement )->fetchAll( PDO::FETCH_ASSOC );
	}
	//-- eo fetchAll

	/**
	 * Exécute une requête SQL
	 * @param  [type] $statement
	 * @return PDOStatement object
	 */
	public function query( $statement )
	{
		return $this->PDOInstance->query( $statement )->fetch();
	}
	//-- eo query
}
