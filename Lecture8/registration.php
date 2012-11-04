<html>
	<head>
		<meta charset="utf-8"/>
		<title>Registration</title>
	</head>
	<body>
		<form action = "test.php" method="post">
			<label for="firstname">*First Name</label>
				<input type="text" name="firstname" id="firstname"/>
			<br/>
			<p>Given Name</p>

			<label for="lastname">*Last Name</label>
				<input type="text" name="lastname" id="lastname"/>
			<br/>
			<p>Surname</p>

			<label for="country">*Country</label>
				<select name="country" id="country">
					<option>China</option>
					<option>American</option>
					<<option>Japan</option>
				</select>
			<br/>

			<input type="submit" value="submit"/>
		</form>

		<form>
			<input type="file" name="avatar"/>
		</form>
	</body>

</html> 
