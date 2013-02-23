<?php
include_once("connection/db_query.php");

if (!isset($_POST['username']) || !isset($_POST['password']) ||
       !isset($_POST['email']))
{
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>MyNotes</title>
		<script src="js/register.js"></script>
		<script src="js/prototype.js"/></script>
	</head>

	<body>
		<div class="bannerDiv">
			<span class="title">MYNotes</span>
		</div>

		<div>
			<form action="register.php" method="post" enctype="multipart/form-data">
				用户名: <input type="text"  id="username" name="username"/></br>
				密码: <input type="password" id="password" name="password"/></br>
				电子邮件: <input type="text" id = "email" name="email"/></br>
				用户头像:<input type="file" id="file" name="file"/></br>
				<input type="submit" value="提交"/>
				<input type="button" id="cancelButton" value="取消"/>
			</form>
		</div>
	</body>

</html>
<?php
}
else
{
	register();
}
?>


<?php
function register()
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$query = "insert into Users values(NULL,'$email','$password','$username')";

	if (isset($_FILES['file']))
	{
		if ($_FILES['file']['type'] == "image/jpeg")
		{
			if($_FILES['file']['error'] > 0) 
				echo "UpdateLoadError:" . $_FILES['file']['error'];
			else if ($_FILES['file']['size'] > 1024 * 1024)
				echo "File size over max size";
			else
			{
				if (file_exists("user/" . $username . ".jpg"))
					echo "user exists";
				else 
				{
					move_uploaded_file($_FILES['file']['tmp_name'], "user/" . $username . ".jpg");
					if (!DBUpdateResult($query))
						echo "user exists";
					else header("Location:login.php");
				}
			}
		}
		else echo "error file type";
	}
	else
	{
		if (!DBUpdateResult($query))
			echo "user exist";
		else header("Location:login.php");
	}
}
?>