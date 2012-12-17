<?php
	session_start();
?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>MyNotes</title>
	</head>
	<body>
<?php
include ("connection/user_controler.php");


	if (checkMd5($_COOKIE['sessionId']) )
	{
		header("Location:friend.php");
		?>
		<p>页面跳转中，请稍后</p>
		<?php
	}
	else
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$isRember = $_POST['remember'];

		$array = user_Login($username,$password);
		if ($array['uid'])
		{
			$expireTime = time() + 60 * 60;
			if ($isRember== true) $expireTime = time() + 60*60*24*30;

			setcookie("username",$username,$expireTime);
			setcookie("email",$array['email'],$expireTime);
			setcookie("sessionId",getMd5($array['uid']),$expireTime);

			$_SESSION['uid'] = $array['uid'];

			header("Location:friend.php");
			?>
			
			<p>页面跳转中，请稍后</p>
			<?php
		}
		else
		{

			header("Location:login.php");
		?>
			<p>服务器异常请重登录</p>
		<?php
		}
	}
?>
	</body>
</html>

<?php

function getMd5($uid)
{
	return md5($uid . "Reader2.0");
}

function checkMd5($sessionId)
{
	return getMd5($_SESSION['uid']) == $sessionId;
}
?>