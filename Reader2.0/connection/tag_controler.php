<?php
include ("db_connection.php");

if (isset($_REQUEST['flag']))
{
	$flag = $_REQUEST['flag'];
}
$result;
switch ($flag) {
	case 'create':
		$description = $_POST['description'];
		$uid = (int)($_POST['uid']);
		$oid = (int)($_POST['oid']);
		$result = tag_Create($description,$uid,$oid);
		break;
	
	case 'delete':
		$tid = (int)($_POST['tid']);
		$result = tag_Delete($tid);
		break;

	case 'find':
		$tid = (int)($_POST['tid']);
		$result = tag_Find($tid);
		break;

	default:
		break;
}
print_r($result);

function tag_Create($description,$uid,$oid)
{
	$mysql = Database::GetConnection();
	$query = "insert into Tag values(NULL,'$description',$uid,$oid)";
	$result = mysql_query($query,$mysql);
	Database::CloseConnection($mysql);
	return $result;
}

function tag_Delete($tid)
{
	$mysql = Database::GetConnection();
	$query = "select * from Tag where tid=$tid";
	$result = mysql_query($query,$mysql);
	Database::CloseConnection($mysql);
	return $result;
}

//return an array of this infomation
function tag_Find($tid)
{
	$mysql = Database::GetConnection();
	$query = "select * from Tag where tid=$tid";
	$result = mysql_query($query,$mysql);

	$number = mysql_num_rows($result);
	$array = [];

	for ($i = 0;$i < $number; $i ++)
	{
		$row = mysql_fetch_array($result);
		$array[count($array)] = $row;
	}


	Database::CloseConnection($mysql);
	return $array;
}
?>