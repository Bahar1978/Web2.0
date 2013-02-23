<?php
session_start();
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>MyNotes</title>
		<script src="js/group_create.js"></script>
		<script src="js/prototype.js"/></script>
	</head>

	<body>
		<div class="bannerDiv">
			<span class="title">MYNotes</span>
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

		<div>
			<p>创建小组</p>
			<div>
				小组名字:<input type="text" id="inputGroupName"/></br>
				详细描述:<input type="text" id="inputDescription"></br>
				<input type="hidden" id="inputUid" value="<?=$_SESSION['uid']?>"/></br>
				<span id="warnning"></span></br>
				<button id="addButton">创建</button>
				<button id="cancelButton">返回</button></br>
			</div>
		</div>
	</body>

</html>
