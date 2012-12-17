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
		$name = $_POST['name'];
		$uid = (int)($_POST['uid']);
		$result = object_Create($name,$description,$uid);
		break;
	
	case 'delete':
		$oid = (int)($_POST['oid']);
		$result = object_Delete($oid);
		break;

	case 'update':
		$oid = (int)($_POST['oid']);
		$description = $_POST['description'];
		$name = $_POST['name'];
		$result = object_Update($oid,$name,$description);
		break;

	default:
		break;
}
print_r($result);


function object_Create($name,$description,$uid)
{
	$since = date("Y-m-d H:i:s");
	$mysql = Database::GetConnection();
	$query = "insert into Objects values(NULL,'$name','$description',$uid,'$since')";
	$result = mysql_query($query);
	Database::CloseConnection($mysql);
	return $result;
}

function object_Delete($oid)
{
	$mysql = Database::GetConnection();
	$query = "delete from Objects where oid=$oid";
	$result = mysql_query($query);
	Database::CloseConnection($mysql);
	return $result;
}

function object_Update($oid,$name,$description)
{
	$since = date("Y-m-d H:i:s");
	$mysql = Database::GetConnection();
	$query = "update Objects set name='$name',description='$description' where oid=$oid";
	$result = mysql_query($query);
	Database::CloseConnection($mysql);
	return $result;
}

?>