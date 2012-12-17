<?php
	session_start();
?>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>MyNotes</title>
		<script src="friend.js"></script>
		<script src="prototype.js"/></script>
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

		<div class="bannerDiv">
			<span class="title">MYNotes</span>
			<span><a herf="">笔记</a></span>
			<span><a herf="friend.php">好友</a></span>
			<span><a herf="group.php">小组</a></span>
		</div>

		<div class="informationDiv">
			<div>
				<img src="Image/userImage.png"/>
			</div>
			<div>
				<span>用户名:<?=$_COOKIE['username']?></span></br>
				<span>用户邮箱:<?=$_COOKIE['email']?></span></br>
				<button id="logout">登出</button>
			</div>
		</div>


		<div class="main">
			<p>好友动态</p>

			<div>
				<div>
					<img src="Image/userImage.png"/>
				</div>
				<div>
					<p>XXX添加了评论到XX</p>
					<p>我是评论。。。。。</p>
				</div>
			</div>	

		</div>

		<div id="friendList">
			<p>我的好友</p>

			<div>
				<div>
					<img src="Image/userImage.png"/>
				</div>
				<div>
					<span>csy</span>
					<span>csy@qq.com</span>
				</div>
			</div>

			<div>
				<div>
					<img src="Image/userImage.png"/>
				</div>
				<div>
					<span>txx</span>
					<span>txx@qq.com</span>
				</div>
			</div>

		</div>
	
		<div class="addDiv">
			<input type="text" id="searchContent" value="好友姓名"/>			
			<button id="addButton">添加好友</button></br>
			<span id="warning"></span>
		</div>


		<div id="noteDiv"/>
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