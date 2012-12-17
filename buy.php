<?php
	session_start();
	$username = $_POST['username'];
	if ($_POST['username'] != "good" || $_POST['password'] != "123456")
	{
		?>
		<html>
			<head>
				<title>stupid</title>
			</head>
			<body><?php
				echo $username;
				?></body>
		</html>
		<?php
	}
	else
	{		
		if (!isset($_COOKIE['id']))
		{
			$_SEESSION['id'] = "undefine";
			$_COOKIE['id'] = "undefine";
			file_put_contents("test.txt", "1000");
		}
		$money = file_get_contents("test.txt");
		$money = (int)($money);
		echo "before:" . $money;
		$money -= 100;
		file_put_contents("test.txt", $money);
		echo "after:" . $money;
	}

?>