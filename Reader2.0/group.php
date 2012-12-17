<?php

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
			<span><a herf="friend.php">好友</a></span>
			<span><a herf="group.php">小组</a></span>
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


		<div class="groupDiv">
			<p>小组信息</p>

			<div>
				<div>
					<img src="Image/userImage.png"/>
				</div>
				<div>
					<span>小组名：中二病</span></br>
					<span>小组内容：大家都是中二病</span>
				</div>
			</div>	

			<div>
				<span>标题</span>
				<span>对象</span>
				<span>作者</span>
				<span>时间</span>
			</div>

			<div>
				<span>中二病育成方法</span>
				<span>中二病也要谈恋爱</span>
				<span>Kaze</span>
				<span>2012.12.1</span>
			</div>
		</div>
	
		<div class="selectDiv">
			<p>选择小组</p>

			<div>
				<a href="">中二病</a></br>
				<a href="">K</a></br>
				<a href="">LittleBusters</a></br>
			</div>	
		</div>

	</body>

</html>