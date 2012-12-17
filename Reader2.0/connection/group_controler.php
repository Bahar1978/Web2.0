<?php
include ("db_connection.php");
header("Content-Type:text/plain");


if (isset($_REQUEST['flag']))
{
	$flag = $_REQUEST['flag'];
}
$result;
switch ($flag) {
	case 'create':
		$uid = (int)($_POST['uid']);
		$groupName = $_POST['groupName'];
		$description = $_POST['description'];
		$result = group_Create($uid,$groupName,$description);
		break;

	case 'get':
		$groupName = $_POST['groupName'];
		$result = group_Get($groupName);
		break;

	case 'check':
		$groupName = $_POST['groupName'];
		$result = group_Exist($groupName);
		break;

	case 'delete':
		$groupName = $_POST['groupName'];
		$result = group_Delete($groupName);
		break;

	case 'addMember':
		$uid = (int)($_POST['uid']);
		$gid = (int)($_POST['gid']);
		$result = group_AddMember($uid,$gid);
		break;

	case 'deleteMember':
		$uid = (int)($_POST['uid']);
		$gid = (int)($_POST['gid']);
		$result = group_DeleteMember($uid,$gid);
		break;

	case 'addManager':
		$uid = (int)($_POST['uid']);
		$gid = (int)($_POST['gid']);
		$result = group_AddManager($uid,$gid);
		break;

	case 'deleteManager':
		$uid = (int)($_POST['uid']);
		$gid = (int)($_POST['gid']);
		$result = group_DeleteManager($uid,$gid);
		break;

	case 'number':
		$result = groups_Number();
		break;

	default:
		break;
}
print_r($result);

function groups_Number()
{
	$mysql = Database::GetConnection();
	$query = "select count(*) as number from Groups";
	$temp = mysql_query($query);
	$array = mysql_fetch_array($temp);
	$result = $array['number'];
	
	Database::CloseConnection($mysql);
	return $result;
}

//if success return gid
function group_Create($uid,$groupName,$description)
{
	$result = false;

	$gid = group_AddGroup($groupName,$description);
	if ($gid != -1)
	{
		$result1 = group_AddManager($uid,$gid);
		$result2 = group_AddMember($uid,$gid);
	}
	return $gid;
}

function group_Get($groupName)
{
	$mysql = Database::GetConnection();
	$query = "select * from Groups where name='$groupName'";
	$result = mysql_query($query,$mysql);
	$array = mysql_fetch_array($result);
	Database::CloseConnection($mysql);
	return $array;
}


//if group exist return  gid,else -1
function group_Exist($groupName)
{
	$mysql = Database::GetConnection();
	$query = "select * from Groups where name='$groupName'";
	$result = mysql_query($query,$mysql);
	$array = mysql_fetch_array($result);
	Database::CloseConnection($mysql);

	if ($result) return (int)($array['gid']);
	else return -1;
}

//delete this group, if success, return true, else false
function group_Delete($groupName)
{
	$mysql = Database::GetConnection();
	$query = "delete from Groups where name='$groupName'";
	$result = mysql_query($query,$mysql);
	Database::CloseConnection($mysql);

	return $result;
}

//if success return gid,else(exist) -1;
function group_AddGroup($name,$description)
{
	$since = date("Y-m-d H:i:s");
	$mysql = Database::GetConnection();
	$query = "insert into Groups values(NULL,'$name','$description','$since')";
	$result = mysql_query($query,$mysql);

	$gid = -1;
	if ($result)
	{
		$query = "select * from Groups where name='$name'";
		$result = mysql_query($query,$mysql);
		$array = mysql_fetch_array($result);
		$gid = (int)($array['gid']);

	}

	Database::CloseConnection($mysql);

	return $gid;
}

//if success return true;
function group_AddManager($uid,$gid)
{
	$since = date("Y-m-d H:i:s");
	$mysql = Database::GetConnection();
	$query = "insert into UsersGroupsManage values($uid,$gid,'$since')";
	$result = mysql_query($query,$mysql);
	Database::CloseConnection($mysql);
	return $result;
}

function group_DeleteManager($uid,$gid)
{
	$mysql = Database::GetConnection();
	$query = "delete from UsersGroupsManage where uid=$uid and gid=$gid";
	$result = mysql_query($query,$mysql);
	Database::CloseConnection($mysql);
	return $result;
}

//if success return true
function group_AddMember($uid,$gid)
{
	$since = date("Y-m-d H:i:s");
	$mysql = Database::GetConnection();
	$query = "insert into UsersGroupsRelation values($uid,$gid,'$since')";
	$result = mysql_query($query,$mysql);
	Database::CloseConnection($mysql);
	return $result;
}

function group_DeleteMember($uid,$gid)
{
	$mysql = Database::GetConnection();
	$query = "delete from UsersGroupsRelation where uid=$uid and gid=$gid";
	$result = mysql_query($query,$mysql);
	Database::CloseConnection($mysql);
	return $result;
}
?>