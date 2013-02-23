<?php
	session_start();
?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>MyNotes</title>
		<script src="js/login.js"></script>
		<script src="js/prototype.js"/></script>
	</head>
	<body>
<?php
	
	if (!isset($_COOKIE['sessionId']) || !checkMd5($_COOKIE['sessionId']))
	{?>

		<div class="bannerDiv">
			<span class="title">MYNotes</span>
		</div>

		<div class="registerDiv">
			<div>
				<span id="note">条笔记</span>
				<span id="comment">条评论 </span>
				<span id="group">个小组</span>
				<span id="user">个用户</span>
			</div>
			<a href="register.php"><strong>加入我们</strong> 注册</a>
		</div>

		<div class="loginDiv">
			<form action="main.php" method="post">
				帐号<input type="text" name="username"/></br>
				密码<input type="password" name="password"/></br>
				记住我<input type="checkbox" name="remember"/>
				<input type="submit" value="登录"/>
			</form>
			<a href="manage_login.php">我是管理员</a>
		</div>

	<?php

	}
	else
	{
		header("Location:friend.php");
		?>

		<p>页面跳转中，请稍后</p>
	<?php
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