<!--
	Code by 10389223.
	I have only implement the validation extra feature.
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>NerdLuv</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link href="heart.gif" type="image/gif" rel="shortcut icon" />
		<link href="nerdluv.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="main">
			<div id="bannerarea">
				<img src="nerdluv.png" alt="banner logo" /> <br />
				where meek geeks meet
			</div>
			
			<!--validate-->
			<?php
				$inputArray = GetInput();
				$warnInfo = CheckInput($inputArray);

				if ($warnInfo != "" )
				{
					print $warnInfo;
				}
				else if (CheckExist($inputArray,GetSingles()))
				{
					print "user Exist";
				}
				else
				{

					$singles = GetSingles();
				?>

				<div id="matches">
				<h1>Matches for <?=$inputArray[0]?></h1>

				<?php
					for ($i = 0; $i < count($singles); $i ++)
					{
						$score = GetPoint($inputArray,$singles[$i]);
						if ($score < 3) continue;
						else{
							//0 name,1 gender, 2 age, 3 type, 4 os, 5 seekgender, 6 minage, 7 maxage
							$string = split(',', $singles[$i]);
						?>

							<div class="match">
								<p class="name">
									<img src="<?=GetSinglePicturePath($string[0])?>" alt="<?=$string[0]?>"/>
									<?=$string[0]?>
								</p>
							<p class="info">
								<strong>gender:</strong>  <?=$string[1]?> <br />
								<strong>age:</strong>     <?=$string[2]?> <br />
								<strong>type:</strong>    <?=$string[3]?> <br />
								<strong>OS:</strong>      <?=$string[4]?> <br />
								<strong>rating:</strong>  <?=$score?>
							</p>
							</div>
						<?php
						}
					}
					SaveInput($inputArray);
				}
			?>

			
			</div>
		</div>
		
		<p>
			Results and page (C) Copyright 2009 NerdLuv Inc.
		</p>

		<div id="w3c">
			<a href="http://validator.w3.org/check/referer">
				<img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" /></a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS" /></a>
		</div>
	</body>
</html>

<?php
//get the form
function GetInput()
{
	$name = $_REQUEST["name"];//0
	$gender = $_REQUEST["gender"];//1
	$age = $_REQUEST["age"];//2
	$type = $_REQUEST["type"];//3
	$os = $_REQUEST["os"];//4
	$seekMale = $_REQUEST["seekMale"];//5
	$seekFemale = $_REQUEST["seekFemale"];//6
	$minAge = $_REQUEST["minAge"];//7
	$maxAge = $_REQUEST["maxAge"];//8
	return array($name,$gender,$age,$type,$os,$seekMale,$seekFemale,$minAge,$maxAge);
}

//validate the form
function CheckInput($inputArray)
{
	$warnInfo = "";
	if ($inputArray[0] == "")
	{
		$warnInfo = "Error: Invalid user name";
		return $warnInfo;
	}
	else if (preg_match("/\d{1,2}/", $inputArray[2]) == false || (int)$inputArray[2] == 0 )
	{
		$warnInfo = "Error: Invalid age";
		return $warnInfo;
	}
	else if ($inputArray[1] != "genderMale" && $inputArray[2] != "genderFemale")
	{
		$warnInfo = "Error: Invalid gender";
		return $warnInfo;
	}
	else if (preg_match("/[IE][NS][FT][JP]/", $inputArray[3]) == false)
	{
		$warnInfo = "Error: Invalid type";
		return $warnInfo;
	}
	else if ($inputArray[4] != "Windows" && $inputArray[4] != "Linux" 
                && $inputArray[4] != "Mac OS X" && $inputArray[4] != "other")
	{
		$warnInfo = "Error: Invalid OS";
		return $warnInfo;
	}
	else if (isset($inputArray[5]) == false && isset($inputArray[6]) == false)
	{
		$warnInfo = "Error: Invalid seeking";
		return $warnInfo;
	}
	else if (preg_match("/\d{1,2}/", $inputArray[7]) == false || 
		        preg_match("/\d{1,2}/", $inputArray[8]) == false || 
		        (int)$inputArray[7] > (int)$inputArray[8] )
	{
		$warnInfo = "Error: Invalid seeking age";
		return $warnInfo;
	}
	 
	return $warnInfo;
}

//check whether a user exist
function CheckExist($content,$singles)
{
	for ($i = 0; $i < count($singles); $i ++)
	{
		$string = split(',', $singles[$i]);
		if ($content[0] == $string[0] ) 	return ture;
	}
	return false;
}

//save the input
function SaveInput($content)
{
	$name = $content[0];
	$gender = "F";
	if ($content[1] == "genderMale") $gender = "M";
	$age = $content[2];
	$type = $content[3];
	$os = $content[4];
	$seek = "";
	if (isset($content[5])) $seek .= "M";
	if (isset($content[6])) $seek .= "F";
	$minAge = $content[7];
	$maxAge = $content[8];

	$result = $name . "," . $gender . "," . $age . "," . $type . "," . $os . "," . $seek . "," . $minAge . "," . $maxAge;
	$fileContent = file_get_contents("singles.txt") . "\n" . $result;
	file_put_contents("singles.txt", $fileContent);
}

//return all singles information
function GetSingles ()
{
	return file("singles.txt",FILE_IGNORE_NEW_LINES);
}

//get the point of this single
function GetPoint ($inputArray,$content)
{
	//0 name,1 gender, 2 age, 3 type, 4 os, 5 seekgender, 6 minage, 7 maxage
	$string = split(',', $content);
	$score = 0;

	$userSeekMale = $inputArray[5];
	$userSeekFemale = $inputArray[6];
	$applicantGender = $string[1];
	//not this gender
	if ( ( (isset($userSeekMale) && ( $applicantGender == "M"  || $applicantGender == "MF") ) ||
		(isset($userSeekFemale) && ($applicantGender == "F" || $applicantGender == "MF"  )  ) )  
		== false )
		return $score;

	$userAge = (int)$inputArray[2];
	$userMinAge = (int)$inputArray[7];
	$userMaxAge = (int)$inputArray[8];
	$applicantAge = (int)$string[2];
	$applicantMinAge = (int)$string[6];
	$applicantMaxAge = (int)$string[7];

	if ($applicantMinAge <= $userAge && $userAge <= $applicantMaxAge
		&& $userMinAge <= $applicantAge && $applicantAge <= $userMaxAge )
		$score++;

	$userOS = $inputArray[4];
	$applicantOS = $string[4];
	if ($userOS === $applicantOS)
		$score++;

	$userType = $inputArray[3];
	$applicantType = $string[3];
	for ($i = 0; $i < 4; $i ++)
		if ($userType[$i] === $applicantType[$i])
			$score++;
	return $score;
}

//get this single picture
function GetSinglePicturePath($name)
{
	$string = strtolower($name);
	for ($i = 0; $i < strlen($string); $i ++)
	{
		if ($string[$i] == ' ')
		{
			$string[$i] = '_';
		}
	}

	$path = "images/" . $string . ".jpg";
	if (!file_exists($path))
		$path = "images/default_user.jpg";
	return $path;
}
?>
