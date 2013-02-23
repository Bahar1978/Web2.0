<?php
include_once ("db_connection.php");

//查询数据库并返回数据，数据已为数组格式
//arg为0时表示只有1组查询，arg为1时表示有可能有多组
function DBSelectResult($query,$arg)
{
	if ($arg == 0)
	{	
		$mysql = Database::GetConnection();
		$temp = mysql_query($query,$mysql);

		if ($temp)
			$result = mysql_fetch_array($temp);
		else
			$result = NULL;

		Database::CloseConnection($mysql);
		return $result;
	}
	else
	{
		$mysql = Database::GetConnection();
		$temp = mysql_query($query,$mysql);
		if($temp)		$number = mysql_num_rows($temp);
		else $number = 0;
		
		$result = array();

		for($i = 0; $i < $number; $i ++)
		{
			$arr = mysql_fetch_array($temp);
			$result[$i] = $arr;
		}

		Database::CloseConnection($mysql);
		return $result;
	}
}

//成功返回true,失败返回false
function DBUpdateResult($query)
{
	$mysql = Database::GetConnection();
	$temp = mysql_query($query,$mysql);
	Database::CloseConnection($mysql);
	return $temp;
}

?>