<?php
	session_start();
?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>MyNotes</title>
		<script src="js/friend.js"></script>
		<script src="js/prototype.js"/></script>
	</head>
	<body>


		<?php

			
			$flag = true;
			if (!checkMd5($_COOKIE['sessionId']))
			{
				$flag = false;
			}

			if ($flag == false)		
			{
				header("Location:login.php");
			}
			else
			{
				
		?>

		<!--标题栏-->
		<div class="bannerDiv">
			<span class="title">MYNotes</span>
		</div>

		<!--用户信息栏-->
		<div class="informationDiv">
			<div>
				<?php
					if (file_exists("user/" . $_COOKIE['username'] . ".jpg"))
						$src = "user/" . $_COOKIE['username'] . ".jpg";
					else $src = "Image/userImage.png"; 
				?>
				<img src="<?=$src?>"/>
			</div>
			<div>
				<span>用户名:<?=$_COOKIE['username']?></span></br>
				<span>用户邮箱:<?=$_COOKIE['email']?></span></br>
				<button id="logout">登出</button>
			</div>
		</div>

		<!--好友功能-->
		<div>
			<!--好友列表-->
			<div id="friendList"></div>
		
			<!--添加好友栏-->
			<div class="addDiv">
				<input type="text" id="searchContent" value="好友姓名"/>			
				<button id="addButton">添加好友</button></br>
				<span id="warning"></span>
			</div>

			<!--好友添加通知栏-->
			<div id="noteDiv"></div>
		</div>
 
 		<!--小组功能-->
 		<div>
			<!--小组列表-->
			<div id="groupList"></div>

			<!--创建小组-->
			<a href="group_create.php">创建小组</a></br>

			<!--管理小组-->
			<div id="groupManageList"></div>
		</div>

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