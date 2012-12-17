<?php
include ("db_connection.php");
header("Content-Type:text/plain");

if (isset($_REQUEST['flag']))
{
	$flag = $_REQUEST['flag'];
}
$result;
switch ($flag) {
	case 'register':
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$result = user_Register($username,$password,$email);
		break;
	
	case 'login':
		$username = $_POST['username'];
		$password = $_POST['password'];
		$result = user_Login($username,$password);
		break;

	case 'update':
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$result = user_EditInfo($username,$password,$email);
		break;

	case 'delete':
		$uid = (int)($_POST['uid']);
		$result = user_Delete($uid);
		break;

	case 'number':
		$result = user_Number();
		break;

	default:
		break;
}
print_r($result);

function user_Number()
{
	$mysql = Database::GetConnection();
	$query = "select count(*) as number from Users";
	$temp = mysql_query($query);
	$array = mysql_fetch_array($temp);
	$result = $array['number'];
	
	Database::CloseConnection($mysql);
	return $result;
}

//if success return true,not success return -1
function user_Register($username,$password,$email)
{
	if (user_Validfy($username,$password,$email))
	{
		$mysql = Database::GetConnection();
		$query = "insert into Users values(NULL,'$email','$password','$username')";
		$result = mysql_query($query,$mysql);
		Database::CloseConnection($mysql);
	}
	else
	{
		$result = -1;
	}
	return $result;
}

function user_Validfy($username,$password,$email)
{
	$flag = true;
	if ($flag)
	{
		$flag = preg_match("/\w{6,20}/", $username);
	}
	if ($flag)
	{
		$flag = preg_match("/\w{6,20}/", $password);
	}
	if ($flag)
	{
		$flag = preg_match("/^[_.0-9a-z-a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,4}$/", $email);
	}
	return $flag;
}

//return associate array
function user_Login($username,$password)
{
	$mysql = Database::GetConnection();
	$query = "select * from Users where username='$username' and password='$password'";
	$result = mysql_query($query,$mysql);
	$result = mysql_fetch_array($result);
	Database::CloseConnection($mysql);
	return $result;
}

function user_Delete($uid)
{
	$mysql = Database::GetConnection();
	$query = "delete from Users where uid='uid'";
	$result = mysql_query($query,$mysql);
	Database::CloseConnection($mysql);
	return $result;
}

//if success,return true
function user_EditInfo($username,$password,$email)
{
	$mysql = Database::GetConnection();
	$query = NULL;
	if ($password)
	{
		$query = "update Users set password='$password'";
		if ($email)
		{
			$query .= ", email='$email' ";
		}
		$query .= "where username='$username'";
	}
	else if ($email)
	{
		$query = "update Users set email='$email' where username='$username'";
	}

	$result;
	if ($query)
	{
		$result = mysql_query($query,$mysql);
	}
	Database::CloseConnection($mysql);
	return $result;
}
?>