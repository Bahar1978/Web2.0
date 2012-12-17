<html>
	<head>
		<title>Comments</title>
	</head>

	<body>
		<h3>Create Comments</h3>
		<form action="comments_controler.php?flag=create" method="POST">
			uid<input type="text" name="uid" /></br>
			oid<input type="text" name="oid"/></br>
			description<input type="text" name="description"/></br>
			<input type="submit"/>
		</form>

		<h3>Delete Comments</h3>
		<form action="comments_controler.php?flag=delete" method="POST">
			cid<input type="text" name="cid" /></br>
			<input type="submit"/>
		</form>

		<h3>Update Comments</h3>
		<form action="comments_controler.php?flag=update" method="POST">
			cid<input type="text" name="cid" /></br>
			description<input type="text" name="description"/></br>
			<input type="submit"/>
		</form>

	</body>
</html>