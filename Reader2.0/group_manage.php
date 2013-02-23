<?php
session_start();
include_once("connection/db_query.php");

$gid = $_GET['gid'];
$uid = $_SESSION['uid'];
$groupInfo = GetGroupInfo($gid);
if (CheckManager($uid,$gid) == NULL) header("Location:login.php");

?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>MyNotes</title>
		<script src="js/group_manage.js"></script>
		<script src="js/prototype.js"></script>
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
			<p>管理小组</p>
			<input type="hidden" value="<?=$gid?>" id="inputGid"/>
			<div>
				<p>小组名称:<?=$groupInfo['name']?></p>
				<p>小组描述:<?=$groupInfo['description']?></p>
				<p>创建时间:<?=$groupInfo['since']?></p>
			</div>

			<!--小组成员列表-->
			<div id="memberList"></div>

			<div>
				<input type="text" id="addText"/> 
				<button id="addButton">添加成员</button></br>
				<span id="warning"></span>
			</div>

		</div>
	</body>

</html>

<?php
function GetGroupInfo($gid)
{
	$query = "select * from Groups where gid=$gid";
	$array = DBSelectResult($query,0);
	return $array;
}

function CheckManager($uid,$gid)
{
	$query = "select *from UsersGroupsRelation where uid=$uid and gid=$gid";
	$array = DBSelectResult($query,0);
	return $array;
}

?>