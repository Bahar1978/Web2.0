<!--Code by 10389223-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<!-- CSE 190 M Homework 4 (NerdLuv) -->
	<head>
		<title>NerdLuv</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link href="http://ssw2p.3322.org/public/hw4/heart.gif" type="image/gif" rel="shortcut icon" />
		<link href="nerdluv.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="main">
			<div id="bannerarea">
				<img src="nerdluv.png" alt="banner logo" /> <br />
				where meek geeks meet
			</div>

			<form id="form" action="results.php" method="post" >
				<fieldset class="fieldset" >
					<legend id="legendArea">New User Signup:</legend>
					
					<div>
						<label>
							<span class="textLabel">Name:</span>
							<input type="text" name="name" class="setLabel" size="16" maxlength="16"/>
						</label>
					</div>
					
					<div>
						<span class="textLabel">Gender:</span>
						<label>
							<input type="radio" name="gender" value="genderMale" class="setLabel"/> Male
						</label>
						<label>
							<input type="radio" name="gender" value="genderFemale" class="setLabel" checked="checked"/>Female
						</label>
					</div>
					
					<div>
						<label>
							<span class="textLabel">Age:</span>
							<input type="text" name="age" class="setLabel" size="5" maxlength="2"/>
						</label>
					</div>

					<div>
						<label>
							<span class="textLabel">Personality type:</span>
							<input type="text" name="type" class="setLabel" size="5" maxlength="4"/>
							(<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know your type?</a>)
						</label>
					</div>

					<div>
						<span class="textLabel">Favorite OS:</span>
						<select  name="os" class="setLabel">
							<option>Windows</option>
							<option>Mac OS X</option>
							<option>Linux</option>
							<option>other</option>
						</select>
					</div>

					<div id="seeking">
						<span class="textLabel">Seeking:</span>
						<label>
							<input type="checkbox" name="seekMale" class="setLabel" checked="checked"/>Male
						</label>
						<label>
							<input type="checkbox" name="seekFemale" class="setLabel"/>Female
						</label>
					</div>


					<div>
						<span class="textLabel">Between ages:</span>
						<input type="text" name="minAge" class="setLabel" size="5" maxlength="2"/>
						and<input type="text" name="maxAge" class="setLabel" size="5" maxlength="2"/>
					</div>

					<div>
						<input type="submit" value="Sign Up" id="submitLabel"/>
					</div>
				</fieldset>
			</form>
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

	