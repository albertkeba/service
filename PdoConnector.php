<?php
/**
 * références:
 * - http://tonylandis.com/php/php5-pdo-singleton-class/
 * - http://stackoverflow.com/questions/130878/global-or-singleton-for-database-connection/219599#219599
 */
class PdoConnector
{
	private static $PDOInstance;

	private function __construct( $dsn, $username, $password )
	{
		return new PDO( $dsn, $username, $password );
	}

	/**
	 * [getInstance description]
	 * @param  string $dsn
	 * @param  string $username
	 * @param  string $password
	 * @return PdoConnector instance
	 */
	public static function getInstance( $dsn, $username, $password )
	{
		if ( ! isset(self::$PDOInstance) )
		{
			try
			{
				self::$PDOInstance = new PdoConnector( $dsn, $username, $password );
				return self::$PDOInstance;
			}
			catch( PDOException $e )
			{
				die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
			}
		}

		return self::$PDOInstance;
	}

	public function beginTransaction()
	{
		return self::$PDOInstance->beginTransaction();
	}
	//-- eo beginTransaction

	public function commit()
	{
		return self::$PDOInstance->commit();
	}
	//-- eo commit

	public function errorCode()
	{
		return self::$PDOInstance->errorCode();
	}
	//-- eo errorCode

	/**
	 * [errorInfo description]
	 * @return [type]
	 */
	public function errorInfo()
	{
		return self::$PDOInstance->errorInfo();
	}
	//-- eo errorInfo

	/**
	 * [exec description]
	 * @param  [type] $statement
	 * @return [type]
	 */
	public function exec( $statement ) 
	{
		return self::$PDOInstance->exec( $statement );
	}
	//-- eo exec

	/**
	 * [getAttribute description]
	 * @param  [type] $attribute
	 * @return [type]
	 */
	public function getAttribute( $attribute )
	{
		return self::$PDOInstance->getAttribute( $attribute );
	}
	//-- eo getAttribute

	public function lastInsertId( $name )
	{
		return self::$PDOInstance->lastInsertId( $name );
	}
	//-- eo lastInsertId

	public function prepare( $statement )
	{
		return self::$PDOInstance->prepare( $statement );
	}
	//-- eo prepare

	public function query( $statement )
	{
		return self::$PDOInstance->query( $statement );
	}
	//-- eo query

	public function queryFetchAllAssoc( $statement )
	{
		return self::$PDOInstance->query( $statement )->fetchAll( PDO::FETCH_ASSOC );
	}
	//-- eo queryFetchAllAssoc

	public function queryFetchRowAssoc( $statement )
	{
		return self::$PDOInstance->query( $statement )->fetch( PDO::FETCH_ASSOC );
	}
	//-- eo queryFetchRowAssoc
}
