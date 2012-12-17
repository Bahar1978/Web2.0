<?php
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>MyNotes</title>
		<link href="group.php" type="text/css" rel="stylesheet"/>
	</head>

	<body>
		<div class="bannerDiv">
			<span class="title">MYNotes</span>
			<span><a herf="">社区</a></span>
			<span><a herf="">好友</a></span>
			<span><a herf="">小组</a></span>
		</div>

		<div class="informationDiv">
			<div>
				<img src="Image/userImage.png"/>
			</div>
			<div>
				<span>用户名:<?=$_COOKIE['username']?></span></br>
				<span>用户邮箱:<?=$_COOKIE['email']?></span>
				<button id="logout">登出</button>
			</div>
		</div>

		<div class="contentDiv">
			<p>添加笔记</p>
			<form action="" method="post">
				标题:<input type="text" name="name"/></br>
				内容:</br>
				<textarea cols="100" rows="30" name="description"></textarea></br>
				添加到：<input type="text" name="objectName"/></br>
				<input type="submit" value="提交"/>
				<input type="button"  value="返回"/>
			</form>
		</div>

	</body>

</html>