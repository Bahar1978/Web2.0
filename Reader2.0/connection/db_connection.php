<?php
class Database{
	private static $db_hostname = "localhost";
	private static $db_username = "kaze";
	private static $db_password = "123456";
	private static $db_database = "Web";
	private static $db_connection;

	static function GetConnection()
	{
		self::$db_connection = mysql_connect(self::$db_hostname,self::$db_username,self::$db_password)
						or  die("Unable to connect to mysql:" . mysql_error());

		mysql_select_db(self::$db_database,self::$db_connection) 
			or die("Unable to select database " . self::$db_database . ":" . mysql_error());
		return self::$db_connection;
	}

	static function CloseConnection($mysql)
	{
		if (!$mysql)
		{
			mysql_close($mysql);
		}
	}
}
?>