<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Buy Your Way to a Better Education!</title>
		<link href="buyagrade.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<?php
			$name = $_POST["name"];
			$section = $_POST["section"];
			$creditNumber = $_POST["creditNumber"];
			$creditType = $_POST["creditType"];
			$fillCheck = ($name <> "") && ($section <> "") && ($creditNumber <> "") 
					&& ($creditType <> "");
		
		if ($fillCheck){
			
			if (preg_match("/\d{4}\-\d{4}\-\d{4}\-\d{4}", subject))
				$temp = split('-', $creditNumber);
			$creditNumber = "";
			for ($i = 0; $i < count($temp); $i ++)
				$creditNumber .= $temp[$i];

			if ($creditType === "Visa") 
				$creditCheck = preg_match("/[4]\d{15}/", $creditNumber);
			else if ($creditType === "MasterCard")
				$creditCheck = preg_match("/[5]\d{15}/", $creditNumber);
			
			if ($creditCheck) $creditCheck = LuhmAlgorithm($creditNumber);


			if ($creditCheck){
			?>
				<h1>Thanks, sucker!</h1>

				<p>Your information has been recorded.</p>

				<dl>
					<dt>Name</dt>
					<dd><?= $name?></dd>

					<dt>Section</dt>
					<dd><?= $section?></dd>

					<dt>Credit Card</dt>
					<dd>
						<?= $creditNumber?>(<?= $creditType?>)
					</dd>
				</dl>

				<?php
					$filename = "suckers.txt";
					$content = file_get_contents($filename);
					$content .= $name . ";" . $section . ";" . $creditNumber . ";" . $creditType . "\n";
					file_put_contents($filename, $content);
				?>
				<pre><?= $content?></pre>
			<?php
			}
			else{
			?>
				<h1>Sorry</h1>
				<p>
				You didn't provide a valid credit number.
				<a href="buyagrade.htm">Try again?</a>
				</p>
			<?php
			}
		
		}
		else{
		?>
			<h1>Sorry</h1>
			<p>
				You didn't fill out the form completely.
				<a href="buyagrade.htm">Try again?</a>
			</p>

		<?php
		}
		?>

	</body>
</html>  

<?php
function  LuhmAlgorithm ($number)
{
	$number = (int)$number;
	$sum = 0;
	$count = 0;
	while ($number != 0)
	{
		$remainder = $number % 10;
		$number = $number / 10;
		if ($count % 2 == 0) $sum += $remainder;
		else
		{
			$remainder *= 2;
			if ($remainder < 10) $sum += $remainder;
			else $sum += 1 + $remainder % 10;
		}

		$count = $count + 1;
	}

	if ($sum % 10 == 0) return true;
	else return false;
}
?>