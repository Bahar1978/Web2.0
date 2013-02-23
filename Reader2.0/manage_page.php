<?php
session_start();
include_once("connection/db_query.php");

if (isset($_SESSION['uid']) )
{
	if (checkAdminByUid($_SESSION['uid']))
	{
		?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>MyNotes</title>
		<script src="js/prototype.js"></script>
		<script src="js/manage_page.js"></script>
	</head>
	<body>
		<h3>欢迎回来，管理员</h3>

		<div id="memberManage">
		</div>

		<div id="addDiv">
			<p>添加成员</p>
			用户名:	<input type="text" id="inputUsername"/></br>
			密码:		<input type="text" id="inputPassword"/></br>
			用户邮箱:	<input type="text" id="inputEmail"/></br>
			<button id="addButton">添加</button>
			<span id="addWarning"></span>
		</div>
	</body>
</html>

		<?php
	}
	else
	{
		$_SESSION = array();
	}
}
else
{
	if (isset($_POST['username']) && isset($_POST['password']))
	{
		if (checkAdmin($_POST['username'],$_POST['password']))
		{
			$_SESSION['uid'] = getAdminUid($_POST['username']);
			header("Location:manage_login.php");
		}
	}
	else
	{
		header("Location:manage_login.php");
	}
}

?>
<?php
function checkAdmin($username,$password)
{
	if ($username != 'root') return false;
	$query = "select * from Users where username='$username' and password='$password'";
	$array = DBSelectResult($query,0);
	if (isset($array['username'])) return $array['uid'];
	else return false;
}	

function checkAdminByUid($uid)
{
	$query = "select * from Users where uid=$uid and username='root'";
	$array = DBSelectResult($query,0);
	if (isset($array['uid'])) return true;
	else return false;
}

function getAdminUid($username)
{
	$query = "select * from Users where username='$username'";
	$array = DBSelectResult($query,0);
	if (isset($array['uid'])) return $array['uid'];
	else return -1;
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