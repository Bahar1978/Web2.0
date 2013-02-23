<?php
session_start();
?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>MyNotes</title>
	</head>
	<body>
		<div>
			<form action="manage_page.php" method="post">
				帐号<input type="text" name="username"/></br>
				密码<input type="password" name="password"/></br>
				<input type="submit" value="登录"/>
			</form>
		</div>
	</body>
</html>
