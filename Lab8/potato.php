<?php
header("Content-Type: text/plain");

$textPath = "potato.txt";

if (isset($_POST['accessories']))
{
	file_put_contents($textPath,$_POST['accessories']);
	echo $_POST['accessories'];
}
else
{
	if (file_exists($textPath))
	{
		$content = file_get_contents($textPath);
		echo $content;
	}
	else
	{
		$handle = fopen($textPath,'w');
		fclose($handle);
		echo "";
	}
}
?>