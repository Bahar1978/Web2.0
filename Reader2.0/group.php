<?php
session_start();
include_once("connection/db_query.php");

$gid = $_GET['gid'];
$array = GetGroupInfo($gid);
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>MyNotes</title>
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


		<div class="groupDiv">
			<p>小组信息</p>

			<div>
				<div>
					<img src="Image/userImage.png"/>
				</div>
				<div>
					<span>小组名：<?=$array['name']?></span></br>
					<span>小组内容：<?=$array['description']?></span>
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
	</body>

</html>

<?php
function GetGroupInfo($gid)
{
	$query = "select *from Groups where gid=$gid";
	return DBSelectResult($query,0);
}

?>