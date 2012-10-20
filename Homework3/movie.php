 <!DOCTYPE html>
 <?php
	$directory = GetFilmDirectory();
	$info = GetInfo($directory);
	$rating = (int)$info[2];
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?=$info[0]?> - Rancid Tomatoes</title>
		<link href="movie.css" type="text/css" rel="stylesheet" />
		
		<!--Favorite icon implementation-->
		<?php
			if ($rating < 60){
			?>
 				<link rel="icon" type="image/gif" href="http://222.200.185.14/public/hw2/rotten.gif"/>
 			<?php
 			}
 			else{
 			?>
 				<link rel="icon" type="image/gif" href="http://222.200.185.14/public/hw2/fresh.gif"/>
 			<?php
 			}
 		?>
	</head>

	<body>
		<div class="bannerDiv">
			<img src="http://www.cs.washington.edu/education/courses/cse190m/09sp/homework/2/banner.png" alt="Rancid Tomatoes" />
		</div>

		<h1 class="movieHeadding"><?= $info[0] . '(' . $info[1] . ')'?></h1>
		
		<div class="contentDiv">
			<div class="overViewDiv">
				<img src="<?=GetGeneralPicturePath($directory)?>" alt="general overview" />

				<dl>
					<?php
						$general = GetGeneralOverview($directory);
						for ($i = 0; $i < count($general); $i ++ ){
						?>
								<dt><?=$general[$i][0]?></dt>
								<dd><?=$general[$i][1]?></dd>
						<?php
						}
					?>
				</dl>
			</div>


			<div class="rottenRatingDiv">
				<?php
					if ($rating >= 60){
					?>
						<img id="rottenRatingImage" src="http://my.ss.sysu.edu.cn/wiki/download/attachments/7045943/freshbig.png?version=1&amp;modificationDate=1270162015000" alt="Fresh"/>
					<?php
					}
					else
					{
					?>
						<img id="rottenRatingImage" src="http://www.cs.washington.edu/education/courses/cse190m/09sp/homework/2/rottenbig.png" alt="Rotten" />
					<?php
					}
					?>

				<span id="rottenRatingText"><?=$info[2]?>%</span> <span id="rottenViewsText">(<?=$info[3]?> reviews total)</span>
			</div>
			
			<div class="contentRatingDiv">
				<div class="ratingDetailsDiv">

					<?php
					          $number = GetReviewNumber($directory); 
						for ($i = 1; $i <= $number / 2; $i ++)
						{
							$reviewInfo = GetReviewInfo($directory,$i);
							$imageSrc = "http://www.cs.washington.edu/education/courses/cse190m/09sp/homework/2/rotten.gif";
							$alt = "Rotten";
							if ($reviewInfo[1] === "FRESH") 
							{
								$imageSrc = "http://www.cs.washington.edu/education/courses/cse190m/09sp/homework/2/fresh.gif";
								$alt = "Fresh";
							}
						?>
							<div class="ratingDetailDiv">
								<p class="ratingQuote">
									<img class="ratingImage" src="<?=$imageSrc?>" alt="<?=$alt?>"/>
									<q><?=$reviewInfo[0]?></q>
								</p>
								<p>
									<img class="reviewerImage" src="http://www.cs.washington.edu/education/courses/cse190m/09sp/homework/2/critic.gif" alt="Critic" />
									<?=$reviewInfo[2]?><br/>
									<span class="locationSpan"><?=$reviewInfo[3]?></span>
								</p>
							</div>
						<?php
						}
					?>
				</div>

				<div class="ratingDetailsDiv">
					<?php
						for ($i = floor($number / 2) + 1; $i <= $number; $i ++)
						{
							$reviewInfo = GetReviewInfo($directory,$i);
							$imageSrc = "http://www.cs.washington.edu/education/courses/cse190m/09sp/homework/2/rotten.gif";
							$alt = "Rotten";
							if ($reviewInfo[1] === "FRESH") 
							{
								$imageSrc = "http://www.cs.washington.edu/education/courses/cse190m/09sp/homework/2/fresh.gif";
								$alt = "Fresh";
							}
						?>
							<div class="ratingDetailDiv">
								<p class="ratingQuote">
									<img class="ratingImage" src="<?=$imageSrc?>" alt="<?=$alt?>"/>
									<q><?=$reviewInfo[0]?></q>
								</p>
								<p>
									<img class="reviewerImage" src="http://www.cs.washington.edu/education/courses/cse190m/09sp/homework/2/critic.gif" alt="Critic" />
									<?=$reviewInfo[2]?><br/>
									<span class="locationSpan"><?=$reviewInfo[3]?></span>
								</p>
							</div>
						<?php
						}
					?>
				</div>

			</div>

			<p class="viewBar">(1-<?=$number?>) of <?=$info[3]?></p>
		</div>

		<p>
    			<a href="http://validator.w3.org/check?uri=referer">
    				<img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" />
    			</a>
  			
    			<a href="http://jigsaw.w3.org/css-validator/check/referer">
       			 	<img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" />
    			</a>
		</p>
       
	</body>
</html>

<?php
function GetFilmDirectory ()
{
	$name = $_REQUEST["film"];
	return $name;
}

/*
* First line is title, second is year, third is rating, fourth is review number
*/
function GetInfo($directoryName)
{
	$path = $directoryName . "/" . "info.txt";
	$string = file($path, FILE_IGNORE_NEW_LINES);
	return $string;
}

/*
* generaloverview
*/
function GetGeneralOverview ($directoryName)
{
	$path = $directoryName . "/" . "generaloverview.txt";
	$string = file($path,FILE_IGNORE_NEW_LINES);
	$array = array();
	for ($i = 0; $i < count($string); $i ++ )
		$array[$i] = split(':', $string[$i]);
	return $array;
}

/*
* general overview picture
*/
function GetGeneralPicturePath($directoryName)
{
	return $directoryName . "/" . "generaloverview.png";
}

function GetReviewNumber ($directoryName)
{
	return count(glob($directoryName . "/" . "review*.txt"));
}

/*
*0: comment 1:FRESH OR ROTTEN 2:NAME 3:LOCATION
*/
function GetReviewInfo ($directoryName, $index)
{
	$path = $directoryName . "/" . "review" . $index . ".txt";
	$string = file($path,FILE_IGNORE_NEW_LINES);
	return $string;
}

?>