<?php
include ("db_connection.php");
header("Content-Type:text/plain");

if (isset($_REQUEST['flag']))
{
	$flag = $_REQUEST['flag'];
}
$result;
switch ($flag) {
	case 'number':
		$result = comments_Number();
		break;

	case 'create':
		$description = $_POST['description'];
		$uid = (int)($_POST['uid']);
		$oid = (int)($_POST['oid']);
		$result = comments_Create($description,$uid,$oid);
		break;
	
	case 'delete':
		$cid = (int)($_POST['cid']);
		$result = comments_Delete($cid);
		break;

	case 'update':
		$cid = (int)($_POST['cid']);
		$description = $_POST['description'];
		$result = comments_Update($cid,$description);
		break;

	default:
		break;
}
print_r($result);

function comments_Number()
{
	$mysql = Database::GetConnection();
	$query = "select count(*) as number from Comments";
	$temp = mysql_query($query);
	$array = mysql_fetch_array($temp);
	$result = $array['number'];
	
	Database::CloseConnection($mysql);
	return $result;
}


function comments_Create($description,$uid,$oid)
{
	$since = date("Y-m-d H:i:s");
	$mysql = Database::GetConnection();
	$query = "insert into Comments values(NULL,'$description',$uid,$oid,'$since')";
	$result = mysql_query($query);
	Database::CloseConnection($mysql);
	return $result;
}

function comments_Delete($cid)
{
	$mysql = Database::GetConnection();
	$query = "delete from Comments where cid=$cid";
	$result = mysql_query($query);
	Database::CloseConnection($mysql);
	return $result;
}

function comments_Update($cid,$description)
{
	$since = date("Y-m-d H:i:s");
	$mysql = Database::GetConnection();
	$query = "update Comments set description='$description', since='$since' where cid=$cid";
	$result = mysql_query($query);
	Database::CloseConnection($mysql);
	return $result;
} 

?>