<html>
	<head>
		<title>Group</title>
	</head>

	<body>
		<h3>Create Group</h3>
		<form action="group_controler.php?flag=create" method="POST">
			uid<input type="text" name="uid" /></br>
			groupName<input type="text" name="groupName"/></br>
			description<input type="text" name="description"></br>
			<input type="submit"/>
		</form>

		<h3>Check Group</h3>
		<form action="group_controler.php?flag=check" method="POST">
			groupName<input type="text" name="groupName"/></br>
			<input type="submit"/>
		</form>

		<h3>Get Group Info</h3>
		<form action="group_controler.php?flag=get" method="POST">
			groupName<input type="text" name="groupName"/></br>
			<input type="submit"/>
		</form>

		<h3>Delete Group</h3>
		<form action="group_controler.php?flag=delete" method="POST">
			groupName<input type="text" name="groupName"/></br>
			<input type="submit"/>
		</form>

		<h3>Add Group Member</h3>
		<form action="group_controler.php?flag=addMember" method="POST">
			uid<input type="text" name="uid"/></br>
			gid<input type="text" name="gid"/></br>
			<input type="submit"/>
		</form>

		<h3>Delete Group Member</h3>
		<form action="group_controler.php?flag=deleteMember" method="POST">
			uid<input type="text" name="uid"/></br>
			gid<input type="text" name="gid"/></br>
			<input type="submit"/>
		</form>

		<h3>Add Group Manager</h3>
		<form action="group_controler.php?flag=addManager" method="POST">
			uid<input type="text" name="uid"/></br>
			gid<input type="text" name="gid"/></br>
			<input type="submit"/>
		</form>

		<h3>Delete Group Manager</h3>
		<form action="group_controler.php?flag=deleteManager" method="POST">
			uid<input type="text" name="uid"/></br>
			gid<input type="text" name="gid"/></br>
			<input type="submit"/>
		</form>

	</body>
</html>