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
    
    static function selectFromDatabase($query){
        
        $mysql = Database::GetConnection();
        $resources = mysql_query($query);
        $result = array();
        $temp   = array();
        $counter = 0;

        if($resources != false)
        while($temp = mysql_fetch_array($resources)){
             $result[$counter] = $temp;
             $counter = $counter + 1;
        }
        Database::CloseConnection($mysql);

        return $result;
    }

    static function getUserName($uid){
       $mysql  = Database::GetConnection();
       $query  = "select username from Users where uid=$uid"; 
       $result = mysql_query($query,$mysql);
       $array  = mysql_fetch_array($result);
       Database::CloseConnection($mysql);
       return $array[0];
   }

}
?>