<html>
	<head>
		<title>Tag</title>
	</head>

	<body>
		<h3>Create Tag</h3>
		<form action="tag_controler.php?flag=create" method="POST">
			description<input type="text" name="description" /></br>
			uid<input type="text" name="uid"/></br>
			oid<input type="text" name="oid"/></br>
			<input type="submit"/>
		</form>

		<h3>Delete Tag</h3>
		<form action="tag_controler.php?flag=delete" method="POST">
			tid<input type="text" name="tid" /></br>
			<input type="submit"/>
		</form>

		<h3>Find Tag</h3>
		<form action="object_controler.php?flag=find" method="POST">
			tid<input type="text" name="tid" /></br>
			<input type="submit"/>
		</form>

	</body>
</html>