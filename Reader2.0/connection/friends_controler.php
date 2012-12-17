<?php
session_start();
include ("db_connection.php");

if (isset($_REQUEST['flag']))
{
	$flag = $_REQUEST['flag'];
}
$result;
switch ($flag) {
	case 'make':
		$username = $_POST['username'];
		$result = friends_Make($username);
		break;
	
	case 'query':
		$name = $_POST['targetname'];
		$result = friends_Query($name);
		break;

	case 'get':
		$result = friends_Get();
		$result = json_encode($result);
		print $result;
		return;
		break;

	case 'notification':
		$result = friends_Notification();
		$result = json_encode($result);
		print $result;
		return;
		break;

	case 'cancel':
		$username = $_POST['username'];
		$result = friends_Cancel($username);
		break;

	default:
		break;
}
print_r ($result);

function friends_Make($username)
{
	$uid1 = (int)($_SESSION['uid']);

	$mysql = Database::GetConnection();
	$query = "select * from Users where username='$username'";
	$result = mysql_query($query);
	$array = mysql_fetch_array($result);
	$uid2 = (int)$array['uid'];
	friends_MakeById($uid1,$uid2);
	Database::CloseConnection($mysql);

	$result = "成功添加";
	return $result;
}

function friends_MakeById($uid1,$uid2)
{
	$mysql = Database::GetConnection();
	$query = "insert into Friends values($uid1,$uid2)";
	$result = mysql_query($query);
	$query = "insert into Friends values($uid2,$uid1)";
	$result = mysql_query($query);
	$query = "delete from FriendsQuery where uid1=$uid1 and uid2=$uid2";
	$result = mysql_query($query);
	$query = "delete from FriendsQuery where uid1=$uid2 and uid2=$uid1";
	$result = mysql_query($query);
	Database::CloseConnection($mysql);
	return $result; 
}

function friends_Notification()
{
	$uid = (int)($_SESSION['uid']);
	$mysql = Database::GetConnection();
	$query = "select * from FriendsQuery where uid2 = $uid";
	$temp = mysql_query($query);
	$result = array();


	$number = mysql_num_rows($temp);
	for ($i = 0; $i < $number; $i ++)
	{
		$array = mysql_fetch_array($temp);
		$targetId = (int)($array['uid1']);
		$query = "select * from Users where uid=$targetId";
		$temp2 = mysql_query($query);
		$array = mysql_fetch_array($temp2);
		$result[count($result)] = $array['username'];
	}
	

	Database::CloseConnection($mysql);
	return $result;
}

function friends_Query($name)
{
	$uid1 = (int)($_SESSION['uid']);
	$mysql = Database::GetConnection();
	$query = "select * from Users where username='$name'";
	$temp = mysql_query($query);
	if (mysql_num_rows($temp) > 0)
	{
		$array = mysql_fetch_array($temp);
		$uid2 = (int)($array['uid']);

		if ($uid2 == $uid1)
		{
			$result = "不能添加自己为好友";
		}
		else{
			$query = "select * from Friends where uid1=$uid1 and uid2=$uid2";
			$temp = mysql_query($query);
			if (mysql_num_rows($temp) > 0)
			{
				$result = "与用户" . $name . "已为好友";
			}
			else
			{
				$query = "select * from FriendsQuery where uid1=$uid1 and uid2=$uid2";
				$temp = mysql_query($query);
				if (mysql_num_rows($temp) > 0)
				{
					$result = "请求已发送";
				}
				else
				{
					$since = date("Y-m-d H:i:s");
					$query = "insert into FriendsQuery values($uid1,$uid2,'$since')";
					$result = mysql_query($query);
					$result = "请求已发送";
				}
			}
		}
	}
	else
	{
		$result = "用户不存在";
	}

	Database::CloseConnection($mysql);
	return $result;
}

//return friends info
function friends_Get()
{
	$uid1 = (int)($_SESSION['uid']);
	$mysql = Database::GetConnection();
	$query = "select * from Friends where uid1=$uid1";
	$temp = mysql_query($query);
	
	$num = mysql_num_rows($temp);
	$result = array();
	for ($i = 0; $i < $num; $i ++)
	{
		$array = mysql_fetch_array($temp);
		$uid2 = (int)($array['uid2']);
		$query = "select * from Users where uid=$uid2";
		$innerTemp = mysql_query($query);
		$array = mysql_fetch_array($innerTemp);

		$number = count($result);
		$result[$number] = array();
		$result[$number]['username'] = $array['username'];
		$result[$number]['email'] = $array['email'];
	}

	Database::CloseConnection($mysql);
	return $result;
}


function friends_Cancel($username)
{
	$uid1 = (int)($_SESSION['uid']);
	$mysql = Database::GetConnection();
	$query = "select * from Users where username='$username'";
	$result = mysql_query($query);
	$array = mysql_fetch_array($result);
	$uid2 = (int)$array['uid'];
	friends_CancelById($uid1,$uid2);
	Database::CloseConnection($mysql);
	$result = "删除成功";
	return $result;
}

function friends_CancelById($uid1,$uid2)
{
	$mysql = Database::GetConnection();
	$query = "delete from FriendsQuery where uid1=$uid1 and uid2=$uid2";
	$result = mysql_query($query);
	$query = "delete from FriendsQuery where uid1=$uid2 and uid2=$uid1";
	$result = mysql_query($query);
	Database::CloseConnection($mysql);
	return $result;
}

function getMd5($uid)
{
	return md5($uid . "Reader2.0");
}

function checkMd5($sessionId)
{
	return getMd5($_SESSION['uid']) == $sessionId;
}
?>